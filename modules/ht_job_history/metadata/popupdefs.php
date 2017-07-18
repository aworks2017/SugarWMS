<?php
$popupMeta = array (
    'moduleMain' => 'ht_job_history',
    'varName' => 'ht_job_history',
    'orderBy' => 'ht_job_history.name',
    'whereClauses' => array (
  'name' => 'ht_job_history.name',
),
    'searchInputs' => array (
  0 => 'ht_job_history_number',
  1 => 'name',
  2 => 'priority',
  3 => 'status',
),
    'listviewdefs' => array (
  'NAME' => 
  array (
    'width' => '32%',
    'label' => 'LBL_NAME',
    'default' => true,
    'link' => true,
    'name' => 'name',
  ),
  'ASSIGNED_USER_NAME' => 
  array (
    'width' => '9%',
    'label' => 'LBL_ASSIGNED_TO_NAME',
    'module' => 'Employees',
    'id' => 'ASSIGNED_USER_ID',
    'default' => true,
    'name' => 'assigned_user_name',
  ),
  'ACTION' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_ACTION',
    'width' => '10%',
  ),
  'ACTION_STOP' => 
  array (
    'type' => 'enum',
    'default' => true,
    'studio' => 'visible',
    'label' => 'LBL_ACTION_STOP',
    'width' => '10%',
  ),
  'ACTION_INFO' => 
  array (
    'type' => 'varchar',
    'label' => 'LBL_ACTION_INFO',
    'width' => '10%',
    'default' => true,
  ),
),
);
