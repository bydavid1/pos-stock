<?php 	

require_once 'core.php';

$orderId = $_POST['orderId'];

$sql = "SELECT order_date, client_name, sub_total, discount, paymentStatus, total FROM orders WHERE order_id = $orderId";

$orderResult = $connect->query($sql);
$orderData = $orderResult->fetch_array();

$orderDate = $orderData[0];
$clientName = $orderData[1]; 
$subTotal = $orderData[2]; 
$discount = $orderData[3];
$payment = $orderData[4];
$total = $orderData[5];

if($payment == 1) { 		
	$paymentStatus = "<label class='label label-success'>Pago completo</label>";
} else if($payment== 2) { 		
	$paymentStatus = "<label class='label label-info'>Pago por adelantado</label>";
} else { 		
	$paymentStatus = "<label class='label label-warning'>No pagado</label>";
} // /else

$orderItemSql = "SELECT order_item.product_id, order_item.rate, order_item.quantity, order_item.total,
product.product_name FROM order_item
	INNER JOIN product ON order_item.product_id = product.product_id 
 WHERE order_item.order_id = $orderId";
$orderItemResult = $connect->query($orderItemSql);

 $table = '
 <table border="1" cellspacing="0" cellpadding="20" width="100%">
	<thead>
		<tr >
			<th colspan="5">

			<center>
				Fecha : '.$orderDate.'
				<center>Cliente : '.$clientName.'</center>
				Teléfono : Desconocido
			</center>		
			</th>
				
		</tr>		
	</thead>
</table>
<table border="0" width="100%;" cellpadding="5" style="border:1px solid black;border-top-style:1px solid black;border-bottom-style:1px solid black;">

	<tbody>
		<tr>
			<th>#</th>
			<th>Producto</th>
			<th>Precio</th>
			<th>Cantidad</th>
			<th>Total</th>
		</tr>';

		$x = 1;
		while($row = $orderItemResult->fetch_array()) {			
						
			$table .= '<tr>
				<th>'.$x.'</th>
				<th>'.$row[4].'</th>
				<th>'.$row[1].'</th>
				<th>'.$row[2].'</th>
				<th>'.number_format($row[3],2).'</th>
			</tr>
			';
		$x++;
		} // /while

		$table .= '<tr>
			<th></th>
		</tr>

		<tr>
			<th></th>
		</tr>

		<tr>
			<th>Sub total</th>
			<th>'.number_format($subTotal,2).'</th>			
		</tr>

		<tr>
			<th>IVA (13%)</th>
			<th>'.number_format($discount,2).'</th>			
		</tr>

		<tr>
			<th>Total</th>
			<th>'.number_format($total,2).'</th>			
		</tr>

		<tr>
			<th>Estado</th>
			
		    <th>'.$paymentStatus.'</th>			
		</tr>
		
	</tbody>
</table>
 ';

 /*<tr>
 <th>Pagado</th>
 <th>'.number_format($paid,2).'</th>			
</tr>

<tr>
 <th>Pendiente</th>
 <th>'.number_format($due,2).'</th>			
</tr>*/

$connect->close();

echo $table;