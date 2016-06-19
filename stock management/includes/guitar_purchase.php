<?php 

	require_once('database_object.php');

	class GuitarPurchase extends DatabaseObject {
	
		protected $order_id;
		protected $guitar_id;
		protected $colour;
		protected $quantity;
		protected $make;

		protected static $table_name = "guitar_purchase";
		protected static $table_fields = array('order_id', 'guitar_id', 'quantity', 'make', 'colour');

		protected $primary_key = array('order_id'=>null, 'guitar_id'=>null, 'colour' =>null); 

		function __construct($order_id=0, $guitar_id=0, $colour='') {
			$this->order_id = $order_id;
			$this->guitar_id = $guitar_id;
			$this->colour = $colour;
			$this->primary_key['order_id'] = $this->order_id;
			$this->primary_key['guitar_id'] = $this->guitar_id;
			$this->primary_key['colour'] = $this->colour;
			if(!$this->check_existing_entry()) {
				unset($this->order_id);
				unset($this->guitar_id);
				unset($this->colour);
				$this->primary_key['order_id'] = null;
				$this->primary_key['guitar_id'] = null;
				$this->primary_key['colour'] = null;
			}
		}

		public function get_order_id() {
			return $this->order_id;
		}

		public function get_colour() {
			return $this->colour;
		}

		public function get_guitar_id() {
			return $this->guitar_id;
		}

		public function get_quantity() {
			return $this->quantity;
		}

		public function get_make() {
			return $this->make;
		}

		public function set_order_id($order_id) {
			is_int($order_id) ? $this->order_id = $order_id : null;
		}

		public function set_guitar_id($guitar_id) {
			is_int($guitar_id) ? $this->guitar_id = $guitar_id : null;
		}

		public function set_quantity($quantity) {
			is_int($quantity) ? $this->quantity = $quantity : null;
		}

		public function set_make($make) {
			is_string($make) ? $this->make = $make : null;
		}

		public function set_colour($colour) {
			is_string($colour) ? $this->colour = $colour : null;
		}

		public static function find_by_order_id($order_id=0) {
			global $database;

			$query = "SELECT * FROM " . self::$table_name;
			$query .= " WHERE order_id=" . $order_id;

			return $database->query($query);
		}

	}


 ?>