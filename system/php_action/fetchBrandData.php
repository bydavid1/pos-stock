<?php

require_once 'core.php';

	
	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if($action == 'ajax'){
         $q = mysqli_real_escape_string($connect,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('brand_id','cod_brand', 'brand_name', 'phone', 'address');
		 $sTable = "brands";
		 $sWhere = "";
		if ($_GET['q'] != "" )
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
		$reload = './index.php';
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($connect, $sql);
		if ($numrows>0){
            echo $sql;
			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="warning">
					<th>Código</th>
					<th>Proveedor</th>
					<th>Direccion</th>
					<th>Telefono</th>
					<th class='text-center' style="width: 36px;">Agregar</th>
				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
                    $id_prov=$row['brand_id'];
                    $name=$row['brand_name'];
					$cod_prov=$row['cod_brand'];
					$address=$row['address'];
					$phone=$row["phone"];
					?>
					<tr>
						<td><?php echo $cod_prov; ?></td>
						<td><?php echo $name; ?></td>
						<td><?php echo $address; ?></td>
						<td><?php echo $phone; ?></td>
						<td class='text-center'><a class='btn btn-info'href="#" onclick="success('<?php echo $cod_prov ?>')"><i class="glyphicon glyphicon-plus"></i></a></td>
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
		}else{
            echo '<center>No hay registros</center>';
            echo $sql;
        }

        

    }else if($action == 'add'){
		$valid['success'] = array('name' => array(), 'nit' => array());
        $value = mysqli_real_escape_string($connect,(strip_tags($_REQUEST['valueSend'], ENT_QUOTES)));
        $query = "SELECT brand_name, phone FROM brands WHERE cod_brand = '$value'";
        $result = mysqli_query($connect, $query);
        $d = mysqli_fetch_array($result);
        $name = $d['brand_name'];
        $phone = $d['phone'];

        $valid['name'] = $name;
        $valid['nit'] = $phone;

        echo json_encode($valid);
    }
?>