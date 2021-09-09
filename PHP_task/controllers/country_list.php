<?php

$elementCount = $CountriesObj->getCountryListCount($search, $from, $to);

include 'utils/paging.class.php';
$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

$paging->process($elementCount, $pageId);

$data = $CountriesObj->getCountryList($paging->size, $paging->first, $search, $order, $from, $to);

if(isset($_POST['search'])){
	common::redirect("index.php?module={$module}&action=list&search={$_POST['search']}&order={$order}&from={$from}&to={$to}&page=1");
	die();
}

if(isset($_POST['filter'])){
	common::redirect("index.php?module={$module}&action=list&search={$search}&order={$order}&from={$_POST['DateFrom']}&to={$_POST['DateTo']}&page=1");
	die();
}

include 'views/country_list.tpl.php';

?>