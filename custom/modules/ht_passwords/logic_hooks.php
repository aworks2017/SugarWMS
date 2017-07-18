<?php
$hook_version = 1; 
$hook_array = Array(); 
// position, file, function 
$hook_array['process_record'] = Array(); 
$hook_array['process_record'][] = Array(10, 'copy password functionality', 'modules/ht_passwords/passwordsHook.php', 'passwordsHook', 'copyPassword');
?>