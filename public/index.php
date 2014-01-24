<?php

require_once '../library/Bootstrap.php';
require_once '../library/Database.php';
require_once '../library/Autoloader.php';

define("DS", DIRECTORY_SEPARATOR);
define('PATH_ROOT', $_SERVER['DOCUMENT_ROOT']);

$bootstrap	= new Bootstrap();
$bootstrap->InitUrl();