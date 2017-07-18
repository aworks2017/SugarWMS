<?php
$module_name = 'ht_project_task_ability';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'projecttask_name' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_PROJECTTASK_NAME',
        'id' => 'PROJECTTASK_ID',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'projecttask_name',
      ),
      'project_name' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_PROJECT_NAME',
        'id' => 'PROJEC_ID',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'project_name',
      ),
      'account_name' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_ACCOUNT_NAME',
        'id' => 'ACCOUNT_ID',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'account_name',
      ),
      'associate_name' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_ASSOCIATE_NAME',
        'id' => 'ASSOCIATE_ID',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'associate_name',
      ),
      'ability_level' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_ABILITY_LEVEL',
        'width' => '10%',
        'name' => 'ability_level',
      ),
      'current_user_only' => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
      ),
    ),
    'advanced_search' => 
    array (
      'projecttask_name' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_PROJECTTASK_NAME',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'id' => 'PROJECTTASK_ID_C',
        'name' => 'projecttask_name',
      ),
      'project_name' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_PROJECT_NAME',
        'id' => 'PROJEC_ID',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'project_name',
      ),
      'associate_name' => 
      array (
        'type' => 'relate',
        'studio' => 'visible',
        'label' => 'LBL_ASSOCIATE_NAME',
        'id' => 'ASSOCIATE_ID',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'associate_name',
      ),
      'ability_level' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_ABILITY_LEVEL',
        'width' => '10%',
        'name' => 'ability_level',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '2',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
?>
