 <?php
	global $db;
	$sql="SELECT value FROM config WHERE category='queue' AND name='workdays_to_sort' LIMIT 1";		
	$result = $db->query($sql, true);
	$row = $db->fetchByAssoc($result);
	echo 'workdays_to_sort value in config is: '.$row['value'];die;
 ?>