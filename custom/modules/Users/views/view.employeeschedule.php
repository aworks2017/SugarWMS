<?php
require_once('include/TemplateHandler/TemplateHandler.php');
require_once('include/SugarFields/SugarFieldHandler.php');
require_once('modules/Calendar/Calendar.php');
class UsersViewEmployeeSchedule extends SugarView{
	public function __construct() {
		parent::SugarView();
		$this->th = new TemplateHandler();
		$this->th->ss =& $this->ss;
	}
 	function display() {
		$this->employeeSchedule();
		echo '<style>
		.error:nth-of-type(1){
			display:none;
		}
		</style>';
		parent::display();
 	}
	function employeeSchedule() {
		global $db,$timedate,$app_list_strings; 
		$this_week = date('Y-m-d',  strtotime( 'monday this week' ));	
		$week_date = $this_week;	
		if(isset($_REQUEST['next_week_date'])){
			$date=$_REQUEST['next_week_date'];
			$week_date = date('d/m/Y', strtotime("$date +7 days"));	
			$week_date = str_replace("/", ".", $week_date);
			$week_date = strtotime($week_date);
			$week_date = date("Y-m-d", $week_date);
		} 
		$diff=0;
		if(isset($_REQUEST['previous_week_date'])){
			$date=$_REQUEST['previous_week_date'];
			$week_date = date('d/m/Y', strtotime("$date -7 days"));
			$week_date = str_replace("/", ".", $week_date);
			$week_date = strtotime($week_date);
			$week_date = date("Y-m-d", $week_date);
			$diff = $this->getDatePeriod($week_date,$this_week);
			$diff=($diff>0 ? 1:0);
		} 
		// get users array
		$enabled_active_users = get_user_array(FALSE, 'Active', '', false, '', " AND is_group=0 ");
        $enabled= array();
        foreach ($enabled_active_users as $userID => $Name) {
			foreach ($this->getWeek($week_date) as $index=>$days){
				$schedule_date = strtotime($days);
				$schedule_date = date("Y-m-d", $schedule_date);
				$select="SELECT * from users_schedule where user_id='{$userID}' AND schedule_date='{$schedule_date}' ";
				$result = $db->query($select, true);
				if($db->getRowCount($result)){
					while($row = $db->fetchByAssoc($result)){
						$row['start_time'] = ($row['start_time']!='0000-00-00 00:00:00') ? $row['start_time'] : '';
						$row['stop_time'] = ($row['stop_time']!='0000-00-00 00:00:00') ? $row['stop_time'] : '';
						$start_date = $timedate->to_display_date($row['start_time']);
						$end_date = $timedate->to_display_date($row['stop_time']);
						$time1 = date('Y-m-d h:ia', strtotime($row['start_time']));
						$time2 = date('Y-m-d h:ia', strtotime($row['stop_time']));
						$start_time = explode(' ', $time1);	
						$stop_time = explode(' ', $time2);
						if($row['work_status'] == 'WORKING'){							
							$time_stamp = $start_time[1].'-'.$stop_time[1];
							$working = 'WORKING';
						}else{
							$time_stamp='';
						}
						 $enabled[$Name][$days]['user_id'] = $userID;
						 $enabled[$Name][$days]['work_status'] = $row['work_status'];
						 $enabled[$Name][$days]['time_stamp'] = $time_stamp;
						 $enabled[$Name][$days]['start_date'] = $start_date.' '.$start_time[1];
						 $enabled[$Name][$days]['end_date'] = $end_date.' '.$stop_time[1];
						 $enabled[$Name][$days]['working'] = $working;
					}
				}else{
					$enabled[$Name][$days]['user_id'] = $userID;
					$enabled[$Name][$days]['work_status'] ='CLOSED';					 
				}				
			}
        }	
		$default_hour="09";
		$default_minutes="00";
		$default_meridium="am";
        $this->ss->assign('default_hours',$default_hour);	
        $this->ss->assign('default_minutes', $default_minutes);	
        $this->ss->assign('default_meridium', $default_meridium);
		$default_end_hour="03";
		$default_end_minutes="30";
		$default_end_meridium="pm";
        $this->ss->assign('default_end_hours',$default_end_hour);	
        $this->ss->assign('default_end_minutes', $default_end_minutes);	
        $this->ss->assign('default_end_meridium', $default_end_meridium);	
        $this->ss->assign('DAYS', $this->getWeek($week_date));	
		$this->ss->assign('WORK_ENUM', $app_list_strings['employee_acl_dom']);		
		$this->ss->assign('HOURS', $app_list_strings['recurring_time_hour_list']);		
		$this->ss->assign('MINUTES', $app_list_strings['recurring_time_minute_list']);		
		$this->ss->assign('meridium', $app_list_strings['dom_meridiem_lowercase']);		
		$this->ss->assign('EMPLOYEES', $enabled);		
		$this->ss->assign('next', $this->get_next_week_Schedule($week_date));
		$this->ss->assign('previous', $this->get_previous_week_Schedule($week_date));
		$this->ss->assign('READONLY', $diff);
		echo $this->th->displayTemplate("Users", "employeeSchedule", "custom/modules/Users/tpls/employeeSchedule.tpl");			
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
	function get_next_week_Schedule($next){
		$str .= "<a href='".ajaxLink("index.php?action=index&module=Users&action=employee_schedule&view=week&next_week_date=".$next."")."'>";
		$str .= "Next Week";
		$str .= "&nbsp;&nbsp;".SugarThemeRegistry::current()->getImage("calendar_next", 'align="absmiddle" border="0"' ,null,null,'.gif', '') . "</a>"; //setting alt tag blank on purpose for 508 compliance
		return $str;
	}
	function get_previous_week_Schedule($previous){
		$str = "";
		$str .= "<a href='".ajaxLink("index.php?action=index&module=Users&action=employee_schedule&view=week&previous_week_date=".$previous."")."'>";
		$str .= "&nbsp;&nbsp;".SugarThemeRegistry::current()->getImage("calendar_previous", 'align="absmiddle" border="0"' ,null,null,'.gif', ''); //setting alt tag blank on purpose for 508 compliance
		$str .= "Previous Week </a>";
		return $str;
	}
	function getDatePeriod($start_date, $end_date){	
		$date1 = date_create($start_date);
		$date2 = date_create($end_date);
		$diff = date_diff($date1, $date2);
		$abc = $diff->format("%R%a days");
		$days = (int)$abc;	
		return $days;
	}	
}