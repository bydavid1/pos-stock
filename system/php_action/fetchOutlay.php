<?php

require_once 'core.php';

$sql = "SELECT outlay_id, provider, outlay_date, quantity, payment_status, total FROM outlay WHERE available = 1";

$result = $connect->query($sql);

$output = array('data' => array());

if($result->num_rows > 0) {


 while($row = $result->fetch_array()) {

	if($row[4] == 1) {
		$paymentStatus = "<label class='label label-success'>Pago completo</label>";
	} else if($row[4] == 2) {
		$paymentStatus = "<label class='label label-info'>Pago por adelantado</label>";
	} else {
		$paymentStatus = "<label class='label label-warning'>No pagado</label>";
	}

 	$button = '<a type="button" class="btn btn-danger" data-toggle="modal" onclick="removeOutlay('.$row[0].')" data-target="#removeOutModal" id="removeOutModalBtn"> <i class="glyphicon glyphicon-trash"></i> Eliminar</a>';


 	$output['data'][] = array(

		$row[0],

 		$row[2],

 		$row[1],

		$row[3],

		$paymentStatus,

		$row[5],

 		$button
 		);
 } // /while

}// if num_rows

$connect->close();

echo json_encode($output);
