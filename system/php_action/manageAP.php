<?php
	require_once 'core.php';

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($connect,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('outlay_description','provider','outlay_date','nit');//Columnas de busqueda
		 $sTable = "outlay";
		 $sWhere = "";
		if ( $_GET['q'] != "" )
		{
			$sWhere = "WHERE (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.="WHERE payment_status = 3 order by outlay_id ";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query   = mysqli_query($connect, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './accountsPayable.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($connect, $sql);
		//loop through fetched data
		if ($numrows>0){

			?>
			<div class="table-responsive">
			  <table class="table table-striped table-hover table-condensed">
				<tr class="info">
                    <th>Fecha</th>
				    <th>Proveedor</th>
					<th>NIT</th>
					<th>Cantidad</th>
                    <th>Total</th>
                    <th>Entrega</th>
					<th class='text-right'>Acciones</th>

				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_outlay=$row['outlay_id'];
						$provider=$row['provider'];
						$nit=$row['nit'];
						$quantity=$row['quantity'];
						$total=$row['total'];
						$deliveryStatus=$row['deliveryStatus'];
                        $date_added= date('d/m/Y', strtotime($row['outlay_date']));


                    if($deliveryStatus == 1) {
                        // activate member
                        $type = "<label class='label label-info'>Completa</label>";
                    } else if($deliveryStatus == 2){
                        // deactivate member
                        $type = "<label class='label label-success'>Parcial</label>";
                    } else{
                        $type = "<label class='label label-danger'>Pendiente</label>";
                    }

					?>
					<input type="hidden" value="<?php echo $date_added;?>" id="fecha<?php echo $id_outlay;?>">
					<input type="hidden" value="<?php echo $provider;?>" id="proveedor<?php echo $id_outlay;?>">
					<input type="hidden" value="<?php echo $nit;?>" id="nit<?php echo $id_outlay;?>">
					<input type="hidden" value="<?php echo $quantity;?>" id="quantity<?php echo $id_outlay;?>">
                    <input type="hidden" value="<?php echo $total;?>" id="total<?php echo $id_outlay;?>">
                    <input type="hidden" value="<?php echo $deliveryStatus;?>" id="entrega<?php echo $id_outlay;?>">
					<tr>
					    <td><?php echo $date_added; ?></td>
						<td><?php echo $provider; ?></td>
						<td ><?php echo $nit; ?></td>
						<td><?php echo $quantity;?></td>
						<td><?php echo $total;?></td>
						<td><?php echo $type;?></td>

					<td ><span class="pull-right">
					<a href="#" class='btn btn-default' title='Pagar' onclick="pagar('<?php echo $id_outlay; ?>')"><i class="glyphicon glyphicon-save"></i> </a></span></td>

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
