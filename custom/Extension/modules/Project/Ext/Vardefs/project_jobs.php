<?php
$dictionary['Project']['fields']['jobs'] = array(
    'name' => 'jobs',
    'type' => 'link',
    'relationship' => 'project_jobs',
    'source' => 'non-db',
    'vname' => 'LBL_JOBS',
);
$dictionary['Project']['relationships']['project_jobs'] =  array(
	'lhs_module'		=> 'Project',
	'lhs_table'			=> 'project',
	'lhs_key'			=> 'id',
	'rhs_module'		=> 'jobs',
	'rhs_table'			=> 'jobs',
	'rhs_key'			=> 'project_id',
	'relationship_type'	=> 'one-to-many',
);
?>