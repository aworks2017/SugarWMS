<?php
$job_strings[] = 'recurringJobs';
function recurringJobs(){
	include 'modules/jobs/updateQueue.php';
	global $timedate,$db,$log;
	$week_day = array('1', '2', '3', '4', '5');
	$status = 'Ready';
	$priority = 'normal';
	$assigned_user_id = "";
	$sql="SELECT pro_acc.account_id AS account_id,pro.id AS pro_id,pro.name AS deliverable_name,pro_c.recurring_type_c AS recurring_type,pro_c.recurring_time_hour_c AS recurring_hour,
		pro_c.recurring_time_minute_c AS recurring_minute,pro.parameter_1,pro.parameter_2,pro_c.recurring_time_ampm_c AS recurring_ampm,pro_c.recurring_value_c AS recurring_value,pro.status AS status,pro.restrict_start_days AS restrict_start_days
		FROM project pro
		INNER JOIN project_cstm pro_c
		  ON (pro.id=pro_c.id_c)
		INNER JOIN projects_accounts pro_acc
		  ON (pro_acc.project_id=pro.id AND pro_acc.deleted = 0 )
		WHERE pro.deleted=0 AND pro_c.recurring_c =1
		ORDER BY pro.date_modified";
	$result = $db->query($sql, true);
	while($row = $db->fetchByAssoc($result)){
		$pro_id = $row['pro_id'];
		$task_sql="SELECT pro.id AS task_id,pro.name AS task_name,pro_c.activity_driver_c AS activity_driver,pro_c.default_count_c AS activity_count,pro.estimated_effort AS estimated_effort, pro.production_notes AS production_notes
		FROM project_task pro
		INNER JOIN project_task_cstm pro_c
		  ON (pro.id=pro_c.id_c)
		WHERE pro.deleted=0 AND pro.project_id= '{$pro_id}'";
		$task_result = $db->query($task_sql, true);
		while($task_row = $db->fetchByAssoc($task_result)){
			$group_id = '';
			//$remaining_days = date('t') - date('j');
			$next_date = gmdate('Y-m-01', strtotime ( '+1 month' , strtotime(gmdate('Y-m-01'))));
			$parts = explode('-', $next_date);
			$remaining_days = cal_days_in_month(CAL_GREGORIAN, $parts[1], $parts[0]);
			if($row['recurring_type'] == 'daily'){
				for($i=0;$i < $remaining_days;$i++){
					$later = $timedate->asUserDate($timedate->getNow()->setDate($parts[0], $parts[1], 1)->modify("+".$i." days"));
					$day = new dateTime($later);
					$new_parts = explode('-', $timedate->to_db_date($later));
					if(in_array($day->format('N'), $week_day) && $new_parts[1] === $parts[1]){
						$jobs_date_time = $later.' '.$row['recurring_hour'].':'.$row['recurring_minute'].$row['recurring_ampm'];
						if($row['status']=='Published'){
							save_jobs($task_row['task_id'], $row['account_id'], $pro_id, $jobs_date_time, $row['parameter_1'],$row['parameter_2'],$task_row['task_name'], $jobs_date_time,$status,$priority,'',$task_row['production_notes'],$assigned_user_id,$row['activity_driver'],$task_row['activity_count'],$row['restrict_start_days'],$task_row['estimated_effort']);
						}
					}
				}
			}elseif($row['recurring_type'] == 'weekly'){
				$nextDate = new DateTime("{$parts[0]}-{$parts[1]}-0");
				$parts[2] = $nextDate->modify("next {$row['recurring_value']}")->format('d');
				for($i=0;$i <= $remaining_days;$i+=7){
					$later = $timedate->asUserDate($timedate->getNow()->setDate($parts[0], $parts[1], $parts[2])->modify("+".$i." days"));
					$new_parts = explode('-', $timedate->to_db_date($later));
					if($new_parts[1] === $parts[1]){
						$jobs_date_time = $later.' '.$row['recurring_hour'].':'.$row['recurring_minute'].$row['recurring_ampm'];
						if($row['status']=='Published'){
							save_jobs($task_row['task_id'], $row['account_id'], $pro_id, $jobs_date_time,$row['parameter_1'],$row['parameter_2'],$task_row['task_name'], $jobs_date_time,$status,$priority,'',$task_row['production_notes'],$assigned_user_id,$row['activity_driver'],$task_row['activity_count'],$row['restrict_start_days'],$task_row['estimated_effort']);
						}
					}
				}
			}elseif($row['recurring_type'] == 'monthly'){
				$now = $timedate->asUserDate($timedate->getNow()->setDate($parts[0], $parts[1], 1));
				$rec_date = explode("/", $now);
				$rec_date[1] = $row['recurring_value'];
				$rec_date = implode("/", $rec_date);
				$days = date_diff(date_create($now),date_create($rec_date));
				if($days->format("%R%a") >= 0){
					$jobs_date_time = $rec_date.' '.$row['recurring_hour'].':'.$row['recurring_minute'].$row['recurring_ampm'];
					if($row['status']=='Published'){	
						save_jobs($task_row['task_id'], $row['account_id'], $pro_id, $jobs_date_time,$row['parameter_1'],$row['parameter_2'],$task_row['task_name'], $jobs_date_time,$status,$priority,'',$task_row['production_notes'],$assigned_user_id,$row['activity_driver'],$task_row['activity_count'],$row['restrict_start_days'],$task_row['estimated_effort']);
					}
				}
			}
		}
	}
	return true;
}
?>