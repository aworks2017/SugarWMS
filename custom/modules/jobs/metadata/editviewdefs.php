<?php
$module_name = 'jobs';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 'SAVE',
          1 => 'CANCEL',
        ),
      ),
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
        'LBL_OVERVIEW_PANEL1' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => false,
    ),
    'panels' => 
    array (
      'LBL_OVERVIEW_PANEL1' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'account_name',
            'label' => 'LBL_ACCOUNT_NAME',
          ),
          1 => 'assigned_user_name',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'project_name',
            'label' => 'LBL_PARENT_NAME',
          ),
          1 => 
          array (
            'name' => 'status',
            'studio' => 'visible',
            'label' => 'LBL_STATUS',
          ),
        ),
        2 => 
        array (
          0 => 'name',
          1 => 
          array (
            'name' => 'activity_driver',
			'customCode' => '{$fields.activity_driver.value}<input type="hidden" name="activity_driver" value="{$fields.activity_driver.value}">',
            'label' => 'LBL_ACTIVITY_DRIVER',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'parameter_1',
            'label' => 'LBL_PARAMETER_1',
          ),
          1 => 
          array (
            'name' => 'activity_count',
            'label' => 'LBL_ACTIVITY_COUNT',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'parameter_2',
            'label' => 'LBL_PARAMETER_2',
          ),
          1 => 
          array (
            'name' => 'estimated_mins',
            'label' => 'LBL_ESTIMATED_MINS',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'project_due_date',
            'label' => 'LBL_PROJECT_DUE_DATE',
          ),
          1 => 
          array (
            'name' => 'production_notes',
          ),
        ),
        6 => 
        array (
          0 => 'priority',
          1 => 
          array (
            'name' => 'notes',
            'label' => 'LBL_NOTES',
          ),
        ),
        7 => 
        array (
          0 => 'restrict_start_days',
          1 => '',
        ),
      ),
    ),
  ),
);
?>
