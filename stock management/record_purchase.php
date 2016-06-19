<?php 
	
	require_once('includes/initialize.php');
	require_owner_login(basename(__FILE__));
	$new_id = Purchase::max_id();
	empty($new_id) ? $new_id = 1 : $new_id++; 
	if(isset($_POST['submit'])) {



		$order_id = $new_id;
		$supplier_id = !empty($_POST['supplier_id']) ? trim($_POST['supplier_id']) : null;
		$purchase_date = !empty($_POST['purchase_date']) ? trim($_POST['purchase_date']) : null;
		$delivery_date = !empty($_POST['delivery_date']) ? trim($_POST['delivery_date']) : null;

		//for purchase table
		if(is_date($purchase_date) && is_date($delivery_date) && $supplier_id>0 && $supplier_id<Supplier::max_id()) {

		

			$purchase = new Purchase();
			$purchase->set_order_id((int) $new_id);
			$purchase->set_supplier_id((int) $supplier_id);
			$purchase->set_purchase_date($purchase_date);
			$purchase->set_delivery_date($delivery_date);
			$guitar_purchases = array(); //for guitar objects;
			$stocks = array();
			for ($i=0; $i < $_POST['no_of_guitars']; $i++) { 
				$guitar_id = !empty($_POST['guitar_id'.$i]) ? trim($_POST['guitar_id'.$i]) : null;
				$make = !empty($_POST['make_date'.$i]) ? trim($_POST['make_date'.$i]) : null;
				$colour = !empty($_POST['colour'.$i]) ? trim($_POST['colour'.$i]) : null;
				$quantity = !empty($_POST['quantity'.$i]) ? trim($_POST['quantity'.$i]) : null;
				
				if($guitar_id!=null && $make!=null && $colour!=null && $quantity!=null) {

					$guitar_purchase = new GuitarPurchase;
					$guitar_purchase->set_order_id((int) $new_id);
					$guitar_purchase->set_guitar_id((int) $guitar_id);
					$guitar_purchase->set_make($make);
					$guitar_purchase->set_colour($colour);
					$guitar_purchase->set_quantity((int) $quantity);

					$guitar_purchases[$i] = $guitar_purchase;
					$stock = new Stock($guitar_id, $colour);
					$stocks[$i] = $stock;
				} else {
					$message = "Form field/s left blank.";
					$type = 'warning';
					$guitar_purchases = false;
					break;
					// header("Location: ".basename(__FILE__));
				}
			}
			if($guitar_purchases) {
				$add = $purchase->add();
				for ($i=0; $i<count($stocks); $i++) {
					$add *= $guitar_purchases[$i]->add();

					if($stocks[$i]->get_guitar_id()) { 
						$add *= $stocks[$i]->add_quantity($quantity);
					}
					else {
						$stocks[$i]->set_guitar_id((int) $guitar_id);
						$stocks[$i]->set_colour($colour);
						$stocks[$i]->set_quantity((int) $quantity);

						$add *= $stocks[$i]->add();
					}
				}
					$message = "Successfully recorded";
					$type = 'success';
			}

		} else {
			$message = "Error! Please check the dates.";
			$type = 'warning';
		}

	}

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Record purchase</title>
	<?php require_once('includes/head.php') ?>
    <link rel="stylesheet" type="text/css" href="css/style.css">
 	
 	<style type="text/css">

		
		.form-control {
			width: 70%;
		}

	 	.record_purchase {
    		text-align: center;
    		font-size: 15px;
    		background-color: #222
    	}

    	.record_purchase:after {
    		content: '';
    		color: red;
    	}


 	</style>


 </head>
 <body class="bg-danger">
<?php require_once('includes/header.php') ?>
        <?php
            $file = basename(__FILE__);
            $file=str_replace(".php", "", $file);
            $file=str_replace("_", " ", $file);
            echo ucwords($file); 
        ?>
        </div>
        

<div class="container-fluid">
        <?php  echo output_message($type, $message) ?>
 	<form method="post" class="form-horizontal" role="form">
 		<label class="col-sm-2 control-label">Order id</label>
 		<input class="form-control col-sm-10" type="number" name="order_id" value="<?php echo Purchase::max_id()+1 ?>" disabled>
 		<br>

 		<label class="col-sm-2 control-label">Supplier</label>
		
				<select name="supplier_id" class="form-control">
					<?php $output="";
		 				$suppliers=Supplier::find_all();
		 				while ($supplier = $database->fetch_assoc($suppliers)) {
		 					$supplier = new supplier($supplier['supplier_id']);
		 					$output .= '<option value="'. $supplier->get_supplier_id() .'">';
		 					$output .= $supplier->get_supplier_id().": ".$supplier->get_company_name(); 
		 					$output .= '</option>'; 
		 				}
		 				echo $output; 
	 				?>
	 			</script>
		 		</select>
 	

 		<label class="col-sm-2 control-label">Purchase Date</label>
 		<input class="form-control" type="date" name="purchase_date" value="" placeholder="YYYY/MM/DD">

 		<label class="col-sm-2 control-label">Delivery Date</label>
 		<input class="form-control" type="date" name="delivery_date" value="" placeholder="YYYY/MM/DD">

 		<input class="form-control" type="hidden" name="no_of_guitars" value="1">
 		<h4 class="purchase_guitar">The guitars obtained from this purchase</h4>

 		<div id="guitars" class="row">
 		

	 	
	 		<div id="guitar0" class="col-sm-6 guitar_detail">
		 		<label class="control-label">Guitar</label>

		 		<select name="guitar_id0" class="form-control">
					<?php 
		 				require('get_guitars.php');

					?>		 			
		 		</select>

		 		<label class="control-label">Make date</label>
		 		<input class="form-control" type="date" name="make_date0" value="" placeholder="YYYY/MM/DD">

		 		<label class="control-label">Colour</label>
		 		<input class="form-control" type="text" name="colour0" value="">

		 		<label class="control-label">Quantity</label>
		 		<input class="form-control" type="number" name="quantity0" value="">

		 		<input class="form-control" type=hidden name=no_of_guitars value=1>
	 		</div>
 
 		</div>

 		
 		<span class = "glyphicon glyphicon-plus btn btn-default" id="add_guitar" style="float:right; margin: -40px 50px"> <br> <br> </span>
 		<span class = "glyphicon glyphicon-minus btn btn-danger" id="remove_guitar" style="float:right; margin: -40px 0px"> <br> <br> </span>
<br>
 		<input type="submit" class="btn btn-primary submit" value="submit" name="submit">

 	</form></div></div></div>

<script type="text/javascript">
	$output = "<?php require('get_guitars.php') ?>"
</script>
<script type="text/javascript" src="js/record_purchase.js"></script>
</div>
 </body>
 </html>