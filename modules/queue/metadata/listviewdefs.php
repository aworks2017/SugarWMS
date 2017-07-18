<?php
$module_name = 'queue';
$listViewDefs [$module_name] = 
array (
  'ORDER_NUMBER' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_ORDER_NUMBER_SHORT',
    'width' => '5%',
    'default' => true,
	'sortable' => true,
  ),
  'PRIORITY_RATIO' => 
  array (
    'type' => 'decimal',
    'label' => 'LBL_PRIORITY_RATIO_SHORT',
    'width' => '5.25%',
    'default' => true,
	'sortable' => true,
  ),
  'GROUP_ID' => 
  array (
    'type' => 'int',
    'label' => 'LBL_GROUP_ID',
    'width' => '6.25%',
    'default' => true,
  ),
  'DELIVERABLE_ID' => 
  array (
    'type' => 'relate',
    'label' => 'LBL_DELIVERABLE_ID',
    'width' => '8.3%',
    'default' => true,
	'sortable' => true,
  ),
  'NAME' => 
  array (
    'width' => '8.3%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'PARAMETER_1' => 
  array (
    'width' => '8.3%',
    'label' => 'LBL_PARAMETER_1',
    'default' => true,
  ),
   'PARAMETER_2' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_PARAMETER_2',
    'width' => '8.3%',
    'default' => true,
  ),
  'PRODUCTION_NOTES' => 
  array (
    'type' => 'text',
    'label' => 'LBL_PRODUCTION_NOTES',
    'sortable' => false,
    'width' => '8.3%',
    'default' => true,
  ),
  'STATUS' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_STATUS',
    'width' => '8.3%',
  ), 
  'NOTES' => 
  array (
    'type' => 'text',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_NOTES',
    'width' => '8.3%',
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'link' => true,
    'type' => 'relate',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'id' => 'ASSIGNED_USER_ID',
    'width' => '8.3%',
    'default' => true,
  ),
  'PROJECT_DUE_DATE' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_PROJECT_DUE_DATE_LIST',
    'width' => '10%',
    'default' => true,
  ),
  'ESTIMATED_START' => 
  array (
    'type' => 'datetimecombo',
    'label' => 'LBL_ESTIMATED_START',
    'width' => '8.3%',
    'default' => true,
  ),
);
?>
