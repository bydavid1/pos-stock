<?php 	

require_once '../includes/load.php';

$valid['success'] = array('success' => false, 'messages' => array());

$productId = $_POST['productId'];

if($productId) { 

 $sql = "UPDATE product SET product_active = 2, product_status = 2 WHERE product_id = {$productId}";

 if($db->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Eliminado exitosamente";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error no se ha podido eliminar";
 }
 
 $db = null;

 echo json_encode($valid);
 
} // /if $_POST