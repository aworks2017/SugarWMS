<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

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

/*********************************************************************************

 * Description: This file is used to override the default Meta-data EditView behavior
 * to provide customization specific to the Calls module.
 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/

require_once('include/MVC/View/views/view.detail.php');

class ProjectViewDetail extends ViewDetail 
{
 	/**
 	 * @see SugarView::display()
 	 */
 	public function display() 
 	{
		global $beanFiles;
		require_once($beanFiles['Project']);

		$focus = new Project();
		$focus->retrieve($_REQUEST['record']);

		global $app_list_strings, $current_user, $mod_strings;
		$this->ss->assign('APP_LIST_STRINGS', $app_list_strings);

		if($current_user->id == $focus->assigned_user_id || $current_user->is_admin){
			$this->ss->assign('OWNER_ONLY', true);
		}
		else{
			$this->ss->assign('OWNER_ONLY', false);
		}
		$this->ss->assign("IS_TEMPLATE", 0);
		
		$recurring_type = $this->bean->recurring_type_c;

		if($this->bean->restrict_start_days ==''){
			$this->bean->restrict_start_days = 'No restriction';
		}elseif($this->bean->restrict_start_days == 0){
			 $this->bean->restrict_start_days = 'Start and end same day';
		}elseif($this->bean->restrict_start_days == 1){
			$this->bean->restrict_start_days = '1 business day';
		}elseif($this->bean->restrict_start_days ==2){
			$this->bean->restrict_start_days = '2 business days';
		}elseif($this->bean->restrict_start_days ==3){
			$this->bean->restrict_start_days = '3 business days';
		} elseif($this->bean->restrict_start_days ==4){
			$this->bean->restrict_start_days = '4 business days';
		}elseif($this->bean->restrict_start_days ==5){
			$this->bean->restrict_start_days = '5 business days';
		}elseif($this->bean->restrict_start_days ==6){
			$this->bean->restrict_start_days = '6 business days';
		}elseif($this->bean->restrict_start_days ==7){
			$this->bean->restrict_start_days = '7 business days';
		} elseif($this->bean->restrict_start_days ==8){
			$this->bean->restrict_start_days = '8 business days';
		}elseif($this->bean->restrict_start_days ==9){
			$this->bean->restrict_start_days = '9 business days';
		} elseif($this->bean->restrict_start_days ==10){
			$this->bean->restrict_start_days = '10 business days';
		}else{
			$this->bean->restrict_start_days = '';
		}
		
	    $recurring_value = $this->bean->recurring_value_c;
		if($recurring_type == 'daily'){
			$recurring_time = 'daily ';
		}
		if($recurring_type == 'weekly'){
			$recurring_time ='every '.$recurring_value;
		}
		if($recurring_type== 'monthly'){
			if($recurring_value == 1){
				$param = 'st';
			}elseif($recurring_value == 2){
				$param = 'nd';
			}elseif($recurring_value == 3){
				$param = 'rd';
			}else{
				$param = 'th';
			}
			$recurring_time ='every month on the '.$recurring_value.'<sup>'.$param.'</sup>';
		}
	    $recurring_time .= ' by '.$this->bean->recurring_time_hour_c;
		$recurring_time .=':'.$this->bean->recurring_time_minute_c;
		$recurring_time .=$this->bean->recurring_time_ampm_c;
		$this->ss->assign(strtoupper('recurring_time_hour_c'), $recurring_time);
 		parent::display();
		echo '<script type="text/javascript" src="custom/include/javascript/clipboard.min.js"></script>';
		echo '<script type="text/javascript">
			var clipboard = new Clipboard(".copy_password_btn");
		</script>';
 	}
}
