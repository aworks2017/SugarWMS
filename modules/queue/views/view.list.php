<?php
require_once('include/MVC/View/views/view.list.php');

class queueViewList extends ViewList
{
	public function preDisplay() {
        parent::preDisplay();
        $this->lv->delete = false;
    }
	function listViewProcess(){
        $this->processSearchForm();
        $this->lv->searchColumns = $this->searchForm->searchColumns;
        if(!$this->headers)
            return;
        if(empty($_REQUEST['search_form_only']) || $_REQUEST['search_form_only'] == false){
            if(!empty($this->where)){
                    $this->where .= " AND ";
            }
            $this->where .= " jobs.status IN('Ready', 'Not Ready', 'Started', 'In Progress', 'Issue','Defer','On Hold') " ;
            $this->where .= " AND jobs.order_number IS NOT NULL AND jobs.order_number !=0 " ;
			$this->lv->ss->assign("SEARCH",true);
            $this->lv->setup($this->seed, 'modules/queue/tpls/ListViewGeneric.tpl', $this->where, $this->params);
            $savedSearchName = empty($_REQUEST['saved_search_select_name']) ? '' : (' ----- ' . $_REQUEST['saved_search_select_name']);
            echo $this->lv->display();
        }
    }
	public function display(){
		echo '<script type="text/javascript" src="modules/jobs/js/jobs.js"></script>';
		parent::display();
		$time = time();
		echo '<script type="text/javascript" src="cache/include/javascript/sugar_grp_yui_widgets.js"></script>';
		echo '<script type="text/javascript" src="modules/queue/js/list.js?v='.$time.'"></script>';
		echo '<script type="text/javascript" src="modules/queue/js/en_us.js"></script>';
		echo '<script type="text/javascript" src="custom/include/javascript/change_status.js?v='.$time.'"></script>';
		echo $this->getQSData();
		echo '<style>
			.list tr.oddListRowS1 td, .list tr.evenListRowS1 td{
				word-break:break-all;
			}
		</style>';
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
			$sqs_objects[$field.'_name_basic'] = $qsd->getQSParent($module);
			$sqs_objects[$field.'_name_basic']['form'] = 'search_form' ;
			$sqs_objects[$field.'_name_basic']['populate_list'] = array($field.'_name_basic', $field.'_id_basic');
		}

		$quicksearch_js = '<script type="text/javascript" language="javascript">sqs_objects= ' . $json->encode($sqs_objects) . '; enableQS();</script>';

		return $quicksearch_js;
	}
}
