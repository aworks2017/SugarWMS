<?php
$dictionary["users_schedule"] = array (
  'table' => 'users_schedule',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'id',
      'type' => 'varchar',
      'len' => 36,
    ),
    1 => 
    array (
      'name' => 'schedule_date',
      'type' => 'date',
      'len' => 36,
    ),
    2 => 
    array (
      'name' => 'user_id',
      'type' => 'varchar',
	  'len' => 36,
    ),
	3 => 
    array (
      'name' => 'work_status',
      'type' => 'varchar',
	  'len' => 36,
    ),
	4 => 
    array (
      'name' => 'start_time',
      'type' => 'datetime',
    ),
	5 => 
    array (
      'name' => 'stop_time',
      'type' => 'datetime',
    ),
	6 => 
    array (
      'name' => 'lunch',
      'type' => 'int',
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'start_loc_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
  ),
);