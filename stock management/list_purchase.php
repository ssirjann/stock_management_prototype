<?php 
	require_once('includes/initialize.php');
	require_login(basename(__FILE__));
	$purchases = Purchase::find_all();

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Purchases</title>
	<?php require_once('includes/head.php') ?>
    <link rel="stylesheet" type="text/css" href="css/style.css">

 	<style type="text/css">

    	.list_purchase {
    		text-align: center;
    		font-size: 15px;
    		background-color: #222
    	}

    	.list_purchase:after {
    		content: '';
    		color: red;
    	}
	</style>
 </head>



 <body  class="bg-danger">	
	<?php require_once('includes/header.php') ?>
	 <?php
            $file = basename(__FILE__);
            $file=str_replace(".php", "", $file);
            $file=str_replace("_", " ", $file);
            echo ucwords($file); 
        ?>
        </div>
        <!-- Page Content -->
        <div id="page-content-wrapper">
 	<div class="container-fluid">
 	<?php echo output_message($type, $message) ?>

 		<div class="row">
 			<div class="" >
 			<?php 

 			// dump($purchases);
 					while($purchase=$database->fetch_assoc($purchases)) {
 						$purchase = new Purchase($purchase['order_id']);

 			 ?>
 				<div class="purchase panel panel-primary">
 					<div class="panel-heading">
 						<h4>Purchase no <?php echo htmlspecialchars($purchase->get_order_id()) ?></h4>
 					</div>

 					<div class="panel-group">

	 					<div class="panel-body">
	 						
						<div class="purchase_detail pull-right">
		 					<span class="purchase_id ">Purchase id: <?php echo htmlspecialchars($purchase->get_order_id()) ?></span><br>
		 					<span class="supplier ">Supplier: 
		 					<?php 
		 						$sid=$purchase->get_supplier_id();
		 						$sid=new Supplier($sid); 
		 						echo htmlspecialchars($sid->get_company_name()) 
		 					?>
		 					</span><br>
						</div> 					
	 					<div class="dates">
							<span class="">Purchase Date: <?php echo htmlspecialchars($purchase->get_purchase_date()) ?></span><br>
							<span class="dd">Delivery Date: <?php echo htmlspecialchars($purchase->get_delivery_date()) ?></span><br>
	 					</div>

	 					<div data-toggle="collapse" data-parent="#accordion" class="view" href="#<?php echo htmlspecialchars($purchase->get_order_id()) ?>">
							<a>View guitars in this purchase<span class="caret"></span></a>
						</div>

	 					<div id="<?php echo htmlspecialchars($purchase->get_order_id()) ?>" class="panel-collapse collapse out">
		 					<table class="table">
		 						
		 					<tr>
		 						<th>Guitar</th>
		 						<th>Colour</th>
		 						<th>Make Date</th>
		 						<th>Quantity</th>
		 					</tr>
		 					<?php 
		 						$guitar_purchases = GuitarPurchase::find_by_order_id($purchase->get_order_id());
		 						while ($guitar_purchase = $database->fetch_assoc($guitar_purchases)) {
		 							$guitar = new Guitar($guitar_purchase['guitar_id']);
		 							$guitar_purchase = new GuitarPurchase($guitar_purchase['order_id'], $guitar_purchase['guitar_id'], $guitar_purchase['colour']);

		 					 ?>
		 					<tr>
		 						<td><?php echo htmlspecialchars($guitar->get_brand())." ". $guitar->get_model() ?></td>
		 						<td><?php echo htmlspecialchars($guitar_purchase->get_colour()) ?></td>
		 						<td><?php echo htmlspecialchars($guitar_purchase->get_make()) ?></td>
		 						<td><?php echo htmlspecialchars($guitar_purchase->get_quantity()) ?></td>
		 					</tr>
		 					<?php } ?>
	 					</table>
	 					</div>


 					</div>
	 			</div>
 			
	 			</div>
	 			<?php } ?>

 			</div></div></div></div></div>
 		
 		</div>	
	</div>




 </body>

			<script type="text/javascript">
				
			</script>


 </html>