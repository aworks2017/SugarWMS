<?php
$job_strings[] = 'update_defer_jobs';
function update_defer_jobs(){
	global $db;
	$sql = "UPDATE jobs SET status='Not Ready' WHERE deleted=0 AND status='Defer'";
	$db->query($sql, true);
	return true;
}
?>