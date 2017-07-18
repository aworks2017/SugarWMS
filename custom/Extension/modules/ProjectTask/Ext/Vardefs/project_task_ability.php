<?php
$dictionary["ProjectTask"]["fields"]["project_task_ability"] = array (
  'name' => 'project_task_ability',
  'type' => 'link',
  'relationship' => 'project_task_ability',
  'source' => 'non-db',
  'vname' => 'LBL_FP',
);
$dictionary['ProjectTask']['relationships']['project_task_ability'] = array(
 'lhs_module'=> 'ProjectTask',
 'lhs_table'=> 'project_task',
 'lhs_key' => 'id',
 'rhs_module'=> 'ht_project_task_ability',
 'rhs_table'=> 'ht_project_task_ability',
 'rhs_key' => 'projecttask_id',
 'relationship_type'=>'one-to-many'
);