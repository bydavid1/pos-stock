<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

  $quotationDate = date('Y-m-d', strtotime($_POST['quotationDate']));	
  $description = $_POST['description'];
  $grandTotal = $_POST['grandTotalValue'];
  $grandQuantity = $_POST['grandQuantityValue'];
  $costumer = $_POST['costumer'];
  $count = $_POST['trCount'];


  $sql = "INSERT INTO quotation (costumer, date, description, quantity, total, available) VALUES ('$costumer', '$quotationDate', '$description', '$grandQuantity', '$grandTotal', 1);";
  
  $res = $connect->query($sql);

  if($res > 0){
      $insert = true;
      $quotation_id = $connect->insert_id;
  }else{
      $insert = false;
  }
  
  $number = (int) $count;

  for($x = 0; $x < $number; $x++) {
    
    $query = "INSERT INTO `quotation_item` (`quotation_item_id`, `quotation_id`, `product_code`, `product_name`, `quantity`, `rate`, `total`, `available`) VALUES (NULL,".$quotation_id.",'".$_POST['productCode'][$x]."','".$_POST['productNameValue'][$x]."','".$_POST['quantity'][$x]."','".$_POST['rate'][$x]."','".$_POST['totalValue'][$x]."', 1);";
    $result = $connect->query($query);
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