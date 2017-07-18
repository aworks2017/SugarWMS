<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point'); 
global $mod_strings, $app_strings, $sugar_config;

		
$module_menu[]=Array("index.php?module=jobs&action=CreateView&return_module=jobs&return_action=DetailView", 
					$mod_strings['LNK_NEW_RECORD'],
					"custom/themes/default/images/Createjobs.gif", 
					'jobs');
							
$module_menu[]= Array("index.php?module=jobs&action=index", 
					$mod_strings['LNK_LIST'],
					"custom/themes/default/images/icon_jobs_32.gif", 
					'jobs');
if(ACLController::checkAccess('jobs', 'import', true))$module_menu[]=Array("index.php?module=Import&action=Step1&import_module=jobs&return_module=jobs&return_action=index", $mod_strings['LNK_IMPORT_JOBS'],"Import", 'jobs');
?>