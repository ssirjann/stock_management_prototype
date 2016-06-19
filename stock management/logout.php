<?php 
	require_once('includes/initialize.php');
	if(!$session->is_logged_in()) {
		$session->message("info", 'Not logged in');
		header("Location: login.php");
	}
	else {
		$session->logout();
		if(!$session->is_logged_in()) {
			$session->message("success", 'Successfully Logged out');
		} else {
			$session->message("danger", 'Logging out failed');
		}
		header("Location: login.php");
	}

 ?>