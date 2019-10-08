<?php
require_once '../includes/load.php';

  $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

  if($action == 'ajax'){
      $q = remove_junk($_REQUEST['q']);
      $aColumns = array('provider', 'purchase_date');
      $sWhere = "WHERE purchase_active = 1";
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
     $sWhere.=" order by purchase_date";
     include 'pagination.php'; 
     $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
     $per_page = 10; 
     $adjacents  = 4; 
     $offset = ($page - 1) * $per_page;
     $count_query = "SELECT count(*) AS numrows FROM purchases $sWhere";
     $count_result = $db->query($count_query);
     $row = $count_result->fetch_array();
     $numrows = $row['numrows'];
     $total_pages = ceil($numrows/$per_page);
     $reload = './purchases.php';
     $sql="SELECT purchase_id, provider, purchase_date, quantity, total, payment_status FROM purchases $sWhere LIMIT $offset,$per_page";
     $query = $db->query($sql);

     if ($numrows > 0){

         ?>
         <div class="table-responsive">
           <table class="table table-hover table-bordered" id="providersData">
             <tr class="info">
                 <th>#</th>
                 <th>Fecha</th>
                 <th>Proveedor</th>
                 <th>Cantidad</th>
                 <th>Estado</th>
				         <th>Total</th>
                 <th class='text-right'>Acciones</th>

             </tr>
             <?php

             while ($row = $query->fetch_array()){

				$Id = $row[0];

				if($row[4] == 1) {
					$paymentStatus = "<label class='label label-success'>Pago completo</label>";
				} else if($row[4] == 2) {
					$paymentStatus = "<label class='label label-info'>Pago por adelantado</label>";
				} else {
					$paymentStatus = "<label class='label label-warning'>No pagado</label>";
				}	
				
				$button = '<a type="button" class="btn btn-danger" data-toggle="modal" onclick="removeOutlay('.$row[0].')" data-target="#removeOutModal" id="removeOutModalBtn"> <i class="glyphicon glyphicon-trash"></i> Eliminar</a>';

                     $fecha = $row[2];
                     $proveedor = $row[1];
                     $cantidad = $row[3];
				          	 $total = $row[4];		

                 ?>
                     <td><?php echo $Id; ?></td>
                     <td><?php echo $fecha; ?></td>
                     <td><?php echo $proveedor;?></td>
                     <td><?php echo $cantidad;?></td>
					           <td><?php echo $paymentStatus;?></td>
                     <td><?php echo number_format($total, 2);?></td>
                     <td class='text-right'><?php echo $button;?></td>

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
               echo "<center>No se encontraron ventas</center>";
             }
         	}