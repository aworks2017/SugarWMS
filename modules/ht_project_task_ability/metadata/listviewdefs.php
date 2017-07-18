<?php
$module_name = 'ht_project_task_ability';
$listViewDefs [$module_name] = 
array (
  'PROJECTTASK_NAME' => 
  array (
    'type' => 'relate',
    'studio' => 'visible',
    'label' => 'LBL_PROJECTTASK_NAME',
    'id' => 'PROJECTTASK_ID',
    'link' => true,
    'width' => '10%',
    'default' => true,
	'related_fields' => 
    array (
      0 => 'projecttask_id',
    ),
  ),
   'PROJECT_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'studio' => 'visible',
    'label' => 'LBL_PROJECT_NAME',
    'id' => 'PROJECT_ID',
    'width' => '20%',
    'default' => true,
  ),
  'ACCOUNT_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'studio' => 'visible',
    'label' => 'LBL_ACCOUNT_NAME',
    'id' => 'ACCOUNT_ID',
    'width' => '15%',
    'default' => true,
  ),
  'ASSOCIATE_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSOCIATE_NAME',
	'type' => 'relate',
	'studio' => 'visible',
	'link' => true,
    'id' => 'ASSOCIATE_ID',
    'default' => true,
	'related_fields' => 
    array (
      0 => 'associate_id',
    ),
  ),
  'ABILITY_LEVEL' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_ABILITY_LEVEL',
    'width' => '10%',
  ),
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => false,
    'link' => true,
  ),
);
?>
