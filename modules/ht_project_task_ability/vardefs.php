<?php
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/

$dictionary['ht_project_task_ability'] = array(
	'table'=>'ht_project_task_ability',
	'audited'=>true,
		'duplicate_merge'=>true,
		'fields'=>array (
  'assigned_user_name' => 
  array (
    'name' => 'assigned_user_name',
    'link' => 'assigned_user_link',
    'vname' => 'LBL_ASSIGNED_TO_NAME',
    'rname' => 'name',
    'type' => 'relate',
    'reportable' => true,
    'source' => 'non-db',
    'table' => 'users',
    'id_name' => 'assigned_user_id',
    'module' => '',
    'duplicate_merge' => 'disabled',
    'required' => false,
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => '255',
    'size' => '20',
    'ext2' => '',
    'quicksearch' => 'enabled',
    'studio' => 'visible',
  ),
  'projecttask_id' => 
  array (
    'required' => false,
    'name' => 'projecttask_id',
    'vname' => 'LBL_PROJECTTASK_NAME_PROJECTTASK_ID',
    'type' => 'id',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => 0,
    'audited' => false,
    'reportable' => false,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 36,
    'size' => '20',
  ),
  'projecttask_name' => 
  array (
    'required' => false,
    'source' => 'non-db',
    'name' => 'projecttask_name',
    'vname' => 'LBL_PROJECTTASK_NAME',
    'type' => 'relate',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => '255',
    'size' => '20',
    'id_name' => 'projecttask_id',
    'ext2' => 'ProjectTask',
    'module' => 'ProjectTask',
    'rname' => 'name',
    'quicksearch' => 'enabled',
    'studio' => 'visible',
  ),
  'associate_id' => 
  array (
    'required' => false,
    'name' => 'associate_id',
    'vname' => 'LBL_ASSOCIATE_ID',
    'type' => 'id',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => 0,
    'audited' => false,
    'reportable' => false,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 36,
    'size' => '20',
  ),
  'associate_name' => 
  array (
    'required' => false,
    'source' => 'non-db',
    'name' => 'associate_name',
    'vname' => 'LBL_ASSOCIATE_NAME',
    'type' => 'relate',
    'massupdate' => 0,
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => '255',
    'size' => '20',
    'id_name' => 'associate_id',
    'ext2' => 'Users',
    'module' => 'Users',
    'rname' => 'name',
    'quicksearch' => 'enabled',
    'studio' => 'visible',
  ),
  'ability_level' => 
  array (
    'required' => false,
    'name' => 'ability_level',
    'vname' => 'LBL_ABILITY_LEVEL',
    'type' => 'enum',
    'massupdate' => true,
    'default' => 'high',
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => true,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 100,
    'size' => '20',
    'options' => 'ability_level_list',
    'studio' => 'visible',
    'dependency' => false,
  ),
  'project_name' => 
  array (
    'name' => 'project_name',
	'type' => 'relate',
	'source' => 'non-db',
	'vname' => 'LBL_PROJECT_NAME',
	'save' => true,
	'id_name' => 'project_id',
	'table' => 'project',
	'module' => 'Project',
	'ext2' => 'Project',
	'rname' => 'name',
	'studio' => 'hidden',
  ),
  'project_id' => 
  array (
    'name' => 'project_id',
	'type' => 'link',
	'source' => 'non-db',
	'reportable' => false,
	'side' => 'left',
	'vname' => 'LBL_PROJECT_ID',
  ),
  'account_name' => 
  array (
    'name' => 'account_name',
	'type' => 'relate',
	'source' => 'non-db',
	'vname' => 'LBL_ACCOUNT_NAME',
	'save' => true,
	'id_name' => 'account_id',
	'table' => 'accounts',
	'module' => 'Accounts',
	'rname' => 'name',
	'studio' => 'hidden',
	'massupdate' => false,
  ),
  'account_id' => 
  array (
    'name' => 'account_id',
	'type' => 'id',
	'source' => 'non-db',
	'reportable' => false,
	'vname' => 'LBL_ACCOUNT_ID',
	'massupdate' => false,
  ),
  
),
	'relationships'=>array (
),
	'optimistic_locking'=>true,
		'unified_search'=>true,
	);
if (!class_exists('VardefManager')){
        require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('ht_project_task_ability','ht_project_task_ability', array('basic','assignable'));