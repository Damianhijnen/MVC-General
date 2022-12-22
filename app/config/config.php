<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'Examen');

define('APPROOT', dirname(dirname(__FILE__))) ;
//URL adjust to the webhost
define('URLROOT', 'http://Examen.nl');

define('SITENAME', 'Bowling');





// Logs 
date_default_timezone_set('Europe/Amsterdam');
$ip  = "Remote IP Address: " . $_SERVER["REMOTE_ADDR"] . "\t";
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', '../app/logs.txt');
error_reporting(E_ALL);


?>
