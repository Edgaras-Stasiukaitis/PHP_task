<?php
	class cities {
		
		private $cities_table = '';
		private $countries_table = '';
		
		public function __construct() {
			$this->cities_table = config::CITIES_TABLE;
			$this->countries_table = config::COUNTRIES_TABLE;
		}
		
		public function getCity($id){
			$query = "  SELECT *
						FROM {$this->cities_table}
						WHERE `ID`='{$id}'";
			$data = mysql::select($query);
			if($data != null)
				return $data[0];
			else
				return -1;
		}
		
		public function getCityList($limit = null, $offset = null, $order = null) {
			$limitOffsetString = "";
			if(isset($limit)) {
				$limitOffsetString .= " LIMIT {$limit}";
				if(isset($offset)) {
					$limitOffsetString .= " OFFSET {$offset}";
				}	
			}
			$orderString = "";
			if($order != null)
				$orderString = " ORDER BY Name {$order}";
			$query = "  SELECT *
						FROM {$this->cities_table}{$orderString}{$limitOffsetString}";
			$data = mysql::select($query);
			return $data;
		}
		
		public function getCityListCount($id, $search = null, $from = null, $to = null) {
			$whereString = "";
			if($search != null){
				$whereString = " AND Name LIKE '%{$search}%'";
				if($from != null && $to != null)
					$whereString .= " AND Date >= '{$from}' AND Date <= '{$to}'";
				else if($from != null)
					$whereString .= " AND Date >= '{$from}'";
				else if($to != null)
					$whereString .= " AND Date <= '{$to}'";
				else
					$whereString .= "";
			} else if($from != null && $to != null)
				$whereString .= " AND Date >= '{$from}' AND Date <= '{$to}'";
			else if($from != null)
				$whereString .= " AND Date >= '{$from}'";
			else if($to != null)
				$whereString .= " AND Date <= '{$to}'";
			else
				$whereString = "";
			$query = "  SELECT COUNT(`ID`) as `amount`
						FROM {$this->cities_table}
						WHERE CountryID = {$id}{$whereString}";
			$data = mysql::select($query);
			return $data[0]['amount'];
		}
		
		public function insertCity($data) {
			$query = "  INSERT INTO {$this->cities_table}
						(
							`Name`,
							`Area`,
							`Population`,
							`Postal_Code`,
							`CountryID`
						)
						VALUES
						(
							'{$data['Name']}',
							'{$data['Area']}',
							'{$data['Population']}',
							'{$data['Postal_Code']}',
							'{$data['CountryID']}'
						)";
			mysql::query($query);
		}
		
		public function updateCity($data) {
			$query = "  UPDATE {$this->cities_table}
						SET   `Name`='{$data['Name']}',
							  `Area`='{$data['Area']}',
							  `Population`='{$data['Population']}',
							  `Postal_Code`='{$data['Postal_Code']}',
							  `CountryID`='{$data['CountryID']}'
						WHERE `ID`='{$data['ID']}'";
			mysql::query($query);
		}
		
		public function deleteCity($id) {
			$query = "  DELETE FROM {$this->cities_table}
						WHERE `ID`='{$id}'";
			mysql::query($query);
		}
		
		public function getCountryName($id) {
			$query = "  SELECT Name
						FROM {$this->countries_table}
						WHERE `ID`='{$id}'";
			$data = mysql::select($query);
			if($data != null)
				return $data[0]['Name'];
			else
				return -1;
		}
		
		public function getCityListByFK($id, $limit = null, $offset = null, $search = null, $order = null, $from = null, $to = null) {
			$limitOffsetString = "";
			if(isset($limit)) {
				$limitOffsetString .= " LIMIT {$limit}";
				if(isset($offset)) {
					$limitOffsetString .= " OFFSET {$offset}";
				}	
			}
			$orderString = "";
			if($order != null)
				$orderString = " ORDER BY ct.Name {$order}";
			$whereString = "";
			if($search != null){
				$whereString = " AND ct.Name LIKE '%{$search}%'";
				if($from != null && $to != null)
					$whereString .= " AND ct.Date >= '{$from}' AND ct.Date <= '{$to}'";
				else if($from != null)
					$whereString .= " AND ct.Date >= '{$from}'";
				else if($to != null)
					$whereString .= " AND ct.Date <= '{$to}'";
				else
					$whereString .= "";
			} else if($from != null && $to != null)
				$whereString .= " AND ct.Date >= '{$from}' AND ct.Date <= '{$to}'";
			else if($from != null)
				$whereString .= " AND ct.Date >= '{$from}'";
			else if($to != null)
				$whereString .= " AND ct.Date <= '{$to}'";
			else
				$whereString = "";
			$query = "	SELECT ct.ID, ct.Name, ct.Area, ct.Population, ct.Postal_Code, ct.Date
						FROM {$this->countries_table} c
						INNER JOIN {$this->cities_table} ct ON c.ID = ct.CountryID
						WHERE c.ID = {$id}{$whereString}{$orderString}{$limitOffsetString}";
			$data = mysql::select($query);
			return $data;
		}
	}
?>