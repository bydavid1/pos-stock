<?php 	

require_once 'core.php';

$valid['success'] = array('success' => false, 'messages' => array());

if($_POST) {	

	$brandName = $_POST['brandName'];
  $brandStatus = $_POST['brandStatus']; 
  $brandCode = $_POST['brandCode']; 
  $nit = $_POST['nit']; 
  $phone = $_POST['phone']; 
  $address = $_POST['address']; 

	$sql = "INSERT INTO brands (cod_brand, brand_name, nit, phone, address, brand_active, brand_status) VALUES ('$brandCode','$brandName','$nit', '$phone', '$address', '$brandStatus', 1)";

	if($connect->query($sql) === TRUE) {
	 	$valid['success'] = true;
		$valid['messages'] = "Creado exitosamente";	
	} else {
	 	$valid['success'] = false;
	 	$valid['messages'] = "Error no se ha podido guardar";
	}
	 

	$connect->close();

	echo json_encode($valid);
 
} // /if $_POST