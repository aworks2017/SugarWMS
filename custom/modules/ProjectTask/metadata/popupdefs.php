<?php
$popupMeta = array (
    'moduleMain' => 'ProjectTask',
    'varName' => 'PROJECT_TASK',
    'orderBy' => 'name',
    'whereClauses' => array (
  'name' => 'project_task.name',
),
    'searchInputs' => array (
  0 => 'name',
),
    'listviewdefs' => array (
  'NAME' => 
  array (
    'width' => '40%',
    'label' => 'LBL_LIST_NAME',
    'link' => true,
    'default' => true,
    'sortable' => true,
    'name' => 'name',
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
