<?php
require_once '../includes/load.php';

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
		 $q = remove_junk($_REQUEST['q']);
		 $aColumns = array('product_cod', 'product_name');
		 $sTable = "product";
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
		$count_query = "SELECT count(*) AS numrows FROM $sTable  $sWhere";
		$count_result = $db->query($count_query);
		$row = $count_result->fetch_array();
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './index.php';
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = $db->query($sql);
		if ($numrows>0){
			?>
			<div class="table-responsive">
				<table class="table">
					<tr class="info">
						<th>Código</th>
						<th>Producto</th>
						<th><span class="pull-right">Cant.</span></th>
						<th><span class="pull-right">Precio</span></th>
						<th class='text-center' style="width: 36px;">Agregar</th>
					</tr>
				<?php
				while ($row = $query->fetch_array()){
					$id_producto=$row['product_id'];
					$codigo_producto=$row['product_cod'];
					$nombre_producto=$row['product_name'];
					$precio_venta=$row["price1"];
					$precio_venta=number_format($precio_venta,2,'.','');
					?>
					<tr>
						<td><?php echo $codigo_producto; ?></td>
						<td><?php echo $nombre_producto; ?></td>
						<td class='col-xs-1'>
							<div class="pull-right">
								<input type="text" class="form-control" style="text-align:right"
									id="cantidad_<?php echo $id_producto; ?>" value="1">
							</div>
						</td>
						<td class='col-xs-2'>
							<div class="pull-right">
								<input type="text" class="form-control" style="text-align:right"
									id="precio_venta_<?php echo $id_producto; ?>" value="<?php echo $precio_venta;?>">
							</div>
						</td>
						<td class='text-center'><a class='btn btn-info' href="#" onclick="agregar('<?php echo $id_producto ?>')"><i
									class="glyphicon glyphicon-plus"></i></a></td>
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=5><span class="pull-right">
					<?php
					 echo paginate($reload, $page, $total_pages, $adjacents);
					?>
					</span></td>
				</tr>
			  </table>
			</div>
			<?php
		}else {
			?>
                <p class="text-center">No se encontraron coincidencias</p>
			<?php
		}
	}
?>