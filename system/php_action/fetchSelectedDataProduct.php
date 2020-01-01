<?php
 try {
     
 require_once '../includes/load.php';

$type = $_POST['type'];

if ($type == "get") {

   $productCode = $_POST['code'];
   $sql = "SELECT product_cod, product_name, price1 FROM product WHERE product_cod = '$productCode'";
   $stmt = $db->query($sql);

}elseif($type == "add"){

   $id = $_POST['id'];
   $sql = "SELECT product_name, product_cod, price1 FROM product WHERE product_id = $id";
   $stmt = $db->query($sql);
}

$num = $db->num_rows($stmt);

if($num>0){
 
   $response = array();

    while ($row = $stmt->fetch_array()){

        extract($row);

        $response_item=array(
            "product_cod" => $row['product_cod'],
            "product_name" => $row['product_name'],
            "price1" => $row['price1']
        );

        array_push($response, $response_item);
    }
    http_response_code(200);

    echo json_encode($response);
}
else{

    http_response_code(204);

    echo json_encode(
        array("message" => "No products found.")
    );
}
     
   $db = null;
 } catch (Exception $th) {
    
   http_response_code(500);

   echo json_encode(
       array("message" => "". $th->getMessage())
   );

 }


