<?php
$dictionary['ProjectTask']['fields']['jobs'] = array(
    'name' => 'jobs',
    'type' => 'link',
    'relationship' => 'project_task_jobs',
    'source' => 'non-db',
    'vname' => 'LBL_JOBS',
);
$dictionary['ProjectTask']['relationships']['project_task_jobs'] =  array(
	'lhs_module'		=> 'ProjectTask',
	'lhs_table'			=> 'project_task',
	'lhs_key'			=> 'id',
	'rhs_module'		=> 'jobs',
	'rhs_table'			=> 'jobs',
	'rhs_key'			=> 'project_task_id',
	'relationship_type'	=> 'one-to-many',
);
?>