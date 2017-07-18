<?php
$hook_version = 1; 
$hook_array = Array(); 
$hook_array['process_record'] = Array(); 
$hook_array['process_record'][] = Array(10, 'Notes Icon', 'modules/queue/queueHook.php', 'queueHook', 'addNoteIcon');
$hook_array['process_record'][] = Array(10, 'change jobs status from list view', 'custom/modules/jobs/jobsHook.php', 'jobsHook', 'changeStatus');
$hook_array['before_save'] = Array(); 
$hook_array['before_save'][] = Array(10, 'get Actual effort', 'custom/modules/jobs/jobsHook.php', 'jobsHook', 'changeAssignUser');
?>