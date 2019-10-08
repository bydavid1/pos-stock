<?php

require_once '../includes/load.php';
	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		 $q = remove_junk($_REQUEST['q']);
		 $aColumns = array('nombre_cliente');
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

		include 'pagination.php'; 
		
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 5; 
		$adjacents  = 4; 
		$offset = ($page - 1) * $per_page;
		$count_query = "SELECT count(*) AS numrows FROM costumers $sWhere";
		$count_result = $db->query($count_query);
		$row = $count_result->fetch_array();
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './addReturn.php';
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = $db->query($sql);
		if ($numrows>0){
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="warning">
					<th>Nombre</th>
					<th>Telefono</th>
					<th>Agregado</th>
					<th>Direccion</th>
					<th>Agregar</th>
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
					$id_cliente=$row['cost_id'];
					$nombre_cliente=$row['cost_name'];
					$telefono_cliente=$row['cost_phone'];
                    $date_added=$row["cost_date"];
                    $direccion_cliente=$row["cost_address"];
				
					?>
					<tr>
						<td><?php echo $nombre_cliente; ?></td>
						<td><?php echo $telefono_cliente; ?></td>
                        <td><?php echo $date_added; ?></td>
                        <td><?php echo $direccion_cliente; ?></td>
						<td><a class='btn btn-info'href="#" onclick="success('<?php echo $id_cliente ?>')"><i class="glyphicon glyphicon-plus"></i></a></td>

                    </tr>
					<?php
				}
				?>
				<tr>
					<td colspan=5><span class="pull-right">
					<?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}else if($action == 'add'){
		$valid['success'] = array('name' => array(), 'nit' => array());
        $value = mysqli_real_escape_string($connect,(strip_tags($_REQUEST['valueSend'], ENT_QUOTES)));
        $query = "SELECT nombre_cliente, nit FROM clientes WHERE id_cliente = '$value'";
        $result = mysqli_query($connect, $query);
        $d = mysqli_fetch_array($result);
        $name = $d['nombre_cliente'];
        $nit = $d['nit'];

        $valid['name'] = $name;
        $valid['nit'] = $nit;

        echo json_encode($valid);
    }
?>