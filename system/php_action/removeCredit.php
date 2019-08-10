<?php

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$id = $_POST['id'];

if($id) {

 $sql = "UPDATE credits SET available = 2 WHERE credit_id = {$id}";

 if($connect->query($sql) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Eliminado exitosamente";
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error no se ha podido eliminar";
 }

 $connect->close();

 echo json_encode($valid);

} // /if $_POST
