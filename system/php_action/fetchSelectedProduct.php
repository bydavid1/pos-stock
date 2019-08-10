<?php

require_once '../includes/load.php';

$productId = $_POST['productId'];

       $sql="SELECT product.product_id, product.product_cod, product.product_name, product.product_image, product.provider_id,
       product.categories_id, product.quantity, product.purchase_price, product.price1, product.price2, product.price3, product.price4, product.utility1, 
       product.utility2, product.utility3, product.utility4, product.product_active, product.product_type,
       providers.prov_name, categories.categories_name FROM product INNER JOIN providers ON product.provider_id = providers.prov_id
         INNER JOIN categories ON product.categories_id = categories.categories_id WHERE product_id = $productId";
$result = $db->query($sql);

if($result->num_rows > 0) {
 $row = $result->fetch_array();
 $product=array(
  "product_id" => $row[0],
  "product_cod" => $row[1],
  "product_name" => $row[2],
  "product_image" => $row[3],
  "quantity" => $row[6],
  "purchase_price" => $row[7],
  "price1" => $row[8],
  "price2" => $row[9],
  "price3" => $row[10],
  "price4" => $row[11],
  "utility1" => $row[12],
  "utility2" => $row[13],
  "utility3" => $row[14],
  "utility4" => $row[15],
  "product_status" => $row[16],
  "product_type" => $row[17],
  "prov_name" => $row[4],
  "categories_name" => $row[5],
  "categories" => $row[18],
  "providers" => $row[19]);
} // if num_rows

$db = null;


echo json_encode($product);
