<?php
$hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['process_record'] = Array(); 
$hook_array['process_record'][] = Array(10, 'change ability level from list view', 'custom/modules/ht_project_task_ability/ht_project_task_abilityHook.php', 'ht_project_task_abilityHook', 'changeAbilityLevel');
?>