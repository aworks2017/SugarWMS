<?php
$module_name = 'aw_project_task_ability';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'task_c' => 
      array (
        'type' => 'relate',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_TASK',
        'id' => 'PROJECTTASK_ID_C',
        'link' => true,
        'width' => '10%',
        'name' => 'task_c',
      ),
      'assigned_user_id' => 
      array (
        'name' => 'assigned_user_id',
        'label' => 'LBL_ASSIGNED_TO',
        'type' => 'enum',
        'function' => 
        array (
          'name' => 'get_user_array',
          'params' => 
          array (
            0 => false,
          ),
        ),
        'width' => '10%',
        'default' => true,
        'displayParams' => 
        array (
          'size' => 1,
        ),
      ),
      'ability_level_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_ABILITY_LEVEL',
        'width' => '10%',
        'name' => 'ability_level_c',
        'displayParams' => 
        array (
          'size' => 1,
        ),
      ),
    ),
    'advanced_search' => 
    array (
      'task_c' => 
      array (
        'type' => 'relate',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_TASK',
        'link' => true,
        'width' => '10%',
        'id' => 'PROJECTTASK_ID_C',
        'name' => 'task_c',
      ),
      'assigned_user_id' => 
      array (
        'name' => 'assigned_user_id',
        'label' => 'LBL_ASSIGNED_TO',
        'type' => 'enum',
        'function' => 
        array (
          'name' => 'get_user_array',
          'params' => 
          array (
            0 => false,
          ),
        ),
        'default' => true,
        'width' => '10%',
      ),
      'ability_level_c' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_ABILITY_LEVEL',
        'width' => '10%',
        'name' => 'ability_level_c',
      ),
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '4',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
?>
