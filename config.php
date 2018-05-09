<?php
/*** configuration *****/
ini_set('display_errors','on');
error_reporting(E_ALL);

session_start();

$root = $_SERVER['DOCUMENT_ROOT'];
$host = $_SERVER['HTTP_HOST'];

define('HOST', 'http://'.$host.'/lependu/');
define('ROOT', $root.'lependu/');

define('CONTROLLER', ROOT.'controller/');
define('VIEW', ROOT.'view/');
define('MODEL', ROOT.'model/');
define('LIB', ROOT.'lib/');
define('IMG', HOST.'assets/images/');
define('CSS', HOST.'assets/css/');