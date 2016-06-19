<?php 
	
	require_once('database_object.php');

	class User extends DatabaseObject {

		protected $user_id;
		protected $username;
		protected $forename;
		protected $surname;
		protected $password;
		protected $role;

		protected static $table_name = "user";
		protected static $table_fields = array("user_id", "password", "forename", "surname", "username", "role");
		protected static $pk = "user_id";
		
		protected $primary_key = "user_id";

		function __construct($user_id=0) {
			$this->user_id = $user_id;
			if(!$this->check_existing_entry()) {
				// $primary_key = $this->primary_key;
				// $this->$primary_key = null;
			}
		}

		public function get_username() {
			return $this->username;			
		}

		public function get_user_id() {
			return $this->user_id;			
		}

		public function get_forename() {
			return $this->forename;			
		}

		public function get_surname() {
			return $this->surname;			
		}

		public function get_password() {
			return $this->password;
		}

		public function get_role() {
			return $this->role;
		}


		public function set_username($username) {
			is_string($username)? $this->username = $username : null;
		}

		public function set_user_id($user_id) {
			is_int($user_id)? $this->user_id = $user_id : null;
		}

		public function set_forename($forename) {
			is_string($forename)? $this->forename = $forename : null;
		}

		public function set_surname($surname) {
			is_string($surname)? $this->surname = $surname : null;
		}

		public function set_email($email) {
			is_string($email)? $this->email = $email : null;
		}
	
		public function set_role($role) {
			is_string($role)? $this->role = $role : null;
		}

		public function set_password($password) {
			is_string($password)? $this->password = $password : null;
		}

		// public function full_name() {
		// 	return $this->first_name . " " . $this->last_name;
		// }


		public function get_full_name () {
			return $this->forename . ' ' .$this->surname;
		}

		public static function existing_username ($username) {
			global $database;
			$username = $database->escape_value($username);
			$username = "'{$username}'";
			$query = "SELECT * FROM ". self::$table_name;
			$query .= " WHERE username=" . $username;
			$query .= " LIMIT 1";
			$users = $database->query($query);
			if($user=$database->fetch_assoc($users)) {
				return true;
			} else {
				return false;
			}
		}

		public static function authenticate($username="", $password="") {
			//returns user object or false;


			global $database;

			$username = $database->escape_value($username);
			$password = $database->escape_value($password);

			$query = "SELECT * FROM " . self::$table_name;
			$query .= " WHERE username= '{$username}'";
			$query .= " AND password='$password'";

			$result_set=$database->query($query);
			if($result = $database->fetch_assoc($result_set)) {
				return new User($result['user_id']);				
			} else {
				return false;
			}
		}
	


	}


	// $u = new User();
	// $u->find_by_primary_key();
	// $u->set_user_id(1);
	// $u->delete();
	// var_dump($u);
	// $u->set_forename("Sirjan");
	// $u->update();
	// $u = new User(23);
	// var_dump($u);
	// $u->set_surname("Gharma");
	// $u->set_email("sharsir.ss@gmail.com");
	// $u->set_password(password_hash("9843645623sirjankophone,sirjanissohandsomeilovehimsomuch@2212/.,./", PASSWORD_DEFAULT));

	// var_dump($u);
	// $u->update();
	// var_dump($u);
	// $u->add();
	// var_dump($u);
	// $a = password_hash("9843645623sirjankophone,sirjanissohandsomeilovehimsomuch@2212/.,./", PASSWORD_BCRYPT);
	// $u->
	// $a = $u->password;

	// echo password_verify("9843645623sirjankophone,sirjanissohandsomeilovehimsomuch@2212/.,.", $a)? 'true' : 'false';
	// $user = User::login('ssirjann', '9843645623sirjankophone,sirjanissohandsomeilovehimsomuch@2212/.,./');
	// if($user) {
	// 	echo "<br>" . "yo dwag, you successfully logged in ";
	// 	var_dump($user);
	// } else {
	// 	echo "<br>" . "Get lost shit head, you don't belong here";
	// }

	// echo "<br>" . password_verify("9843645623sirjankophone,sirjanissohandsomeilovehimsomuch@2212/.,./", '$2y$10$nKeo5X8rBLGGwHlENs2u1uA36yW8zQWNV7QaFWagCEXPaEeXc/NSm');

	// echo "<br>" . "<br>";
	// $u = new User(2);
	// var_dump($u);

 ?>
