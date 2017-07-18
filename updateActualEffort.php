<?php
ini_set('max_execution_time', 30000); //300 seconds = 5 minutes
ini_set('memory_limit','2048M');
include ('include/MVC/preDispatch.php');
require_once('include/entryPoint.php');
require_once('include/MVC/SugarApplication.php');

global $db, $timedate;
$select_job = "SELECT id FROM `jobs` where (actual_effort != '999999' OR actual_effort IS NULL) AND  deleted = 0";
$result_job = $db->query($select_job);
while($row_job = $db->fetchByAssoc($result_job)){
	$job_id = $row_job['id'];
	$sql = "select * from ht_job_history where jobs_id = '{$job_id}'
	order by date_entered asc";
	$result = $db->query($sql,true);
	$new_action_job = '';
	$old_action_job = '';
	$break_start =  '12:30pm';
	$break_end =  '1:30pm';
	$actual_effort = 0;
	while($row = $db->fetchByAssoc($result)){
		$new_action_job = strtolower($row['action_job']);
		if($old_action_job == $new_action_job){
			continue;
		}	
		$old_action_job = $new_action_job;
		if(strtolower($row['action_job']) == 'start'){
			$start_time = date('Y-m-d H:i', strtotime($row['date_entered']));
		}else if(in_array(strtolower($row['action_job']), array('issue','completed','in progress' ) )) {
			$end_time = date('Y-m-d H:i', strtotime($row['date_entered']));
			if($start_time > 0 && $end_time > 0){
				$actual_effort += (strtotime($end_time) - strtotime($start_time))/60;
				/*
				*	Adjust actual effort for lunch break
				*/
				if((strtotime(date('h:ia',strtotime($start_time."-6hours"))) < strtotime($break_start)) && (strtotime(date('h:ia',strtotime($end_time."-6hours"))) > strtotime($break_end))){
					$actual_effort -= 60;
				}
			}
		}
	}

	if($actual_effort > 0 ){
		$sql = "UPDATE jobs
				SET actual_effort='{$actual_effort}'
				WHERE id='{$job_id}' ";
		$db->query($sql);
	}
}
echo 'script executed successfully';
?>