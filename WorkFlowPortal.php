<?php
class WorkFlowPortal{
	private $dbconfig, $db, $sugar_config;
	function __construct(){
		require_once('config.php');
		$this->sugar_config = $sugar_config;
		$this->dbconnect();
	}
	function main(){
		//fetch api key from config table
		$sql = "SELECT value AS api_key
				FROM config
				WHERE name='api_key' AND category='workflowportal'";
		$result = $this->dbquery($sql);
		if (isset($_REQUEST['key']) && $_REQUEST['key'] == $result[0]['api_key']) {
			//Check action
			if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
				//list of actions
				if($_REQUEST['action'] == 'get_task'){
					if(isset($_REQUEST['user']) && !empty($_REQUEST['user']) ){
						$user_name = $_REQUEST['user'];
						$result = $this->getCurrentJobId($user_name);
						if(empty($result) || $result == 'ONCALL'){
							$result = $this->fecthRelatedJob($user_name, '');
							if(empty($result)){
								echo json_encode(0);
							}else{
								echo json_encode($result);
							}
						}else{
							echo json_encode($result);
						}
					}else{
						echo  json_encode('Invalid User');
					}
				}elseif($_REQUEST['action'] == 'start'){
					if(isset($_REQUEST['job']) && !empty($_REQUEST['job']) ){
						$job_id = $_REQUEST['job'];

						//Updating Job Status Started
						$date =gmdate("Y-m-d H:i:s");
						$sql = "UPDATE jobs
								SET status='Started',
								actual_start= IF(actual_start IS NULL OR actual_start='', '{$date}', actual_start)
								WHERE id='{$job_id}'";
						$this->dbquery($sql);

						$sql = "SELECT j.id, j.name, j.assigned_user_id, j.parameter_1, j.parameter_2,  j.estimated_start, j.actual_finish, j.activity_count, j.activity_driver, proj.name AS deliverable_name, proj.deliverable_id, act.name AS account_name, j.production_notes, j.stopping_point, j.notes, j.restrict_start_days, j.estimated_mins
								FROM jobs j
								LEFT JOIN  project proj
									ON (proj.id=j.project_id AND proj.deleted=0)
								LEFT JOIN  accounts act
									ON (act.id=j.account_id AND act.deleted=0)
								WHERE j.deleted=0 AND j.id='{$job_id}'";
						$result = $this->dbquery($sql);

						//Updating Job History
						$this->logJobHistory($result[0]['assigned_user_id'], 'start', $job_id);
						//Check user current job id
						$sql_current_job = "SELECT current_job_id
								FROM users
								WHERE id='{$result[0]['assigned_user_id']}'";
						$result_current_job = $this->dbquery($sql_current_job);
						if ($result_current_job[0]['current_job_id']=='ONCALL'){
							//Updating oncall_history
							$sql_up = "UPDATE oncall_history
									SET stop_time=NOW(),stop_reason = 'Assigned new task'
									WHERE user_id='{$result[0]['assigned_user_id']}' AND stop_time IS NULL";
							$this->dbquery($sql_up);
						}

						//Assigning current_job_id to user
						$sql = "UPDATE users
								SET current_job_id='{$job_id}'
								WHERE id='{$result[0]['assigned_user_id']}'";
						$this->dbquery($sql);

						//Returning Job data
						$result =array(
							'job_id' => $result[0]['id'],
							'name' => $result[0]['name'],
							'parameter_1' => $result[0]['parameter_1'],
							'parameter_2' => $result[0]['parameter_2'],
							'estimated_start' => $result[0]['estimated_start'],
							'estimated_finish' => $result[0]['actual_finish'],
							'activity_count' => $result[0]['activity_count'],
							'activity_driver' => $result[0]['activity_driver'],
							'account_name' => $result[0]['account_name'],
							'deliverable_name' => $result[0]['deliverable_name'],
							'deliverable_id' => $result[0]['deliverable_id'],
							'production_notes' => $result[0]['production_notes'],
							'notes' => $result[0]['notes'],
							'restrict_start_days' => $result[0]['restrict_start_days'],
							'estimated_mins' => $result[0]['estimated_mins'],
						);
						echo json_encode($result);
						return true;
					}else{
						echo  json_encode('Invalid Job Id');
						return false;
					}
				}elseif($_REQUEST['action'] == 'on_call'){
					if(isset($_REQUEST['user']) && !empty($_REQUEST['user'])){
						//select user_id by user name
						$sql = "SELECT id,current_job_id
								FROM users
								WHERE user_name = '{$_REQUEST['user']}'";
						$result = $this->dbquery($sql);
						$user_id = $result[0]['id'];
						//if already ONCALL simply return
						if($result[0]['current_job_id'] != 'ONCALL'){
							//Assigning ONCALL to user
							$sql = "UPDATE users
									SET current_job_id='ONCALL'
									WHERE user_name = '{$_REQUEST['user']}'";
							$this->dbquery($sql);
							//Updating oncall_history
							$sql = "INSERT INTO oncall_history (user_id,start_time)
									VALUES('{$user_id}', NOW())";
							$this->dbquery($sql);
						}
						return true;
					}else{
						echo  json_encode('User Name Required');
						return false;
					}
				}elseif($_REQUEST['action'] == 'logout'){
					if(isset($_REQUEST['user']) && !empty($_REQUEST['user'])){
						//select user_id by user name
						$sql = "SELECT id,current_job_id
								FROM users
								WHERE user_name = '{$_REQUEST['user']}'";
						$result = $this->dbquery($sql);
						$user_id = $result[0]['id'];
						//if not ONCALL simply return
						if($result[0]['current_job_id'] == 'ONCALL'){

							$sql = "UPDATE users
									SET current_job_id=NULL
									WHERE user_name = '{$_REQUEST['user']}'";
							$this->dbquery($sql);

							$sql = "UPDATE oncall_history
							 		SET stop_time = NOW(), stop_reason='Logged Out'
									WHERE user_id='{$user_id}'";
							$this->dbquery($sql);
						}
						return true;
					}else{
						echo  json_encode('User Name Required');
						return false;
					}
				}elseif($_REQUEST['action'] == 'update'){
					if(isset($_REQUEST['job']) && !empty($_REQUEST['job']) && isset($_REQUEST['new_count']) && !empty($_REQUEST['new_count'])  ){

						//Updating Activity Count
						$sql = "UPDATE jobs
								SET activity_count='{$_REQUEST['new_count']}'
								WHERE id='{$_REQUEST['job']}'";
						$this->dbquery($sql);
						echo json_encode($_REQUEST['new_count']);
						return true;
					}else{
						echo json_encode('Incomplete Information');
						return false;
					}

				}elseif($_REQUEST['action'] == 'stop'){
					if(isset($_REQUEST['job']) && !empty($_REQUEST['job']) && isset($_REQUEST['action_stop']) && !empty($_REQUEST['action_stop'])){
						$job_id = $_REQUEST['job'];
						$action_stop = $_REQUEST['action_stop'];
						//select assigned_user_id from stopped job

						$sql = "SELECT assigned_user_id,notes
								FROM jobs
								WHERE deleted=0 AND id='{$job_id}'";
						$result = $this->dbquery($sql);
						$assigned_user_id = $result[0]['assigned_user_id'];
						$action_info  = isset($_REQUEST['action_info']) ? $_REQUEST['action_info']:'';
						//$notes = $result[0]['notes'].$action_info;
						//Updating Job History
						$this->logJobHistory($assigned_user_id, $_REQUEST['action_stop'], $job_id, $action_info);
						if(strtolower($_REQUEST['action_stop']) == 'completed' || strtolower($_REQUEST['action_stop']) == 'in progress' || strtolower($_REQUEST['action_stop']) == 'issue'){
							$select_job = "SELECT actual_effort FROM `jobs` where id = '{$job_id}' AND  deleted = 0 ";
							$result_job = $this->dbquery($select_job);
							$actual_effort = $result_job[0]['actual_effort'];
							if($actual_effort != 999999){
								$select = "SELECT date_entered, id, action_job FROM ht_job_history where jobs_id='{$job_id}' AND deleted=0 ORDER BY date_entered DESC";
								$result = $this->dbquery($select);
								$start_time = '';
								$end_time = '';
								$break_start =  '12:30pm';
								$break_end =  '1:30pm';
								$count = 0;
								foreach($result as $row){
									if($count == 0 && in_array(strtolower($row['action_job']), array('issue','completed','in progress' ) )) {//  ==  || strtolower($row['action_job']) ==  || strtolower($row['action_job']) ==  || strtolower($row['action_job']) == || strtolower($row['action_job']) == 'qa check'){
										$end_time = date('Y-m-d H:i', strtotime($row['date_entered']));
									}elseif(in_array(strtolower($row['action_job']), array('issue','completed','in progress' ) )) {//  ==  || strtolower($row['action_job']) ==  || strtolower($row['action_job']) ==  || strtolower($row['action_job']) == || strtolower($row['action_job']) == 'qa check'){
										break;
									}else{
										$start_time = date('Y-m-d H:i', strtotime($row['date_entered']));
									}
									$count++;
								}
								if($end_time > 0 && $start_time > 0){

									$actual_effort += (strtotime($end_time) - strtotime($start_time))/60;
									
									
									if((strtotime(date('h:ia',strtotime($start_time."-6hours"))) < strtotime($break_start)) && (strtotime(date('h:ia',strtotime($end_time."-6hours"))) > strtotime($break_end))){
										$actual_effort -= 60;
									}
									$current_timestamp = gmdate("Y-m-d H:i:s");
									$sql = "UPDATE jobs
											SET actual_effort='{$actual_effort}', actual_finish ='{$current_timestamp}', status='Completed', order_number = NULL , priority_ratio = NULL
											WHERE id='{$_REQUEST['job']}' ";
									$this->dbquery($sql);
								}
							}
						}

						//Updating Jobs Status and action stoping point
						//$action_stopping_point = isset($_REQUEST['action_stopping_point']) ? $_REQUEST['action_stopping_point'] : '';
						$sql = "UPDATE jobs
								SET status='{$_REQUEST['action_stop']}', notes ='{$action_info}'
								WHERE id='{$job_id}'";
						$this->dbquery($sql);

						//Set current_user_id NULL
						$sql = "UPDATE users
								SET current_job_id= NULL
								WHERE id='{$assigned_user_id}'";
						$this->dbquery($sql);


						$result = $this->fecthRelatedJob($assigned_user_id, $job_id);
						echo json_encode($result);
						return true;
					}else{
						echo json_encode('Incomplete Information');
						return false;
					}
				}else{
					echo json_encode('Invalid Action');
					return false;
				}
			}else{
				echo json_encode('Empty Action');
				return false;
			}

		}else{
			echo json_encode('Invalid Key');
			return false;
		}
	}
	function dbconnect(){
		$this->db = mysql_connect($this->sugar_config['dbconfig']['db_host_name'], $this->sugar_config['dbconfig']['db_user_name'], $this->sugar_config['dbconfig']['db_password']) or die(mysql_error());

		mysql_select_db($this->sugar_config['dbconfig']['db_name'], $this->db) or die(mysql_error());
	}
	function dbquery($query){
		$res = mysql_query($query, $this->db);
		$data = array();
		$return = array();
		if($res != '1'){
			while($data = mysql_fetch_assoc($res))
			{
				$return[] = $data;
			}
		}
		return $return;
	}
	function fecthRelatedJob($user_name, $job_id){
		$job_where ="";
		$user_where ="";
		$user_join ="";
		if(!empty($job_id)){
			$job_where = "AND jobs.id !='{$job_id}'";
			$user_where = "AND jobs.assigned_user_id ='{$user_name}'";
			$order_limit = "LIMIT 1";
		}elseif(!empty($user_name)){
			$user_where = "AND users.user_name='{$user_name}'";
			$user_join ="INNER JOIN users ON(jobs.assigned_user_id=users.id)";
			$order_limit = "ORDER BY order_number LIMIT 1";
		}
		$sql ="SELECT  jobs.id AS job_id
				FROM  jobs
				{$user_join}
				WHERE jobs.deleted=0 AND (jobs.order_number != 0 AND jobs.order_number is NOT NULL)   AND jobs.status IN('Ready','Started') {$user_where} {$job_where} AND jobs.id NOT IN ( SELECT current_job_id FROM users WHERE current_job_id != 'ONCALL' and current_job_id is not null)
				{$order_limit}";
		$job_id ='';
		$result = $this->dbquery($sql);
		if(!empty($result)){
			return $result[0]['job_id'];
		}else{
			return 0;
		}
	}
	function getUserName($user_id){
		$user_sql = "SELECT CONCAT_WS(' ', first_name, last_name) AS name
				FROM users
				WHERE deleted=0 AND id='{$user_id}'";
		$user = $this->dbquery($user_sql);
		return $user[0]['name'];
	}
	function getCurrentJobId($user_name){
		$user_sql = "SELECT current_job_id
				FROM users
				WHERE deleted=0 AND user_name='{$user_name}'";
		$user = $this->dbquery($user_sql);
		return $user[0]['current_job_id'];
	}
	function logJobHistory($user_id, $action, $job_id, $action_info=''){
		$date =gmdate("Y-m-d H:i:s");
		$user_name = $this->getUserName($user_id);
		$sql = "INSERT INTO ht_job_history(id, name,created_by, modified_user_id, assigned_user_id, action_job, jobs_id, date_entered, date_modified, deleted, action_info)
				VALUES(UUID(), '{$user_name}', '{$user_id}', '{$user_id}',  '{$user_id}', '{$action}', '{$job_id}', '{$date}', '{$date}', 0, '{$action_info}')";
		$this->dbquery($sql);
	}
}

$workflow = new WorkFlowPortal();
$workflow->main();
?>