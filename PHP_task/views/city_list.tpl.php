<?php 
	$controller = new city_controller($this->model);
	$errors = $controller->createAction($module, $action, $pageId, $search, $order, $from, $to, $countryID);
?>
<div class="d-flex justify-content-between mt-3">
	<a class="btn btn-secondary ml-3" style="width:150px;" href="index.php?module=country&action=list" role="button">Atgal į šalis</a>
	<a class="btn btn-warning mr-3" style="width:150px;" href="index.php?module=city&action=list&countryID=<?php echo $countryID; ?>" role="button">Išvalyti filtrus</a>
</div>
<div class="container pt-2">
	<h1><center><?php echo $this->model->getCountryName($countryID) ?></center></h1>
	<form method="post">
		<div class="form-row pt-5">
		  <div class="form-group col-md-3">
			<input type="text" class="form-control <?php echo ($errors['invalidName'] ? 'is-invalid' : '' ); ?>" name="Name" placeholder="Pavadinimas" value="<?php echo isset($_POST['Name']) ? $_POST['Name'] : '' ?>">
		  </div>
		  <div class="form-group col-md-3">
			<input type="number" class="form-control <?php echo ($errors['invalidArea'] ? 'is-invalid' : '' ); ?>" name="Area" placeholder="Plotas" value="<?php echo isset($_POST['Area']) ? $_POST['Area'] : '' ?>">
		  </div>
		  <div class="form-group col-md-3">
			<input type="number" class="form-control <?php echo ($errors['invalidPopulation'] ? 'is-invalid' : '' ); ?>" name="Population" placeholder="Gyventojų skaičius" value="<?php echo isset($_POST['Population']) ? $_POST['Population'] : '' ?>">
		  </div>
		  <div class="form-group col-md-2">
			<input type="text" class="form-control <?php echo ($errors['invalidPostal_Code'] ? 'is-invalid' : '' ); ?>" name="Postal_Code" placeholder="Pašto kodas" value="<?php echo isset($_POST['Postal_Code']) ? $_POST['Postal_Code'] : '' ?>">
		  </div>
		  <div class="form-group col-md-1">
			<button type="submit" name="submit" value="submit" class="btn btn-success float-right">Pridėti</button>
		  </div>
		</div>
	</form>
	<?php
	if(!empty($error)){
		echo "<div class='alert alert-danger' role='alert'>
				<center>{$error}</center>
			  </div>";
	}
	if(isset($_SESSION['imported']) && $_SESSION['imported']['status']){
		$_SESSION['imported']['status'] = false;
		echo "<div class='alert alert-success' role='alert'>
				<center><b>{$_SESSION['imported']['value']}</b> miestai(-ų) sėkmingai importuoti(-a) iš failo!</center>
			  </div>";
	}
	if(isset($_SESSION['deleted']) && $_SESSION['deleted']){
		$_SESSION['deleted'] = false;
		echo "<div class='alert alert-success' role='alert'>
				<center>Miestas sėkmingai pašalintas!</center>
			  </div>";
	}
	if(!empty($errors['invalidData'])){
		echo "<div class='alert alert-danger' role='alert'>
				<center>Užpildykite paryškintus laukelius!</center>
			  </div>";
	}
	if($data == null){
		echo "<div class='alert alert-warning' role='alert'>
				<center>Miestų pagal pasirinktą šalį/filtrą nėra!</center>
			  </div>";
			  die();
	}
	if(isset($_SESSION['added']) && $_SESSION['added']){
		$_SESSION['added'] = false;
		echo "<div class='alert alert-success' role='alert'>
				<center>Miestas sėkmingai pridėtas!</center>
			  </div>";
	}
	if(isset($_SESSION['edited']) && $_SESSION['edited']){
		$_SESSION['edited'] = false;
		echo "<div class='alert alert-success' role='alert'>
				<center>Miestas sėkmingai atnaujintas!</center>
			  </div>";
	}
	?>
	<div class="row pt-2">
		<div class="alert alert-info" style="line-height:5px;" role="alert">
			<b><?php echo "Atvaizduojama ".count($data)." iš {$paging->totalRecords} miestų ({$pageId} iš {$paging->totalPages} puslapių)"; ?></b>
		</div>
		<table class="table table-hover">
		  <thead>
			<tr>
				<th>ID</th>
				<th><a href='index.php?module=city&action=list&countryID=<?php echo $countryID; ?>&search=<?php echo $search; ?>&order=<?php if($order == '') echo "asc"; else if($order == 'asc') echo "desc"; else echo "asc"; echo "&from={$from}&to={$to}&page={$pageId}"; ?>'>Pavadinimas</a></th>
				<th>Plotas, km²</th>
				<th>Gyventojų skaičius</th>
				<th>Pašto kodas</th>
				<th>Pridėjimo data</th>
				<th>Parinktys</th>
			</tr>
		  </thead>
		  <tbody>
			<?php
			if($data != null){
				foreach($data as $key => $val) {
				echo
					"<tr>"
						."<th scope='row'>{$val['ID']}</th>"
						."<td>{$val['Name']}</td>"
						."<td>".number_format($val['Area'])."</td>"
						."<td>".number_format($val['Population'])."</td>"
						."<td>{$val['Postal_Code']}</td>"
						."<td>{$val['Date']}</td>"
						."<td>"
							."<a href='#' onclick='showConfirmDialog(\"city\", \"{$val['ID']}\", \"{$search}\", \"{$order}\", \"{$from}\", \"{$to}\", \"{$pageId}\", \"{$paging->totalPages}\", \"{$paging->totalRecords}\", \"{$countryID}\"); return false;' style='color: red;'><i class='btn btn-outline-danger btn-sm bi bi-trash'></i></a>&nbsp;"
							."<a href='index.php?module=city&action=edit&countryID={$countryID}&id={$val['ID']}&search={$search}&order={$order}&from={$from}&to={$to}&page={$pageId}' style='color: orange;'><i class='btn btn-sm btn-outline-warning bi bi-pencil-square'></a>"
						."</td>"
					."</tr>";
				}
			}
			?>
		  </tbody>
		</table>
	</div>

<?php include 'views/paging.tpl.php'; ?>