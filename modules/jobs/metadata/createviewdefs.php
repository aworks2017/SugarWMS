<?php
$module_name = 'jobs';
$viewdefs [$module_name] = 
array (
  'EditView' => 
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
	  'form' => 
      array (
        'buttons' => 
		array(
		  0 => array( 'customCode' => '<input type="submit" id="save_jobs" value="Save" onclick="var _form = document.getElementById(\'CreateView\');_form.action.value = \'save_jobs\'; if(check_form(\'CreateView\'))SUGAR.ajaxUI.submitForm(_form); window.onbeforeunload = null;return false;"  />'),
		  1 => array( 'customCode' => '<input type="button" id="cancle_job" value="Cancel" onclick="window.location=\'index.php?module=queue&action=index\'"/>'),
		),
      ),
      'useTabs' => false,
	   'includes' => 
      array (
        0 => 
        array (
          'file' => 'modules/jobs/js/jobs.js',
        ),
      ),
	  'javascript' => '<script type="text/javascript">addToValidate("CreateView","project_due_date","date",true,"Due Date");addToValidate("CreateView","project_name","relate",true,"Deliverable");addToValidate("CreateView","account_name","relate",true,"Account");addToValidate("CreateView","add_all_tasks","bool",true,"Add all tasks");
	  $("#btn_project_name").hide();$("#btn_clr_project_name").hide();$("#project_name").prop( "disabled", true);	
	  </script>',
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
           0 => 
          array (
            'name' => 'account_id',
            'label' => 'LBL_ACCOUNT_NAME',
			'displayParams' => 
            array (
				  'call_back_function' => 'call_back_account',
				  'class' => 'sqsEnabled'
				)
			),
        ),
        1 => 
        array (
           0 => 
          array (
            'name' => 'project_id',
            'label' => 'LBL_PARENT_NAME',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'project_due_date',
            'label' => 'LBL_PROJECT_DUE_DATE',
          ),
          
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'parameter_1',
            'label' => 'LBL_PARAMETER_1',
          ),
        ),
        4 => 
        array (
          0 => 
		  array (
			'name' => 'parameter_2',
			'label' => 'LBL_PARAMETER_2',
          ),
        ),
        5 => 
        array (
          0 => 
		  array (
			'name' => 'restrict_start_days',
          ),
        ),
		6 => 
        array (
          0 => 
		  array (
			'name' => 'activity_count',
          ),
        ),
      ),
    ),
  ),
);
?>
