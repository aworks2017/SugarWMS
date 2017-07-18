 <?php
 
function reassignSubmit($job_id,$reassign_user){		
	global $db;
	if(isset($reassign_user) && !empty($reassign_user) ){
		$job_update = BeanFactory::getBean('jobs');
		$job_update->retrieve($job_id);
		$job_update->assigned_user_id= $reassign_user;
		$job_update->save();
		echo'success';
	}else{
		echo'Error Record is empty';
	}
}
function specialHandling($status, $job_id){		
	global $db;
	if(isset($job_id) && !empty($job_id) ){ 
		$job_special = BeanFactory::getBean('jobs');
		$job_special->retrieve($job_id);
		$job_special->status='Special Handling' ;
		$job_special->save();
		echo'success';
	}else{
		echo'Error Record is empty';
	}
}
function save_jobs($project_task_id, $account_id, $project_id,$project_due_date, $parameter_1,$parameter_2, $job_name,  $job_due_date, $status, $priority,$buffer_minutes,$production_notes, $assigned_user_id,$activity_driver ,$activity_count,$restrict_start_days,$estimated_effort){
	global $db;
	
	//Business days validation
	$valid_date = validateBusinessDate($project_due_date);
	
	$project_due_date = $valid_date ? $valid_date : $project_due_date;
	$job = new jobs();
	$job->project_task_id = $project_task_id;
	$job->project_id = $project_id;
	$job->name = $job_name;
	$job->account_id = $account_id;
	$job->project_due_date = $project_due_date;
	$job->jobs_date_time = $job_due_date;
	$job->status = $status;
	$job->parameter_1 = $parameter_1;
	$job->parameter_2 = $parameter_2;
	$job->restrict_start_days = $restrict_start_days;
	$job->priority= $priority;
	$job->buffer_mins= $buffer_minutes;
	$job->production_notes= $production_notes;
	$job->assigned_user_id= $assigned_user_id;
	$job->activity_driver= $activity_driver;
	$job->activity_count= $activity_count;
	$job->estimated_mins= $estimated_effort;
	$job->save();
}

 
function validateBusinessDate($str){
	global $current_user,$timedate;
	$str_date_time = explode(' ',$str);
	$format = $timedate->get_date_format();
	
	$date = DateTime::createFromFormat( $format, $str_date_time[0]);
	if($date->format($format) !== $str_date_time[0]){
		$date->modify("last day of previous month");  
	}
	
	if(	$date->format("w") == 6 || $date->format("w") == 0){
		$date->modify('last friday');
	}

	if($date && $date->format($format)){
		return $date->format($format).' '.$str_date_time[1];
	}else{
		return false;
	}
}
 
 
 
 
 
 
 ?>