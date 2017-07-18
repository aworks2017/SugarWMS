<?php
include ('include/MVC/preDispatch.php');
require_once('include/entryPoint.php');
require_once('include/MVC/SugarApplication.php');
global $sugar_config;
print"<pre>";print_r($sugar_config);die;