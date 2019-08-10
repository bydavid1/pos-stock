<?php 	

require_once 'core.php';


$valid['success'] = array('success' => false, 'messages' => array());

$outlayId = $_POST['outlayId'];

if($outlayId) { 

 $sql = "UPDATE outlay SET available = 2 WHERE outlay_id = {$outlayId}";

 $outlayItem = "UPDATE outlay_item SET available = 2 WHERE  outlay_id = {$outlayId}";

 if($connect->query($sql) === TRUE && $connect->query($outlayItem) === TRUE) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the brand";
 }
 
 $connect->close();

 echo json_encode($valid);
 
} // /if $_POST