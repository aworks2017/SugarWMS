<?php
global $db;
$sql = "INSERT INTO config(category, name, value) VALUES ('workflowportal', 'api_key', '432e0a359bbf3669e6da610d57ea5d0cd9e2')";
$db->query($sql, true);
echo 'Key Inserted!';die;
?>