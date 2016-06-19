<?php 
	
	require_once('includes/initialize.php');

	if(isset($_POST['val']) && !empty($_POST['val']) && $_POST['val']!='0') {$supplier = $_POST['val'];}
	else {die;}
	$supplier = $database->escape_value($supplier);
	$query = "SELECT * FROM ";
	$query .= "supplier WHERE company_name LIKE '%" . $supplier . "%'"; 

	$suppliers=$database->query($query);
	$names = array();
	while ($supplier = $database->fetch_assoc($suppliers)) {
			$names[$supplier['supplier_id']] = $supplier['company_name'];
	}

	 echo json_encode($names);

 ?>