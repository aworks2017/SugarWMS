<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

 

class SugarWidgetSubPanelTopCreateAccountNameButtonProject extends SugarWidgetSubPanelTopButtonQuickCreate
{
    public function getWidgetId()
    {
        return parent::getWidgetId();
    }

	function display($defines)
	{
		global $app_strings, $currentModule;
		$title = $app_strings['LBL_NEW_BUTTON_TITLE'];
		$value = $app_strings['LBL_NEW_BUTTON_LABEL'];
		$this->module = $defines['module'];
		if( ACLController::moduleSupportsACL($defines['module'])  && !ACLController::checkAccess($defines['module'], 'edit', true)){
			$button = "<input title='$title'class='button' type='button' name='button' value='  $value  ' disabled/>\n";
			return $button;
		}
		$additionalFormFields = array();
		if(isset($defines['focus']->name)) 
		$additionalFormFields['name'] = ($defines['focus']->name).':';
		$button = $this->_get_form($defines, $additionalFormFields);
		$button .= "<input title='$title' class='button' type='submit' name='{$this->getWidgetId()}' id='{$this->getWidgetId()}' value='  $value  '/>\n";
		$button .= "</form>";
		return $button;
	}
}
?>