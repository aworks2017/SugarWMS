<?php
class accountHook {
	    function convertToUppercase(&$bean, $event, $arguments){
		$bean->client_code = strtoupper($bean->client_code);
    }
}