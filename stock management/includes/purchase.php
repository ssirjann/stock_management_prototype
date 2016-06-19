<?php 

	require_once('database_object.php');
	
	class Purchase extends DatabaseObject {
		protected $order_id;
		protected $supplier_id;
		protected $purchase_date;
		protected $delivery_date;

		protected static $table_name = "purchase";
		protected static $table_fields = array('order_id', 'supplier_id', 'purchase_date', 'delivery_date');
		protected static $pk = "order_id";

		protected $primary_key = "order_id";

		function __construct($order_id=0) {
			$this->order_id = $order_id;
			if(!$this->check_existing_entry()) {
				unset($this->order_id);
			}
		}

		public function get_order_id() {
			return $this->order_id;
		}

		public function get_supplier_id() {
			return $this->supplier_id;
		}

		public function get_purchase_date() {
			return $this->purchase_date;
		}

		public function get_delivery_date() {
			return $this->delivery_date;
		}

		public function set_order_id($order_id) {
			is_int($order_id) ? $this->order_id = $order_id : null;
		}

		public function set_supplier_id($supplier_id) {
			is_int($supplier_id) ? $this->supplier_id = $supplier_id : null;
		}

		public function set_purchase_date($purchase_date) {
			is_string($purchase_date) ? $this->purchase_date = $purchase_date : null;
		}

		public function set_delivery_date($delivery_date) {
			is_string($delivery_date) ? $this->delivery_date = $delivery_date : null;
		}

	}

 ?>