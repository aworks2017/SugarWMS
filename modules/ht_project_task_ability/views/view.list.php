<?php
require_once('include/MVC/View/views/view.list.php');

class ht_project_task_abilityViewList extends ViewList
{
	public function preDisplay() {
        parent::preDisplay();
        $this->lv->delete = false;
		 $this->lv->actionsMenuExtraItems[] = $this->rebuildDeleteButton();
    }
	public function display(){
		parent::display();
		echo '<script type="text/javascript" src="custom/include/javascript/change_ability_level.js"></script>';
		echo $this->getQSData();
	}
	private function getQSData(){
		$json = getJSONobj();
		require_once('include/QuickSearchDefaults.php');
		$qsd = QuickSearchDefaults::getQuickSearchDefaults();
		$sqs_objects =array();
		
		$param = array(
			'ProjectTask' => 'projecttask',
			'Project' => 'project',
			'Users' => 'associate',
			'Accounts' => 'account',
		);
		
		foreach ($param as $module => $field){
			$sqs_objects[$field.'_name_basic'] = $qsd->getQSParent($module);
			$sqs_objects[$field.'_name_basic']['form'] = 'search_form' ;
			$sqs_objects[$field.'_name_basic']['populate_list'] = array($field.'_name_basic', $field.'_id_basic');
		}
		
		$quicksearch_js = '<script type="text/javascript" language="javascript">sqs_objects= ' . $json->encode($sqs_objects) . '; enableQS();</script>';
		
		return $quicksearch_js;
	}
	protected function rebuildDeleteButton()
    {
        global $app_strings;
    
        return <<<EOHTML
<a id ="delete_listview_top" class="menuItem" style="width: 150px;" href="#" onmouseover='hiliteItem(this,"yes");' 
        onmouseout='unhiliteItem(this);' 
        onclick="return sListView.send_mass_update('selected', 'Please select at least 1 record to proceed.', 1)">Delete</a>
EOHTML;
    }
}
