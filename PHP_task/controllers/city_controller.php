<?php

class city_controller{
	
	private $model;

	public function __construct($model) {
		$this->model = $model;
	}
	
	public function listAction($error, $module, $action, $pageId, $search, $order, $from, $to, $countryID){
		$elementCount = $this->model->getCityListCount($countryID, $search, $from, $to);

		include 'utils/paging.class.php';
		$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

		$paging->process($elementCount, $pageId);

		$data = $this->model->getCityListByFK($countryID, $paging->size, $paging->first, $search, $order, $from, $to);

		if(isset($_POST['search'])){
			common::redirect("index.php?module={$module}&action=list&countryID={$countryID}&search={$_POST['search']}&order={$order}&from={$from}&to={$to}&page=1");
			die();
		}

		if(isset($_POST['filter'])){
			common::redirect("index.php?module={$module}&action=list&countryID={$countryID}&search={$search}&order={$order}&from={$_POST['DateFrom']}&to={$_POST['DateTo']}&page=1");
			die();
		}

		return include 'views/city_list.tpl.php';
	}
	
	public function createAction($module, $action, $pageId, $search, $order, $from, $to, $countryID){
		$errors = array();
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
				echo "test";
				$this->model->insertCity(array('Name' => $_POST['Name'], 
											   'Area' => $_POST['Area'], 
											   'Population' => $_POST['Population'], 
											   'Postal_Code' => $_POST['Postal_Code'], 
											   'CountryID' => $countryID));
				$_SESSION['added'] = true;
				common::redirect("index.php?module=city&action=list&countryID={$countryID}&search={$search}&order={$order}&from={$from}&to={$to}&page={$pageId}");
				die();
			} else{
				$errors['invalidData'] = true;
			}
		}
		return $errors;
	}
	
	public function editAction($error, $module, $action, $pageId, $search, $order, $from, $to, $countryID, $id){
		$errors = array();
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
				$this->model->updateCity(array('Name' => $_POST['Name'], 
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
			$data = $this->model->getCity($id);
		}
		
		return include 'views/city_form.tpl.php';
	}
	
	public function deleteAction($error, $module, $action, $pageId, $search, $order, $from, $to, $countryID, $id){
		if(!empty($id)) {
			$this->model->deleteCity($id);
			$_SESSION['deleted'] = true;
		}
		common::redirect("index.php?module={$module}&action=list&countryID={$countryID}&search={$search}&order={$order}&from={$from}&to={$to}&page={$pageId}");
		die();
	}
}

?>