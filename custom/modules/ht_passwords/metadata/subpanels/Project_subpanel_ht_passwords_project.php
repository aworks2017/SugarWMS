<?php
// created: 2016-11-25 13:38:13
$subpanel_layout['list_fields'] = array (
  'name' => 
  array (
    'vname' => 'LBL_NAME',
    'widget_class' => 'SubPanelDetailViewLink',
    'width' => '20%',
    'default' => true,
  ),
  'password_id' => 
  array (
    'type' => 'varchar',
    'vname' => 'LBL_PASSWORD_ID',
    'width' => '15%',
    'default' => true,
  ),
  'login_id' => 
  array (
    'type' => 'varchar',
    'vname' => 'LBL_LOGIN_ID',
    'width' => '15%',
    'default' => true,
  ),
  'password' => 
  array (
    'type' => 'varchar',
    'vname' => 'LBL_PASSWORD',
    'width' => '15%',
    'default' => true,
  ),
  'notes' => 
  array (
    'type' => 'text',
    'studio' => 'visible',
    'vname' => 'LBL_NOTES',
    'sortable' => false,
    'width' => '26%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'ht_passwords',
    'width' => '5%',
    'default' => true,
  ),
);