<?php
	class countries {
		
		private $countries_table = '';
		private $cities_table = '';
		
		public function __construct() {
			$this->countries_table = config::COUNTRIES_TABLE;
			$this->cities_table = config::CITIES_TABLE;
		}
		
		public function getCountry($id){
			$query = "  SELECT *
						FROM {$this->countries_table}
						WHERE `ID`='{$id}'";
			$data = mysql::select($query);
			if($data != null)
				return $data[0];
			else
				return -1;
		}
		
		public function getCountryList($limit = null, $offset = null, $search = null, $order = null, $from = null, $to = null) {
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
			$whereString = "";
			if($search != null){
				$whereString = " WHERE `Name` LIKE '%{$search}%'";
				if($from != null && $to != null)
					$whereString .= " AND Date >= '{$from}' AND Date <= '{$to}'";
				else if($from != null)
					$whereString .= " AND Date >= '{$from}'";
				else if($to != null)
					$whereString .= " AND Date <= '{$to}'";
				else
					$whereString .= "";
			} else if($from != null && $to != null)
				$whereString .= " WHERE Date >= '{$from}' AND Date <= '{$to}'";
			else if($from != null)
				$whereString .= " WHERE Date >= '{$from}'";
			else if($to != null)
				$whereString .= " WHERE Date <= '{$to}'";
			else
				$whereString = "";
			$query = "  SELECT *
						FROM {$this->countries_table}{$whereString}{$orderString}{$limitOffsetString}";
			$data = mysql::select($query);
			return $data;
		}
		
		public function getCountryListCount($search = null, $from = null, $to = null) {
			$whereString = "";
			if($search != null){
				$whereString = " WHERE `Name` LIKE '%{$search}%'";
				if($from != null && $to != null)
					$whereString .= " AND Date >= '{$from}' AND Date <= '{$to}'";
				else if($from != null)
					$whereString .= " AND Date >= '{$from}'";
				else if($to != null)
					$whereString .= " AND Date <= '{$to}'";
				else
					$whereString .= "";
			} else if($from != null && $to != null)
				$whereString .= " WHERE Date >= '{$from}' AND Date <= '{$to}'";
			else if($from != null)
				$whereString .= " WHERE Date >= '{$from}'";
			else if($to != null)
				$whereString .= " WHERE Date <= '{$to}'";
			else
				$whereString = "";
			$query = "  SELECT Name, Date, COUNT(`ID`) as `amount`
						FROM {$this->countries_table}{$whereString}";
			$data = mysql::select($query);
			return $data[0]['amount'];
		}
		
		public function insertCountry($data) {
			$query = "  INSERT INTO {$this->countries_table}
						(
							`Name`,
							`Area`,
							`Population`,
							`Phone_Code`
						)
						VALUES
						(
							'{$data['Name']}',
							'{$data['Area']}',
							'{$data['Population']}',
							'{$data['Phone_Code']}'
						)";
			mysql::query($query);
		}
		
		public function updateCountry($data) {
			$query = "  UPDATE {$this->countries_table}
						SET   `Name`='{$data['Name']}',
							  `Area`='{$data['Area']}',
							  `Population`='{$data['Population']}',
							  `Phone_Code`='{$data['Phone_Code']}'
						WHERE `ID`='{$data['ID']}'";
			mysql::query($query);
		}
		
		public function deleteCountry($id) {
			$query = "  DELETE FROM {$this->countries_table}
						WHERE `ID`={$id}";
			mysql::query($query);
		}
		
		public function deleteCities($id) {
			$query = "  DELETE FROM {$this->cities_table}
						WHERE `CountryID` IN {$id}";
			mysql::query($query);
		}
	}
?>