<?php
$module_name = 'aw_project_task_ability';
$listViewDefs [$module_name] = 
array (
  'ABILITY_LEVEL_C' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_ABILITY_LEVEL',
    'width' => '10%',
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
  'TASK_C' => 
  array (
    'type' => 'relate',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_TASK',
    'id' => 'PROJECTTASK_ID_C',
    'link' => false,
    'width' => '10%',
  ),
);
?>
