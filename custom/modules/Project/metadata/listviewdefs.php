<?php
$listViewDefs ['Project'] = 
array (
  'NAME' => 
  array (
    'width' => '30%',
    'label' => 'LBL_LIST_NAME',
    'link' => true,
    'default' => true,
  ),
  'ACCOUNT_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'studio' => 'visible',
    'label' => 'LBL_ACCOUNT_NAME',
    'id' => 'ACCOUNT_ID',
    'width' => '20%',
    'default' => true,
  ),
  'STATUS' => 
  array (
    'width' => '20%',
    'label' => 'LBL_STATUS',
    'link' => false,
    'default' => true,
  ),
  'SUBCLIENT_CODE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_SUBCLIENT_CODE',
    'width' => '10%',
    'default' => true,
  ),
  'DELIVERABLE_ID' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_DELIVERABLE_ID',
    'width' => '10%',
    'default' => true,
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_ASSIGNED_USER_ID',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
  ),
  'ESTIMATED_START_DATE' => 
  array (
    'width' => '20%',
    'label' => 'LBL_DATE_START',
    'link' => false,
    'default' => false,
  ),
  'ESTIMATED_END_DATE' => 
  array (
    'width' => '20%',
    'label' => 'LBL_DATE_END',
    'link' => false,
    'default' => false,
  ),
);
?>
