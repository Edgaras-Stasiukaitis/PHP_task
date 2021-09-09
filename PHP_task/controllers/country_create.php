<?php

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
		$CountriesObj->insertCountry(array('Name' => $_POST['Name'], 
										   'Area' => $_POST['Area'], 
										   'Population' => $_POST['Population'], 
										   'Phone_Code' => $_POST['Phone_Code']));
		$_SESSION['added'] = true;
		common::redirect("index.php?module=country&action=list&search={$search}&order={$order}&from={$from}&to={$to}&page={$pageId}");
		die();
	} else{
		$errors['invalidData'] = true;
	}
}

?>