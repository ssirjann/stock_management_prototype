<?php 

	require_once('includes/initialize.php');
	require_owner_login(basename(__FILE__));

	if(isset($_POST['submit'])) {
		$username = !empty(trim($_POST['username'])) ? $_POST['username'] : null;
		$forename = !empty(trim($_POST['forename'])) ? $_POST['forename'] : null;
		$surname = !empty(trim($_POST['surname'])) ? $_POST['surname'] : null;
		$role = !empty(trim($_POST['role'])) ? $_POST['role'] : null;
		$password = !empty(trim($_POST['password'])) ? $_POST['password'] : null;
		$c_password = !empty(trim($_POST['c_password'])) ? $_POST['c_password'] : null;
		if($username!=null&&$forename!=null&&$surname!=null&&$role!=null&&$password!=null&&$c_password!=null){
			
			if(!User::existing_username($username)) {

				if($password === $c_password) {
					$user = new User();
					$user->set_username($username);
					$user->set_password($password);
					$user->set_forename($forename);
					$user->set_surname($surname);
					$user->set_role($role);

					if($user->add()) {
						$type = "success";
						$message = "Successfully registered user ". $user->get_forename();
					} else {
						$type = "warning";
						$message = "Error occured, please try later";
					}
				}else {
					$type = "warning";
					$message = "The passwords do no match";
				}
			} else {
				$type = "warning";
				$message = "The username is already registered";
			}


		}
		else {
			$type = "warning";
			$message = "Please input all the fields";
		}
	}





 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<?php require_once('includes/head.php') ?>
    <link rel="stylesheet" type="text/css" href="css/style.css">
 	<style type="text/css">

    	.register {
    		text-align: center;
    		font-size: 15px;
    		background-color: #222
    	}

    	.register:after {
    		content: '';
    		color: red;
    	}


	

</style>
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
			<label class="control-label col-sm-3">Username</label>
			<input type="text" class="input-control col-sm-9" name="username" value="<?php echo isset($username) ? $username : '' ?>">
			
			<label class="control-label col-sm-3">First name:</label>
			<input type="text" class="input-control col-sm-9" name="forename" value="<?php echo isset($forename) ? $forename : '' ?>">

			<label class="control-label col-sm-3">Last name:</label>
			<input type="text" class="input-control col-sm-9" name="surname" value="<?php echo isset($surname) ? $surname : '' ?>">

			<label class="control-label col-sm-3">Role:</label>
			<input type="text" class="input-control col-sm-9" name="role" value="<?php echo isset($role) ? $role : '' ?>">

			<label class="control-label col-sm-3">Password:</label>
			<input type="password" class="input-control col-sm-9" name="password" value="">

			<label class="control-label col-sm-3">Confirm password:</label>
			<input type="password" class="input-control col-sm-9" name="c_password" value="">


	 		<input type="submit" class="btn btn-primary submit" value="submit" name="submit">

		</form>		
	</div>
</body>
</html>