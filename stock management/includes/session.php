<?php
// A class to help work with Sessions
// In our case, primarily to manage logging users in and out

// Keep in mind when working with sessions that it is generally 
// inadvisable to store DB-related objects in sessions

class Session {
	
	private $logged_in=false;
	public $user_id;
  public $message;
	public $type;
	public $role;
	
	function __construct() {
		session_start();
    $this->check_login();
		$this->check_message();
	}
	
  public function is_logged_in() {
    return $this->logged_in;
  }

	public function login($user) {
    // database should find user based on username/password
    if($user){
      $this->user_id = $_SESSION['user_id'] = $user->get_user_id();
      $this->logged_in = true;
      $this->role = $_SESSION['role'] = $user->get_role();
    }
  }
  
  public function logout() {
    unset($_SESSION['user_id']);
    unset($this->user_id);
    unset($this->role);
    $this->logged_in = false;
  }

	public function message($type='', $msg="") {
	  if(!empty($msg)) {
	    // then this is "set message"
	    // make sure you understand why $this->message=$msg wouldn't work
      $_SESSION['message'] = $msg;
	    $_SESSION['type'] = $type;
		}
	}

	public function get_message() {
    return $this->message;
  }

	private function check_login() {
    if(isset($_SESSION['user_id'])) {
      $this->user_id = $_SESSION['user_id'];
      $this->logged_in = true;
      $this->role = $_SESSION['role'];
    } else {
      unset($this->user_id);
      $this->logged_in = false;
      unset($this->role);
    }
  }

  private function check_message() {
    if(isset($_SESSION['message'])) {
      // Add it as an attribute and erase the stored version
      $this->message = $_SESSION['message'];
      $this->type = isset($_SESSION['type']) ? $_SESSION['type'] : 'info';
      unset($_SESSION['message']);
      unset($_SESSION['type']);
    } else {
      $this->message = "";
      $this->type = "";
    }
  }
  
	
}

$session = new Session();
$message=$session->get_message();
$type = $session->type;

?>