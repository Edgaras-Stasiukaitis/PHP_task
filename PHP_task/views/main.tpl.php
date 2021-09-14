<!DOCTYPE html>
<?php
	if(isset($_POST['upload']))
		include 'utils/upload_file.php';
?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>Šalys ir miestai</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
		<script type="text/javascript" src="scripts/dialog.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <a class="navbar-brand" href="index.php?module=country&action=list">Šalys ir miestai</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>
		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto"></ul>
			<form class="form-inline my-2 my-lg-0" method="post" enctype="multipart/form-data">
			  <div class="mr-4">
			    <input type="file" name="file"/>
				<input class="btn btn-info my-2 my-sm-0" type="submit" name="upload" value="Importuoti"/>
			  </div>
			</form>
			<form class="form-inline my-2 my-lg-0" method="post">
			  <input class="form-control mr-sm-2" type="text" name="search" placeholder="Paieška" value="<?php echo $search != '' ? $search : ''; ?>" aria-label="search">
			  <button class="btn btn-primary my-2 my-sm-0" type="submit" value="submit"><span class="bi-search"></span> Ieškoti</button>
			</form>
		  </div>
		</nav>
		<?php
			file_exists($actionFile) ? include $actionFile : include 'controllers/country_controller.php';
			$controller = new $controllerName($model);
			$controller->$action(isset($error) ? $error : null, $module, $action, $pageId, $search, $order, $from, $to, $countryID, $id);		
		?>
	</body>
</html>