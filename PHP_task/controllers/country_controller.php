<?php

class country_controller{
	
	private $model;

	public function __construct($model) {
		$this->model = $model;
	}
	
	public function listAction($error, $module, $action, $pageId, $search, $order, $from, $to, $countryID, $id){
		$elementCount = $this->model->getCountryListCount($search, $from, $to);

		include 'utils/paging.class.php';
		$paging = new paging(config::NUMBER_OF_ROWS_IN_PAGE);

		$paging->process($elementCount, $pageId);

		$data = $this->model->getCountryList($paging->size, $paging->first, $search, $order, $from, $to);

		if(isset($_POST['search'])){
			common::redirect("index.php?module={$module}&action=list&search={$_POST['search']}&order={$order}&from={$from}&to={$to}&page=1");
			die();
		}

		if(isset($_POST['filter'])){
			common::redirect("index.php?module={$module}&action=list&search={$search}&order={$order}&from={$_POST['DateFrom']}&to={$_POST['DateTo']}&page=1");
			die();
		}

		return include 'views/country_list.tpl.php';
	}
	
	public function createAction($module, $action, $pageId, $search, $order, $from, $to){
		$errors = array();
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
				$this->model->insertCountry(array('Name' => $_POST['Name'], 
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
			if($_POST['Phone_Code'] == '')
				$errors['invalidPhone_Code'] = true;
			if(empty($errors)){
				$this->model->updateCountry(array('Name' => $_POST['Name'], 
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
			$data = $this->model->getCountry($id);
		}
		
		return include 'views/country_form.tpl.php';
	}
	
	public function deleteAction($error, $module, $action, $pageId, $search, $order, $from, $to, $countryID, $id){
		if(!empty($id)) {
			$this->model->deleteCities("({$id})");
			$this->model->deleteCountry($id);
			$_SESSION['deleted'] = true;
		}
		common::redirect("index.php?module={$module}&action=list&search={$search}&order={$order}&from={$from}&to={$to}&page={$pageId}");
		die();
	}
}

?>