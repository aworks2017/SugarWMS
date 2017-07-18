<?php

/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/


class ProjectViewEdit extends ViewEdit {

 	function ProjectViewEdit(){
 		parent::ViewEdit();
 	}

 	function display() {
		$this->bean->is_template = 0;
		$this->ev->ss->assign("is_template", 0);
		$vardefs = $this->bean->field_defs;
		echo"<script type='text/javascript'>
				var module_fields=".json_encode($vardefs).";
				var module_view = 'EditView';
				var recurring_value_c = '".($this->bean->recurring_value_c)."';
			</script>";
		echo "<script src='custom/include/javascript/dependent_fields.js'></script>";
		global $app_list_strings;
		$dropdwon= '<select id="recurring_time_hour_c" name="recurring_time_hour_c">'.get_select_options_with_id($app_list_strings['recurring_time_hour_list'], ((!isset($this->bean->recurring_time_hour_c) || empty($this->bean->recurring_time_hour_c)) ?  '05' : $this->bean->recurring_time_hour_c)).'</select> : ';
		$dropdwon.= '<select id="recurring_time_minute_c"  name="recurring_time_minute_c">'.get_select_options_with_id($app_list_strings['recurring_time_minute_list'], (isset( $this->bean->recurring_time_minute_c) ?  $this->bean->recurring_time_minute_c : '00') ).'</select> ';
		$dropdwon .= '<select id="recurring_time_ampm_c" name="recurring_time_ampm_c">'.get_select_options_with_id($app_list_strings['dom_meridiem_uppercase'], (isset( $this->bean->recurring_time_ampm_c)  ? $this->bean->recurring_time_ampm_c : 'PM' ))  .'</select>';
		$this->ev->ss->assign(strtoupper('recurring_time_hour_c'), $dropdwon);
		parent::display();
 	}
}
?>
