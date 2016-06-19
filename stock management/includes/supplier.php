<?php 

	require_once('database_object.php');

	class Supplier extends DatabaseObject{
		protected $supplier_id; 
		protected $company_name; 
		protected $country; 
		protected $email; 
		protected $phone; 

		protected static $table_name = "supplier";
		protected static $table_fields = array('supplier_id', 'company_name', 'country', 'email', 'phone');
		protected static $pk = "supplier_id";

		protected $primary_key = "supplier_id";

		function __construct($supplier_id) {
			$this->supplier_id = $supplier_id;
			if(!$this->check_existing_entry()) {
				unset($this->supplier_id);
			}
		}

		public function get_supplier_id() {
			return $this->supplier_id; 
		}

		public function get_company_name() {
			return $this->company_name; 
		}

		public function get_country() {
			return $this->country; 
		}

		public function get_phone() {
			return $this->phone; 
		}

		public function get_email() {
			return $this->email; 
		}

		public function set_supplier_id($supplier_id) {
			is_int($supplier_id) ? $this->supplier_id  = $supplier_id : null;
		}
		
		public function set_name($name) {
			is_string($name) ? $this->name  = $name : null;
		}

		public function set_country($country) {
			is_string($country) ? $this->country  = $country : null;
		}

		public function set_phone($phone) {
			is_int($phone) ? $this->phone  = $phone : null;
		}

		public function set_email($email) {
			is_string($email) ? $this->email  = $email : null;
		}




	}

 ?>