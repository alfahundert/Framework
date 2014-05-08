<?php

session_start();

define("DS", DIRECTORY_SEPARATOR);
define('PATH_ROOT', '..' . DS);

require_once('../library/Bootstrap.php');
$bootstrap	= new Bootstrap();
$bootstrap->Init();