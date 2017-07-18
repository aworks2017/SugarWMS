<?php
$module_name = 'ht_project_task_ability';
$viewdefs [$module_name] = 
array (
  'QuickCreate' => 
  array (
    'templateMeta' => 
    array (
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'ability_level',
            'studio' => 'visible',
            'label' => 'LBL_ABILITY_LEVEL',
          ),
          1 => '',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'projecttask_name',
            'studio' => 'visible',
            'label' => 'LBL_PROJECTTASK_NAME',
          ),
          1 => '',
        ),
        2 => 
        array (
          0 => 'associate_name',
          1 => '',
        ),
      ),
    ),
  ),
);
?>
