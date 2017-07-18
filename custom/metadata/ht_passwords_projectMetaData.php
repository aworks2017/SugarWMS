<?php
// created: 2016-11-25 13:04:05
$dictionary["ht_passwords_project"] = array (
  'true_relationship_type' => 'many-to-many',
  'relationships' => 
  array (
    'ht_passwords_project' => 
    array (
      'lhs_module' => 'ht_passwords',
      'lhs_table' => 'ht_passwords',
      'lhs_key' => 'id',
      'rhs_module' => 'Project',
      'rhs_table' => 'project',
      'rhs_key' => 'id',
      'relationship_type' => 'many-to-many',
      'join_table' => 'ht_passwords_project_c',
      'join_key_lhs' => 'ht_passwords_projectht_passwords_ida',
      'join_key_rhs' => 'ht_passwords_projectproject_idb',
    ),
  ),
  'table' => 'ht_passwords_project_c',
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
      'name' => 'date_modified',
      'type' => 'datetime',
    ),
    2 => 
    array (
      'name' => 'deleted',
      'type' => 'bool',
      'len' => '1',
      'default' => '0',
      'required' => true,
    ),
    3 => 
    array (
      'name' => 'ht_passwords_projectht_passwords_ida',
      'type' => 'varchar',
      'len' => 36,
    ),
    4 => 
    array (
      'name' => 'ht_passwords_projectproject_idb',
      'type' => 'varchar',
      'len' => 36,
    ),
  ),
  'indices' => 
  array (
    0 => 
    array (
      'name' => 'ht_passwords_projectspk',
      'type' => 'primary',
      'fields' => 
      array (
        0 => 'id',
      ),
    ),
    1 => 
    array (
      'name' => 'ht_passwords_project_alt',
      'type' => 'alternate_key',
      'fields' => 
      array (
        0 => 'ht_passwords_projectht_passwords_ida',
        1 => 'ht_passwords_projectproject_idb',
      ),
    ),
  ),
);