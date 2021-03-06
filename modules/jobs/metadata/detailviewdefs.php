<?php
$module_name = 'jobs';
$viewdefs [$module_name] =
array (
  'DetailView' =>
  array (
    'templateMeta' =>
    array (
      'form' =>
      array (
        'buttons' =>
        array (
          0 => 'EDIT',
          1 => 'DUPLICATE',
          2 => 'FIND_DUPLICATES',
          3 => '',
          4 =>
          array (
            'customCode' => '<input type="button" value="View Job History" name="view_job_history" id="view_job_history" onclick="open_popup(\'jobs\', \'600\', \'400\', \'&record={$fields.id.value}&module_name=jobs&view_job_history={$fields.name.value}\', true, false,\'\' ); return false;">',
          ),
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
      'syncDetailEditViews' => true,
    ),
    'panels' =>
    array (
      'LBL_OVERVIEW_PANEL1' =>
      array (
        0 =>
        array (
          0 => 'name',
          1 => 'assigned_user_name',
        ),
        1 =>
        array (
          0 => '',
          1 =>'',
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
            'label' => 'LBL_ESTIMATED_FINISH',
          ),
        ),
        4 =>
        array (
          0 =>
          array (
            'name' => 'actual_effort',
            'label' => 'LBL_ACTUAL_EFFORT',
          ),
          1 => 'priority',
        ),
        5 =>
        array (
          0 => '',
          1 =>
          array (
            'name' => 'project_name',
            'label' => 'LBL_PARENT_NAME',
          ),
        ),
        6 =>
        array (
          0 => '',
          1 => '',
        ),
        7 =>
        array (
          0 =>
          array (
            'name' => 'order_number',
            'label' => 'LBL_ORDER_NUMBER',
          ),
          1 =>
          array (
            'name' => 'account_name',
            'label' => 'LBL_ACCOUNT_NAME',
          ),
        ),
        8 =>
        array (
          0 =>
          array (
            'name' => 'project_due_date',
            'label' => 'LBL_PROJECT_DUE_DATE',
          ),
          1 =>
          array (
            'name' => 'status',
            'studio' => 'visible',
            'label' => 'LBL_STATUS',
          ),
        ),
        9 =>
        array (
          0 =>
          array (
            'name' => 'parameter_1',
            'label' => 'LBL_PARAMETER_1',
          ),
          1 =>
          array (
            'name' => 'parameter_2',
            'label' => 'LBL_PARAMETER_2',
          ),
        ),
        10 =>
        array (
          0 =>
          array (
            'name' => 'activity_count',
            'label' => 'LBL_ACTIVITY_COUNT',
          ),
          1 =>
          array (
            'name' => 'activity_driver',
            'label' => 'LBL_ACTIVITY_DRIVER',
          ),
        ),
		11 =>
        array (
          0 =>
          array (
            'name' => 'production_notes',
          ),
        ),
        12 =>
        array (
          0 => 'description',
        ),
      ),
    ),
  ),
);
?>
