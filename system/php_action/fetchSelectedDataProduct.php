<?php

require_once 'core.php';

$valid['success'] = array('success' => false, 'message1' => array(), 'message2' => array(), 'message3' => array());
$type = $_POST['type'];

if ($type == "get"){

   $productCode = $_POST['code'];
   $sql = "SELECT product_name, rate1 FROM product WHERE cod_product = '$productCode'";
   $result = $connect->query($sql);

   if($result->num_rows > 0) {
    while ($row = $result->fetch_array()){
       $res = $row['product_name'];
       $rate = $row['rate1'];
    }
      $valid['success'] = true;
      $valid['message1'] = $res;
      $valid['message2'] = $rate;
      $valid['message3'] = null;
   }else{
      $valid['success'] = false;
      $valid['message1'] = null;
      $valid['message2'] = null;
      $valid['message3'] = null;
   }

   echo json_encode($valid);

}else if($type == "add"){

   $id = $_POST['id'];


   $sql = "SELECT product_name, cod_product, rate1 FROM product WHERE product_id = $id";
   $result = $connect->query($sql);

   if($result->num_rows > 0) {
      while ($row = $result->fetch_array()){
         $name = $row['product_name'];
         $code = $row['cod_product'];
         $rate = $row['rate1'];
      }
      $valid['success'] = true;
      $valid['messages1'] = $name;
      $valid['messages2'] = $code;
      $valid['messages3'] = $rate;
   }else{
      $valid['success'] = false;
      $valid['message1'] = null;
      $valid['message2'] = null;
      $valid['message3'] = null;
   }

     echo json_encode($valid);
}


$connect->close();
