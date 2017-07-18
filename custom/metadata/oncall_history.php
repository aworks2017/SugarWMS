<?php
$dictionary["oncall_history"] = array (
  'table' => 'oncall_history',
  'fields' => 
  array (
    0 => 
    array (
      'name' => 'id',
      'type' => 'int',
      'len' => 10,
	  'auto_increment'=>true,
    ),
    1 => 
    array (
      'name' => 'user_id',
      'type' => 'varchar',
	  'len' => 36,
    ),
    2 => 
    array (
      'name' => 'start_time',
      'type' => 'datetime',
    ),
	3 => 
    array (
      'name' => 'stop_time',
      'type' => 'datetime',
    ),
	4 => 
    array (
      'name' => 'stop_reason',
      'type' => 'varchar',
	  'len' => 255,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'oncall_history_1spk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
  ),
);