<?php
$module_name = 'jobs';
$listViewDefs [$module_name] = 
array (
  'GROUP_ID' => 
  array (
    'type' => 'int',
    'label' => 'LBL_GROUP_ID',
    'width' => '10%',
    'default' => true,
  ),
  'DELIVERABLE_ID' => 
  array (
    'type' => 'relate',
    'label' => 'LBL_DELIVERABLE_ID',
    'width' => '10%',
    'default' => true,
	'sortable' => true,
  ),
  
  'NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_NAME',
    'default' => true,
    'link' => true,
  ),
  'PARAMETER_1' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_PARAMETER_1',
    'width' => '15%',
    'default' => true,
  ),
  'PARAMETER_2' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_PARAMETER_2',
    'width' => '10%',
    'default' => true,
  ),
  'PRODUCTION_NOTES' => 
  array (
    'type' => 'text',
    'label' => 'LBL_PRODUCTION_NOTES',
    'sortable' => false,
    'width' => '5%',
    'default' => true,
  ),
  'STATUS' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_STATUS',
    'width' => '10%',
  ),
  'NOTES' => 
  array (
    'type' => 'text',
    'label' => 'LBL_NOTES',
    'sortable' => false,
    'width' => '5%',
    'default' => true,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'link' => true,
    'type' => 'relate',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'id' => 'ASSIGNED_USER_ID',
    'width' => '10%',
    'default' => true,
  ),
  'PROJECT_DUE_DATE' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_PROJECT_DUE_DATE',
    'width' => '10%',
    'default' => true,
  ),
  'ACTUAL_EFFORT' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_ACTUAL_EFFORT',
    'width' => '8%',
    'default' => true,
  ), 
);
?>
