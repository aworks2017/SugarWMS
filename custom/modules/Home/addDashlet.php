<?php
	global $db;
	$query = "SELECT user_preferences.id, user_preferences.contents FROM user_preferences WHERE category='Home'";
	$db_result = $db->query($query);
	$is_updated = false;
	while($db_row = $db->fetchByAssoc($db_result)){
		$pref_array = unserialize(base64_decode($db_row['contents']));
		$pref_array['dashlets']['8ec83051-10bd-275f-2925-5634bc0fc907'] = array(
			'className' => 'iFrameDashlet',
			'module' => 'Home',
			'options' => array(
				'title' => ' Job Queue',
				'url' => 'http://dev1.autonomyworks.net/index.php?module=jobs&action=queue&fromDashlet=true',
				'height' => '415',
				'autoRefresh' => '-1',
			),
			'fileLocation' => 'modules/Home/Dashlets/iFrameDashlet/iFrameDashlet.php'
		);
		$pref_array['pages'][0]['columns'][0]['dashlets'][0] = '8ec83051-10bd-275f-2925-5634bc0fc907';
		$new_contents = base64_encode(serialize($pref_array));
		$sql = "UPDATE user_preferences SET contents='{$new_contents}' where id='{$db_row['id']}' AND category='Home'";
		if($db->query($sql, true)){
			$is_updated = true;
		}
	}
	if($is_updated){
		echo 'Dashlet added.';
	}
?>