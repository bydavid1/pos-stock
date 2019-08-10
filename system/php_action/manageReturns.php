<?php
	require_once 'core.php';

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

    if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($connect,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('costumer');//Columnas de busqueda
		 $sTable = "returns";
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
		$sWhere.=" order by return_id ";
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
		$reload = './retuns.php';
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($connect, $sql);
		//loop through fetched data
		if ($numrows>0){

			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="info">
					<th>Fecha</th>
					<th>Cliente</th>
					<th>Cantidad</th>
					<th>Total</th>
					<th>Estado</th>
					<th class='text-right'>Acciones</th>

				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
                        $id_return=$row['return_id'];
                        $date=$row['date'];
						$costumer=$row['costumer'];
						$quantity=$row['quantity'];
						$total=$row['rate'];
                        $available=$row['available'];

                        if($available == 1) {
                            // activate member
                            $active = "<label class='label label-success'>Disponible</label>";
                        } else {
                            // deactivate member
                            $active = "<label class='label label-danger'>No disponible</label>";
                        } // /else

					?>

					<input type="hidden" value="<?php echo $nombre_cliente;?>" id="nombre_cliente<?php echo $id_return;?>">
					<input type="hidden" value="<?php echo $telefono_cliente;?>" id="telefono_cliente<?php echo $id_return;?>">
					<input type="hidden" value="<?php echo $email_cliente;?>" id="email_cliente<?php echo $id_return;?>">
					<input type="hidden" value="<?php echo $direccion_cliente;?>" id="direccion_cliente<?php echo $id_return;?>">
					<input type="hidden" value="<?php echo $status_cliente;?>" id="status_cliente<?php echo $id_clid_returniente;?>">

					<tr>

						<td><?php echo $date; ?></td>
						<td ><?php echo $costumer; ?></td>
						<td><?php echo $quantity;?></td>
						<td><?php echo $total;?></td>
						<td><?php echo $available;?></td>

					<td ><span class="pull-right">
					<a href="#" class='btn btn-default' title='Editar cliente' onclick="obtener_datos('<?php echo $id_cliente;?>');" data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a>
					<a href="#" class='btn btn-default' title='Borrar cliente' onclick="eliminar('<?php echo $id_cliente; ?>')"><i class="glyphicon glyphicon-trash"></i> </a></span></td>

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
