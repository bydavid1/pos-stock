<?php 	

require_once 'core.php';
$session_id= session_id();

$valid['success'] = array('success' => false, 'messages' => array());

  $orderDate = date('Y-m-d', strtotime($_POST['orderDate']));	
  $clientName = $_POST['clientName'];
  $subTotalValue = $_POST['subTotal'];
  $iva = $_POST['iva'];
  $total = $_POST['total'];
  $paymentStatus = $_POST['paymentStatus'];

				
	$sql = "INSERT INTO orders (order_date, client_name, sub_total, discount, total, paymentStatus, order_status) VALUES ('$orderDate', '$clientName',  '$subTotalValue', '$iva', '$total', '$paymentStatus', '1');";
	$res = $connect->query($sql);
	$order_id;
	if($res > 0) {
		$order_id = $connect->insert_id;
		$insertOrder = true;
	}else{
		$insertOrder = false;
	}


	$data = "SELECT tmp.`quantity_tmp`, tmp.`product_id`,tmp.`rate_tmp`,tmp.`total_tmp`,product.`product_name` FROM tmp INNER JOIN product ON tmp.`product_id` = product.`product_id` WHERE tmp.session_id = '".$session_id."'";
   
	$result = $connect->query($data);
	while($products = $result->fetch_array()){

		$updateProductQuantitySql = "SELECT product.quantity FROM product WHERE product.product_id = ".$products['product_id']."";
		$updateProductQuantityData = $connect->query($updateProductQuantitySql);
        $producQuantityData = $updateProductQuantityData->fetch_array();
			$updateQuantity = $producQuantityData['quantity'] - $products['quantity_tmp'];							
				// update product table
				$updateProductTable = "UPDATE product SET quantity = '$updateQuantity' WHERE product_id = ".$products['product_id']."";

				if($connect->query($updateProductTable) === TRUE){
					$updateStock = true;
				}else{
					$updateStock = false;
				}

				// add into order_item
				$orderItemSql = "INSERT INTO order_item (order_id, product_id, quantity, rate, total, order_item_status) 
				VALUES (".$order_id." , ".$products['product_id'].", ".$products['quantity_tmp'].", ".$products['rate_tmp'].", ".$products['total_tmp'].", 1)";

				 
				if($connect->query($orderItemSql) === TRUE){
					$insertOrderItem = true;
				}else{
					$insertOrderItem = false;
				}			
				
				$kardex = "INSERT INTO kardex (concept, date, quantity, balance, product_id) VALUES ('Ingreso a factura', '$orderDate', ".$producQuantityData['quantity'].", '-".$products['quantity_tmp']."', ".$products['product_id'].")";
				$fact = $connect->query($kardex);
	}
	 if($insertOrder == true && $updateStock == true && $insertOrderItem == true){
		$valid['success'] = true;
		$valid['messages'] = "Se agrego con exito";	
	}else{
		$valid['success'] = false;
		$valid['messages'] = "Ocurrio un problema";
	}
		
	
	$connect->close();

	echo json_encode($valid);

?>


 
