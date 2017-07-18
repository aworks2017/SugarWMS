<?php
$popupMeta = array (
    'moduleMain' => 'Project',
    'varName' => 'PROJECT',
    'orderBy' => 'name',
    'whereClauses' => array (
  'name' => 'project.name',
  'status' => 'project.status',
  'account_name' => 'project.account_name',
  'priority' => 'project.priority',
),
'whereStatement'=> " project.id IN (SELECT project.id 
FROM project
INNER JOIN project_task ON(project_task.deleted=0 AND project.id=project_task.project_id)
where project.deleted=0)",
    'searchInputs' => array (
  0 => 'name',
  1 => 'status',
  2 => 'account_name',
  3 => 'priority',
),
    'searchdefs' => array (
  'name' => 
  array (
    'name' => 'name',
    'width' => '10%',
  ),
  'status' => 
  array (
    'name' => 'status',
    'width' => '10%',
  ),
  'account_name' => 
  array (
    'type' => 'relate',
    'link' => true,
    'studio' => 'visible',
    'label' => 'LBL_ACCOUNT_NAME',
    'id' => 'ACCOUNT_ID',
    'width' => '10%',
    'name' => 'account_name',
  ),
  'priority' => 
  array (
    'name' => 'priority',
    'width' => '10%',
  ),
),
    'listviewdefs' => array (
  'NAME' => 
  array (
    'width' => '30%',
    'label' => 'LBL_LIST_NAME',
    'link' => true,
    'default' => true,
    'name' => 'name',
  ),
  'ACCOUNT_NAME' => 
  array (
    'type' => 'relate',
    'link' => true,
    'studio' => 'visible',
    'label' => 'LBL_ACCOUNT_NAME',
    'id' => 'ACCOUNT_ID',
    'width' => '20%',
    'default' => true,
    'name' => 'account_name',
  ),
  'STATUS' => 
  array (
    'width' => '20%',
    'label' => 'LBL_STATUS',
    'link' => false,
    'default' => true,
    'name' => 'status',
  ),
  'SUBCLIENT_CODE' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_SUBCLIENT_CODE',
    'width' => '10%',
    'default' => true,
    'name' => 'subclient_code',
  ),
  'DELIVERABLE_ID' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_DELIVERABLE_ID',
    'width' => '10%',
    'default' => true,
    'name' => 'deliverable_id',
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '10%',
    'label' => 'LBL_LIST_ASSIGNED_USER_ID',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
    'name' => 'assigned_user_name',
  ),
),
);
