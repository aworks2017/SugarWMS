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

$dictionary['ht_job_history'] = array(
	'table'=>'ht_job_history',
	'audited'=>true,
		'duplicate_merge'=>true,
		'fields'=>array (
  'jobs_id' => array (
    'required' => true,
    'name' => 'jobs_id',
    'vname' => 'LBL_JOB_ID',
    'type' => 'id',
	'reportable' => false,
	'importable' => 'required',
  ),
   'action_job' =>  array (
    'required' => false,
    'name' => 'action_job',
    'vname' => 'LBL_ACTION',
    'type' => 'enum',
    'len' => 100,
    'size' => '20',
    'options' => 'action_list',
    'dependency' => false,
  ),
  'action_info' =>  array (
    'required' => false,
    'name' => 'action_info',
    'vname' => 'LBL_ACTION_INFO',
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
  'jobs_name'=> array(
		'name'=>'jobs_name',
		'rname'=>'name',
		'id_name'=>'jobs_id',
		'vname'=>'LBL_JOB_RELATE_NAME',
		'type'=>'relate',
		'join_name'=>'jobs',
		'table'=>'jobs',
		'isnull'=>'true',
		'module'=>'jobs',
		'massupdate'=>false,
		'source'=>'non-db',
	),
  'action_stop' => 
  array (
    'required' => false,
    'name' => 'action_stop',
    'vname' => 'LBL_ACTION_STOP',
    'type' => 'enum',
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
    'len' => 100,
    'size' => '20',
    'options' => 'action_stop_list',
    'studio' => 'visible',
    'dependency' => false,
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
VardefManager::createVardef('ht_job_history','ht_job_history', array('basic','assignable'));