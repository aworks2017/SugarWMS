<?php
global $db;
$delete="DELETE FROM users_schedule";
$db->query($delete, true);
echo "Script is executed";