 <?php
 class jobsQueue{
	function initialize_queue(&$bean, $event, $arguments){
		global $db, $timedate;
		$now = $timedate->nowDb();
		$before_date = $this->getNextWorkingDay();
		$count = 1;
		$project_due_date = '';
		$logic_where = '';
		if(!empty($bean) && $bean != ''){
			$p1 = html_entity_decode($bean->parameter_1, ENT_QUOTES | ENT_HTML);
			$project_due = $timedate->to_db($bean->project_due_date);
			if(empty($project_due) || $project_due == '')
				$project_due = $bean->project_due_date;
			$logic_where = " AND jobs.project_id = '{$bean->project_id}' AND jobs.project_due_date = '{$project_due}'
				AND IFNULL(jobs.parameter_1,'') = '".addslashes($p1)."'";
		}
		$sql ="SELECT jobs.id AS job_id, jobs.project_due_date, estimated_mins, activity_count, pt.order_number
				FROM jobs
				INNER JOIN project_task pt
					ON (jobs.project_task_id = pt.id AND pt.deleted=0)
				WHERE jobs.deleted=0 AND jobs.status IN('Ready','Started','In Progress','Not Ready','Issue','Defer','On Hold')
					AND jobs.project_due_date <= '{$before_date}'
						{$logic_where}
				ORDER BY jobs.project_due_date DESC,pt.order_number+0 DESC";
		$result = $db->query($sql, true);
		while($row = $db->fetchByAssoc($result)){
			if($project_due_date != $row['project_due_date']){
				$project_due_date = $row['project_due_date'];
				$job_due_date = $project_due_date;
			}else{
				$job_due_date = $estimated_start;
			}

			$date = $job_due_date;
			if(is_null($row['activity_count'])){
				$estimated_effort = $row['estimated_mins'];
			}else{
				$estimated_effort = ($row['estimated_mins'] * $row['activity_count']);
			}
			$time = strtotime($date);
			$time = $time - ( $estimated_effort * 60);
			$estimated_start = date("Y-m-d H:i:s", $time);
			$sql_update_order = "UPDATE jobs
							SET jobs.estimated_start='{$estimated_start}', jobs_date_time ='{$job_due_date}'
							WHERE jobs.id='{$row['job_id']}'";
			$db->query($sql_update_order, true);
		}
		return;
	}
	function refresh_queue(){
		global $db,$timedate;
		$now = $timedate->nowDb();
		$before_date = $this->getWorkDaysToSort();
		$this->calculate_priority_ratio($before_date);
		$count = 1;
		$sql ="SELECT jobs.id AS job_id
				FROM jobs
				WHERE jobs.deleted=0 AND jobs.status IN('Ready','Started','In Progress','Not Ready','Issue','Defer','On Hold')
				AND jobs.project_due_date <= '{$before_date}' AND jobs.estimated_start<= '{$before_date}'
				ORDER BY jobs.priority_ratio DESC,jobs.priority_ratio_numerator DESC";
		$result = $db->query($sql, true);
		while($row = $db->fetchByAssoc($result)){
			$sql_update_order = "UPDATE jobs
							SET  jobs.order_number ='{$count}'
							WHERE jobs.id='{$row['job_id']}'";
			$db->query($sql_update_order, true);
			$count++;
		}
		return;
	}
	function getNextWorkingDay(){
		global $db,$timedate;
		$date = $timedate->nowDbDate();
		$select="SELECT value from config where name='workdays_to_initialize' AND category='queue'";
		$result = $db->query($select, true);
		$row = $db->fetchByAssoc($result);
		$add_day = (int)$row['value'];
		$new_date = gmdate('Y-m-d', strtotime("$date +$add_day weekdays"));
		return $new_date;
	}
	function getWorkDaysToSort(){
		global $db,$timedate;
		$date = $timedate->nowDbDate();
		$select="SELECT value from config where name='workdays_to_sort' AND category='queue'";
		$result = $db->query($select, true);
		$row = $db->fetchByAssoc($result);
		$add_day = (int)$row['value'];
		$new_date = gmdate('Y-m-d', strtotime("$date +$add_day weekdays"));
		return $new_date;
	}
	function calculate_priority_ratio($before_date){
		global $db,$timedate,$log;
		$now = time();

		//$now is Unix timestamp in UTC

		$sql ="SELECT id AS job_id, project_due_date, estimated_start AS start_time
		FROM jobs
		WHERE jobs.deleted=0 AND jobs.status IN('Ready','Started','In Progress','Not Ready','Issue','Defer','On Hold')
		AND jobs.project_due_date <= '{$before_date}'
		ORDER BY project_due_date DESC,estimated_start DESC";
		$result = $db->query($sql, true);
		while($row = $db->fetchByAssoc($result)){

			if (is_null($row['start_time'])){
				$priority_ratio=-1;

			} else {

				//add ." UTC" to strtotime function to force UTC
				$deliverable_due_time = strtotime($row['project_due_date']." UTC");
				$job_start_time = strtotime($row['start_time']." UTC");

				$diff = $deliverable_due_time - $job_start_time;

				$priority_ratio_numerator = round($diff/3600,3);


				$due = date('Y-m-d', $deliverable_due_time);
				$today = date('Y-m-d', $now);

				//special function to use UTC  (NOT mkktime)
				$today_begin = gmmktime(13,30,0);
				$today_end = gmmktime(22,30,0);


				if ($deliverable_due_time < $now){
					//due in the past

					$priority_ratio = 999;

				}else if (($due == $today) && ($now >= $today_begin) && ($now <= $today_end)){
					//same day

					$diff = $deliverable_due_time - $now;
					$priority_ratio_denominator = round($diff/3600,3);

					$priority_ratio = round($priority_ratio_numerator/$priority_ratio_denominator,3);

				}else if (($due == $today) && ($now > $today_end)){
 					//same day and after working hours

					$priority_ratio = 999;

 				}else{
					// due on a future date (also includes jobs that are due today but current time is before 8:30am)

					$due_start = new DateTime();
					$due_start->setTimezone(new DateTimeZone('UTC'));
					$due_start->setTimestamp($deliverable_due_time);

					$due_start->setTime(13, 30);   //converted due date to UTC and now setting start time for that date to 8:30am

					$biz_days = $this->number_of_working_days($today, $row['project_due_date']);

					if ($biz_days == 1){

						$diff = $deliverable_due_time - $due_start->getTimestamp();

					} else if ($biz_days == 2){

						$diff = ($deliverable_due_time - $due_start->getTimestamp()) + max(($today_end - $now),0);
						//$log->fatal('job_id =  '.$row['job_id'].' has biz_days=2 with diff = '.$diff.' and due_start = '.$due_start->getTimestamp().' and today_end = '.$today_end);

					} else {

						$diff = ($deliverable_due_time - $due_start->getTimestamp()) + max(($today_end - $now),0) + (8 * 60 * 60 * ($biz_days - 2));
					}

					$priority_ratio_denominator = round(($diff/3600),3);

					$priority_ratio = round($priority_ratio_numerator/$priority_ratio_denominator,3);

					//$log->fatal('due on future date job_id =  '.$row['job_id'].'   deliverable due date = '.$deliverable_due_time.'  job start time = '.$job_start_time.'   current_time = '.$now.'	priority_ratio = '.$priority_ratio.'   priority_ratio_numerator = '.$priority_ratio_numerator.'   diff = '.$diff.'   biz days = '.$biz_days.'   priority_ratio_denominator = '.$priority_ratio_denominator);

				}

				//$log->fatal('job_id =  '.$row['job_id'].'   deliverable due date = '.$deliverable_due_time.'  job start time = '.$job_start_time.'   current_time = '.$now.'	priority_ratio = '.$priority_ratio.'   priority_ratio_numerator = '.$priority_ratio_numerator);

				$update_priority_ratio="Update jobs SET priority_ratio='{$priority_ratio}' , priority_ratio_numerator='{$priority_ratio_numerator}' WHERE id='{$row['job_id']}'";
				$db->query($update_priority_ratio, true);
			}

		}
		return true;
	}
	function calculate_priority_ratio_old($before_date){
		global $db,$timedate,$log;
		$now = $timedate->nowDb();
		$sql ="SELECT id AS job_id, project_due_date, estimated_start AS start_time
		FROM jobs
		WHERE jobs.deleted=0 AND jobs.status IN('Ready','Started','In Progress','Not Ready','Issue','Defer','On Hold')
		AND jobs.project_due_date <= '{$before_date}'
		ORDER BY project_due_date DESC,estimated_start DESC";
		$result = $db->query($sql, true);
		while($row = $db->fetchByAssoc($result)){
			$working_day_hours= ($this->number_of_working_days($timedate->nowDb(), $row['project_due_date']))*8;
			$date_diff = $this->time_to_decimal($row['project_due_date']) + $working_day_hours;
			$start_time = $this->time_to_decimal($row['start_time']) + $working_day_hours;
			$priority_ratio = round((($date_diff - $start_time) / ($date_diff - $this->time_to_decimal($now))),3);
			if($priority_ratio < 0) $priority_ratio = 999;
			$priority_ratio_numerator = round(($date_diff - $start_time),3);
			$log->debug('job_id =  '.$row['job_id'].'   project_due_date = '.$row['project_due_date'].'  start_time = '.$row['start_time'].'  days _diff between today and job_due_date * 8 = '.$working_day_hours.'   project_due_date + days_hours = '.$date_diff.'   start_time + days_hours = '.$start_time.'   current_time = '.$timedate->nowDb().'('.$this->time_to_decimal($timedate->nowDb()).')   priority_ratio = '.$priority_ratio.'   priority_ratio_numerator = '.$priority_ratio_numerator);
			$update_priority_ratio="Update jobs SET priority_ratio='{$priority_ratio}' , priority_ratio_numerator='{$priority_ratio_numerator}' WHERE id='{$row['job_id']}' and deleted=0";
			$db->query($update_priority_ratio, true);
		}
		return true;
	}
	function time_to_decimal($time) {
		$timeArr = explode(':', explode(' ', $time)[1]);
		$decTime = round(($timeArr[0] + $timeArr[1]/60), 3);
		return $decTime;
	}
	function number_of_working_days($from, $to) {
		global $timedate;
		$from = explode(" ",$from)[0];
		$to = explode(" ",$to)[0];
		$workingDays = [1, 2, 3, 4, 5]; # date format = N (1 = Monday, ...)
		//$holidayDays = ['*-12-25', '*-01-01', '2013-12-23']; # variable and fixed holidays
		$from = $timedate->fromString($from);
		$to = $timedate->fromString($to);
		$interval = new DateInterval('P1D');

		$periods = new DatePeriod($from, $interval, $to);
		$days = 1;
		foreach ($periods as $period) {
			if (!in_array($period->format('N'), $workingDays)) continue;
			//if (in_array($period->format('Y-m-d'), $holidayDays)) continue;
			//if (in_array($period->format('*-m-d'), $holidayDays)) continue;
			$days++;
		}
		return $days;
	}
	function updateAssignment(&$bean, $event, $arguments){
		global $db;
		$db->query("UPDATE jobs SET assigned_user_id='' WHERE id='{$bean->id}' AND assigned_user_id='NULL'");

	}
 }
 ?>