<?PHP
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

/**
 * THIS CLASS IS FOR DEVELOPERS TO MAKE CUSTOMIZATIONS IN
 */
require_once('modules/ht_project_task_ability/ht_project_task_ability_sugar.php');
class ht_project_task_ability extends ht_project_task_ability_sugar {
	
	function ht_project_task_ability(){	
		parent::ht_project_task_ability_sugar();
	}
	function create_new_list_query($order_by, $where,$filter=array(),$params=array(), $show_deleted = 0,$join_type='', $return_array = false,$parentbean=null, $singleSelect = false, $ifListForExport = false)
	{
		$return_array = parent::create_new_list_query($order_by, $where,$filter,$params, $show_deleted,$join_type, $return_array,$parentbean, $singleSelect, $ifListForExport);
		if(isset($_REQUEST['module']) && $_REQUEST['module'] == 'ht_project_task_ability'){
			$return_array['select'] .=', jt1.id as project_id, jt1.name as project_name, ac.id as account_id, ac.name as account_name';
			$return_array['from'] = str_replace("ht_project_task_ability.project_id","jt0.project_id", $return_array['from']);
			$return_array['from'] .=" LEFT JOIN projects_accounts pa ON(pa.deleted=0 AND pa.project_id=jt1.id) LEFT JOIN accounts ac ON(ac.deleted=0 AND ac.id=pa.account_id)";
			$return_array['where'] = str_replace("p.project_name","jt1.name", $return_array['where']);
			$return_array['where'] = str_replace("ht_project_task_ability.account_name","ac.name", $return_array['where']);
            $return_array['order_by'] = str_replace("project_name","jt1.name", $return_array['order_by']);
		}
		return $return_array;
	}
}
?>