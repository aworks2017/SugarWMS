<?php
include('config.php');
$db = $sugar_config['dbconfig'];
$root = getcwd();
exec("mysqldump -u {$db['db_user_name']} -p'{$db['db_password']}' {$db['db_name']} > {$root}/imenus.sql");
$file = 'imenus.sql';

if (file_exists($file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    flush();
    readfile($file);
    exit;
}else{
	echo "Couldn't export tables. Please contact to Administrator.";
}
?>