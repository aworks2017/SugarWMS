<?php
require_once('include/MVC/View/SugarView.php');
require_once('include/TemplateHandler/TemplateHandler.php');
require_once('include/SugarFields/SugarFieldHandler.php');
class jobsViewDeliverabletasks extends ViewEdit
{
	public function __construct() {
		parent::SugarView();
		$this->th = new TemplateHandler();
		$this->th->ss =& $this->ss;
	}
 	function display() {
		$this->taskslist();
		echo '<style>
		#header, #footer, .error{
			display:none;
		}
		</style>';
		//parent::display();
 	}
	function taskslist() {
		global $db,$app_list_strings,$timedate;
		if (isset ($_REQUEST['deliverable_id']) && !empty($_REQUEST['deliverable_id'])){
			$project_id = $_REQUEST['deliverable_id'];
			$project = BeanFactory::getBean('Project');
			$project->retrieve($project_id);
			$sql = "SELECT pt.id, pt.name, ptc.activity_driver_c AS activity_driver,pt.production_notes,pt.estimated_effort,pt.buffer_mins, ptc.default_count_c AS activity_count
					FROM project_task pt
					LEFT JOIN project_task_cstm ptc ON (ptc.id_c = pt.id)
					WHERE pt.deleted=0 AND pt.project_id='{$project_id}'
					ORDER BY pt.order_number ASC";
			$result = $db->query($sql, true);
			$jobs  = array();
			$assigned_user_drop  = array();
			$assigned_user_drop[]  = '';
			if($db->getRowCount($result)){
				//$jobs['p_1'] = $project->parameter_1;
				//$jobs['p_2'] = $project->parameter_2;
				while($row = $db->fetchByAssoc($result)){
					$jobs[$row['id']] = array (
					'task_id' =>  $row['id'],
					'task_name' =>  $row['name'],
					'activity_driver' =>  $row['activity_driver'],
					'activity_count' =>  $row['activity_count'],
					'production_notes' =>  $row['production_notes'],
					'estimated_effort' =>  $row['estimated_effort']
					);
					$jobs[$row['id']]['sqs_data'] = $this->getQSData($row['id']);
					$assigned_user_drop[$row['id']]=  $this->getAllUsers($row['id']);
				}
			}
				
			$this->ss->assign('ASSIGN_USERS', $assigned_user_drop);
			$this->ss->assign('results', $jobs);
			$this->ss->assign('TIME_MERIDIEM', $app_list_strings['dom_meridiem_lowercase']);
			$this->ss->assign('HOURS_LIST', $app_list_strings['hours_list']);
			$this->ss->assign('MINUTES_LIST', $app_list_strings['minutes_list']);
			$this->ss->assign('PRIORITY_STATUS_OPTIONS', $app_list_strings['priority_status_options']);
			$this->ss->assign('JOB_STATUS_DOM', $app_list_strings['job_status_dom']);
			echo $this->th->displayTemplate("jobs", "viewdeliverabletasks", "modules/jobs/tpls/viewdeliverabletasks.tpl");			
		
		}
	}
	private function getQSData($task_id){
		$json = getJSONobj();
		require_once('include/QuickSearchDefaults.php');
		$qsd = QuickSearchDefaults::getQuickSearchDefaults();
		$sqs_objects =array();
		$p_1 = 'assigned_user_name_'.$task_id;
		$p_2 = 'assigned_user_id_'.$task_id;
		$sqs_objects[$p_1] = $qsd->getQSUser($p_1,$p_2);
		$sqs_objects[$p_1]['form'] = "CreateView" ;
		return json_encode($sqs_objects);
		 
	}
	private function getAllUsers($task_id){
			global $db,$app_list_strings,$timedate;
			$sql = "SELECT users.id,CONCAT_WS(' ', users.first_name, users.last_name) as user_name 
					FROM users
					WHERE users.deleted=0 AND users.status='Active' AND users.id NOT IN(
						SELECT associate_id AS id 
						FROM (
							SELECT *
							FROM (
								SELECT *
								FROM ht_project_task_ability 
								WHERE deleted=0 AND projecttask_id='{$task_id}'
								ORDER BY date_modified DESC
							) as inner_tab
							GROUP BY associate_id
						) outer_tab
						WHERE ability_level ='Excluded'
					)";
			$result = $db->query($sql, true);
			$assign_users = array();
			$assign_users[] = '';
			while($row = $db->fetchByAssoc($result)){
				$assign_users[$row['id']] = $row['user_name'];
			}
			return $assign_users;
	}

}