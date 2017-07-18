<?php
// created: 2015-10-26 14:06:25
$subpanel_layout['list_fields'] = array (
  'date_modified' => 
  array (
    'vname' => 'LBL_DATE_MODIFIED',
    'width' => '25%',
    'default' => true,
  ),
  'modified_by_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'vname' => 'LBL_MODIFIED_NAME',
    'id' => 'MODIFIED_USER_ID',
    'width' => '25%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Users',
    'target_record_key' => 'modified_user_id',
  ),
  'action_job' => 
  array (
    'type' => 'enum',
    'vname' => 'LBL_ACTION',
    'width' => '25%',
    'default' => true,
  ),
  'action_stop' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_ACTION_STOP',
    'width' => '13%',
  ),
  'action_info' => 
  array (
    'type' => 'varchar',
    'vname' => 'LBL_ACTION_INFO',
    'width' => '12%',
    'default' => true,
  ),
);