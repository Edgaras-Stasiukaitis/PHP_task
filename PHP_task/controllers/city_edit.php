<?php

$citiesObj = new cities();
if(!empty($_POST['submit'])) {
	if($_POST['Name'] == '')
		$errors['invalidName'] = true;
	if($_POST['Area'] == '')
		$errors['invalidArea'] = true;
	if($_POST['Population'] == '')
		$errors['invalidPopulation'] = true;
	if($_POST['Postal_Code'] == '')
		$errors['invalidPostal_Code'] = true;
	if(empty($errors)){
		$citiesObj->updateCity(array('Name' => $_POST['Name'], 
										   'Area' => $_POST['Area'], 
										   'Population' => $_POST['Population'], 
										   'Postal_Code' => $_POST['Postal_Code'],
										   'CountryID' => $countryID,
										   'ID' => $id));
		$_SESSION['edited'] = true;
		common::redirect("index.php?module=city&action=list&countryID={$countryID}&search={$search}&order={$order}&from={$from}&to={$to}&page={$pageId}");
		die();
	} else{
		$errors['invalidData'] = true;
		$data = $_POST;
	}
} else {
	$data = $citiesObj->getCity($id);
}

include 'views/city_form.tpl.php';

?>