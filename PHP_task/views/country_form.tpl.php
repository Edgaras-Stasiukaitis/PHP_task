<div class="container-sm pt-5" style="max-width: 650px;">
	<div class="form-group col-lg-12">
		<div class="alert alert-primary" role="alert">
		  <h5 class="alert-heading">Redaguojama šalis: <?php echo $this->model->getCountry($id)['Name']; ?></h5>
		</div>
	</div>
	<form method="post" class="pt-4">
	  <div class="form-group col-lg-12">
		<label for="Name">Šalies pavadinimas</label>
		<input type="text" class="form-control <?php echo ($errors['invalidName'] ? 'is-invalid' : '' ); ?>" name="Name" value="<?php echo isset($data['Name']) ? $data['Name'] : ''; ?>" placeholder="Įveskite šalies pavadinimą">
	  </div>
	  <div class="form-group col-lg-12">
		<label for="Area">Šalies plotas</label>
		<input type="number" class="form-control <?php echo ($errors['invalidArea'] ? 'is-invalid' : '' ); ?>" name="Area" value="<?php echo isset($data['Area']) ? $data['Area'] : ''; ?>" placeholder="Įveskite šalies plotą">
	  </div>
	  <div class="form-group col-lg-12">
		<label for="Population">Šalies gyventojų skaičius</label>
		<input type="number" class="form-control <?php echo ($errors['invalidPopulation'] ? 'is-invalid' : '' ); ?>" name="Population" value="<?php echo isset($data['Population']) ? $data['Population'] : ''; ?>" placeholder="Įveskite šalies gyventojų skaičių">
	  </div>
	  <div class="form-group col-lg-12">
		<label for="Phone_Code">Šalies telefono kodas</label>
		<input type="text" class="form-control <?php echo ($errors['invalidPhone_Code'] ? 'is-invalid' : '' ); ?>" name="Phone_Code" value="<?php echo isset($data['Phone_Code']) ? $data['Phone_Code'] : ''; ?>" placeholder="Įveskite šalies telefono kodą">
	  </div>
	  <div class="form-group col-lg-12">
	    <button type="submit" name="submit" class="btn btn-success" value="submit">Įrašyti</button>
		<a class="btn btn-info" href='<?php echo "index.php?module=country&action=list&search={$search}&order={$order}&from={$from}&to={$to}&page={$pageId}"; ?>' role="button">Grįžti</a>
	  </div>
	</form>
	<?php
	if(!empty($errors['invalidData'])){
		echo "<div class='alert alert-danger' role='alert'>
				<center>Užpildykite paryškintus laukelius!</center>
			  </div";
	}
	?>
</div>