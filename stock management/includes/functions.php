<?php 
	require_once('session.php');
	
	function is_date($date_str) {
		if(substr_count($date_str, '/') != 2) {
			return false;
		} else {
			$date = explode('/', $date_str);
			$year = $date[0];
			$month = $date[1];
			$day = $date[2];
			if(checkdate($month, $day, $year)) {
				return true;
			} else {
				return false;
			}
		}
	}

	function require_login($destination='') {
		global $session;

		if(!$session->is_logged_in()) {
			$session->message("warning", "You must login to view that page");
			$destination = !empty($destination) ? '?destination=' . $destination : '';
			header("Location: login.php".($destination));
			
		}
	}

	function require_owner_login($destination='') {
		global $session;
		if(!$session->is_logged_in()) {
			require_login($destination);
		} else {
			if(strcasecmp($session->role, 'owner') != 0) {
				$session->message("warning", "Owner login required to access page $destination");
				header("Location: list_guitar.php");
			}
		} 
	}

	function output_message($type='', $message="") {
	  if (!empty($message)) { 
	    return "<p class=\"alert-{$type} alert alert-dismissable message\"> <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\"> &times; </button>{$message}</p>";
	  } else {
	    return "";
	  }
	}


 ?>