<?php
$module_name = 'ht_job_history';
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
            'name' => 'action_job',
            'label' => 'LBL_ACTION',
          ),
          1 => 
          array (
            'name' => 'action_stop',
            'studio' => 'visible',
            'label' => 'LBL_ACTION_STOP',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'jobs_name',
            'label' => 'LBL_JOB_RELATE_NAME',
          ),
          1 => 
          array (
            'name' => 'action_info',
            'label' => 'LBL_ACTION_INFO',
          ),
        ),
        2 => 
        array (
          0 => '',
          1 => '',
        ),
      ),
    ),
  ),
);
?>
