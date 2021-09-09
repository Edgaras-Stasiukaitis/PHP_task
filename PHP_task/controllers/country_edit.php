<?php

$countriesObj = new countries();
if(!empty($_POST['submit'])) {
	if($_POST['Name'] == '')
		$errors['invalidName'] = true;
	if($_POST['Area'] == '')
		$errors['invalidArea'] = true;
	if($_POST['Population'] == '')
		$errors['invalidPopulation'] = true;
	if($_POST['Phone_Code'] == '')
		$errors['invalidPhone_Code'] = true;
	if(empty($errors)){
		$countriesObj->updateCountry(array('Name' => $_POST['Name'], 
										   'Area' => $_POST['Area'], 
										   'Population' => $_POST['Population'], 
										   'Phone_Code' => $_POST['Phone_Code'],
										   'ID' => $id));
		$_SESSION['edited'] = true;
		common::redirect("index.php?module=country&action=list&search={$search}&order={$order}&from={$from}&to={$to}&page={$pageId}");
		die();
	} else{
		$errors['invalidData'] = true;
		$data = $_POST;
	}
} else {
	$data = $countriesObj->getCountry($id);
}

include 'views/country_form.tpl.php';

?>