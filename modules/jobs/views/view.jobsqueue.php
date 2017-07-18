<?php
require_once('include/MVC/View/SugarView.php');
require_once('include/TemplateHandler/TemplateHandler.php');
require_once('modules/jobs/jobsQueue.php');
class jobsViewJobsqueue extends SugarView{
	public function __construct() {
		parent::SugarView();
		$this->th = new TemplateHandler();
		$this->th->ss =& $this->ss;
	}
 	function display() {
		global $timedate;
		$this->jobsqueue();
		echo '<style>
		#header, #footer, .error{
			display:none;
		}
		</style>';
 	}
	function jobsqueue() {
		global $db,$app_list_strings, $timedate,$log;
		$queue= new jobsQueue();
		$now = $timedate->nowDb();
		$before_date = $queue->getNextWorkingDay();
		$before_date .= '23:59:00';
		if($_REQUEST['refresh_queue']==1){
			$queue->refresh_queue();
		}
		$sort_by_val ='ORDER BY jobs.priority_ratio DESC,jobs.priority_ratio_numerator DESC';
		$sortBy = (isset($_REQUEST['sortBy']) && $_REQUEST['sortBy']!='undefined')? $_REQUEST['sortBy'] : '';
		if(!empty($sortBy) && $sortBy=='by_due_date')   $sort_by_val = 'ORDER BY jobs.estimated_start, jobs.id ASC';
		if(!empty($sortBy) && $sortBy=='by_name')   $sort_by_val = 'ORDER BY project.name ASC';
		if(!empty($sortBy) && $sortBy=='by_position')   $sort_by_val = 'ORDER BY jobs.order_number+0 ASC';
		$group_by = '';
		if($sortBy != 'by_position'){
			$group_by = 'GROUP BY project_id , parameter_1';
		}
		$sql = "SELECT  jobs.id AS job_id ,jobs.parameter_1, jobs.status,jobs.name AS job_name, jobs.order_number , jobs.project_due_date, jobs.estimated_start AS start_time ,jobs.jobs_date_time AS finish_time,jobs.project_task_id AS project_task_id ,project.id AS project_id , project.name AS project_name ,project.restrict_start_days AS restrict_start_days ,
				users.id AS assigned_user_id , CONCAT_WS(' ', users.first_name, users.last_name) AS assigned_user_name,
				jobs.priority_ratio
				FROM jobs
				INNER JOIN project
					ON (jobs.project_id = project.id AND project.deleted=0)
				LEFT JOIN users
					ON (jobs.assigned_user_id = users.id AND users.deleted=0)
				WHERE jobs.deleted=0 AND (jobs.order_number != 0 AND jobs.order_number is NOT NULL)   AND jobs.status IN('Ready','Started','In Progress','Not Ready','Issue','Defer','On Hold')  AND jobs.project_due_date <= '{$before_date}' AND jobs.project_due_date >= '{$now}' {$sort_by_val}
				";
		$sql_remain_task ="SELECT project_id,parameter_1, SUM(estimated_mins) AS total_time , project_due_date
				FROM `jobs`
				WHERE deleted=0 AND jobs.status IN('Ready','Started','In Progress','Not Ready','Issue','Defer','On Hold')  AND jobs.project_due_date <= '{$before_date}' AND jobs.project_due_date >= '{$now}'
				{$group_by}";
		$result = $db->query($sql, true);
		$result_remain_task = $db->query($sql_remain_task, true);
		$jobs  = array();
		$arry_index = '';
		while($row = $db->fetchByAssoc($result)){
			$date_diff= $row['project_due_date'];
			$time_remainig = abs(strtotime($date_diff) - strtotime($timedate->nowDb()));
			$time_remainig = $this->sec_to_time($time_remainig);
			if($sortBy != 'by_position'){
				//$arry_index = preg_replace('/\s+\:/', '', $row['project_id']."-".$row['parameter_1']);
				$arry_index = str_replace(array(' ', ':'), array('', '__'), $row['project_id']."-".$row['parameter_1']);
			}
			if(!in_array($arry_index, array_keys($jobs)) && $sortBy != 'by_position'){
				$jobs[$arry_index] = array(
					'project_id' => $row['project_id'],
					'project_name' => $row['project_name'].' '.$row['parameter_1'],
				);
			}
			if(!empty($row['parameter_1'])){
				$row['job_name'] .= ' - '.$row['parameter_1'];
			}
			$jobs[$arry_index]['jobs'][$row['job_id']] = array(
				'order_number' => $row['order_number'],
				'job_id' => $row['job_id'],
				'status' => $row['status'],
				'project_task_id' => $row['project_task_id'],
				'job_name' => $row['job_name'],
				'time_remainig' => $time_remainig,
				'start_time' => $timedate->to_display_time($row['start_time']),
				'finish_time' => $timedate->to_display_time($row['finish_time']),
				'project_due_date' => $timedate->to_display_date_time($row['project_due_date']) ,
				'associate' => $row['assigned_user_name'],
				'associate_id' => $row['assigned_user_id'],
				'project_name' => $row['project_name'],
				'due' => $timedate->to_display_date_time($row['project_due_date']),
				'priority_ratio' => round($row['priority_ratio'],3),
				'restrict_start_days' => $row['restrict_start_days'],
			);
		}
		if($sortBy != 'by_position'){
			while($row = $db->fetchByAssoc($result_remain_task)){
				$time_remainig = $this->sec_to_time($row['total_time']*60);
				//$arry_index = preg_replace('/\s+\:/', '', $row['project_id']."-".$row['parameter_1']);
				$arry_index = str_replace(array(' ', ':'), array('', '__'), $row['project_id']."-".$row['parameter_1']);
				if(in_array($arry_index, array_keys($jobs))){
					$jobs[$arry_index]['total_time'] = $time_remainig;
					$jobs[$arry_index]['due'] = $timedate->to_display_date_time($row['project_due_date']);
				}
			}
		}

		$this->ss->assign('results', $jobs);
		if(!empty($sortBy) && $sortBy == 'by_position'){
			echo $this->th->displayTemplate("jobs", "jobsqueueposition", "modules/jobs/tpls/viewjobsbyposition.tpl");
		}else{
			echo $this->th->displayTemplate("jobs", "viewjobsqueue", "modules/jobs/tpls/viewjobsqueue.tpl");
		}
	}
	function sec_to_time($time) {
		$result='';
		$hours = floor($time / (60 * 60));
		$time -= $hours * (60 * 60);
		$minutes = floor($time / 60);
		$time -= $minutes * 60;
		$seconds = floor($time);
		$time -= $seconds;
		$result .= ($hours > 0) ?  $hours. ' hours':'';
		$result .= ($minutes > 0) ? ' '.$minutes. ' minutes':'';
		return $result;
	}
}
?>
