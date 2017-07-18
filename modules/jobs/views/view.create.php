<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
class jobsViewCreate extends ViewEdit
{
	public function preDisplay()
    {
        $metadataFile = 'modules/jobs/metadata/createviewdefs.php';
        $this->ev = $this->getEditView();
        $this->ev->ss =& $this->ss;
        $this->ev->setup($this->module, $this->bean, $metadataFile, get_custom_file_if_exists('include/EditView/EditView.tpl'));
    }
	public function display(){
		$this->ev->formName = "CreateView";
		echo $this->getQSData();
		parent::display();
	}
	private function getQSData(){
		$json = getJSONobj();
		require_once('include/QuickSearchDefaults.php');
		$qsd = QuickSearchDefaults::getQuickSearchDefaults();
		$sqs_objects =array();
		
		$param = array(
			'Accounts' => 'account',
			'Project' => 'project',
		);
		
		foreach ($param as $module => $field){
			$sqs_objects[$field.'_name'] = $qsd->getQSParent($module);
			$sqs_objects[$field.'_name']['form'] = $this->ev->formName ;
			if($module=='Project'){				
				$sqs_objects[$field.'_name']['field_list'] = array('name', 'id', 'parameter_1', 'parameter_2','restrict_start_days');
				$sqs_objects[$field.'_name']['populate_list'] = array($field.'_name', $field.'_id', 'parameter_1', 'parameter_2','restrict_start_days');
			 }else{				
				 $sqs_objects[$field.'_name']['populate_list'] = array($field.'_name', $field.'_id');
			 }
		}
		
		$quicksearch_js = '<script type="text/javascript" language="javascript">sqs_objects= ' . $json->encode($sqs_objects) . '; enableQS();</script>';
		
		return $quicksearch_js;
	}
}