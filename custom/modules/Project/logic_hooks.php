<?php 
$hook_version = 1; 
$hook_array = Array(); 
$hook_array['before_save'] = Array(); 
$hook_array['before_save'][] = Array(1, 'convert to upper case', 'custom/modules/project/projectHook.php','projectHook', 'convertToUppercase');
?>