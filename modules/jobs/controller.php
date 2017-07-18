<?php
include 'modules/jobs/updateQueue.php';
class jobsController extends SugarController {
	function action_Popup(){
		if(isset($_REQUEST['view_job_history']) && !empty($_REQUEST['view_job_history'])){			
			$this->view = 'jobhistory';
		}elseif(isset($_REQUEST['view_job_queue']) && !empty($_REQUEST['view_job_queue'])){
			echo '<link rel="stylesheet" type="text/css" href="cache/themes/Sugar5/css/yui.css?v=wnp0HbAFkNhCwf9l6DueSA" /><link rel="stylesheet" type="text/css" href="include/javascript/jquery/themes/base/jquery.ui.all.css" /><link rel="stylesheet" type="text/css" href="cache/themes/Sugar5/css/deprecated.css?v=wnp0HbAFkNhCwf9l6DueSA" /><link rel="stylesheet" type="text/css" href="cache/themes/Sugar5/css/style.css?v=wnp0HbAFkNhCwf9l6DueSA" />
				<script>jscal_today = 1000*1446695557; if(typeof app_strings == "undefined") app_strings = new Array();</script><script type="text/javascript" src="cache/include/javascript/sugar_grp1_jquery.js?v=wnp0HbAFkNhCwf9l6DueSA"></script><script type="text/javascript" src="cache/include/javascript/sugar_grp1_yui.js?v=wnp0HbAFkNhCwf9l6DueSA"></script><script type="text/javascript" src="cache/include/javascript/sugar_grp1.js?v=wnp0HbAFkNhCwf9l6DueSA"></script><script type="text/javascript" src="include/javascript/calendar.js?v=wnp0HbAFkNhCwf9l6DueSA"></script><script>
				<script type="text/javascript">SUGAR.themes.image_server="";</script><script type="text/javascript">var name_format = "s f l";</script><script type="text/javascript">
					var time_reg_format = \'([0-9]{1,2}):([0-9]{1,2})([ ]*[ap]m)\';
					var date_reg_format = \'([0-9]{1,2})/([0-9]{1,2})/([0-9]{4})\';
					var date_reg_positions = { \'m\': 1,\'d\': 2,\'Y\': 3 };
					var time_separator = \':\';
					var cal_date_format = \'%m/%d/%Y\';
					var time_offset = -21600;
					var num_grp_sep = \',\';
					var dec_sep = \'.\';
				</script><script type="text/javascript" src="cache/jsLanguage/en_us.js?v=wwfZ5tpzrvs2ZbnzeLoVQA"></script><script type="text/javascript" src="cache/jsLanguage/Home/en_us.js?v=wwfZ5tpzrvs2ZbnzeLoVQA"></script><script type=\'text/javascript\'>
				var sugar_cache_dir = \'cache/\';
				var action_sugar_grp1 = \'ajaxui\';
				</script>
				<script type="text/javascript" src="cache/themes/Sugar5/js/style.js?v=wnp0HbAFkNhCwf9l6DueSA"></script>';
			$this->view = 'jobsqueue';
				
		}else{
			$this->view = 'popup';
		}
	}
	function action_CreateView(){		
		$this->view = 'create';
	}
	function action_queue(){	
	
		$this->view = 'jobsqueue';
	
	}
	function action_reassign(){		
		$this->view = 'reassign';
	}
	function action_deliverable_tasks(){	
		$this->view = 'deliverabletasks';
	}
	function action_reassignSubmit(){		
		reassignSubmit($_REQUEST['job_id'], $_REQUEST['reassign_user']);
	}
	function action_specialHandling(){		
		specialHandling('Special Handling',$_REQUEST['job_id']);
	}
	function action_save_jobs(){
		if(isset ($_REQUEST['tasks']) && !empty ($_REQUEST['tasks'])){
			$tasks = $_REQUEST['tasks'];
			foreach ($tasks AS $task_no => $task_id){
				$due_hours = $_REQUEST['job_due_date_hours_'.$task_id] < '1'  ? '00': $_REQUEST['job_due_date_hours_'.$task_id];
				$due_minutes = $_REQUEST['job_due_date_minutes_'.$task_id] < '1'  ? '00' : $_REQUEST['job_due_date_minutes_'.$task_id];
				$task_due_date = $_REQUEST['job_due_date_'.$task_id].' ' .$due_hours.':'.$due_minutes.$_REQUEST['job_due_date_meridiem_'.$task_id];
				$assigned_user_id='';
				if($_REQUEST['assigned_user_id_drop_'.$task_id] !='0'){
					$assigned_user_id = $_REQUEST['assigned_user_id_drop_'.$task_id];
				}else{
					$assigned_user_id =$_REQUEST['assigned_user_id_'.$task_id];
				}
				save_jobs($task_id, $_REQUEST['account_id'], $_REQUEST['project_id'], $_REQUEST['project_due_date'],$_REQUEST['parameter_1'],$_REQUEST['parameter_2'],$_REQUEST['task_name_'.$task_id], $task_due_date,$_REQUEST['task_status'.$task_id],$_REQUEST['task_priority'.$task_id],$_REQUEST['task_buffer'.$task_id],$_REQUEST['production_notes_'.$task_id], $assigned_user_id, $_REQUEST['activity_driver'.$task_id], $_REQUEST['activity_count'], $_REQUEST['restrict_start_days'], $_REQUEST['estimated_minutes_'.$task_id]);
			}
		}
		$popup = (isset($_REQUEST['jobqueueform']))? $_REQUEST['jobqueueform'] : '';
		if($popup == 'jobqueueformsubmit'){
			SugarApplication::redirect("index.php?module=jobs&action=queue");
		}
		else{
			SugarApplication::redirect("index.php?module=queue&action=index");
		}
	}
	function action_change_status(){
		if(!empty($_REQUEST['id'])){
			global $db;
			$update ='';
			$update .= (!empty($_REQUEST['status'])) ? "status='{$_REQUEST['status']}'" : "priority='{$_REQUEST['priority']}'";
			if(!empty($_REQUEST['status'])){
				$select = "SELECT current_job_id 
					   FROM users 
					   WHERE deleted=0 AND current_job_id='{$_REQUEST['id']}'";
				$result = $db->query($select, true);
				if($db->getRowCount($result) > 0){
					echo 2;
				}else{
					$sql = "UPDATE jobs SET {$update} WHERE deleted=0 AND id='{$_REQUEST['id']}'";
					return $db->query($sql, true);				
				}
			}else{
				$sql = "UPDATE jobs SET {$update} WHERE deleted=0 AND id='{$_REQUEST['id']}'";
				return $db->query($sql, true);
			}
		}
	}
	function action_change_note(){
		if(!empty($_REQUEST['job_id'])){
			global $db;
			$sql = "UPDATE jobs SET {$_REQUEST['field']}='{$_REQUEST['field_val']}' WHERE deleted=0 AND id='{$_REQUEST['job_id']}'";
			return $db->query($sql, true);
		}
	}
	
	function action_change_assigned_user(){
		if(!empty($_REQUEST['assigned_user']) && !empty($_REQUEST['job_id'])){
			global $db;
			$assigned_value = "'{$_REQUEST['assigned_user']}'";
			if($_REQUEST['assigned_user'] == 'NULL'){
				$assigned_value = 'NULL';
			}
			$select = "SELECT current_job_id 
					   FROM users 
					   WHERE deleted=0 AND current_job_id='{$_REQUEST['job_id']}'";
			$result = $db->query($select, true);
			if($db->getRowCount($result) > 0){
				echo 2;
			}else{
				$sql = "UPDATE jobs SET assigned_user_id={$assigned_value} WHERE deleted=0 AND id='{$_REQUEST['job_id']}'";
				return $db->query($sql, true);				
			}
		}
	}
	function action_get_users(){
		if(!empty($_REQUEST['id'])){
			$job = BeanFactory::getBean('jobs', $_REQUEST['id']);
			global $db;
			$sql = "SELECT users.id,CONCAT_WS(' ', users.first_name, users.last_name) as user_name 
					FROM users
					WHERE users.deleted=0 AND users.status='Active' AND users.id NOT IN(
						SELECT associate_id AS id 
						FROM (
							SELECT *
							FROM (
								SELECT *
								FROM ht_project_task_ability 
								WHERE deleted=0 AND projecttask_id='{$job->project_task_id}'
								ORDER BY date_modified DESC
							) as inner_tab
							GROUP BY associate_id
						) outer_tab
						WHERE ability_level ='Excluded'
					)";
			$result = $db->query($sql, true);
			$users = array();
			while($row = $db->fetchByAssoc($result)){
				$users[$row['id']] = $row['user_name'];
			}
			echo json_encode($users);
			return true;
		}
	}
	function action_change_ability_level(){
		if(!empty($_REQUEST['ability_level']) && !empty($_REQUEST['id'])){
			global $db;
			$sql = "UPDATE ht_project_task_ability SET ability_level='{$_REQUEST['ability_level']}' WHERE deleted=0 AND id='{$_REQUEST['id']}'";
			return $db->query($sql, true);
		}
	}
	function action_getDeliverablesFields(){
		global $db;
			$query_project = "SELECT parameter_1,parameter_2,restrict_start_days,activity_driver FROM project where deleted = 0 and id='{$_REQUEST['deliverable_id']}' and status='Published'";
			$result_project = $db->query($query_project, false);
			$row_project = $db->fetchByAssoc($result_project);
				$deliverable_fields[] = array(
				'parameter_1' => $row_project['parameter_1'],
				'parameter_2' => $row_project['parameter_2'],
				'restrict_start_days' => $row_project['restrict_start_days'],
				'activity_driver' => $row_project['activity_driver']
				);
			print_r(json_encode($deliverable_fields,JSON_FORCE_OBJECT));die;
	}
	function action_getDeliverables(){
		global $db;
		$query = "SELECT project.id, project.name, project.deliverable_id
				  FROM project
				  INNER JOIN projects_accounts ON(projects_accounts.deleted=0 AND project.id=projects_accounts.project_id)
				  WHERE project.deleted = 0 AND project.status='Published' AND projects_accounts.account_id='{$_REQUEST['account_id']}'
				  ORDER BY project.deliverable_id ASC";
		$result = $db->query($query, false);
		$deliverable[] = array(
			'label' => '|',
			'value' => ''
		);
		while($row = $db->fetchByAssoc($result)) {
			$deliverable[] = array(
			'label' => $row['deliverable_id'].'|'.$row['name'],
			'value' => $row['id']
			);
		}
		print_r(json_encode($deliverable,JSON_FORCE_OBJECT));die;		
	}
}
?>