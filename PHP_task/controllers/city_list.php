<?php

$elementCount = $CitiesObj->getCityListCount($countryID, $search, $from, $to);

include 'utils/paging.class.php';
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

$paging->process($elementCount, $pageId);

$data = $CitiesObj->getCityListByFK($countryID, $paging->size, $paging->first, $search, $order, $from, $to);

if(isset($_POST['search'])){
	common::redirect("index.php?module={$module}&action=list&countryID={$countryID}&search={$_POST['search']}&order={$order}&from={$from}&to={$to}&page=1");
	die();
}

if(isset($_POST['filter'])){
	common::redirect("index.php?module={$module}&action=list&countryID={$countryID}&search={$search}&order={$order}&from={$_POST['DateFrom']}&to={$_POST['DateTo']}&page=1");
	die();
}

include 'views/city_list.tpl.php';

?>