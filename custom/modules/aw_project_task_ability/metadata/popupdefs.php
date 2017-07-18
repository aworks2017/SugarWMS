<?php
$popupMeta = array (
    'moduleMain' => 'aw_project_task_ability',
    'varName' => 'aw_project_task_ability',
    'orderBy' => 'aw_project_task_ability.name',
    'whereClauses' => array (
  'task_c' => 'aw_project_task_ability.task_c',
  'assigned_user_name' => 'aw_project_task_ability.assigned_user_name',
  'ability_level_c' => 'aw_project_task_ability_cstm.ability_level_c',
),
    'searchInputs' => array (
  4 => 'task_c',
  5 => 'assigned_user_name',
  6 => 'ability_level_c',
),
    'searchdefs' => array (
  'task_c' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_TASK',
    'id' => 'PROJECTTASK_ID_C',
    'link' => true,
    'width' => '10%',
    'name' => 'task_c',
  ),
  'assigned_user_name' => 
  array (
    'link' => true,
    'type' => 'relate',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'id' => 'ASSIGNED_USER_ID',
    'width' => '10%',
    'name' => 'assigned_user_name',
  ),
  'ability_level_c' => 
  array (
    'type' => 'enum',
    'studio' => 'visible',
    'label' => 'LBL_ABILITY_LEVEL',
    'width' => '10%',
    'name' => 'ability_level_c',
  ),
),
);
