<?php
	require_once 'core.php';

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_cliente=intval($_GET['id']);

		$sql= "DELETE FROM clientes WHERE id_cliente='".$id_cliente."'";
		$res = $connect->query($sql);
			if ($res > 0){
			?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
			</div>
			<?php

		}

	}
	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($connect,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('costumer', 'date');//Columnas de busqueda
		 $sTable = "quotation";
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
		$sWhere.=" order by quotation_id";
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
		$reload = './quotations.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($connect, $sql);
		//loop through fetched data
		if ($numrows>0){

			?>
			<div class="table table-responsive table-condensed">
			  <table class="table table-striped table-hover table-condensed">
				<tr  class="info">
				    <th>Fecha</th>
					<th>Cliente</th>
					<th>Cantidad</th>
					<th>Total</th>
					<th class='text-right'>Acciones</th>

				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_quotation=$row['quotation_id'];
						$costumer=$row['costumer'];
						$date=$row['date'];
						$quantity=$row['quantity'];
						$total=$row['total'];
					?>

					<tr>
					    <td><?php echo $date; ?></td>
						<td><?php echo $costumer; ?></td>
						<td ><?php echo $quantity; ?></td>
						<td><?php echo $total;?></td>

					<td ><span class="pull-right">
					<a href="#" class='btn btn-default' title='Editar cliente' onclick="obtener_datos('<?php echo $id_quotation;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a>
					<a href="#" class='btn btn-default' title='Borrar cliente' onclick="eliminar('<?php echo $id_quotation; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>

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
