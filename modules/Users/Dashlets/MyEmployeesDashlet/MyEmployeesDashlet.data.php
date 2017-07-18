<?php
global $current_user;

$dashletData['MyEmployeesDashlet']['searchFields'] = array(

);
$dashletData['MyEmployeesDashlet']['columns'] =  array(
	'name' => array(
		'width'   => '60',
		'label'   => 'LBL_LIST_NAME',
		'link'    => true,
		'default' => true
	),
	'current_job_id' => array(
		'width'   => '40',
		'label'   => 'LBL_CURRENT_JOB_ID',
		'link'    => false,
		'default' => true
	),
);
?>
