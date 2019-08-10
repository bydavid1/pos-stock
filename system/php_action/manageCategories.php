<?php
require_once '../includes/load.php';

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

    if($action == 'ajax'){
         $q = remove_junk($_REQUEST['q']);
		 $aColumns = array('categories_name');
		 $sTable = "categories";
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
		$sWhere.=" order by categories_id ";
		include 'pagination.php'; 
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 10;
		$adjacents  = 4; 
		$offset = ($page - 1) * $per_page;
		$count_query = $db->query("SELECT count(*) AS numrows FROM $sTable  $sWhere");
		$row= mysqli_fetch_array($count_query);
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		$reload = './categories.php';
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = $db->query($sql);
		if ($numrows>0){

			?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="info">
					<th>Nombre de categoria</th>
					<th>Estado</th>
					<th class='text-right'>Acciones</th>

				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
                        $id=$row['categories_id'];
                        $name=$row['categories_name'];
                        $status=$row['categories_status'];


                        if($status == 1) {
                            // activate member
                            $stat_categories = "<label class='label label-success'>Disponible</label>";
                        } else {
                            // deactivate member
                            $stat_categories = "<label class='label label-danger'>No disponible</label>";
                        }
                   
                        $button = '<!-- Single button -->
                       <div class="btn-group">
                         <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           Acción <span class="caret"></span>
                         </button>
                         <ul class="dropdown-menu">
                           <li><a type="button" data-toggle="modal" id="editCategoriesModalBtn" data-target="#editCategoriesModal" onclick="editCategories('.$id.')"> <i class="glyphicon glyphicon-edit"></i> Editar</a></li>
                           <li><a type="button" data-toggle="modal" data-target="#removeCategoriesModal" id="removeCategoriesModalBtn" onclick="removeCategories('.$id.')"> <i class="glyphicon glyphicon-trash"></i> Eliminar</a></li>       
                         </ul>
                       </div>';
                   

					?>

					<tr>

						<td><?php echo $name; ?></td>
						<td><?php echo $stat_categories; ?></td>
						<td class='text-right'><?php echo $button;?></td>

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
