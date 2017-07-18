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

 * Portions created by SugarCRM are Copyright (C) SugarCRM, Inc.
 * All Rights Reserved.
 * Contributor(s): ______________________________________..
 ********************************************************************************/
require_once("include/OutboundEmail/OutboundEmail.php");

class UsersController extends SugarController
{
	/**
	 * bug 48170
	 * Action resetPreferences gets fired when user clicks on  'Reset User Preferences' button
	 * This action is set in UserViewHelper.php
	 */
	protected function action_resetPreferences(){
	    if($_REQUEST['record'] == $GLOBALS['current_user']->id || ($GLOBALS['current_user']->isAdminForModule('Users'))){
	        $u = new User();
	        $u->retrieve($_REQUEST['record']);
	        $u->resetPreferences();
	        if($u->id == $GLOBALS['current_user']->id) {
	            SugarApplication::redirect('index.php');
	        }
	        else{
	            SugarApplication::redirect("index.php?module=Users&record=".$_REQUEST['record']."&action=DetailView"); //bug 48170]
	
	        }
	    }
	}  
	protected function action_delete()
	{
	    if($_REQUEST['record'] != $GLOBALS['current_user']->id && ($GLOBALS['current_user']->isAdminForModule('Users')
            ))
        {
            $u = new User();
            $u->retrieve($_REQUEST['record']);
            $u->status = 'Inactive';
            $u->employee_status = 'Terminated';
            $u->save();
            $u->mark_deleted($u->id);
            $GLOBALS['log']->info("User id: {$GLOBALS['current_user']->id} deleted user record: {$_REQUEST['record']}");

            $eapm = loadBean('EAPM');
            $eapm->delete_user_accounts($_REQUEST['record']);
            $GLOBALS['log']->info("Removing user's External Accounts");
            
            SugarApplication::redirect("index.php?module=Users&action=index");
        }
        else 
            sugar_die("Unauthorized access to administration.");
	}
	protected function action_employee_schedule() 
	{
		$this->view = 'employeeschedule';
	}
	protected function action_employee_acl() 
	{
		global $db, $timedate;
		$this_week = date('Y-m-d',  strtotime( 'monday this week' ));	
		$week_date = $this_week;	
		$week_request='';
		if(isset($_REQUEST['next_week_date'])){
			$date=$_REQUEST['next_week_date'];
			$week_date = date('d/m/Y', strtotime("$date +7 days"));	
			$week_date = str_replace("/", ".", $week_date);
			$week_date = strtotime($week_date);
			$week_date = date("Y-m-d", $week_date);
			$week_request="&view=week&next_week_date=".$_REQUEST['next_week_date'];
		} 
		if(isset($_REQUEST['previous_week_date'])){
			$date=$_REQUEST['previous_week_date'];
			$week_date = date('d/m/Y', strtotime("$date -7 days"));
			$week_date = str_replace("/", ".", $week_date);
			$week_date = strtotime($week_date);
			$week_date = date("Y-m-d", $week_date);
			$week_request="&view=week&previous_week_date=".$_REQUEST['previous_week_date'];
		} 		
		$active_users = get_user_array(FALSE, 'Active', '', false, '', " AND is_group=0 ");
        $enabled= array();
		$start_lunch='';
		$end_lunch='';
		$date_start='';
		$date_end='';
		$inserts='';
		foreach ($active_users as $userID => $Name) {
			foreach ($this->getWeek($week_date) as $index=>$days){
				if(!empty($_REQUEST['schedule_date_'.$days.'_'.$userID])){
					$schedule_date = strtotime($_REQUEST['schedule_date_'.$days.'_'.$userID]);
					$schedule_date = date("Y-m-d", $schedule_date);
				}
				if(!empty($_REQUEST['dropdown_'.$days.'_'.$userID]))	$dropdown=$_REQUEST['dropdown_'.$days.'_'.$userID];
				if($dropdown == 'WORKING'){	
					if(!empty($_REQUEST['date_start_'.$days.'_'.$userID])){
						$start_arr = explode(' ',$_REQUEST['date_start_'.$days.'_'.$userID]);	
						$str_date = str_replace("/", ".", $start_arr[0]);
						$str_date = strtotime($str_date);
						$str_date = date("Y-m-d", $str_date);
						$date_start = "'".$str_date.' '.$start_arr[1]."'";
						$start_lunch = $start_arr[1];
					}
					if(!empty($_REQUEST['date_end_'.$days.'_'.$userID])){
						$end_arr = explode(' ',$_REQUEST['date_end_'.$days.'_'.$userID]);	
						$end_date = str_replace("/", ".", $end_arr[0]);
						$end_date = strtotime($end_date);
						$end_date = date("Y-m-d", $end_date);
						$date_end = "'".$str_date.' '.$end_arr[1]."'";	
						$end_lunch = $end_arr[1];
					}
					if($start_lunch< "12:30:00" && $end_lunch> "12:30:00"){
						$lunch = 1;
					}					
				}elseif($dropdown=="CLOSED"||$dropdown=="OFF"||$dropdown=="SICK"){
					$date_start='NULL';
					$date_end='NULL';
					$lunch=0;
				}else{
					$dropdown_split=explode('-',$dropdown);
					if($dropdown_split[0]< "12:30:00" && $dropdown_split[1]> "12:30:00"){
						$lunch=1;
					}else{
						$lunch=0;
					}
					$date_start='NULL';
					$date_end='NULL';
				}
				$delete = "DELETE FROM users_schedule WHERE user_id='{$userID}' AND schedule_date='{$schedule_date}'";
				$db->query($delete, true);
				
				$inserts.=$insert="INSERT INTO users_schedule 
						 (id, schedule_date, user_id, work_status, start_time, stop_time, lunch)
						 VALUES(UUID(), '{$schedule_date}', '{$userID}', '{$dropdown}', {$date_start}, {$date_end}, '{$lunch}')";	
				
				$db->query($insert, true);
			}
		}
		global $log;
		$log->fatal($inserts);
		SugarApplication::appendErrorMessage("The changes have been saved successfully.");
		SugarApplication::redirect("index.php?module=Users&action=employee_schedule".$week_request);
	}
	protected function action_wizard() 
	{
		$this->view = 'wizard';
	}
	protected function action_saveuserwizard() 
	{
	    global $current_user, $sugar_config;
	    
	    // set all of these default parameters since the Users save action will undo the defaults otherwise
	    $_POST['record'] = $current_user->id;
	    $_POST['is_admin'] = ( $current_user->is_admin ? 'on' : '' );
	    $_POST['use_real_names'] = true;
	    $_POST['reminder_checked'] = '1';
	    $_POST['reminder_time'] = 1800;
        $_POST['mailmerge_on'] = 'on';
        $_POST['receive_notifications'] = $current_user->receive_notifications;
        $_POST['user_theme'] = (string) SugarThemeRegistry::getDefault();
	    
	    // save and redirect to new view
	    $_REQUEST['return_module'] = 'Home';
	    $_REQUEST['return_action'] = 'index';
		require('modules/Users/Save.php');
	}

    protected function action_saveftsmodules()
    {
        $this->view = 'fts';
        $GLOBALS['current_user']->setPreference('fts_disabled_modules', $_REQUEST['disabled_modules']);
    }

    /**
     * action "save" (with a lower case S that is for OSX users ;-)
     * @see SugarController::action_save()
     */
    public function action_save()
    {
        require 'modules/Users/Save.php';
    }
	protected function action_update_current_job_id() 
	{	global $db;
		$update="update jobs set actual_effort = 999999 where id = '{$_REQUEST['job_id']}' AND deleted=0";
		$db->query($update,true);
		$update="update users set current_job_id='' where id='{$_REQUEST['id']}' AND deleted=0";
		$db->query($update,true);
		echo $_REQUEST['id'];die;
	}
	function getWeek($date){
		$dayNames = array(
			0=>'Monday', 
			1=>'Tuesday', 
			2=>'Wednesday', 
			3=>'Thursday', 
			4=>'Friday', 
			5=>'Saturday', 
			6=>'Sunday',
		);
		$curr_week=array();
		foreach($dayNames as $index=>$day){
			$curr_week[$day] = date('m/d/Y', strtotime("$date +$index days"));
		}
		return $curr_week;
	}	
}	

