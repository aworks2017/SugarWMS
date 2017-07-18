<?php
$job_strings[] = 'jobsQueue';
require_once('modules/jobs/jobsQueue.php');
function jobsQueue(){
	global $timedate,$db,$log;
	$queue= new jobsQueue();
	$time = date("H:i:s");
	$week_day = array('Mon','Tue','Wed','Thu', 'Fri');
	$today= date('D');
	$before_date = $queue->getNextWorkingDay();
	$now = $timedate->nowDb();
	$sql = "SELECT jobs.id
			FROM jobs
			WHERE jobs.deleted=0 AND jobs.status IN('Ready','Started','In Progress','Not Ready','Issue','Defer','On Hold')
			AND jobs.project_due_date <= '{$before_date}' AND jobs.project_due_date >= '{$now}'";
	$result = $db->query($sql, true);
	while($row = $db->fetchByAssoc($result)){
		$job_bean = BeanFactory::getBean('jobs', $row['id']);
		$queue->initialize_queue($job_bean);
	}
	$queue->refresh_queue();
	return true;
}
?>