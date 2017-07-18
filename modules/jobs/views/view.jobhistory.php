<?php
require_once('include/MVC/View/SugarView.php');
require_once('include/TemplateHandler/TemplateHandler.php');
class jobsViewJobhistory extends SugarView{
	public function __construct() {
			parent::SugarView();
			$this->th = new TemplateHandler();
			$this->th->ss =& $this->ss;
		}
 	function display() {
 		$this->jobhistory();
 	}
	function jobhistory() {
		global $db,$app_list_strings, $timedate;
		$job_id = $_REQUEST['record'];
		$sql = "SELECT * FROM ht_job_history 
				WHERE jobs_id ='{$job_id}' AND deleted=0 
				ORDER BY date_entered DESC";
		$result = $db->query($sql, true);
		$this->selected_records = $_REQUEST['view_job_history'];
		$this->ss->assign('selected_records', $this->selected_records);
		$i=0;
		$value = array();
		while($row = $db->fetchByAssoc($result)){
			$row['date_entered'] = $timedate->to_display_date_time($row['date_entered']);
			$value[$i] = $row;
			$value[$i]['action_stop'] = $row['action_job']=='stop' ? $app_list_strings['action_stop_list'][$row['action_stop']] : '';
			if($i%2 != 0){
				$css_class = 'same';	
			}else{
				$css_class = 'alt';
			}
			$value[$i]['css_class'] = $css_class;
			$i++;
		}
		$this->ss->assign('results', $value );
		echo $this->th->displayTemplate("jobs", "viewhistory", "modules/jobs/tpls/viewhistory.tpl");			
	}	
}
?>
