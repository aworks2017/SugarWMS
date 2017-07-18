<?php
// created: 2015-10-15 19:41:05
$subpanel_layout= array (
 	'where' => "ht_project_task_ability.ability_level !='Excluded'",
'list_fields' => array(
  'associate_name' => 
  array (
    'link' => true,
    'type' => 'relate',
    'studio' => 'visible',
    'vname' => 'LBL_ASSOCIATE_NAME',
    'id' => 'ASSOCIATE_ID',
    'width' => '10%',
    'default' => true,
    'widget_class' => 'SubPanelDetailViewLink',
    'target_module' => 'Users',
    'target_record_key' => 'associate_id',
  ),
  'ability_level' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'vname' => 'LBL_ABILITY_LEVEL',
    'width' => '10%',
  ),
  'edit_button' => 
  array (
    'vname' => 'LBL_EDIT_BUTTON',
    'widget_class' => 'SubPanelEditButton',
    'module' => 'ht_project_task_ability',
    'width' => '4%',
    'default' => true,
  ),
  'remove_button' => 
  array (
    'vname' => 'LBL_REMOVE',
    'widget_class' => 'SubPanelRemoveButton',
    'module' => 'ht_project_task_ability',
    'width' => '5%',
    'default' => true,
  ),
  ),
);