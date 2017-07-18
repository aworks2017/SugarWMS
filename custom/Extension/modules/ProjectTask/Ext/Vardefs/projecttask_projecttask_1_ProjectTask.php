<?php
// created: 2015-05-01 07:11:02
$dictionary["ProjectTask"]["fields"]["projecttask_projecttask_1"] = array (
  'name' => 'projecttask_projecttask_1',
  'type' => 'link',
  'relationship' => 'projecttask_projecttask_1',
  'source' => 'non-db',
  'module' => 'ProjectTask',
  'bean_name' => 'ProjectTask',
  'vname' => 'LBL_PROJECTTASK_PROJECTTASK_1_FROM_PROJECTTASK_L_TITLE',
  'id_name' => 'projecttask_projecttask_1projecttask_ida',
);
$dictionary["ProjectTask"]["fields"]["projecttask_projecttask_1_name"] = array (
  'name' => 'projecttask_projecttask_1_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_PROJECTTASK_PROJECTTASK_1_FROM_PROJECTTASK_L_TITLE',
  'save' => true,
  'id_name' => 'projecttask_projecttask_1projecttask_ida',
  'link' => 'projecttask_projecttask_1',
  'table' => 'project_task',
  'module' => 'ProjectTask',
  'rname' => 'name',
);
$dictionary["ProjectTask"]["fields"]["projecttask_projecttask_1projecttask_ida"] = array (
  'name' => 'projecttask_projecttask_1projecttask_ida',
  'type' => 'link',
  'relationship' => 'projecttask_projecttask_1',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'right',
  'vname' => 'LBL_PROJECTTASK_PROJECTTASK_1_FROM_PROJECTTASK_R_TITLE',
);
