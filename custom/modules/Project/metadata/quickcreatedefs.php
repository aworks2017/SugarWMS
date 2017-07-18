<?php
$viewdefs ['Project'] = 
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
	  'includes' => 
      array (
			0 =>
			array (
			  'file' => 'custom/include/javascript/project.js',
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
          1 => 'status',
        ),
        1 => 
        array (
          0 => 'assigned_user_name',
          1 => 'priority',
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'rate_type_c',
            'studio' => 'visible',
            'label' => 'LBL_RATE_TYPE',
          ),
          1 => 
          array (
            'name' => 'rate_c',
            'label' => 'LBL_RATE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'recurring_c',
            'label' => 'LBL_RECURRING',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'recurring_type_c',
            'studio' => 'visible',
            'label' => 'LBL_RECURRING_TYPE',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'recurring_time_c',
            'label' => 'LBL_RECURRING_TIME',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'recurring_value_c',
            'studio' => 'visible',
            'label' => 'LBL_RECURRING_VALUE',
          ),
		  1 => 'restrict_start_days',
        ),
        7 => 
        array (
          0 => 
          array (
            'name' => 'subclient_code',
            'label' => 'LBL_SUBCLIENT_CODE',
          ),
          1 => 
          array (
            'name' => 'deliverable_id',
            'label' => 'LBL_DELIVERABLE_ID',
          ),
        ),
        8 => 
        array (
          0 => 'description',
        ),
      ),
    ),
  ),
);
?>
