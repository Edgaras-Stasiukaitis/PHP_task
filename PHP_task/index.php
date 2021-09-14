<?php
include 'config.php';
include 'utils/common.class.php';
include 'utils/mysql.class.php';
include 'models/countries.php';
include 'models/cities.php';

session_start();

$module = 'country';
if(isset($_GET['module'])) {
	$module = mysql::escape($_GET['module']);
}

$id = '';
if(isset($_GET['id'])) {
	$id = mysql::escape($_GET['id']);
}

$countryID = '';
if(isset($_GET['countryID'])) {
	$countryID = mysql::escape($_GET['countryID']);
}

$action = 'listAction';
if(isset($_GET['action'])) {
	$action = mysql::escape($_GET['action'])."Action";
}

$pageId = 1;
if(!empty($_GET['page'])) {
	$pageId = mysql::escape($_GET['page']);
}

$search = '';
if(!empty($_GET['search'])) {
	$search = mysql::escape($_GET['search']);
}

$order = '';
if(isset($_GET['order'])) {
	$order = mysql::escape($_GET['order']);
}

$from = '';
if(isset($_GET['from'])) {
	$from = mysql::escape($_GET['from']);
}

$to = '';
if(isset($_GET['to'])) {
	$to = mysql::escape($_GET['to']);
}

$actionFile = "country_controller";
if(!empty($module) && !empty($action)) {
	$actionFile = "controllers/{$module}_controller.php";
}

$controllerName = "country_controller";
if(!empty($module)) {
	$controllerName = $module."_controller";
}

$model = '';
$model = $controllerName == "country_controller" ? new countries() : new cities();
	
include 'views/main.tpl.php';

?>