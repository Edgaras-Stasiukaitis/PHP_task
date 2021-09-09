<?php
if(!empty($id)) {
	$CitiesObj->deleteCity($id);
	$_SESSION['deleted'] = true;
}
common::redirect("index.php?module={$module}&action=list&countryID={$countryID}&search={$search}&order={$order}&from={$from}&to={$to}&page={$pageId}");
die();
?>