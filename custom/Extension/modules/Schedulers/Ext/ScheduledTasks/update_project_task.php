<?php
$job_strings[] = 'update_project_task';
function update_project_task(){
	global $timedate,$db,$log;
		$from =date("Y-m-d H:i:s", strtotime("-6 Months")); 
		$to=date("Y-m-d H:i:s");
		$select = "SELECT id FROM project_task where deleted=0";
		$result = $db->query($select, true);
		while($row = $db->fetchByAssoc($result)){
			$task_id = $row['id'];
			$select_job = "select count(*) as num_occurences,AVG(actual_effort) as avg_time_c   from jobs where project_task_id ='{$task_id}' AND deleted=0 AND (project_due_date BETWEEN '{$from}' AND '{$to}')";
			$result_job = $db->query($select_job, true);
			$row_job = $db->fetchByAssoc($result_job);
			$num_occurences = $row_job['num_occurences'];
			$avg_time_c = round($row_job['avg_time_c'],2);
			$avg_count_c  = round($num_occurences/6,2);
			$update_pt="UPDATE  project_task_cstm SET num_occurences_c='{$num_occurences}',avg_time_c='{$avg_time_c}',avg_count_c='{$avg_count_c}' where id_c='{$task_id}'";
			$db->query($update_pt, true);
		}
	return true;
}
?>