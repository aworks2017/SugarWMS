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

$dictionary['queue'] = array(
	'table'=>'jobs',
	'audited'=>true,
		'duplicate_merge'=>true,
		'fields'=>array (
			'order_number' => array (
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
			'priority_ratio' => array (
				'name' => 'priority_ratio',
				'vname' => 'LBL_PRIORITY_RATIO',
				'type' => 'currency',
				'audited'=>false,
				'required'=>false,
				'comment' => ''
			),

			'status' => array (
				'required' => false,
				'name' => 'status',
				'vname' => 'LBL_STATUS',
				'type' => 'enum',
				'massupdate' => 1,
				'default' => 'Not Ready',
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
			'production_notes'=> array(
				'name' => 'production_notes',
				'vname' => 'LBL_PRODUCTION_NOTES',
				'required' => false,
				'type' => 'text',
			),
			'notes'=> array(
				'name' => 'notes',
				'vname' => 'LBL_NOTES',
				'required' => false,
				'type' => 'text',
			),
			'project_due_date' => array (
				'required' => false,
				'name' => 'project_due_date',
				'vname' => 'LBL_PROJECT_DUE_DATE',
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
			'estimated_start' => array (
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
			'project_name'=> array(
				'name'=>'project_name',
				'rname'=>'name',
				'id_name'=>'project_id',
				'vname'=>'LBL_PROJECT_NAME',
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
			'project_id' => array(
				'name' => 'project_id',
				'vname' => 'LBL_PROJECT_ID',
				'type' => 'id',
				'reportable' => false,
				'importable' => 'required',
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
			'account_id' => array(
				'name' => 'account_id',
				'vname' => 'LBL_ACCOUNTS_ID',
				'type' => 'id',
				'source' => 'non-db',
				'reportable' => false,
				'importable' => 'required',
				'audited'=>false,
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
				'massupdate'=>false,
				'required' => true,
				'source'=>'non-db',
				'audited'=>true,
			),
			'start_date_before' => array (
				'required' => false,
				'name' => 'start_date_before',
				'vname' => 'LBL_START_DATE_BEFORE',
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
				'size' => '20',
				'required' => true,
				'source' => 'non-db'
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
			'group_id' => 
			  array (
				'required' => false,
				'name' => 'group_id',
				'vname' => 'LBL_GROUP_ID',
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
				'disable_num_format' => true,
				'len' => '255',
				'size' => '20',
			  ),
		),
		'relationships' => array (
		),
	'optimistic_locking'=>true,
		'unified_search'=>true,
	);
if (!class_exists('VardefManager')){
        require_once('include/SugarObjects/VardefManager.php');
}
VardefManager::createVardef('queue','queue', array('basic','assignable'));