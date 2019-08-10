<?php
	require_once 'core.php';

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($connect,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('costumer', 'credit_date');//Columnas de busqueda
		 $sTable = "credits";
		 $sWhere = "WHERE available = 1";
		if ( $_GET['q'] != "" )
		{
				$sWhere .= " and (";
				for ( $i=0 ; $i<count($aColumns) ; $i++ )
				{
						$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
				}
				$sWhere = substr_replace( $sWhere, "", -3 );
				$sWhere .= ')';
		}
		$sWhere.=" order by credit_date";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query = "SELECT count(*) AS numrows FROM credits $sWhere";
		$count_result = $connect->query($count_query);
		$row = $count_result->fetch_array();
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './credit.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($connect, $sql);
		//loop through fetched data
		if ($numrows>0){

			?>
			<div class="table-responsive">
			  <table class="table table-striped table-hover table-condensed">
				<tr  class="info">
				    <th>Fecha</th>
					<th>Cliente</th>
					<th>Cantidad</th>
					<th>Total</th>
          <th>Estado</th>
					<th>Entrega</th>
					<th class='text-right'>Acciones</th>

				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_credit=$row['credit_id'];
						$costumer=$row['costumer'];
						$quantity=$row['quantity'];
						$total=$row['total'];
						$payment_status=$row['payment_status'];
						$delivery_status=$row['delivery_status'];
                        $date= date('d/m/Y', strtotime($row['credit_date']));


                    if($payment_status == 1) {
                        // activate member
                        $type = "<label class='label label-info'>Pagado</label>";
                    } else if($payment_status == 2){
                        // deactivate member
                        $type = "<label class='label label-success'>Pago adelantado</label>";
                    } else{
                        $type = "<label class='label label-danger'>No pagado</label>";
                    }

                    if($delivery_status == 1) {
                        // activate member
                        $status = "<label class='label label-info'>Entregado</label>";
                    } else if($delivery_status == 2){
                        // deactivate member
                        $status = "<label class='label label-success'>Parcial</label>";
                    } else{
                        $status = "<label class='label label-danger'>Pendiente</label>";
                    }
					?>

					<tr>
					  <td style="cursor: pointer;" id="viewCredit" data-toggle="modal" data-target="#viewCreditModal" onclick="view(<?php echo $id_credit; ?>)"><?php echo $date; ?></td>
						<td style="cursor: pointer;" id="viewCredit" data-toggle="modal" data-target="#viewCreditModal" onclick="view(<?php echo $id_credit; ?>)"><?php echo $costumer; ?></td>
						<td style="cursor: pointer;" id="viewCredit" data-toggle="modal" data-target="#viewCreditModal" onclick="view(<?php echo $id_credit; ?>)"><?php echo $quantity; ?></td>
						<td style="cursor: pointer;" id="viewCredit" data-toggle="modal" data-target="#viewCreditModal" onclick="view(<?php echo $id_credit; ?>)"><?php echo '$'.number_format($total, 2);?></td>
						<td style="cursor: pointer;" id="viewCredit" data-toggle="modal" data-target="#viewCreditModal" onclick="view(<?php echo $id_credit; ?>)"><?php echo $type;?></td>
						<td style="cursor: pointer;" id="viewCredit" data-toggle="modal" data-target="#viewCreditModal" onclick="view(<?php echo $id_credit; ?>)"><?php echo $status;?></td>

					<td ><span class="pull-right">
					<a href="#" class='btn btn-success' title='Editar credito' onclick="print('<?php echo $id_credit;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-print"></i></a>
					<a href="#" class='btn btn-danger' title='Borrar credito' onclick="remove('<?php echo $id_credit; ?>')" data-toggle="modal" data-target="#removeCreditModal" id="removeCreditBtn"><i class="glyphicon glyphicon-trash"></i> </a></span></td>

					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=7><span class="pull-right">
					<?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}else {
			echo "<center>No se encontraron registros</center>";
		}
	}
?>
