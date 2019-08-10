<?php 	

require_once 'core.php';

$sql = "SELECT order_id, order_date, client_name, sub_total, discount, total, paymentStatus FROM orders WHERE order_status = 1";
$result = $connect->query($sql);



$output = array('data' => array());

if($result->num_rows > 0) { 
 
 $paymentStatus = ""; 
 $x = 1;

 while($row = $result->fetch_array()) {
 	$orderId = $row[0];

 	$countOrderItemSql = "SELECT count(*) FROM order_item WHERE order_id = $orderId";
 	$itemCountResult = $connect->query($countOrderItemSql);
 	$itemCountRow = $itemCountResult->fetch_row();


 	// active 
 	if($row[6] == 1) { 		
 		$paymentStatus = "<label class='label label-success'>Pago completo</label>";
 	} else if($row[6] == 2) { 		
 		$paymentStatus = "<label class='label label-info'>Pago por adelantado</label>";
 	} else { 		
 		$paymentStatus = "<label class='label label-warning'>No pagado</label>";
 	} // /else

 	$button = '<!-- Single button -->
	<div class="btn-group">
	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	    Acción <span class="caret"></span>
	  </button>
	  <ul class="dropdown-menu">
	    <li><a href="editOrder.php?o=editOrd&i='.$orderId.'" id="editOrderModalBtn"> <i class="glyphicon glyphicon-edit"></i> Editar</a></li>
	    
	    <li><a type="button" data-toggle="modal" id="paymentOrderModalBtn" data-target="#paymentOrderModal" onclick="paymentOrder('.$orderId.')"> <i class="glyphicon glyphicon-save"></i> Pagar</a></li>

	    <li><a type="button" onclick="printOrder('.$orderId.')"> <i class="glyphicon glyphicon-print"></i> Imprimir </a></li>
	    
	    <li><a type="button" data-toggle="modal" data-target="#removeOrderModal" id="removeOrderModalBtn" onclick="removeOrder('.$orderId.')"> <i class="glyphicon glyphicon-trash"></i> Eliminar</a></li>       
	  </ul>
	</div>';		

 	$output['data'][] = array( 		
 		
 		$row[0],
 		// order date
 		$row[1],
 		// client name
 		$row[2], 
		 //total de prod
		$itemCountRow,
        //sub total
 		$row[3], 		 	
        //total
		$row[5], 
        //pago
		$paymentStatus,
 		//boton
 		$button 		
 		); 	
 	$x++;
 } // /while 

}// if num_rows

$connect->close();

echo json_encode($output);