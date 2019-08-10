<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

  $outlayDate = date('Y-m-d', strtotime($_POST['outlayDate']));
  $description = $_POST['description'];
  $grandTotal = $_POST['grandTotalValue'];
  $grandQuantity = $_POST['grandQuantityValue'];
  $provider = $_POST['provider'];
  $nit = $_POST['nit'];
  $paymentStatus = $_POST['paymentStatus'];
  $paymentType = $_POST['paymentType'];
  $deliveryStatus = $_POST['deliveryStatus'];
  $count = $_POST['trCount'];


  $sql = "INSERT INTO outlay (nit, outlay_description, provider, outlay_date, quantity, total, payment_status, payment_type, delivery_status, available) VALUES ('$nit', '$description', '$provider', '$outlayDate','$grandQuantity','$grandTotal', '$paymentStatus', '$paymentType', '$deliveryStatus', 1);";
  $res = $connect->query($sql);
  $outlay_id;
  if($res > 0){
      $outlay_id = $connect->insert_id;
      $number = (int) $count;
      $validate = 0;
      $productValid = 0;
      for($x = 0; $x < $number; $x++) {

        if($_POST['productNameValue'][$x] != ''){

        $query = "INSERT INTO `outlay_item` (`outlay_item_id`, `outlay_id`, `product_code`, `product_name`, `quantity`, `rate`, `total`, `available`) VALUES (NULL,".$outlay_id.",'".$_POST['productCode'][$x]."','".$_POST['productNameValue'][$x]."','".$_POST['quantity'][$x]."','".$_POST['rate'][$x]."','".$_POST['totalValue'][$x]."', 1);";
        $result = $connect->query($query);

        if ($result > 0) {
          $productValid++;
            $data = "SELECT quantity, product_id FROM product WHERE cod_product = '".$_POST['productCode'][$x]."'";
            $updateProductQuantityData = $connect->query($data);
             $productQuantityData = $updateProductQuantityData->fetch_array();
              $updateQuantity = $productQuantityData['quantity'] + $_POST['quantity'][$x];

            $update = "UPDATE `product` SET `quantity` = $updateQuantity WHERE `cod_product` = '".$_POST['productCode'][$x]."'";
            $quantityUpdated = $connect->query($update);

              if ($quantityUpdated > 0) {

                      $kardex = "INSERT INTO kardex (concept, date, quantity, balance, product_id) VALUES ('Compra', '$outlayDate', ".$productQuantityData['quantity'].", '+". $_POST['quantity'][$x]."', ".$productQuantityData['product_id'].")";
                      $fact = $connect->query($kardex);

                      if ($fact > 0) {
                        $validate++;
                      }

               }else {
                     $valid['success'] = false;
                     $valid['messages'] = 'No se pudo actualizar el stock del producto (error: '.$connect->error.')';
                  }
           }else {
              $valid['success'] = false;
              $valid['messages'] = 'Ocurrio un error al registrar los items'.$connect->error.')';
             }

      }else {
        // No process
      }
    }//for

  }else{
    $valid['success'] = false;
    $valid['messages'] = 'Ocurrio un error'.$connect->error.')';
  }


  //Out process

  if ($validate == $productValid) {
    $valid['success'] = true;
    $valid['messages'] = 'Compra registrada con exito';
  }else {
    $valid['success'] = false;
    $valid['messages'] = 'Ocurrio un problema (error: '.$connect->error.')';
  }

  $connect->close();

	echo json_encode($valid);
