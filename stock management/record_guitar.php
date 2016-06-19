<?php 

	require_once('includes/initialize.php');
	require_owner_login(basename(__FILE__));
	$rule = isset($rule) ? $rule : null;
	// echo basename(__FILE__);
	$new_id = Guitar::max_id();
	empty($new_id) ? $new_id = 1 : $new_id++; 

	$max_file_size = 1048576;

	if(isset($_POST['submit'])) {

		$guitar_id = $new_id;
		$model = !empty($_POST['model']) ? $_POST['model'] : null;
		$brand = !empty($_POST['brand']) ? $_POST['brand'] : null;
		$marked_price = !empty($_POST['marked_price']) ? $_POST['marked_price'] : null;
		$image = !empty($_FILES['guitar_image']) ? $_FILES['guitar_image'] : null;

		if($model!=null && $brand!=null && $marked_price!=null && $image!=null) {

			$target = (__DIR__) . '../' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'guitar' . $guitar_id;
		
			$guitar= new Guitar();
			$guitar->set_guitar_id((int) $guitar_id);
			if (strpos($image['type'], 'image') !== false) {
				if($image['size']<$max_file_size) {
					$upload = $guitar->save_photo($image, $target);
				} else {
					$upload = false;
					$message = "File too large";
					$type = "warning";
				}
			} else {
				$message = "Wrong file type, please use an image file";
				$type = "warning";
			}
			$guitar->set_model($model);
			$guitar->set_brand($brand);
			$guitar->set_marked_price((int) $marked_price);
			if($upload) {
				if($guitar->add()) {
					$message = "Successfully added guitar info";
					$type = "success";
				} else {
					$message = "Internal error occurred";
					$type = "warning";
				}
		
			}
		} else {
				$message = "Fill out all the fields";

				$type = "warning";

		}
	}

 ?>
 <!DOCTYPE html>
 <html>
 <head>
 	<title>Record guitar</title>
	<?php require_once('includes/head.php') ?>
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<style type="text/css">
		.form-control {
			width: 70%;
		}

    	.record_guitar {
    		text-align: center;
    		font-size: 15px;
    		background-color: #222
    	}

    	.record_guitar:after {
    		content: '';
    		color: red;
    	}




 	</style>
 </head>
 <body class="bg-danger">
 	<?php require_once ('includes/header.php') ?>
        <?php
            $file = basename(__FILE__);
            $file=str_replace(".php", "", $file);
            $file=str_replace("_", " ", $file);
            echo ucwords($file); 
        ?>
        </div>
        
 <div class="container-fluid">
 	<?php echo output_message($type, $message) ?>
 	<form method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
 	<div class="form-group">
 		
 		<label class="col-sm-2 control-label">Guitar id</label>
 		<input class="form-control col-sm-12" type="number" name="guitar_id" value="<?php echo Guitar::max_id()+1 ?>"disabled>
 	</div>
<div class="form-group">
	
 		<label class="col-sm-2 control-label">Image (<=1MB) </label>
 		<input type="hidden" name="guitar_image" value="<?php echo $max_file_size ?>">
 		<input class="col-sm-10" type="file" name="guitar_image">
</div>

<div class="form-group">
	
 		<label class="col-sm-2 control-label">Brand</label>
 		<input class="form-control col-sm-10" type="text" name="brand" value="">
</div>

<div class="form-group">
 		<label class="col-sm-2 control-label">Model</label>
 		<input class="form-control col-sm-10" type="text" name="model" value="">
</div>
	
<div class="form-group">
	
 		<label class="col-sm-2 control-label">Marked price</label>
 		<input class="form-control col-sm-10" type="number" name="marked_price" value="">

</div>
 		<input type="submit" value="submit" class="btn btn-primary submit" name="submit">

 	</form>
 </div>
 </body>
 </html> 