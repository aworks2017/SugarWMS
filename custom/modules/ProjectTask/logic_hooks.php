<?php
$hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['after_ui_frame'] = Array(); 
$hook_array['before_save'] = Array(); 
$hook_array['after_relationship_add'] = Array();
$hook_array['before_save'][] = Array(77, 'create tasks ability records', 'custom/modules/ProjectTask/ProjectTaskHook.php','ProjectTaskHook', 'createTaskAbilityRecords'); 
$hook_array['before_save'][] = Array(20, 'set first time save', 'custom/modules/ProjectTask/ProjectTaskHook.php','ProjectTaskHook', 'recordFirstTimeSave'); 
$hook_array['after_save'][] = Array(78, 'create recurring deliverable jobs', 'custom/modules/ProjectTask/ProjectTaskHook.php','ProjectTaskHook', 'createRecurringJobs'); 
$hook_array['after_relationship_add'][] = Array(100, 'update task order Asc', 'custom/modules/ProjectTask/ProjectTaskHook.php', 'ProjectTaskHook', 'updateTaskOrderASC');
$hook_array['before_relationship_delete'] = Array();
$hook_array['before_relationship_delete'][] = Array(100, 'update task order Desc', 'custom/modules/ProjectTask/ProjectTaskHook.php', 'ProjectTaskHook', 'updateTaskOrderDesc');
?>	