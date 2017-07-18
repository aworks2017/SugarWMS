<?php
// Do not store anything in this file that is not part of the array or the hook version.  This file will	
// be automatically rebuilt in the future. 
 $hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['after_login'] = Array(); 
$hook_array['after_login'][] = Array(1, 'SugarFeed old feed entry remover', 'modules/SugarFeed/SugarFeedFlush.php','SugarFeedFlush', 'flushStaleEntries'); 
$hook_array['before_save'] = Array(); 
$hook_array['after_save'] = Array(); 
$hook_array['process_record'] = Array(); 
$hook_array['before_save'][] = Array(77, 'create tasks ability records', 'custom/modules/Users/UsersHook.php', 'UsersHook', 'createTaskAbilityRecords'); 
$hook_array['before_save'][] = Array(77, 'Set employee id', 'custom/modules/Users/UsersHook.php', 'UsersHook', 'setEmployeeID'); 
$hook_array['before_save'][] = Array(78, 'create new user in portal', 'custom/modules/Users/UsersHook.php', 'UsersHook', 'addUserToPortal'); 
$hook_array['after_save'][] = Array(80, 'set default associate role', 'custom/modules/Users/UsersHook.php','UsersHook', 'assignToAssociateRole'); 
$hook_array['after_save'][] = Array(90, 'set default password', 'custom/modules/Users/UsersHook.php','UsersHook', 'setDefaultPassword'); 
$hook_array['process_record'][] = Array(90, 'updateJobId', 'custom/modules/Users/UsersHook.php','UsersHook', 'updateJobId'); 
?>