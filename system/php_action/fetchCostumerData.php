<?php

require_once 'core.php';

	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
         $q = mysqli_real_escape_string($connect,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('nombre_cliente');
		 $sTable = "clientes";
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
		$count_query   = mysqli_query($connect, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './addReturn.php';
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($connect, $sql);
		if ($numrows>0){
			echo $sql;
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
					$id_cliente=$row['id_cliente'];
					$nombre_cliente=$row['nombre_cliente'];
					$telefono_cliente=$row['telefono_cliente'];
                    $date_added=$row["date_added"];
                    $direccion_cliente=$row["direccion_cliente"];
				
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