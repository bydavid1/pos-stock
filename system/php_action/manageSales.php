<?php 	
require_once '../includes/load.php';

  $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

  if($action == 'ajax'){
      $q = remove_junk($_REQUEST['q']);
      $aColumns = array('client_name', 'sale_date');
      $sWhere = "WHERE sale_active = 1";
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
     $sWhere.=" order by sale_date";
     include 'pagination.php'; 
     $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
     $per_page = 10; 
     $adjacents  = 4; 
     $offset = ($page - 1) * $per_page;
     $count_query = "SELECT count(*) AS numrows FROM sales $sWhere";
     $count_result = $db->query($count_query);
     $row = $count_result->fetch_array();
     $numrows = $row['numrows'];
     $total_pages = ceil($numrows/$per_page);
     $reload = './sales.php';
     $sql="SELECT sale_id, sale_date, client_name, sub_total, sale_total, payment_status FROM sales $sWhere LIMIT $offset,$per_page";
     $query = $db->query($sql);

     if ($numrows > 0){

         ?>
         <div class="table-responsive">
           <table class="table table-hover table-bordered" id="providersData">
             <tr class="info">
                 <th>#</th>
                 <th>Fecha</th>
                 <th>Cliente</th>
                 <th>Productos</th>
                 <th>Sub total</th>
				 <th>Total</th>
				 <th>Pago</th>
                 <th class='text-right'>Acciones</th>

             </tr>
             <?php

             while ($row = $query->fetch_array()){

				$orderId = $row[0];

				if($row[6] == 1) { 		
					$paymentStatus = "<label class='label label-success'>Pago completo</label>";
				} else if($row[6] == 2) { 		
					$paymentStatus = "<label class='label label-info'>No pagado</label>";
				} else { 		
					$paymentStatus = "<label class='label label-warning'>Desconocido</label>";
				} 

				$countOrderItemSql = "SELECT quantity FROM sale_item WHERE sale_id = $orderId";
				$itemCountResult = $db->query($countOrderItemSql);
				$itemCountRow = $itemCountResult->fetch_row();
				
				$button = '<!-- Single button -->
				<div class="btn-group">
				  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Acción <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu">
					<li><a href="editOrder.php?o=editOrd&i='.$orderId.'" id="editOrderModalBtn"> <i class="glyphicon glyphicon-edit"></i> Editar</a></li>
					
					<li><a type="button" data-toggle="modal" id="paymentOrderModalBtn" data-target="#paymentOrderModal" onclick="paymentOrder('.$orderId.')"> <i class="glyphicon glyphicon-save"></i> Pagar</a></li>
			
					<li><a type="button" onclick="printOrder('.$orderId.')"> <i class="glyphicon glyphicon-print"></i> Imprimir </a></li>
					
					<li><a type="button" data-toggle="modal" data-target="#removeOrderModal" id="removeOrderModalBtn" onclick="removeOrder('.$orderId.')"> <i class="glyphicon glyphicon-trash"></i> Eliminar</a></li>       
				  </ul>
				</div>';

                     $fecha = $row[1];
                     $cliente = $row[2];
                     $subTotal = $row[3];
					           $total = $row[5];		

                 ?>
                     <td><?php echo $orderId; ?></td>
                     <td><?php echo $fecha; ?></td>
                     <td><?php echo $cliente;?></td>
                     <td><?php echo $itemCountRow[0];?></td>
                     <td><?php echo number_format($subTotal, 2);?></td>
				          	 <td><?php echo number_format($total, 2);?></td>
				          	 <td><?php echo $paymentStatus;?></td>
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