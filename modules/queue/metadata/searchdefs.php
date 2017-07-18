<?php
$module_name = 'queue';
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
      'deliverable_id' => 
      array (
        'type' => 'varchar',
        'label' => 'LBL_DELIVERABLE_ID',
        'link' => true,
        'width' => '10%',
        'default' => true,
        'name' => 'deliverable_id',
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
		)
      ),
      'start_date_before' => 
      array (
        'type' => 'datetime',
        'studio' => 'hidden',
        'label' => 'LBL_START_DATE_BEFORE',
        'width' => '10%',
        'default' => true,
        'name' => 'start_date_before',
		'is_date_field' => true,
      ),
	  'status' => 
      array (
        'type' => 'enum',
        'label' => 'LBL_STATUS',
        'width' => '10%',
        'default' => true,
        'name' => 'status',
      ),
	  'assigned_user_id' => 
      array (
        'name' => 'assigned_user_id',
        'label' => 'LBL_ASSOCIATE',
        'type' => 'enum',
        'function' => 
        array (
          'name' => 'get_user_array',
          'params' => 
          array (
            0 => false,
            1 => 'Active',
            2 => '',
            3 => false,
            4 => '',
            5 => ' AND portal_only=0  AND id IN(SELECT user_id FROM acl_roles_users WHERE role_id="e74a4e89-d82c-30d3-9277-54c187e227fb") ',
            6 => true,
          ),
        ),
        'default' => true,
        'width' => '10%',
      ),
	'parameter_1' => 
      array (
        'default' => true,
        'studio' => 'visible',
        'label' => 'LBL_PARAMETER_1',
        'width' => '10%',
        'name' => 'parameter_1',
      ),
	   'group_id' => 
      array (
        'type' => 'int',
        'label' => 'LBL_GROUP_ID',
        'width' => '10%',
        'default' => true,
        'name' => 'group_id',
      ), 
    ),
  ),
  'templateMeta' => 
  array (
    'maxColumns' => '3',
    'maxColumnsBasic' => '3',
    'widths' => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
);
?>
