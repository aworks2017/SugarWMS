<?php
$module_name = 'jobs';
$searchdefs [$module_name] = 
array (
  'layout' => 
  array (
    'basic_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'status' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_STATUS',
        'width' => '10%',
        'name' => 'status',
      ),
      'parameter_1' => 
      array (
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_PARAMETER_1',
        'width' => '10%',
        'name' => 'parameter_1',
      ),
      'current_user_only' => 
      array (
        'name' => 'current_user_only',
        'label' => 'LBL_CURRENT_USER_FILTER',
        'type' => 'bool',
        'default' => true,
        'width' => '10%',
      ),
    ),
    'advanced_search' => 
    array (
      'name' => 
      array (
        'name' => 'name',
        'default' => true,
        'width' => '10%',
      ),
      'project_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_PARENT_NAME',
        'id' => 'PROJECT_ID',
        'width' => '10%',
        'default' => true,
        'name' => 'project_name',
        'displayParams' => 
        array (
          'class' => 'sqsEnabled',
          'initial_filter' => '&status_advanced=Published',
        ),
      ),
      'account_name' => 
      array (
        'type' => 'relate',
        'link' => true,
        'label' => 'LBL_ACCOUNT_NAME',
        'id' => 'ACCOUNT_ID',
        'width' => '10%',
        'default' => true,
        'name' => 'account_name',
        'displayParams' => 
        array (
          'class' => 'sqsEnabled',
          'initial_filter' => '&custom_status_c_advanced=active',
        ),
      ),
      'project_due_date' => 
      array (
        'type' => 'date',
        'label' => 'LBL_PROJECT_DUE_DATE',
        'width' => '10%',
        'default' => true,
        'name' => 'project_due_date',
      ),
      'status' => 
      array (
        'type' => 'enum',
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_STATUS',
        'width' => '10%',
        'name' => 'status',
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
        'displayParams' => 
        array (
          'call_back_function' => 'call_back_account',
          'class' => 'sqsEnabled',
        ),
      ),
      'have_notes' => 
      array (
        'name' => 'have_notes',
        'default' => true,
        'width' => '10%',
        'displayParams' => 
        array (
          'size' => 1,
        ),
      ),
      'actual_finish' => 
      array (
        'type' => 'date',
        'label' => 'LBL_ACTUAL_FINISH_LIST',
        'width' => '10%',
        'default' => true,
        'name' => 'actual_finish',
      ), 
	  'group_id' => 
      array (
        'type' => 'int',
        'label' => 'LBL_GROUP_ID',
        'width' => '10%',
        'default' => true,
        'name' => 'group_id',
      ),
      'parameter_1' => 
      array (
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_PARAMETER_1',
        'width' => '10%',
        'name' => 'parameter_1',
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
