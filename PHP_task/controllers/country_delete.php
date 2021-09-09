<?php
if(!empty($id)) {
	$CountriesObj->deleteCities("({$id})");
	$CountriesObj->deleteCountry($id);
	$_SESSION['deleted'] = true;
}
common::redirect("index.php?module={$module}&action=list&search={$search}&order={$order}&from={$from}&to={$to}&page={$pageId}");
die();
?>