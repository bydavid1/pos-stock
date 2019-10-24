<?php
require_once '../includes/load.php';

  $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

  if($action == 'ajax'){
      $q = remove_junk($_REQUEST['q']);
      $aColumns = array('prov_name', 'prov_nit');
      $sWhere = "WHERE prov_status = 1 AND prov_active = 1";
     if ( $_GET['q'] != "" )
     {
         $sWhere .= " and (";
         for ( $i=0 ; $i<count($aColumns) ; $i++ )
         {
             $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
         }
         $sWhere = substr_replace( $sWhere, "", -3 );
         $sWhere .= ')';
     }
     $sWhere.=" order by prov_name";
     include 'pagination.php'; 
     $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
     $per_page = 10; 
     $adjacents  = 4; 
     $offset = ($page - 1) * $per_page;
     $count_query = "SELECT count(*) AS numrows FROM providers $sWhere";
     $count_result = $db->query($count_query);
     $row = $count_result->fetch_array();
     $numrows = $row['numrows'];
     $total_pages = ceil($numrows/$per_page);
     $reload = './providers.php';
     $sql="SELECT prov_id, prov_cod, prov_name, prov_phone, prov_nit, prov_address, prov_active, prov_status FROM providers $sWhere LIMIT $offset,$per_page";
     $query = $db->query($sql);

     if ($numrows > 0){

         ?>
         <div class="table-responsive">
           <table class="table table-hover table-bordered" id="providersData">
             <tr class="info">
                 <th>Codigo</th>
                 <th>Nombre</th>
                 <th>Telefono</th>
                 <th>NIT</th>
                 <th>Direccion</th>
				         <th>Disponible</th>
                 <th class="text-right">Acciones</th>

             </tr>
             <?php

             while ($row = $query->fetch_array()){
                     $Id = $row[0];
                     $prov_cod = $row[1];
                     $prov_name = $row[2];
                     $prov_phone = $row[3];
                     $prov_nit = $row[4];
					 $prov_address = $row[5];
					 if($row[7] == 1) {
						$activeBrands = "<label class='label label-success'>Disponible</label>";
					} else {
						$activeBrands = "<label class='label label-danger'>No disponible</label>";
					}

                     $button = '<a type="button" class="btn btn-warning" data-toggle="modal" data-target="#editBrandModel" onclick="editBrands('.$Id.')"> <i class="glyphicon glyphicon-edit"></i></a>
					 <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#removeMemberModal" onclick="removeBrands('.$Id.')"> <i class="glyphicon glyphicon-trash"></i></a>';

                 ?>
                     <td><?php echo $prov_cod; ?></td>
                     <td><?php echo $prov_name; ?></td>
                     <td><?php echo $prov_phone;?></td>
                     <td><?php echo $prov_nit;?></td>
                     <td><?php echo $prov_address;?></td>
					           <td><?php echo $activeBrands;?></td>
                     <td class="text-right"><?php echo $button;?></td>

                  </tr>
                  <?php
         				}
         				?>
         				<tr>
         					<td colspan=10><span class="pull-right">
         					<?php
         					 echo paginate($reload, $page, $total_pages, $adjacents);
         					?></span></td>
         				</tr>
         			  </table>
         			</div>
         			<?php
         		}else {
               echo "<center>No se encontraron proveedores</center>";
             }
         	}