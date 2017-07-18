<?php
require_once('include/MVC/View/views/view.list.php');

class jobsViewList extends ViewList
{
	public function preDisplay() {
        parent::preDisplay();
        $this->lv->delete = false;
    }
	public function display(){
		parent::display();
		$time = time();
		echo '<script type="text/javascript" src="custom/include/javascript/change_status.js?v='.$time.'"></script>';
		echo '<script type="text/javascript" src="modules/queue/js/en_us.js"></script>';
		echo '<script type="text/javascript" src="cache/include/javascript/sugar_grp_yui_widgets.js"></script>';
		echo '<script type="text/javascript" src="modules/queue/js/list.js?v='.$time.'"></script>';
		echo $this->getQSData();
		echo '<style>
			.list tr.oddListRowS1 td, .list tr.evenListRowS1 td{
				word-break:break-all;
			}
		</style>';
	}
	function listViewProcess(){
        $this->processSearchForm();
        $this->lv->searchColumns = $this->searchForm->searchColumns;

        if(!$this->headers)
            return;
		$this->where = str_replace("(jobs.actual_finish like '[]%' )", "1=1", $this->where);
		$this->where = str_replace("(jobs.have_notes IS NULL OR jobs.have_notes = '')", "1=1", $this->where);
		$this->where = str_replace("jobs.have_notes in ('Yes')", "1=1", $this->where);
		$this->where = str_replace("jobs.have_notes in ('No')", "1=1", $this->where);
		if(isset($_REQUEST['have_notes_advanced']) && isset($_REQUEST['have_notes_advanced'][0]) && !empty($_REQUEST['have_notes_advanced'][0])){
			if($_REQUEST['have_notes_advanced'][0] == 'Yes'){
				$this->where .=" AND jobs.notes IS NOT NULL AND jobs.notes!=''";
			}elseif($_REQUEST['have_notes_advanced'][0] == 'No'){
				$this->where .=" AND jobs.notes IS NULL OR jobs.notes=''";
			}
		}
        if(empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false){
            $this->lv->ss->assign("SEARCH",true);
            $this->lv->setup($this->seed, 'modules/jobs/tpls/ListViewGeneric.tpl', $this->where, $this->params);
            $savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' - ' . $_REQUEST['saved_search_select_name']);
            echo $this->lv->display();
        }
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
			$sqs_objects[$field.'_name_advanced'] = $qsd->getQSParent($module);
			$sqs_objects[$field.'_name_advanced']['form'] = 'search_form' ;
			$sqs_objects[$field.'_name_advanced']['populate_list'] = array($field.'_name_advanced', $field.'_id_advanced');
		}
		
		$quicksearch_js = '<script type="text/javascript" language="javascript">sqs_objects= ' . $json->encode($sqs_objects) . '; enableQS();</script>';
		
		return $quicksearch_js;
	}
}
