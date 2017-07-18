<?php
$popupMeta = array (
    'moduleMain' => 'ht_project_task_ability',
    'varName' => 'ht_project_task_ability',
    'orderBy' => 'ht_project_task_ability.name',
    'whereClauses' => array (
  'name' => 'ht_project_task_ability.name',
),
    'searchInputs' => array (
  0 => 'ht_project_task_ability_number',
  1 => 'name',
  2 => 'priority',
  3 => 'status',
),
    'listviewdefs' => array (
  'PROJECTTASK_NAME' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_PROJECTTASK_NAME',
    'id' => 'PROJECTTASK_ID_C',
    'link' => true,
    'width' => '10%',
    'default' => true,
  ),
  'ASSOCIATE_NAME' => 
  array (
    'link' => true,
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_ASSOCIATE_NAME',
    'id' => 'ASSOCIATE_ID',
    'width' => '10%',
    'default' => true,
  ),
  'ABILITY_LEVEL' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_ABILITY_LEVEL',
    'width' => '10%',
  ),
),
);
