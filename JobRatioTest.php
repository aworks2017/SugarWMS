<?php
class WorkFlowPortal{
	private $dbconfig, $db, $sugar_config;
	function __construct(){
		require_once('config.php');
		$this->sugar_config = $sugar_config;
		$this->dbconnect();
	}
	function main(){
		global $db,$timedate,$log;
		$now = time();

		//$now is Unix timestamp in UTC

		$job_id = $_REQUEST['job'];

		$sql ="SELECT id AS job_id, project_due_date, estimated_start AS start_time
		FROM jobs
		WHERE jobs.id='".$job_id."'";
		$row = $this->dbquery($sql, true);

			if (is_null($row[0]['start_time'])){
				$priority_ratio=-1;

			} else {

				//add ." UTC" to strtotime function to force UTC
				$deliverable_due_time = strtotime($row[0]['project_due_date']." UTC");
				$job_start_time = strtotime($row[0]['start_time']." UTC");


				$diff = $deliverable_due_time - $job_start_time;

				$priority_ratio_numerator = round($diff/3600,3);

				$due = date('Y-m-d', $deliverable_due_time);
				$today = date('Y-m-d', $now);

				//special function to use UTC  (NOT mkktime)
				$today_begin = gmmktime(13,30,0);
				$today_end = gmmktime(22,30,0);


				echo nl2br (" job_id =  ".$row[0]['job_id']." \n   deliverable due date = ".$deliverable_due_time." \n  job start time = ".$job_start_time." \n   current_time = ".$now." \n");

				echo nl2br (" \n (due - start) =  ".$diff." \n   priority_ratio_numerator = ".$priority_ratio_numerator." \n  today start = ".$today_begin." \n   today end = ".$today_end." \n");



				if ($deliverable_due_time < $now){
					//due in the past
					echo nl2br (" \n due in the past \n ");
					$priority_ratio = 999;

				}else if (($due == $today) && ($now >= $today_begin) && ($now <= $today_end)){
					//same day
					echo nl2br (" \n due today and current time is between 8:30-5:30 \n ");

					$diff = $deliverable_due_time - $now;
					$priority_ratio_denominator = round($diff/3600,3);

					$priority_ratio = round($priority_ratio_numerator/$priority_ratio_denominator,3);

				}else if (($due == $today) && ($now > $today_end)){
 					//same day and after working hours
					echo nl2br (" \n due today and current time is after 5:30 \n ");

					$priority_ratio = 999;

 				}else{
					// due on a future date (also includes jobs that are due today but current time is before 8:30am)
					echo nl2br (" \n due on a future date which includes jobs due today if current time is before 8:30am \n ");

					$due_start = new DateTime();
					$due_start->setTimezone(new DateTimeZone('UTC'));
					$due_start->setTimestamp($deliverable_due_time);

					$due_start->setTime(13, 30);   //converted due date to UTC and now setting start time for that date to 8:30am

					//$biz_days = $this->number_of_working_days($today, $row[0]['project_due_date']);


							$workingDays = [1, 2, 3, 4, 5]; # date format = N (1 = Monday, ...)
							$holidayDays = ['*-12-25', '*-01-01', '2013-12-23']; # variable and fixed holidays
							$from = new DateTime($today);
 							$to = new DateTime($row[0]['project_due_date']);
							$interval = new DateInterval('P1D');

							$periods = new DatePeriod($from, $interval, $to);
							$biz_days = 0;   // this is 1 in the jobsQueue function and not sure why has to be 0 here but only way it works
							foreach ($periods as $period) {
								if (!in_array($period->format('N'), $workingDays)) continue;
								if (in_array($period->format('Y-m-d'), $holidayDays)) continue;
								if (in_array($period->format('*-m-d'), $holidayDays)) continue;
								$biz_days++;
							}



					echo nl2br (" \n 8:30am of due date =  ".$due_start->getTimestamp());




					if ($biz_days == 1){

						$diff = $deliverable_due_time - $due_start->getTimestamp();

					} else if ($biz_days == 2){

						$diff = ($deliverable_due_time - $due_start->getTimestamp()) + max(($today_end - $now),0);
						//echo ' job_id =  '.$row[0]['job_id'].' has biz_days=2 with diff = '.$diff.' and due_start = '.$due_start->getTimestamp().' and today_end = '.$today_end;

					} else {

						$diff = ($deliverable_due_time - $due_start->getTimestamp()) + max(($today_end - $now),0) + (8 * 60 * 60 * ($biz_days - 2));
					}

					$priority_ratio_denominator = round(($diff/3600),3);

					$priority_ratio = round($priority_ratio_numerator/$priority_ratio_denominator,3);

				}

				echo nl2br (" \n business days between =  ".$biz_days." \n (due - current) =  ".$diff." \n priority_ratio_denominator =  ".$priority_ratio_denominator." \n  \n  priority_ratio = ".$priority_ratio);

			}






	}
	function dbconnect(){
		$this->db = mysql_connect($this->sugar_config['dbconfig']['db_host_name'], $this->sugar_config['dbconfig']['db_user_name'], $this->sugar_config['dbconfig']['db_password']) or die(mysql_error());

		mysql_select_db($this->sugar_config['dbconfig']['db_name'], $this->db) or die(mysql_error());
	}
	function dbquery($query){
		$res = mysql_query($query, $this->db);
		$data = array();
		if($res != '1'){
			while($data[] = mysql_fetch_assoc($res))
			{

			}
		}
		return $data;
	}


}

$workflow = new WorkFlowPortal();
$workflow->main();
?>