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

$dictionary['jobs'] = array(
	'table'=>'jobs',
	'audited'=>false,
		'duplicate_merge'=>true,
		'fields'=>array (
  'order_number' => 
  array (
    'required' => false,
    'name' => 'order_number',
    'vname' => 'LBL_ORDER_NUMBER',
    'type' => 'int',
    'massupdate' => 0,
    'default' => '0',
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
    'enable_range_search' => false,
    'disable_num_format' => '',
    'min' => false,
    'max' => false,
  ),
  'project_task_id' => array(
		'name' => 'project_task_id',
		'vname' => 'LBL_PROJECT_TASK_ID',
		'required' => true,
		'type' => 'id',
		'reportable' => false,
		'importable' => 'required',

	),
  'project_due_date' => 
  array (
    'required' => false,
    'name' => 'project_due_date',
    'vname' => 'LBL_PROJECT_DUE_DATE',
    'type' => 'datetimecombo',
    'massupdate' => 1,
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
    'size' => '20',
    'enable_range_search' => true,
	'options' => 'project_due_search_dom',
    'dbType' => 'datetime',
	'required' => true,
  ),
  'buffer_mins' => 
  array (
    'required' => false,
    'name' => 'buffer_mins',
    'vname' => 'LBL_BUFFER_MINS',
    'type' => 'int',
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
    'enable_range_search' => false,
    'disable_num_format' => '',
    'min' => false,
    'max' => false,
  ),
  'parameter_1' => 
  array (
    'required' => false,
    'name' => 'parameter_1',
    'vname' => 'LBL_PARAMETER_1',
    'type' => 'varchar',
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
  ),
  'parameter_2' => 
  array (
    'required' => false,
    'name' => 'parameter_2',
    'vname' => 'LBL_PARAMETER_2',
    'type' => 'varchar',
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
  ),
  'restrict_start_days' => 
  array (
    'required' => false,
    'name' => 'restrict_start_days',
    'vname' => 'LBL_RESTRICT_START_DAYS',
    'type' => 'varchar',
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
    'len' => '5',
    'size' => '20',
  ),
  'estimated_mins' => 
  array (
    'required' => false,
    'name' => 'estimated_mins',
    'vname' => 'LBL_ESTIMATED_MINS',
    'type' => 'int',
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
    'enable_range_search' => false,
    'disable_num_format' => '',
    'min' => false,
    'max' => false,
  ),
  'actual_finish' => 
  array (
    'required' => false,
    'name' => 'actual_finish',
    'vname' => 'LBL_ACTUAL_FINISH',
    'type' => 'datetimecombo',
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
    'size' => '20',
    'dbType' => 'datetime',
	'enable_range_search' => true,
	'options' => 'actual_finish_search_dom',
  ),
  'estimated_start' => 
  array (
    'required' => false,
    'name' => 'estimated_start',
    'vname' => 'LBL_ESTIMATED_START',
    'type' => 'datetimecombo',
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
    'size' => '20',
    'enable_range_search' => false,
    'dbType' => 'datetime',
  ),
  'actual_start' => 
  array (
    'required' => false,
    'name' => 'actual_start',
    'vname' => 'LBL_ACTUAL_START',
    'type' => 'datetimecombo',
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
    'size' => '20',
    'enable_range_search' => false,
    'dbType' => 'datetime',
  ),
  'status' => 
  array (
    'required' => false,
    'name' => 'status',
    'vname' => 'LBL_STATUS',
    'type' => 'enum',
    'massupdate' => 1,
    'default' => 'Ready',
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
    'options' => 'job_status_dom',
    'studio' => 'visible',
    'dependency' => false,
  ),
	'predecessors' => array(
	'name' => 'predecessors',
	'vname' => 'LBL_PREDECESSORS',
	'required' => false,
	'type' => 'text',
	),
	'project_id' => array(
		'name' => 'project_id',
		'vname' => 'LBL_PROJECT_ID',
		'type' => 'enum',
		'reportable' => false,
		'importable' => 'required',
	),
	'date_entered' => array(
		'name' => 'date_entered',
		'vname' => 'LBL_DATE_ENTERED',
		'type' => 'datetime',
		'enable_range_search' => true,
		'options' => 'date_range_search_dom',
	),
	'date_modified' => array(
		'name' => 'date_modified',
		'vname' => 'LBL_DATE_MODIFIED',
		'type' => 'datetime',
		'enable_range_search' => true,
		'options' => 'date_range_search_dom',
		),
	'milestone_flag' => array(
		'name' => 'milestone_flag',
		'vname' => 'LBL_MILESTONE_FLAG',
		'type' =>'bool',
		'required' => false,
		'massupdate' => false
		),
	'task_number' => array(
		'name' => 'task_number',
		'vname' => 'LBL_TASK_NUMBER',
		'required' => false,
		'type' => 'int',
	),
	'estimated_effort' => array(
		'name' => 'estimated_effort',
		'vname' => 'LBL_ESTIMATED_EFFORT',
		'required' => false,
		'type' => 'decimal',
		'dbType' => 'DECIMAL(20,2)',
	),
	'actual_effort' => array(
		'name' => 'actual_effort',
		'vname' => 'LBL_ACTUAL_EFFORT',
		'required' => false,
		'type' => 'int',
	),
	'deleted' => array(
		'name' => 'deleted',
		'vname' => 'LBL_DELETED',
		'type' => 'bool',
		'required' => false,
		'default' => '0',
		'reportable'=>false,
	),
	'utilization' => array(
		'name' => 'utilization',
		'vname' => 'LBL_UTILIZATION',
		'required' => false,
		'type' => 'int',
		'validation' => array('type' => 'range', 'min' => 0, 'max' => 100),
		//'function' => 'getUtilizationDropdown',
		'function' => array('name'=>'getUtilizationDropdown', 'returns'=>'html', 'include'=>'modules/ProjectTask/ProjectTask.php'),
		'default' => 100,
	),
	'project_name'=> array(
		'name'=>'project_name',
		'rname'=>'name',
		'id_name'=>'project_id',
		'vname'=>'LBL_PARENT_NAME',
		'type'=>'relate',
		'join_name'=>'project',
		'table'=>'project',
		'isnull'=>'true',
		'module'=>'Project',
		'ext2'=>'Project',
		'massupdate'=>false,
		'source'=>'non-db',
		'required' => true,
	),
	'deliverable_id'=> array(
		'name'=>'deliverable_id',
		'rname'=>'deliverable_id',
		'id_name'=>'project_id',
		'vname'=>'LBL_DELIVERABLE_ID',
		'type'=>'relate',
		'join_name'=>'project',
		'table'=>'project',
		'isnull'=>'true',
		'module'=>'Project',
		'ext2'=>'Project',
		'massupdate'=>false,
		'source'=>'non-db',
		'required' => false,
	),
	'project_task_name'=> array(
		'name'=>'project_task_name',
		'rname'=>'name',
		'id_name'=>'project_task_id',
		'vname'=>'LBL_PROJECT_TASK_NAME',
		'type'=>'relate',
		'join_name'=>'project_task',
		'table'=>'project_task',
		'isnull'=>'true',
		'module'=>'ProjectTask',
		'massupdate'=>false,
		'source'=>'non-db',
	),
	'jobs_date_time'=> array(
		'required' => false,
		'name' => 'jobs_date_time',
		'vname' => 'LBL_JOBS_DATE_TIME',
		'type' => 'datetimecombo',
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
		'size' => '20',
		'enable_range_search' => true,
		'options' => 'date_range_search_dom',
		'dbType' => 'datetime',
		'required' => true,
		'display_default' => 'now&05:00pm',
	),
	'stopping_point'=> array(
		'name' => 'stopping_point',
		'vname' => 'LBL_STOPPING_POINT',
		'type' => 'varchar',
		'dbType' => 'varchar',
		'len' => '50',
		'audited'=>false,
		'required'=>false,
		'comment' => ''
	),
	'notes'=> array(
		'name' => 'notes',
		'vname' => 'LBL_NOTES',
		'required' => false,
		'type' => 'text',
	),
	// 'deliverable_id'=> array(
		// 'required' => false,
		// 'name' => 'deliverable_id',
		// 'vname' => 'LBL_DELIVERABLE_ID',
		// 'type' => 'varchar',
		// 'massupdate' => 0,
		// 'no_default' => false,
		// 'comments' => '',
		// 'help' => '',
		// 'importable' => 'true',
		// 'duplicate_merge' => 'disabled',
		// 'duplicate_merge_dom_value' => '0',
		// 'audited' => false,
		// 'reportable' => true,
		// 'unified_search' => false,
		// 'merge_filter' => 'disabled',
		// 'len' => '25',
		// 'source' => 'non-db',
		// 'size' => '20',
	// ),
/* 	'notes' => array (
		'name' => 'notes',
		'type' => 'link',
		'relationship' => 'project_tasks_notes',
		'source'=>'non-db',
		'vname'=>'LBL_NOTES',
	), */
	'tasks' => array (
		'name' => 'tasks',
		'type' => 'link',
		'relationship' => 'project_tasks_tasks',
		'source'=>'non-db',
		'vname'=>'LBL_TASKS',
	),
	'meetings' => array (
		'name' => 'meetings',
		'type' => 'link',
		'relationship' => 'project_tasks_meetings',
		'source'=>'non-db',
		'vname'=>'LBL_MEETINGS',
	),
	'calls' => array (
		'name' => 'calls',
		'type' => 'link',
		'relationship' => 'project_tasks_calls',
		'source'=>'non-db',
		'vname'=>'LBL_CALLS',
	),

	'emails' => array (
		'name' => 'emails',
		'type' => 'link',
		'relationship' => 'emails_project_task_rel',/* reldef in emails */
		'source'=>'non-db',
		'vname'=>'LBL_EMAILS',
	),
	'projects' =>  array (
		'name' => 'projects',
		'type' => 'link',
		'relationship' => 'projects_project_tasks',
		'source'=>'non-db',
		'vname'=>'LBL_LIST_PARENT_NAME',
	),
 /*  'created_by_link' => array (
		'name' => 'created_by_link',
		'type' => 'link',
		'relationship' => 'project_tasks_created_by',
		'vname' => 'LBL_CREATED_BY_USER',
		'link_type' => 'one',
		'module'=>'Users',
		'bean_name'=>'User',
		'source'=>'non-db',
  ),
  'modified_user_link' => array (
		'name' => 'modified_user_link',
		'type' => 'link',
		'relationship' => 'project_tasks_modified_user',
		'vname' => 'LBL_MODIFIED_BY_USER',
		'link_type' => 'one',
		'module'=>'Users',
		'bean_name'=>'User',
		'source'=>'non-db',
		
  ), */
    'job_history_link' => array(
		'name' => 'job_history_link',
		'type' => 'link',
		'relationship' => 'jobs_job_history',
		'source' => 'non-db',
		'vname' => 'LBL_JOBS_HISTORY',
  ),
   'account_id' => array(
		'name' => 'account_id',
		'vname' => 'LBL_ACCOUNTS_ID',
		'type' => 'enum',
		'reportable' => false,
		'importable' => 'required',
		'function' => 'getAccount',
		'audited'=>false,
		'massupdate'=>false,
	),
	'account_name'=> array(
		'name'=>'account_name',
		'rname'=>'name',
		'id_name'=>'account_id',
		'vname'=>'LBL_ACCOUNT_NAME',
		'type'=>'relate',
		'join_name'=>'accounts',
		'bean_name' => 'Account',
		'table'=>'accounts',
		'isnull'=>'true',
		'module'=>'Accounts',
		'link'=>'accounts_jobs_link',
		'massupdate'=>false,
		'required' => true,
		'source'=>'non-db',
		'audited'=>true,
		'ext2'=>'Accounts',
	),
	'add_all_tasks' => array( 
		'name' => 'add_all_tasks',
		'vname' => 'LBL_ADD_ALL_TASKS',
		'default' => 1,
		'type' => 'bool',
		'comment' => 'Add all tasks',
		'studio' => false,
		'massupdate'=> false,
		'required' => true,
   ),
   'have_notes' => 
  array (
    'required' => false,
    'name' => 'have_notes',
    'vname' => 'LBL_HAVE_NOTES',
    'type' => 'enum',
    'no_default' => false,
    'comments' => '',
    'help' => '',
    'importable' => 'true',
    'duplicate_merge' => 'disabled',
    'duplicate_merge_dom_value' => '0',
    'audited' => false,
    'reportable' => false,
    'unified_search' => false,
    'merge_filter' => 'disabled',
    'len' => 100,
    'size' => '20',
    'options' => 'have_notes_dom',
    'studio' => 'visible',
    'dependency' => false,
	'source'=>'non-db',
	'massupdate'=> false,
  ),
 ),
	'relationships'=> array (
		'jobs_job_history' =>  array(
		'lhs_module'		=> 'jobs',
		'lhs_table'			=> 'jobs',
		'lhs_key'			=> 'id',
		'rhs_module'		=> 'ht_job_history',
		'rhs_table'			=> 'ht_job_history',
		'rhs_key'			=> 'jobs_id',
		'relationship_type'	=> 'one-to-many',
		),
	),
	'optimistic_locking'=>true,
		'unified_search'=>true,
	);
if (!class_exists('VardefManager')){
        require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('jobs','jobs', array('basic','assignable'));