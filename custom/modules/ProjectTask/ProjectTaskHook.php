<?php
class ProjectTaskHook {
	
	private $repeatArray = array();
	
    function createTaskAbilityRecords(&$bean, $event, $arguments){
		//create task ability records for new project task
		if(empty($bean->fetched_row['id'])){
			$db = $bean->db;
			$sql = "SELECT id FROM users WHERE deleted=0";
			$result = $db->query($sql, true);
			while($row = $db->fetchByAssoc($result)){
				$ability = new ht_project_task_ability();
				$ability->projecttask_id = $bean->id;
				$ability->associate_id = $row['id'];
				$ability->ability_level = 'Excluded';
				$ability->save();
			}
		}
    }
		
	function updateTaskOrderASC(&$bean, $event, $arguments){
		global $log;
		if(isset($arguments['related_module']) && $arguments['related_module'] == 'ProjectTask' && $bean->id == $_REQUEST['record'] && $arguments['id'] != $arguments['related_id']){
			$bean->order_number = $arguments['related_bean']->order_number+1;
			$this->updateParentsASC($bean->id, $bean->order_number);
		}
    }
	function updateParentsASC($post_task_id, $order){
		global $db;
		$this->repeatArray[] = $post_task_id;
		$sql = "SELECT pt.id, pt.name
				FROM project_task pt
				INNER JOIN projecttask_projecttask_1_c ptc ON(ptc.deleted=0 AND pt.id=ptc.projecttask_projecttask_1projecttask_idb)
				WHERE pt.deleted=0 AND ptc.projecttask_projecttask_1projecttask_ida='{$post_task_id}'";
		$result = $db->query($sql, true);
		$row = $db->fetchByAssoc($result);
		if(!empty($row['id']) && !in_array($row['id'],$this->repeatArray)){
			$update = "UPDATE project_task SET order_number={$order}+1 WHERE deleted=0 AND id='{$row['id']}'";
			$db->query($update, true);
			$this->updateParentsASC($row['id'], $order+1);
		}
	}
	function updateTaskOrderDesc(&$bean, $event, $arguments){
		global $log;
		if(isset($arguments['related_module']) && isset($arguments['related_id']) && $arguments['related_module'] == 'ProjectTask' && $arguments['id'] != $arguments['related_id']){ 
			$this->updateParentsDesc($bean->id, $arguments['related_bean']->order_number-1);
		}
    }
	function recordFirstTimeSave(&$bean, $event, $arguments){
		if(empty($bean->fetched_row['id'])){
			$bean->first_save = 1;
		}
    }
	function updateParentsDesc($post_task_id, $order){
		global $db;
		$this->repeatArray[] = $post_task_id;
		$sql = "SELECT pt.id, pt.name
				FROM project_task pt
				INNER JOIN projecttask_projecttask_1_c ptc ON(ptc.deleted=0 AND pt.id=ptc.projecttask_projecttask_1projecttask_idb)
				WHERE pt.deleted=0 AND ptc.projecttask_projecttask_1projecttask_ida='{$post_task_id}'";
		$result = $db->query($sql, true);
		$row = $db->fetchByAssoc($result); 
		if(!empty($row['id']) && !in_array($row['id'],$this->repeatArray)){
			$update = "UPDATE project_task SET order_number={$order} WHERE deleted=0 AND id='{$row['id']}'";
			$db->query($update, true);
			$this->updateParentsDesc($row['id'], $order+1);
		}
	}
	function createRecurringJobs(&$bean, $event, $arguments){
		if($bean->first_save == 1){
			include 'modules/jobs/updateQueue.php';
			$remaining_days = date('t') - date('j');
			$status = 'Ready';
			$priority = 'normal';
			$assigned_user_id = "";
			$week_day = array('1', '2', '3', '4', '5');
			global $timedate;
			if(isset($bean->project_id) && !empty($bean->project_id) ){
				$group_id = '';
				$project = BeanFactory::getBean('Project');
				$project->retrieve($bean->project_id);
				if($project->recurring_type_c == 'daily'){
					for($i=0;$i <= $remaining_days;$i++){
						$later = $timedate->asUserDate($timedate->getNow()->modify("+".$i." days"));
						$day = new dateTime($later);
						if(in_array($day->format('N'), $week_day)){
							$jobs_date_time = $later.' '.$project->recurring_time_hour_c.':'.$project->recurring_time_minute_c.$project->recurring_time_ampm_c;
							save_jobs($bean->id, $project->account_id, $project->id, $jobs_date_time,$project->parameter_1,$project->parameter_2,$bean->name, $jobs_date_time,$status,$priority,'',$bean->production_notes,$assigned_user_id,$bean->activity_driver_c,$bean->default_count_c, $project->restrict_start_days, $bean->estimated_effort);
						}
					}
				}elseif($project->recurring_type_c == 'weekly'){
					$recurring_value = date('N', strtotime($project->recurring_value_c));
					$now = date("w");
					$day_diff =  ($recurring_value - $now) ;
					$rec_date = $day_diff < 0 ? $day_diff + 7 : $day_diff;
					for($i=$rec_date;$i <= $remaining_days;$i+=7){
						$later = $timedate->asUserDate($timedate->getNow()->modify("+".$i." days"));
						$day = new dateTime($later);
						if(in_array($day->format('N'), $week_day)){
							$jobs_date_time = $later.' '.$project->recurring_time_hour_c.':'.$project->recurring_time_minute_c.$project->recurring_time_ampm_c;
							save_jobs($bean->id, $project->account_id, $project->id, $jobs_date_time,$project->parameter_1,$project->parameter_2,$bean->name, $jobs_date_time,$status,$priority,'',$bean->production_notes,$assigned_user_id,$bean->activity_driver_c,$bean->default_count_c, $project->restrict_start_days, $bean->estimated_effort);
						}
					}
				}elseif($project->recurring_type_c == 'monthly'){
					$now = $timedate->asUserDate($timedate->getNow());
					$rec_date = explode("/", $now);
					$rec_date[1] = $project->recurring_value_c;
					$rec_date = implode("/", $rec_date);
					$days = date_diff(date_create($now),date_create($rec_date));
					if($days->format("%R%a") >= 0){
						$jobs_date_time = $rec_date.' '.$project->recurring_time_hour_c.':'.$project->recurring_time_minute_c.$project->recurring_time_ampm_c;
						save_jobs($bean->id, $project->account_id, $project->id, $jobs_date_time,$project->parameter_1,$project->parameter_2,$bean->name, $jobs_date_time,$status,$priority,'',$bean->production_notes,$assigned_user_id,$bean->activity_driver_c,$bean->default_count_c, $project->restrict_start_days, $bean->estimated_effort);
					}
				}
				// creating jobs for next month.
				$next_date = gmdate('Y-m-01', strtotime ( '+1 month' , strtotime(gmdate('Y-m-01'))));
				$parts = explode('-', $next_date);
				$remaining_days = cal_days_in_month(CAL_GREGORIAN, $parts[1], $parts[0]);
				if($project->recurring_type_c == 'daily'){
					for($i=0;$i < $remaining_days;$i++){
						$later = $timedate->asUserDate($timedate->getNow()->setDate($parts[0], $parts[1], 1)->modify("+".$i." days"));
						$day = new dateTime($later);
						if(in_array($day->format('N'), $week_day)){
							$jobs_date_time = $later.' '.$project->recurring_time_hour_c.':'.$project->recurring_time_minute_c.$project->recurring_time_ampm_c;
							if($project->status == 'Published'){
								save_jobs($bean->id, $project->account_id, $project->id, $jobs_date_time,$project->parameter_1,$project->parameter_2,$bean->name, $jobs_date_time,$status,$priority,'',$bean->production_notes,$assigned_user_id,$bean->activity_driver_c,$bean->default_count_c, $project->restrict_start_days, $bean->estimated_effort);
							}
						}
					}
				}elseif($project->recurring_type_c == 'weekly'){
					$nextDate = new DateTime("{$parts[0]}-{$parts[1]}-0");
					$parts[2] = $nextDate->modify("next {$project->recurring_value_c}")->format('d');
					for($i=0;$i <= $remaining_days;$i+=7){
						$later = $timedate->asUserDate($timedate->getNow()->setDate($parts[0], $parts[1], $parts[2])->modify("+".$i." days"));
						$new_parts = explode('-', $timedate->to_db_date($later));
						if($new_parts[1] === $parts[1]){
							$jobs_date_time = $later.' '.$project->recurring_time_hour_c.':'.$project->recurring_time_minute_c.$project->recurring_time_ampm_c;
							if($project->status == 'Published'){
								save_jobs($bean->id, $project->account_id, $project->id, $jobs_date_time,$project->parameter_1,$project->parameter_2,$bean->name, $jobs_date_time,$status,$priority,'',$bean->production_notes,$assigned_user_id,$bean->activity_driver_c,$bean->default_count_c, $project->restrict_start_days, $bean->estimated_effort);
							}
						}
					}
				}elseif($project->recurring_type_c == 'monthly'){
					$now = $timedate->asUserDate($timedate->getNow()->setDate($parts[0], $parts[1], 1));
					$rec_date = explode("/", $now);
					$rec_date[1] = $project->recurring_value_c;
					$rec_date = implode("/", $rec_date);
					$days = date_diff(date_create($now),date_create($rec_date));
					if($days->format("%R%a") >= 0){
						$jobs_date_time = $rec_date.' '.$project->recurring_time_hour_c.':'.$project->recurring_time_minute_c.$project->recurring_time_ampm_c;
						if($project->status == 'Published'){	
							save_jobs($bean->id, $project->account_id, $project->id, $jobs_date_time,$project->parameter_1,$project->parameter_2,$bean->name, $jobs_date_time,$status,$priority,'',$bean->production_notes,$assigned_user_id,$bean->activity_driver_c,$bean->default_count_c, $project->restrict_start_days, $bean->estimated_effort);
						}
					}
				}
			}
			$bean->db->query("UPDATE project_task SET first_save=0 WHERE id='{$bean->id}'", true);
		}
	}
}
