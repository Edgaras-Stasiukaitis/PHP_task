<div class="container-sm pt-5" style="max-width: 650px;">
	<div class="form-group col-lg-12">
		<div class="alert alert-primary" role="alert">
		  <h5 class="alert-heading">Redaguojamas miestas: <?php echo $citiesObj->getCity($id)['Name']; ?></h5>
		</div>
	</div>
	<form method="post" class="pt-4">
	  <div class="form-group col-lg-12">
		<label for="exampleInputEmail1">Miesto pavadinimas</label>
		<input type="text" class="form-control <?php echo ($errors['invalidName'] ? 'is-invalid' : '' ); ?>"" name="Name" value="<?php echo isset($data['Name']) ? $data['Name'] : ''; ?>" placeholder="Įveskite miesto pavadinimą">
	  </div>
	  <div class="form-group col-lg-12">
		<label for="exampleInputEmail1">Miesto plotas</label>
		<input type="number" class="form-control <?php echo ($errors['invalidArea'] ? 'is-invalid' : '' ); ?>"" name="Area" value="<?php echo isset($data['Area']) ? $data['Area'] : ''; ?>" placeholder="Įveskite miesto plotą">
	  </div>
	  <div class="form-group col-lg-12">
		<label for="exampleInputEmail1">Miesto gyventojų skaičius</label>
		<input type="number" class="form-control <?php echo ($errors['invalidPopulation'] ? 'is-invalid' : '' ); ?>" name="Population" value="<?php echo isset($data['Population']) ? $data['Population'] : ''; ?>" placeholder="Įveskite miesto gyventojų skaičių">
	  </div>
	  <div class="form-group col-lg-12">
		<label for="exampleInputEmail1">Miesto pašto kodas</label>
		<input type="text" class="form-control <?php echo ($errors['invalidPostal_Code'] ? 'is-invalid' : '' ); ?>" name="Postal_Code" value="<?php echo isset($data['Postal_Code']) ? $data['Postal_Code'] : ''; ?>" placeholder="Įveskite miesto pašto kodą">
	  </div>
	  <div class="form-group col-lg-12">
	    <button type="submit" name="submit" class="btn btn-success" value="submit">Įrašyti</button>
		<a class="btn btn-info" href='<?php echo "index.php?module=city&action=list&countryID={$countryID}&search={$search}&order={$order}&from={$from}&to={$to}&page={$pageId}"; ?>' role="button">Grįžti</a>
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