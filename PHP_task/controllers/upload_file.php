<?php
	function checkAndInsert($module, $CountriesObj, $CitiesObj, $line, $countryID = null){
		$name = iconv(mb_detect_encoding($line[0], mb_detect_order(), true), "UTF-8", $line[0]);;
		$area = $line[1];
		$error = '';
		if(!is_numeric($area))
			$error = "Faile yra įrašas(-ų) su neteisingai nurodyta ploto reikšme!";
		$population = $line[2];
		if(!is_numeric($population))
			$error = "Faile yra įrašas(-ų) su neteisingai nurodytu gyventojų skaičiumi!";
		$code = $line[3];
		if(empty($error)){
			if($module == "country")
				$CountriesObj->insertCountry(array('Name' => $name, 'Area' => $area, 'Population' => $population, 'Phone_Code' => $code));
			else
				$CitiesObj->insertCity(array('Name' => $name, 'Area' => $area, 'Population' => $population, 'Postal_Code' => $code, 'CountryID' => $countryID));
		}
		return $error;
	}
	
	function detectDelimiter($csvFile)
	{
		$delimiters = [";" => 0, "," => 0, "\t" => 0, "|" => 0];
		$handle = fopen($csvFile, "r");
		$firstLine = fgets($handle);
		fclose($handle); 
		foreach ($delimiters as $delimiter => &$count)
			$count = count(str_getcsv($firstLine, $delimiter));
    return array_search(max($delimiters), $delimiters);
}
	
	if ($_FILES['file']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['file']['tmp_name'])) {
		$file_loc = $_FILES['file']['tmp_name'];
		$file_type = $_FILES['file']['type'];
		$count = 0;
		if($file_type == "application/vnd.ms-excel"){
			$delimiter = detectDelimiter($file_loc);
			$file_csv = fopen($file_loc, "r");			
			while (($line = fgetcsv($file_csv, 1000, $delimiter)) !== FALSE) {
				$error = checkAndInsert($module, $CountriesObj, $CitiesObj, $line, $countryID);
				$count++;
			}
			fclose($file_csv);
			$_SESSION['imported'] = array('status' => true, 'value' => $count);
		}
		else if($file_type == "text/plain"){
			$file_txt = fopen($file_loc, "r");
			while(!feof($file_txt)) {
				$error = checkAndInsert($module, $CountriesObj, $CitiesObj, explode(";", fgets($file_txt)), $countryID);
				$count++;
			}
			fclose($file_txt);
			$_SESSION['imported'] = array('status' => true, 'value' => $count);
		} else{
			$error = "Pasirinktas netinkamas failo formatas! (Tinkami .csv, .txt failų tipai)";
		}
	}
?>