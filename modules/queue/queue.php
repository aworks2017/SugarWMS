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
require_once('modules/queue/queue_sugar.php');
class queue extends queue_sugar {
	
	function queue(){	
		parent::queue_sugar();
	}
	function fill_in_additional_list_fields()
	{
		parent::fill_in_additional_list_fields();
		global $db, $timedate;
		//updating Actual JOb Start time.
		$sql = "SELECT date_entered
				FROM ht_job_history 
				WHERE deleted=0 AND LOWER(action_job)='start' AND jobs_id ='{$this->id}'
				ORDER BY date_entered DESC
				LIMIT 1";
		$result = $db->query($sql, true);
		$row = $db->fetchByAssoc($result);
		$this->estimated_start = $timedate->to_display_date_time($row['date_entered']);
	}
	function create_new_list_query($order_by, $where,$filter=array(),$params=array(), $show_deleted = 0,$join_type='', $return_array = false,$parentbean=null, $singleSelect = false)
	{
		$return_array =  parent::create_new_list_query($order_by, $where, $filter, $params, $show_deleted, $join_type, $return_array, $parentbean, $singleSelect);
		$return_array['from'] = str_replace('queue', 'jobs', $return_array['from']);
		if(isset($_REQUEST['start_date_before_basic']) && !empty($_REQUEST['start_date_before_basic'])){
			global $db,$timedate;
			$start_date = $_REQUEST['start_date_before_basic'];
			$sql = "SELECT id,project_due_date ,restrict_start_days 
					FROM jobs 
					WHERE jobs.deleted=0 AND jobs.restrict_start_days!='' AND jobs.restrict_start_days IS NOT NULL ";
			$result = $db->query($sql, true);
			$job_ids = array();
			while($row = $db->fetchByAssoc($result)){
				$dueDate = $timedate->to_display_date($row['project_due_date']);
				$days= (int)$row['restrict_start_days'];
				$new_date =  strtotime("$dueDate - $days  weekdays");
				if( $new_date <= strtotime($start_date)){
					
					$job_ids[] = $row['id'];
				}
			}
			if($job_ids){
				$job_ids_where = implode("','",$job_ids);
			}
			$cstm_where = explode('AND', $return_array['where']);
			foreach ($cstm_where AS $key => $data){
				if(strpos($data,"start_date_before")){
					unset($cstm_where[$key]);
					if($key == 0){
						$add_where = ' where ( ';
					}
				}
			}
			$return_array['where'] = $add_where.implode("AND",$cstm_where);
			$return_array['where'] .=" AND (jobs.restrict_start_days='' OR jobs.restrict_start_days IS NULL OR jobs.id IN ('{$job_ids_where}')) ";
		}
		if($order_by=='group_id ASC' || $order_by=='group_id DESC' || str_replace(" ",$order_by)=='group_id'){
			$return_array['order_by'] .= ', jobs.order_number asc, jobs.priority_ratio asc';
		}else{
			$return_array['order_by'] .= ', jobs.group_id asc , jobs.order_number asc, jobs.priority_ratio asc';			
		}
		return $return_array;
	}
}
?>