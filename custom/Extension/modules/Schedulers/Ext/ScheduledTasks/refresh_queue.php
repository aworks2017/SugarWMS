<?php
$job_strings[] = 'refresh_queue';
function refresh_queue(){
	require_once('modules/jobs/jobsQueue.php');
	$queue = new jobsQueue();
	$queue->refresh_queue();
	return true;
}
?>