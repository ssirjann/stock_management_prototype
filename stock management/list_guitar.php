<?php 



	require_once('includes/initialize.php');
	require_login(basename(__FILE__));
	$guitars = Guitar::find_all();
	


 ?>

<!DOCTYPE html>
 <html lang="en">
 <head>
 	<title>Guitars</title>
	<?php require_once('includes/head.php') ?>
    <link rel="stylesheet" type="text/css" href="css/style.css">
 	<style type="text/css">


		.col-sm-3 img {
			height: 100%;
			width: 100%;
		}

		.panel-heading h4 {
			width: 30%;
			margin-left: auto;
			margin-right: auto;
		}
    	.list_guitar {
    		text-align: center;
    		font-size: 15px;
    		background-color: #222
    	}

    	.list_guitar:after {
    		content: '';
    		color: red;
    	}



 	</style>

</head>

<body class=bg-danger>
<?php require_once('includes/header.php') ?>
        <!-- Page Content -->
        <?php
            $file = basename(__FILE__);
            $file=str_replace(".php", "", $file);
            $file=str_replace("_", " ", $file);
            echo ucwords($file); 
        ?>
        </div>
        
        <div id="page-content-wrapper">
	<div class="container-fluid">
	<?php echo output_message($type, $message); ?>
		<div class="">
			<?php 
 					while($guitar=$database->fetch_assoc($guitars)) {
	 					$guitar = new Guitar($guitar['guitar_id']);
			 ?>
			<div class="panel panel-primary">
 					<div class="panel-heading">
 						<h4>Guitar no <?php echo htmlspecialchars($guitar->get_guitar_id()); ?></h4>
 					</div>

 					<div class="panel-group">

	 					<div class="panel-body row">
	 						<div class="col-sm-3">
	 							<img src="<?php echo htmlspecialchars($guitar->get_image_location());?>" class="img-thumbnail img-circle">
	 						</div>
	 						<div class="col-sm-9">
	 							
								<div class="pull-right">
				 					<span>Guitar id: <?php echo htmlspecialchars($guitar->get_guitar_id()); ?></span><br>
				 					<span>Marked Price: <?php echo htmlspecialchars($guitar->get_marked_price()); ?></span><br>
								</div> 					
			 					<div class="dates">
									<span class="">Brand: <?php echo htmlspecialchars($guitar->get_brand()); ?></span><br>
									<span class="dd">Model: <?php echo htmlspecialchars($guitar->get_Model()); ?></span><br>
			 					</div>

			 					<div data-toggle="collapse" data-parent="#accordion" class="view" href="#<?php echo htmlspecialchars($guitar->get_guitar_id()); ?>">
									<a>View stock of this guitar<span class="caret"></span></a>
								</div>

			 					<div id="<?php echo htmlspecialchars($guitar->get_guitar_id()); ?>" class="panel-collapse collapse out">
				 					<table class="table">
				 					<tr>
				 						<th>Colour</th>
				 						<th>Quantity</th>
				 					</tr>
				 					<?php 
				 						$stocks = Stock::find_by_guitar_id($guitar->get_guitar_id());
				 						while($stock = $database->fetch_assoc($stocks)){				 							
					 						$stock = new Stock($guitar->get_guitar_id(), $stock['colour']);
				 					 ?>
				 					<tr>
				 						<td><?php echo htmlspecialchars($stock->get_colour()); ?></td>
				 						<td><?php echo htmlspecialchars($stock->get_quantity()); ?></td>
				 					</tr>
				 					<?php } ?>
				 					</table>
			 					</div>
	 						</div>
					</div>
					</div>

				</div>
				 					<?php } ?>
		</div></div></div></div>


	</div>


</script>

</body>
</html>