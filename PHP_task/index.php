<?php
include 'config.php';
include 'utils/common.class.php';
include 'utils/mysql.class.php';
include 'models/countries.php';
include 'models/cities.php';

session_start();
	
$CountriesObj = new countries();
$CitiesObj = new cities();

$module = '';
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

$action = '';
if(isset($_GET['action'])) {
	$action = mysql::escape($_GET['action']);
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

$actionFile = "";
if(!empty($module) && !empty($action)) {
	$actionFile = "controllers/{$module}_{$action}.php";
}
	
include 'views/main.tpl.php';

?>