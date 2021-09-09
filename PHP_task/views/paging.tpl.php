<div class="pt-3">
	<nav aria-label="pagination">
	  <?php $prev = $pageId - 1; $next = $pageId + 1; ?>
	  <ul class="pagination justify-content-center">
		  <li class='page-item <?php if($pageId == 1) echo " disabled" ?>'>
		    <a class='page-link' href='<?php echo "index.php?module={$module}&action=list&countryID={$countryID}&search={$search}&order={$order}&from={$from}&to={$to}&page=" . $prev; ?>'>Praeitas</a>
	      </li>
			<?php echo $paging->get_pagination_links($paging->totalPages, $pageId, $paging->data, "index.php?module={$module}&action=list&countryID={$countryID}&search={$search}&order={$order}&from={$from}&to={$to}"); ?>
		  <li class='page-item <?php if($paging->totalPages == 1 || $pageId == $paging->totalPages) echo " disabled" ?>'>
		    <a class='page-link' href='<?php echo "index.php?module={$module}&action=list&countryID={$countryID}&search={$search}&order={$order}&from={$from}&to={$to}&page=" . $next; ?>'>Sekantis</a>
		  </li>
	  </ul>
	</nav>
</div>
</div>
<div class="container-sm pt-5" style="max-width: 600px;">
	<h3><center>Filtravimo kriterijai</center></h3>
	<form method="post" class="pt-4">
	  <div class="form-group col-lg-12">
		<label for="DateFrom">Pasirinkite data nuo:</label>
		<input type="date" class="form-control" name="DateFrom" value="<?php echo $from != '' ? $from : ''; ?>">
	  </div>
	  <div class="form-group col-lg-12">
		<label for="DateTo">Pasirinkite data iki:</label>
		<input type="date" class="form-control" name="DateTo" value="<?php echo $to != '' ? $to : ''; ?>">
	  </div>
	  <div class="form-group col-lg-12">
		<button type="submit" name="filter" class="btn btn-warning btn-block" value="filter"><i class="bi bi-filter"></i> Filtruoti</button>
	  </div>
	</form>
</div>