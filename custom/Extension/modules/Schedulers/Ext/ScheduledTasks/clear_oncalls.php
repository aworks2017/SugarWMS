<?php
$job_strings[] = 'clear_oncalls';
function clear_oncalls(){
	global $db;
	$sql = "UPDATE users SET current_job_id='' WHERE deleted=0 AND current_job_id='ONCALL'";
	$db->query($sql, true);
	return true;
}
?>