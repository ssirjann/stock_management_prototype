<?php 

	require_once('database_object.php');

	class Stock extends DatabaseObject {

		protected $guitar_id;
		protected $quantity;
		protected $colour;


		protected static $table_name = "stock";
		protected static $table_fields = array('guitar_id', 'colour','quantity');
		protected static $pk = 'guitar_id';

		protected $primary_key = array('guitar_id'=>null, 'colour'=>null);


		function __construct($guitar_id=0, $colour='') {
			$this->guitar_id = $guitar_id;
			$this->colour = $colour;
			$this->primary_key['guitar_id'] = $guitar_id;
			$this->primary_key['colour'] = $colour;
			if(!$this->check_existing_entry()) {
				$this->quantity = 0;
				$this->add();
			}
		}

		public function get_guitar_id() {
			return isset($this->guitar_id) ? $this->guitar_id : false;
		}

		public function get_quantity() {
			return isset($this->quantity) ? $this->quantity : false;
		}

		public function get_colour() {
			return isset($this->colour) ? $this->colour : false;
		}

		public function set_guitar_id($guitar_id) {
			is_int($guitar_id) ? $this->guitar_id = $guitar_id : null;
		}

		public function set_quantity($quantity) {
			is_int($quantity) ? $this->quantity = $quantity : null;
		}

		public function set_colour($colour) {
			is_string($colour) ? $this->colour = $colour : null;
		}

		public function add_quantity($quantity) {
			$this->quantity += $quantity;
			$this->update();
		}

		public function deduct_quantity($quantity) {
			$this->quantity -= $quantity;
			$this->update();
		}

		public static function find_by_guitar_id($guitar_id) {
			global $database;
			$query = "SELECT * FROM " . self::$table_name;
			$query .= " WHERE guitar_id = " . $guitar_id;
			return $database->query($query);
		}

	}

 ?>