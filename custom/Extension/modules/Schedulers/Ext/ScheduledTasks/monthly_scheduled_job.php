<?php
$job_strings[] = 'monthly_scheduled_job';
function monthly_scheduled_job(){
	global $db;
	$next_month = date('Y-m-d',  strtotime( 'first day of next month' ));	
	$enabled_active_users = get_user_array(FALSE, 'Active', '', false, '', " AND is_group=0");
	$sql = "SELECT u.id FROM users u
			INNER JOIN acl_roles_users aru ON(aru.deleted=0 AND u.id=aru.user_id)
			WHERE u.deleted=0 AND aru.role_id='e74a4e89-d82c-30d3-9277-54c187e227fb'";
	$result = $db->query($sql, true);
	$next_date = date('Y-m-01', strtotime ( '+1 month' , strtotime(date('Y-m-01'))));
	$parts = explode('-', $next_date);
	$next_month_days = cal_days_in_month(CAL_GREGORIAN, $parts[1], $parts[0]);
	while($row = $db->fetchByAssoc($result)) {
		for($i=0; $i<$next_month_days; $i++){
			$schedule_date=date('d/m/Y', strtotime("$next_month +$i days"));
			$schedule_date = str_replace("/", ".", $schedule_date);
			$schedule_date = strtotime($schedule_date);
			$schedule_date = date("Y-m-d", $schedule_date);	
			$insert="INSERT INTO users_schedule(id,schedule_date,user_id,work_status,start_time,stop_time,lunch)
					 VALUES(UUID(),'{$schedule_date}','{$row['id']}','OFF',NULL,NULL,0)";	
			$db->query($insert, true);					
		}						
	}
	return true;
}
?>