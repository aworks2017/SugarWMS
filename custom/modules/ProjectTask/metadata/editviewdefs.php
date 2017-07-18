<?php
$viewdefs ['ProjectTask'] = 
array (
  'EditView' => 
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
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'modules/ProjectTask/ProjectTask.js',
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
            'name' => 'name',
            'label' => 'LBL_NAME',
          ),
          1 => 
          array (
            'name' => 'default_count_c',
            'label' => 'LBL_DEFAULT_COUNT',
          ),
        ),
        1 => 
        array (
          0 => 'production_notes',
          1 => '',
        ),
        2 => 
        array (
          0 => 'estimated_effort',
          1 => 
          array (
            'name' => 'activity_driver_c',
            'label' => 'LBL_ACTIVITY_DRIVER',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'project_name',
            'label' => 'LBL_PROJECT_NAME',
          ),
          1 => '',
        ),
      ),
    ),
  ),
);
?>
