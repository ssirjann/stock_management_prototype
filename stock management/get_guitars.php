<?php 
		 				$output="";
		 				$guitars=Guitar::find_all();
		 				while ($guitar = $database->fetch_assoc($guitars)) {
		 					$guitar = new Guitar($guitar['guitar_id']);
		 					$output .= '<option value='. $guitar->get_guitar_id() .'>';
		 					$output .= $guitar->get_guitar_id().": ".$guitar->get_brand() . " " . $guitar->get_model(); 
		 					$output .= '</option>'; 
		 				}
		 				echo ($output);
?>