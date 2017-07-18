<?php
class jobsHook {
    function changeStatus(&$bean, $event, $arguments){
		$bean->status = '<select id="'.$bean->id.'" name="status" onfocus="setPrvVla(this);" onChange="updateStatus(this);">'.get_select_options_with_id($GLOBALS['app_list_strings']['job_status_dom'], $bean->status).'</select>';
	}
    function getDeliverableId(&$bean, $event, $arguments){
		$db = $bean->db;
		$job = BeanFactory::getBean('jobs', $bean->id);
		$select = "SELECT deliverable_id FROM project where id= '{$job->project_id}' AND deleted=0";
		$result = $db->query($select, true);
		$row = $db->fetchByAssoc($result);
		$bean->deliverable_id = $row['deliverable_id'];
    } 
    function changeAssignUser(&$bean, $event, $arguments){
		global $sugar_config;
		$db = $bean->db;
		if($bean->assigned_user_id != $bean->fetched_row['assigned_user_id'] || $bean->status != $bean->fetched_row['status']){
			$select = "SELECT current_job_id 
					   FROM users 
					   WHERE deleted=0 AND current_job_id='{$bean->id}'";
			$result = $db->query($select, true);
			if($db->getRowCount($result) > 0){
				$url = $sugar_config['site_url'].'/index.php?module=jobs&action=DetailView&record='.$bean->id;
				SugarApplication::appendErrorMessage('<a href="'.$url.'">'.$bean->name.'</a> is currently assigned in Workflow Tool - no changes are allowed');					
				SugarApplication::redirect('index.php?module='.$bean->module_name);
			}	
		}
    } 
	function get_actual_effort(&$bean, $event, $arguments){
		global $db, $timedate;
		$select = "SELECT * FROM ht_job_history WHERE jobs_id='{$bean->id}' AND deleted=0 ORDER BY date_entered asc";
		$result = $db->query($select, true);
		$actual_effort = 0;
		$start_time = '';
		$break_start =  '12:30pm';
		$break_end =  '1:30pm';
		while($row = $db->fetchByAssoc($result)){
			if(strtolower($row['action_job']) == 'start'){
				$start_time = date('Y-m-d H:i', strtotime($row['date_entered']));
			}elseif(strtolower($row['action_job']) == 'stop' || strtolower($row['action_job']) == 'completed' || strtolower($row['action_job']) == 'in progress' || strtolower($row['action_job']) == 'issue' || strtolower($row['action_job']) == 'qa check'){
				
				$end_time = date('Y-m-d H:i', strtotime($row['date_entered']));
				$actual_effort += (strtotime($end_time) - strtotime($start_time))/60;
				/*
				*	Adjust actual effort for lunch break
				*/
				if((strtotime(date('h:ia',strtotime($start_time))) < strtotime($break_start)) && (strtotime(date('h:ia',strtotime($end_time))) > strtotime($break_end))){
					$actual_effort -= 60;
				}
			}
		}
		$sql = "UPDATE jobs
			 SET actual_effort ='{$actual_effort}', order_number = NULL , priority_ratio = NULL
			 WHERE id='{$bean->id}' AND status='Completed'";
		$db->query($sql,true);		
    }
	function updateActualEffort(&$bean, $event, $arguments){
		if(empty($bean->fetched_row['id']) || $bean->fetched_row['id'] == ""){
			global $db, $timedate;
			$sql = "UPDATE jobs
				 SET actual_effort = 0
				 WHERE id='{$bean->id}'";
			$db->query($sql,true);		
		}
    }
	function changePriority(&$bean, $event, $arguments){
		$bean->priority = "<span id='{$bean->id}' class='priority'>{$GLOBALS['app_list_strings']['priority_status_options'][$bean->priority]}</span>";
    }
	function getNextWorkingDay($date){
		$add_day = 2;
		$new_date = gmdate('Y-m-d', strtotime("$date +$add_day weekdays"));
		return $new_date;
	}
	function getGroupId(&$bean, $event, $arguments){
		global $db,$timedate;
		if(empty($bean->fetched_row['id']) && ($bean->project_due_date !== $bean->fetched_row['project_due_date'] || $bean->parameter_1 !== $bean->fetched_row['parameter_1'])){
			$p1 = html_entity_decode($bean->parameter_1, ENT_QUOTES | ENT_HTML);
			$project_due = $timedate->to_db($bean->project_due_date);
			if(empty($project_due) || $project_due == '')
				$project_due = $bean->project_due_date;
			$query = "SELECT group_id FROM jobs where  jobs.project_id = '{$bean->project_id}' AND jobs.project_due_date = '{$project_due}'
				AND IFNULL(jobs.parameter_1,'') = '".addslashes($p1)."'";
			$result = $db->query($query);
			$group_id = '';
			$row = $db->fetchByAssoc($result);
			if($row['group_id'] > 0){
					$group_id = $row['group_id'];
			}else{
				$result = $db->query("SELECT max(group_id) AS group_id FROM jobs");
				$row = $db->fetchByAssoc($result);
				if($row['group_id'] > 0 ){
					$group_id = $row['group_id']+1;
				}else{
					$group_id = '100001';
				}
			}
			$bean->group_id = $group_id;
		}
	}
	/* function initialize_queue(&$bean, $event, $arguments){
		global $timedate;
		$db=$bean->db;
		$before_date = $this->getNextWorkingDay($timedate->nowDbDate());
		$before_date .=' 17:00:00';
		$count = 1;
		$project_due_date = '';
		$sql ="SELECT jobs.id AS job_id, jobs.project_due_date, pt.estimated_effort,pt.order_number
				FROM jobs 
				INNER JOIN project_task pt
					ON (jobs.project_task_id = pt.id AND pt.deleted=0) 
				WHERE jobs.deleted=0 AND jobs.status IN('Ready','Started','In Progress','Not Ready') 
				AND jobs.project_due_date <= '{$before_date}' AND jobs.project_due_date >= NOW() 
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
			$estimated_effort = $row['estimated_effort'];
			$time = strtotime($date);
			$time = $time - ( $estimated_effort * 60);
			$estimated_start = date("Y-m-d H:i:s", $time);
			$sql_update_order = "UPDATE jobs
							SET jobs.estimated_start='{$estimated_start}', jobs_date_time ='{$job_due_date}'
							WHERE jobs.id='{$row['job_id']}'";
			$db->query($sql_update_order, true);
		}
		$sql ="SELECT jobs.id AS job_id
				FROM jobs 
				WHERE jobs.deleted=0 AND jobs.status IN('Ready','Started','In Progress','Not Ready') 
				AND jobs.project_due_date <= '{$before_date}' AND jobs.project_due_date >= NOW() 
				ORDER BY jobs.estimated_start ASC";
		$result = $db->query($sql, true);
		while($row = $db->fetchByAssoc($result)){
			$sql_update_order = "UPDATE jobs
							SET  jobs.order_number ='{$count}'
							WHERE jobs.id='{$row['job_id']}'";
			$db->query($sql_update_order, true);
			$count++;
		}
		return;
		
	}	 */
}
