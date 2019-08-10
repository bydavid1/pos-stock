<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

  $returnDate = date('Y-m-d', strtotime($_POST['returnDate']));	
  $description = $_POST['description'];
  $grandTotal = $_POST['grandTotalValue'];
  $grandQuantity = $_POST['grandQuantityValue'];
  $costumer = $_POST['costumer'];
  $nit = $_POST['nit'];
  $paymentStatus = $_POST['paymentStatus'];
  $count = $_POST['trCount'];


  $sql = "INSERT INTO returns (description, costumer, nit, date, quantity, rate, return_status, available) VALUES ('$description', '$costumer', '$nit', '$returnDate','$grandQuantity','$grandTotal', '$paymentStatus', 1);";
  
  $res = $connect->query($sql);

  if($res > 0){
      $insert = true;
      $return_id = $connect->insert_id;
  }else{
      $insert = false;
  }
  
  $number = (int) $count;

  for($x = 0; $x < $number; $x++) {
    
    $query = "INSERT INTO `return_item` (`return_item_id`, `return_id`, `product_code`, `product_name`, `quantity`, `rate`, `total`, `available`) VALUES (NULL,".$return_id.",'".$_POST['productCode'][$x]."','".$_POST['productNameValue'][$x]."','".$_POST['quantity'][$x]."','".$_POST['rate'][$x]."','".$_POST['totalValue'][$x]."', 1);";
    $result = $connect->query($query);

    $data = "SELECT quantity, product_id FROM product WHERE cod_product = '".$_POST['productCode'][$x]."'";
		$updateProductQuantityData = $connect->query($data);
     $producQuantityData = $updateProductQuantityData->fetch_array();
      $updateQuantity = $producQuantityData['quantity'] + $_POST['quantity'][$x];
    
    $update = "UPDATE `product` SET `quantity` = $updateQuantity WHERE `cod_product` = '".$_POST['productCode'][$x]."'";
    $quantityUpdated = $connect->query($update);

    $kardex = "INSERT INTO kardex (concept, date, quantity, balance, product_id) VALUES ('Devolucion', '$returnDate', ".$producQuantityData['quantity'].", '+". $_POST['quantity'][$x]."', ".$producQuantityData['product_id'].")";
    $fact = $connect->query($kardex);

  }


  if($insert == TRUE && $result > 0){
    $valid['success'] = true;
    $valid['messages'] = 'Se agrego exitosamente';
  }else{
    $valid['success'] = false;
    $valid['messages'] = 'Ocurrio un error';
  }

  $connect->close();

	echo json_encode($valid);