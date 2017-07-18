<?php
$module_name = 'jobs';
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
          0 => 'name',
          1 => 'assigned_user_name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'accounts_name',
            'label' => 'LBL_ACCOUNTS_NAME',
          ),
          1 => 
          array (
            'name' => 'account_name',
            'label' => 'LBL_ACCOUNTS_NAME',
          ),
        ),
		 2 => 
        array (
          0 => 
          array (
            'name' => 'estimated_mins',
            'label' => 'LBL_ESTIMATED_MINS',
          ),
          1 => 
          array (
            'name' => 'estimated_start',
            'label' => 'LBL_ESTIMATED_START',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'buffer_mins',
            'label' => 'LBL_BUFFER_MINS',
          ),
          1 => 
          array (
            'name' => 'actual_finish',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'actual_effort',
            'label' => 'LBL_ACTUAL_EFFORT',
          ),
          1 => 
          array (
            'name' => 'estimated_effort',
            'label' => 'LBL_ESTIMATED_EFFORT',
          ),
        ),
      ),
    ),
  ),
);
?>
