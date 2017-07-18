<?php
$module_name = 'ht_passwords';
$listViewDefs [$module_name] = 
array (
  'NAME' => 
  array (
    'width' => '25%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
  ),
  'PASSWORD_ID' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_PASSWORD_ID',
    'width' => '15%',
    'default' => true,
  ),
  'LOGIN_ID' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_LOGIN_ID',
    'width' => '15%',
    'default' => true,
  ),
  'PASSWORD' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_PASSWORD',
    'width' => '15%',
    'default' => true,
  ),
  'NOTES' => 
  array (
    'type' => 'text',
    'studio' => 'visible',
    'label' => 'LBL_NOTES',
    'sortable' => false,
    'width' => '30%',
    'default' => true,
  ),
);
?>
