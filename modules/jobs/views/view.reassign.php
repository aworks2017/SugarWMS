<?php
require_once('include/MVC/View/SugarView.php');
require_once('include/TemplateHandler/TemplateHandler.php');
class jobsViewreassign extends SugarView{
	public function __construct() {
		parent::SugarView();
		$this->th = new TemplateHandler();
		$this->th->ss =& $this->ss;
		}
 	function display() {
 		$this->reassign();
 	}
	function reassign() {
		global $db;
		$job_id = $_REQUEST['job_id'];
		$assign_id = $_REQUEST['assign_id'];
		$pro_t_id = $_REQUEST['pt_id'];
		
		$sql = "SELECT users.id AS user_id ,CONCAT_WS(' ', users.first_name, users.last_name) as user_name 
				FROM ht_project_task_ability 
				INNER JOIN users
				ON (ht_project_task_ability.associate_id = users.id AND users.deleted=0)
				WHERE projecttask_id='{$pro_t_id}' AND ability_level != 'Excluded' AND ht_project_task_ability.deleted=0";
		$result = $db->query($sql, true);
		if($db->getRowCount($result)){
			$option = array();
			while($row = $db->fetchByAssoc($result)){
				$option[$row['user_id']] = $row['user_name'];
			}
			$this->ss->assign('option', $option);
			$this->ss->assign('assign_id', $assign_id);
			$this->ss->assign('job_id', $job_id);
			$this->ss->assign('pro_t_id', $pro_t_id);
			echo $this->th->displayTemplate("jobs", "viewreassign", "modules/jobs/tpls/viewreassignuser.tpl");
        }
		else{
			echo'<h3 style="color: #0046ad;margin:42px">No Associate to Re-Assign<h3>';
		}
			
	}	
}
?>
