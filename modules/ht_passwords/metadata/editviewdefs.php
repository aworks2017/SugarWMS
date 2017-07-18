<?php
$module_name = 'ht_passwords';
$viewdefs [$module_name] = 
array (
  'EditView' => 
  array (
    'templateMeta' => 
    array (
		'form' => 
			array (
			'hideAudit' => true,
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
        'DEFAULT' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
      'syncDetailEditViews' => true,
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 
          array (
            'name' => 'password_id',
            'label' => 'LBL_PASSWORD_ID',
          ),
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'login_id',
            'label' => 'LBL_LOGIN_ID',
          ),
          1 => 
          array (
            'name' => 'password',
            'label' => 'LBL_PASSWORD',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'notes',
            'studio' => 'visible',
            'label' => 'LBL_NOTES',
          ),
          1 => '',
        ),
      ),
    ),
  ),
);
?>
