<?php
$job_strings[] = 'update_oncall_history';
function update_oncall_history(){
	global $timedate,$db,$log;

	//first, check to see if any associates left work without closing a job
		$select = "SELECT u.id as user_id, user_name, current_job_id  FROM users u join acl_roles_users ru on ru.user_id = u.id and ru.role_id = (select id from acl_roles where name = 'Associate' and deleted=0)
					where  current_job_id != 'ONCALL' and current_job_id is not null AND u.deleted=0";
			$result = $db->query($select, true);
			while($row = $db->fetchByAssoc($result)){
				$sql1 = "UPDATE users
						 SET current_job_id =NULL
						 WHERE id='{$row['user_id']}' AND deleted=0";
				 $db->query($sql1,true);

				 $current_timestamp=date("Y-m-d H:i:s");
				 $sql_job_history = "INSERT INTO ht_job_history(id, name,created_by, modified_user_id, assigned_user_id, action_job, jobs_id, date_entered, date_modified, deleted, action_info)
									VALUES(UUID(), '{$row['user_name']}', '{$row['user_id']}', '{$row['user_id']}',  '{$row['user_id']}', 'In Progress', '{$row['current_job_id']}', '{$current_timestamp}', '{$current_timestamp}', 0, 'Closed by WMS with end of day scheduler')";
				 $db->query($sql_job_history,true);

				 $sql_close_job = "UPDATE jobs
				 					SET status='In Progress',actual_effort=999999
				 					WHERE id='{$row['current_job_id']}'";
				 $db->query($sql_close_job,true);
		}


	//now remove any users still oncall
		$select = "SELECT * FROM users where  current_job_id='ONCALL' AND deleted=0";
		$result = $db->query($select, true);
		while($row = $db->fetchByAssoc($result)){
			$sql = "UPDATE users
					 SET current_job_id =NULL
					 WHERE id='{$row['id']}' AND deleted=0";
			 $db->query($sql,true);
			 $current_timestamp=date("Y-m-d H:i:s");
			 $sql_oncall = "UPDATE oncall_history
							 SET stop_time ='{$current_timestamp}', stop_reason='End of shift'
							 WHERE user_id='{$row['id']}'";
			 $db->query($sql_oncall,true);
		}
	return true;
}
?>