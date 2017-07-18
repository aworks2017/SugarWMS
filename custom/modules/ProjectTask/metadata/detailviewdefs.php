<?php
$viewdefs ['ProjectTask'] = 
array (
  'DetailView' => 
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
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'EDIT',
          1 => 'DELETE',
        ),
        'hideAudit' => true,
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
          0 => 'name',
          1 => 'estimated_effort',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'avg_time_c',
            'label' => 'LBL_AVG_TIME',
          ),
        ),
        2 => 
        array (
          0 => 'production_notes',
          1 => '',
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'activity_driver_c',
            'label' => 'LBL_ACTIVITY_DRIVER',
          ),
          1 => 
          array (
            'name' => 'default_count_c',
            'label' => 'LBL_DEFAULT_COUNT',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'project_name',
            'customCode' => '<a href="index.php?module=Project&action=DetailView&record={$fields.project_id.value}">{$fields.project_name.value}&nbsp;</a>',
            'label' => 'LBL_PARENT_ID',
          ),
          1 => 
          array (
            'name' => 'avg_count_c',
            'label' => 'LBL_AVG_COUNT',
          ),
        ),
        5 => 
        array (
          0 => 'order_number',
          1 => '',
        ),
      ),
    ),
  ),
);
?>
