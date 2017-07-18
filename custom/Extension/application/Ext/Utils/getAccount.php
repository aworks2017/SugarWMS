<?php
function getAccount(){
	global $db;
	$query = "SELECT id as account_id, name AS account_name, accounts.client_code
			  FROM accounts
			  INNER JOIN accounts_cstm ON(accounts.id=accounts_cstm.id_c)
			  WHERE deleted = 0 AND custom_status_c='active'
			  ORDER BY accounts.client_code, accounts.name ASC";
	$result = $db->query($query, false);
	$account = array(''=>'');
	while ($row = $db->fetchByAssoc($result)) {
		$account[$row['account_id']] = $row['client_code'].'|'.$row['account_name'];
	}
	return $account;
}
?>