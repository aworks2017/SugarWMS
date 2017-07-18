<?php
$hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['after_save'] = Array(); 
$hook_array['before_save'] = Array(); 
$hook_array['process_record'] = Array(); 
$hook_array['process_record'][] = Array(10, 'change jobs status from list view', 'custom/modules/jobs/jobsHook.php', 'jobsHook', 'changeStatus');
$hook_array['process_record'][] = Array(10, 'Notes Icon', 'modules/queue/queueHook.php', 'queueHook', 'addNoteIcon');
//$hook_array['process_record'][] = Array(10, 'get Deliverable ID ', 'custom/modules/jobs/jobsHook.php', 'jobsHook', 'getDeliverableId');
$hook_array['process_record'][] = Array(10, 'change jobs priority from list view', 'custom/modules/jobs/jobsHook.php', 'jobsHook', 'changePriority');
$hook_array['before_save'][] = Array(10, 'get Actual effort', 'custom/modules/jobs/jobsHook.php', 'jobsHook', 'changeAssignUser');
$hook_array['before_save'][] = Array(11, 'get Group ID', 'custom/modules/jobs/jobsHook.php', 'jobsHook', 'getGroupId');
$hook_array['after_save'][] = Array(40, 'initialize queue', 'modules/jobs/jobsQueue.php', 'jobsQueue', 'initialize_queue');
$hook_array['after_save'][] = Array(40, 'set assignment to null', 'modules/jobs/jobsQueue.php', 'jobsQueue', 'updateAssignment');
//$hook_array['after_save'][] = Array(42, 'initialize queue', 'modules/jobs/jobsQueue.php', 'jobsQueue', 'refresh_queue');
$hook_array['after_save'][] = Array(43, 'set actual_effort to 0 ', 'custom/modules/jobs/jobsHook.php', 'jobsHook', 'updateActualEffort');
?>