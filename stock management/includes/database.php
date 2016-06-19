<?php 
	
	require_once('config.php');

	class MySQLDatabase {

		private $connection;
		public $last_query;

		function __construct() {
			$this->open_connection();
		}

		private function open_connection() {
			$this->connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
			if(!$this->connection) {
				die("Database connection failed." . mysqli_error($this->connection));
			}
		}

		public function query($sql) {
			$this->last_query = $sql;
			$result_set = mysqli_query($this->connection, $sql);
			$this->confirm_query($result_set);
			return $result_set;
		}

		public function escape_value($sql) {
			return mysqli_real_escape_string($this->connection, $sql);
		}

		public function affected_rows() {
			return mysqli_affected_rows($this->connection);
		}

		public function num_rows($result_set) {
			return mysqli_num_rows($this->connection);
		}

		public function fetch_assoc($result_set) {
			return mysqli_fetch_assoc($result_set);
		}


		public function insert_id() {
		  // get the last id inserted over the current db connection
		  return mysqli_insert_id($this->connection);
		}
		  

		private function confirm_query($result_set) {
			if(!$result_set) {
				// print_r($this->last_query);
				// die(mysqli_error($this->connection));
			}
		}

		public function close_connection() {
			if($this->connection) {
				mysqli_close($this->connection);
				unset($this->connection);
			}
		}

		function __destruct() {
			$this->close_connection();
		}
	}

	$database = new MySQLDatabase();
?>
