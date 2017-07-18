<?php
class UsersHook {
    function createTaskAbilityRecords(&$bean, $event, $arguments){
		//create task ability records for new project task
		if(empty($bean->fetched_row['id'])){
			$db = $bean->db;
			$sql = "SELECT id FROM project_task WHERE deleted=0";
			$result = $db->query($sql, true);
			while($row = $db->fetchByAssoc($result)){
				$ability = new ht_project_task_ability();
				$ability->projecttask_id = $row['id'];
				$ability->associate_id = $bean->id;
				$ability->ability_level = 'Excluded';
				$ability->save();
			}
		}
    } 
	function assignToAssociateRole(&$bean, $event, $arguments){
		if(empty($bean->fetched_row['id'])){
			$db = $bean->db;
			 $sql = "INSERT INTO acl_roles_users (id, date_modified,deleted, role_id,user_id)
			 VALUES(UUID(), NOW(),'0', 'e74a4e89-d82c-30d3-9277-54c187e227fb','{$bean->id}')";
			 $db->query($sql, true);
		}
    }
	function setDefaultPassword(&$bean, $event, $arguments){
		$sql = "UPDATE  users SET user_hash='e99a18c428cb38d5f260853678922e03', pwd_last_changed=NOW()
				where id= '{$bean->id}' AND (user_hash IS NULL OR user_hash='')";
		$bean->db->query($sql, true);
    }
	function addUserToPortal(&$bean, $event, $arguments){
		global $sugar_config,$log;
		if(empty($bean->fetched_row['id'])){
			if(!empty($_REQUEST['new_password'])){
				$password = $_REQUEST['new_password'];
			}else{
				$password = 'abc123';
			}
			$api_key = $this->getApiKey();
			$url = $sugar_config['aw_user_server'].'?api_key='.$api_key.'&user_name='.($bean->user_name).'&pswd='.$password.'&user_type=employee'; 
			$log->fatal($url);
			$log->debug($url);
			$ch = curl_init();    
			curl_setopt($ch, CURLOPT_URL,$url);  
			curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // return into a variable  
			curl_setopt($ch, CURLOPT_TIMEOUT, 10);  
			$result = curl_exec($ch);  
			$log->fatal(print_r($result, true));
			$log->debug(print_r($result, true));
			curl_close($ch);
		}
    }
	function getApiKey(){
		global $db;
		$sql = "SELECT value 
				FROM config 
				WHERE category='workflowportal' AND name='api_key'
				LIMIT 1";
		$result = $db->query($sql, true);
		$row = $db->fetchByAssoc($result);
		return $row['value'];
	}
	function updateJobId(&$bean, $event, $arguments){
		global $db,$timedate,$current_user;
		if(trim($bean->current_job_id) === 'ONCALL'){
			$sql = "SELECT start_time FROM `oncall_history` 
				WHERE user_id = '{$bean->id}'
				ORDER BY id DESC 
				LIMIT 1";
			$result = $db->query($sql, true);
			$row = $db->fetchByAssoc($result);
			$start_time = new datetime($row['start_time']);
			$bean->start_time = $timedate->asUser($start_time, $current_user);
		}else if($bean->current_job_id){
			$sql = "SELECT date_entered AS start_time FROM `ht_job_history` 
				WHERE jobs_id = '{$bean->current_job_id}' AND deleted = 0 AND action_job = 'start'
				ORDER BY date_modified DESC 
				LIMIT 1";
			$result = $db->query($sql, true);
			$row = $db->fetchByAssoc($result);
			$start_time = new datetime($row['start_time']);
			$bean->start_time = $timedate->asUser($start_time, $current_user);
		}
		$bean->current_job_id = "<span id='{$bean->id}' class='user_job_id' onclick='updateJobId(\"".$bean->id."\",\"".$bean->current_job_id."\")'>{$bean->current_job_id}</span>";
	}
	function setEmployeeID(&$bean, $event, $arguments){
		if(empty($bean->fetched_row['id'])){
			$db = $bean->db;
			$select="SELECT IFNULL(MAX(employee_id), 0) AS employee_id FROM users WHERE deleted=0";
			$result = $db->query($select, true);
			$row = $db->fetchByAssoc($result);
			$bean->employee_id = intval($row['employee_id'])+1;
		}
	}
}