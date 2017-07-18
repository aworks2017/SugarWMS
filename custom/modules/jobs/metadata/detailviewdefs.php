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
          1 =>
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
        'LBL_DETAILVIEW_PANEL2' => 
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
          1 => 'priority',
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'project_due_date',
            'label' => 'LBL_PROJECT_DUE_DATE',
          ),
          1 => '',
        ),
        6 => 
        array (
          0 => 'restrict_start_days',
          1 => 
          array (
            'name' => 'notes',
            'label' => 'LBL_NOTES',
          ),
        ),
        7 => 
        array (
          0 => 'production_notes',
          1 => 'group_id',
        ),
      ),
      'lbl_detailview_panel2' => 
      array (
        0 => 
        array (
          0 => 
          array (
            'name' => 'estimated_mins',
            'label' => 'LBL_ESTIMATED_MINS',
          ),
          1 => 
          array (
            'name' => 'actual_effort',
            'label' => 'LBL_ACTUAL_EFFORT',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'estimated_start',
            'label' => 'LBL_ESTIMATED_START',
          ),
          1 => 
          array (
            'name' => 'actual_start',
            'label' => 'LBL_ACTUAL_START',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'jobs_date_time',
            'label' => 'LBL_JOBS_DATE_TIME',
          ),
          1 => 
          array (
            'name' => 'actual_finish',
          ),
        ),
      ),
    ),
  ),
);
?>
