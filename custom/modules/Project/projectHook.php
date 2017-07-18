<?php
class projectHook {
	function convertToUppercase(&$bean, $event, $arguments){
		$bean->subclient_code = strtoupper($bean->subclient_code);
		$bean->deliverable_id = strtoupper($bean->deliverable_id);
    }
}