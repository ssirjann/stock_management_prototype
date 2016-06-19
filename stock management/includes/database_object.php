<?php
	require_once('database.php');

	class DatabaseObject {

		public function add() {
			global $database;
			$values = array();
			$query = "INSERT INTO " . static::$table_name;

			foreach (static::$table_fields as $value) {
				$values[$value] = is_string($this->$value) ?
					"'".$database->escape_value($this->$value)."'" : $this->$value;
			}
			$query .= " (" . join(", ", array_keys($values)) . ") ";
			$query .= " VALUES (" . join(", ", array_values($values)) . ") ";
			////echo $query;
			if($database->query($query)) {
				return true;
			} else {
				return false;
			}	
		}

		public function update() {
			global $database;
			$values = array();

			$query = "UPDATE ".static::$table_name;
			$query .= " SET ";
			foreach (static::$table_fields as $attribute) {
				$value = $this->$attribute;
				$value = is_string($value) ? $database->escape_value($value) : $value;
				$value = is_string($value) ? "'".$value."'" : $value;
				$values[] = " $attribute".'='.$value;
			}
			$query .= join(", ", array_values($values));
			$query .=" WHERE " . $this->crud_condition();
			////echo $query;
			if($database->query($query)) {
				if(is_array($this->primary_key)) {
					$pk = $this->primary_key;
					foreach ($pk as $key => $value) {
						$this->primary_key[$key] = $this->$key;
					}
				}
				return true;
			} else {
				return false;
			}			
		}

		public function delete() {
			global $database;
		}

		public function crud_condition() {
			$pk = $this->primary_key;
			if(!is_array($pk)) {
				$query = $pk .'='. $this->$pk;
			} else {
				$condition = array();
				foreach ($pk as $key => $value) {
					$value = is_string($value) ? "'$value'" : $value;
					$condition[] .=$key .'='. $value;
				}
				$query = join (" AND ", array_values($condition));
			}
			return $query;
		}

		public function max_id() {
			global $database;
			$query = "SELECT max(".static::$pk.") FROM " . static::$table_name;
			//echo $query;
			$result_set = $database->query($query);
			$result = mysqli_fetch_assoc($result_set);
			return $result['max('.static::$pk.')']; 
		}

		private function find_by_primary_key() {
			global $database;
			$pk = $this->primary_key;

			$query = "SELECT * FROM ".static::$table_name;
			$query .= " WHERE ".$this->crud_condition();
			
			// echo $query;
			return $database->query($query);
		}

		protected function check_existing_entry() {
			$pk = $this->primary_key;
			$result_set = $this->find_by_primary_key(); 
			if($result = mysqli_fetch_assoc($result_set)) {
				foreach ($result as $attribute => $value) {
					if(property_exists(get_called_class(), $attribute)) {
						$this->$attribute = $value;
					}
				}
				return true;
			} else {
				return false;
			}
		}

		public static function find_all() {
			global $database;
			$query = "SELECT * FROM " . static::$table_name;
			return $database->query($query);
		}


	}
?>