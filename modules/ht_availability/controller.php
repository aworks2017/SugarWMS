<?php
class ht_availabilityController extends SugarController {
	function action_index(){
		echo '<javascript type="text/javascript">open_popup(\'jobs\', \'600\', \'400\', \'&record={$fields.id.value}&module_name=jobs&view_job_queue=true\', true, false,\'\' ); return false;"></script>';
	}
	function action_listview(){
		echo '<javascript type="text/javascript">open_popup(\'jobs\', \'600\', \'400\', \'&record={$fields.id.value}&module_name=jobs&view_job_queue=true\', true, false,\'\' ); return false;"></script>';
	}
}
?>