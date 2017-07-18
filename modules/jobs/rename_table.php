<?php
global $db;
$sql = "DROP TABLE ht_jobs";
$db->query($sql, true);
$sql = "DROP TABLE ht_jobs_audit";
$db->query($sql, true);
echo 'table renamed';die;
?>