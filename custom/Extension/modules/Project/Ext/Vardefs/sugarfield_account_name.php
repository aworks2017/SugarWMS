<?php
$dictionary["Project"]["fields"]["account_name"] = array (
  'name' => 'account_name',
  'type' => 'relate',
  'source' => 'non-db',
  'vname' => 'LBL_ACCOUNT_NAME',
  'save' => true,
  'id_name' => 'account_id',
  'link' => 'accounts',
  'table' => 'accounts',
  'module' => 'Accounts',
  'rname' => 'name',
  'studio' => 'hidden',
  'required' => true,
);
$dictionary["Project"]["fields"]["account_id"] = array (
  'name' => 'account_id',
  'type' => 'id',
  'relationship' => 'projects_accounts',
  'source' => 'non-db',
  'reportable' => false,
  'side' => 'left',
  'vname' => 'LBL_ACCOUNT_ID',
);
