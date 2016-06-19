<?php 

	require_once('database_object.php');

	class Guitar extends DatabaseObject {

		protected $guitar_id;
		protected $image_location;
		protected $model;
		protected $brand;
		protected $marked_price;
		  protected $upload_errors = array(
		// http://www.php.net/manual/en/features.file-upload.errors.php
		UPLOAD_ERR_OK 				=> "No errors.",
		UPLOAD_ERR_INI_SIZE  	=> "Larger than upload_max_filesize.",
	  UPLOAD_ERR_FORM_SIZE 	=> "Larger than form MAX_FILE_SIZE.",
	  UPLOAD_ERR_PARTIAL 		=> "Partial upload.",
	  UPLOAD_ERR_NO_FILE 		=> "No file.",
	  UPLOAD_ERR_NO_TMP_DIR => "No temporary directory.",
	  UPLOAD_ERR_CANT_WRITE => "Can't write to disk.",
	  UPLOAD_ERR_EXTENSION 	=> "File upload stopped by extension."
	);

		protected static $table_name = "guitar";
		protected static $table_fields = array('guitar_id', 'model', 'brand', 'image_location', 'marked_price');
		protected static $pk = 'guitar_id';

		protected $primary_key = 'guitar_id';


		function __construct($guitar_id=0) {
			$this->guitar_id = $guitar_id;
			if(!$this->check_existing_entry()) {
				$this->guitar_id = null;
			}
		}

		public function get_guitar_id() {
			return $this->guitar_id;
		}

		public function get_model() {
			return $this->model;
		}

		public function get_brand() {
			return $this->brand;
		}

		public function get_marked_price() {
			return $this->marked_price;
		}

		public function get_image_location() {
			return $this->image_location;
		}

		public function set_guitar_id($guitar_id) {
			is_int($guitar_id) ? $this->guitar_id = $guitar_id : null;
		}

		public function set_marked_price($marked_price) {
			is_int($marked_price) ? $this->marked_price = $marked_price : null;
		}

		public function set_model($model) {
			is_string($model) ? $this->model = $model : null;
		}

		public function set_brand($brand) {
			is_string($brand) ? $this->brand = $brand : null;
		}

		public function set_image_location($image_location) {
			is_string($image_location) ? $this->image_location = $image_location : null;
		}

		public function save_photo($file) {
			$target = (__DIR__) . DIRECTORY_SEPARATOR . '../'. DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'guitar' . $this->guitar_id;
			if(move_uploaded_file($file['tmp_name'], $target)) {
				$this->image_location = 'images' . DIRECTORY_SEPARATOR . 'guitar' .$this->guitar_id;
				return true;
			} else {
				$this->image_location = '';
				$_SESSION['message'];
				return false;
			}
		}

	}

 ?>