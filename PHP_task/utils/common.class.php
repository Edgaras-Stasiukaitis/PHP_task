<?php

class common {

	public static function redirect($url) {
		echo "<script type='text/javascript'>document.location.href='" . $url . "';</script>";
		echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $url . '">';
	}
}

?>