<?php
require_once '../includes/load.php';
	
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
		$q = remove_junk($_REQUEST['q']);
		 $aColumns = array('cost_name');//Columnas de busqueda
		 $sTable = "costumers";
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
		$sWhere.=" order by cost_name";
		include 'pagination.php'; 
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10; 
		$adjacents  = 4; 
		$offset = ($page - 1) * $per_page;
		$count_query = "SELECT count(*) AS numrows FROM costumers $sWhere";
		$count_result = $db->query($count_query);
		$row = $count_result->fetch_array();
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './costumers.php';
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = $db->query($sql);
		if ($numrows>0){
			
			?>
			<div class="table-responsive">
			  <table class="table table-striped table-hover table-condensed">
				<tr  class="info">
				    <th>Codigo</th>
					<th>Nombre</th>
					<th>Teléfono</th>
					<th>Email</th>
					<th>Dirección</th>
					<th>Agregado</th>
					<th class='text-right'>Acciones</th>
					
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_cliente=$row['cost_id'];
						$codigo=$row['cost_code'];
						$nombre_cliente=$row['cost_name'];
						$telefono_cliente=$row['cost_phone'];
						$email_cliente=$row['cost_email'];
						$direccion_cliente=$row['cost_address'];
						$date_added= date('d/m/Y', strtotime($row['cost_date']));
						
					?>
					<input type="hidden" value="<?php echo $codigo;?>" id="nombre_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $nombre_cliente;?>" id="nombre_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $telefono_cliente;?>" id="telefono_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $email_cliente;?>" id="email_cliente<?php echo $id_cliente;?>">
					<input type="hidden" value="<?php echo $direccion_cliente;?>" id="direccion_cliente<?php echo $id_cliente;?>">
					
					<tr>
					    <td><?php echo $codigo; ?></td>
						<td><?php echo $nombre_cliente; ?></td>
						<td ><?php echo $telefono_cliente; ?></td>
						<td><?php echo $email_cliente;?></td>
						<td><?php echo $direccion_cliente;?></td>
						<td><?php echo $date_added;?></td>
						
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
		}
	}
?>