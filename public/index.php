<?php

define("DS", DIRECTORY_SEPARATOR);
define('PATH_ROOT', $_SERVER['DOCUMENT_ROOT'] . DS);

require_once('../library/Bootstrap.php');
$bootstrap	= new Bootstrap();
$bootstrap->InitUrl();