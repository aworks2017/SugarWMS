<?php
$viewdefs ['Project'] = 
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
        'hidden' => '<input type="hidden" name="is_template" value="{$is_template}" />',
        'buttons' => 
        array (
          0 => 
          array (
            'customCode' => '<input title="{$APP.LBL_SAVE_BUTTON_TITLE}" id ="SAVE_HEADER" accessKey="{$APP.LBL_SAVE_BUTTON_KEY}" class="button primary" onclick="if(customValidation()) return false; var _form = document.getElementById(\'EditView\'); _form.action.value=\'Save\'; if(check_form(\'EditView\'))SUGAR.ajaxUI.submitForm(_form);return false;"  type="submit" name="button" value="Save" id="SAVE_HEADER">',
          ),
          1 => 
          array (
            'customCode' => '{if !empty($smarty.request.return_action) && $smarty.request.return_action == "ProjectTemplatesDetailView" && (!empty($fields.id.value) || !empty($smarty.request.return_id)) }<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="this.form.action.value=\'ProjectTemplatesDetailView\'; this.form.module.value=\'{$smarty.request.return_module}\'; this.form.record.value=\'{$smarty.request.return_id}\';" type="submit" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL{$place}"> {elseif !empty($smarty.request.return_action) && $smarty.request.return_action == "DetailView" && (!empty($fields.id.value) || !empty($smarty.request.return_id)) }<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="this.form.action.value=\'DetailView\'; this.form.module.value=\'{$smarty.request.return_module}\'; this.form.record.value=\'{$smarty.request.return_id}\';" type="submit" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL{$place}"> {elseif $is_template}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="this.form.action.value=\'ProjectTemplatesListView\'; this.form.module.value=\'{$smarty.request.return_module}\'; this.form.record.value=\'{$smarty.request.return_id}\';" type="submit" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL{$place}"> {else}<input title="{$APP.LBL_CANCEL_BUTTON_TITLE}" accessKey="{$APP.LBL_CANCEL_BUTTON_KEY}" class="button" onclick="this.form.action.value=\'index\'; this.form.module.value=\'{$smarty.request.return_module}\'; this.form.record.value=\'{$smarty.request.return_id}\';" type="submit" name="button" value="{$APP.LBL_CANCEL_BUTTON_LABEL}" id="CANCEL{$place}"> {/if}',
          ),
        ),
      ),
      'javascript' => '<script type="text/javascript">
						$("#recurring_c").change(function(){ldelim}
							if($("#recurring_c").is(":checked")){ldelim}
								$("#recurring_time_hour_c").val("05");
								$("#recurring_time_ampm_c").val("PM");
								{rdelim}
						{rdelim});
					</script>',
      'includes' => 
      array (
        0 => 
        array (
          'file' => 'custom/modules/Project/project.js',
        ),
      ),
      'useTabs' => false,
      'tabDefs' => 
      array (
        'LBL_PROJECT_INFORMATION' => 
        array (
          'newTab' => false,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'lbl_project_information' => 
      array (
        0 => 
        array (
          0 => 'name',
          1 => 'status',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'recurring_c',
            'label' => 'LBL_RECURRING',
          ),
        ),
        2 => 
        array (
          0 => 
          array (
            'name' => 'recurring_type_c',
            'studio' => 'visible',
            'label' => 'LBL_RECURRING_TYPE',
          ),
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'recurring_time_hour_c',
            'label' => 'LBL_RECURRING_TIME',
            'customCode' => '{$RECURRING_TIME_HOUR_C}',
          ),
        ),
        4 => 
        array (
          0 => 
          array (
            'name' => 'recurring_value_c',
            'studio' => 'visible',
            'label' => 'LBL_RECURRING_VALUE',
          ),
          1 => 'restrict_start_days',
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'account_name',
            'displayParams' => 
            array (
              'field_to_name_array' => 
              array (
                'id' => 'account_id',
                'name' => 'account_name',
                'client_code' => 'client_code',
              ),
              'additionalFields' => 
              array (
                'client_code' => 'client_code',
              ),
            ),
          ),
          1 => '',
        ),
        6 => 
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
        7 => 
        array (
          0 => 
          array (
            'name' => 'deliverable_id',
            'label' => 'LBL_DELIVERABLE_ID',
          ),
          1 => 
          array (
            'name' => 'activity_driver',
            'label' => 'LBL_ACTIVITY_DRIVER',
          ),
        ),
      ),
    ),
  ),
);
?>
