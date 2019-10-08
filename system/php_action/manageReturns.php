<?php
	require_once '../includes/load.php';

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

    if($action == 'ajax'){
		 $q = remove_junk($_REQUEST['q']);//Eliminar caracteres especiales
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
		include 'pagination.php'; 
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; 
		$adjacents  = 4; 
		$offset = ($page - 1) * $per_page;
		$count_query = "SELECT count(*) AS numrows FROM returns $sWhere";
		$count_result = $db->query($count_query);
		$row = $count_result->fetch_array();
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './retuns.php';
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = $db->query($sql);
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
