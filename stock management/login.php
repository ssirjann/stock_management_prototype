<?php 

	require_once('includes/initialize.php');
	
	if(!isset($_POST['submit']) && $session->is_logged_in()) header("Location: list_guitar.php");
	
	$type = isset($type) ? $type : '';
	
	$destination = isset($_GET['destination']) ? $_GET['destination'] : 'list_guitar.php';
	
	if (isset($_POST['submit'])) {
	
		$username = trim($_POST['username']);
		$password = $_POST['password'];
	
		if(!isset($username) || !isset($password) || empty($password) || empty($username)){
			$message ="Username and password cannot be empty";
			$type = 'warning';
		} else {
			$user = User::authenticate($username, $password);		//returns user object
			if($user) {
				$session->login($user);
				$session->message('success','Logged in -'. ucfirst($user->get_forename()).', the '. $user->get_role());

				header("Location: " . $destination);
			} else {
				$message ='Username/Password incorrect';
				$type = 'warning';
			}
		}
	




	}


 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<?php require_once('includes/head.php') ?>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body class="bg-danger">
	<?php require_once("includes/header.php"); ?>
        <?php
            $file = basename(__FILE__);
            $file=str_replace(".php", "", $file);
            $file=str_replace("_", " ", $file);
            echo ucwords($file); 
        ?>
        </div>
        
	<div class="container-fluid">
        <?php echo output_message($type, $message); ?>
		<form class="form-horizontal" role="form" method="post">
			<label class="control-label col-sm-2">Username</label>
			<input type="text" class="input-control col-sm-10" name="username" value="">
			
			<label class="control-label col-sm-2">Password:</label>
			<input type="password" class="input-control col-sm-10" name="password" value="">

	 		<input type="submit" class="btn btn-primary submit" value="submit" name="submit">

		</form>		
	</div>
</body>
</html>