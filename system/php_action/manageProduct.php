<?php

require_once '../includes/load.php';

  $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

  if($action == 'ajax'){
      $q = remove_junk($_REQUEST['q']);
      $aColumns = array('product_name', 'product_cod');
      $sWhere = "WHERE product_status = 1 AND product_active = 1";
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
     $sWhere.=" order by product_cod";
     include 'pagination.php'; 
     $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
     $per_page = 10; 
     $adjacents  = 4; 
     $offset = ($page - 1) * $per_page;
     $count_query = "SELECT count(*) AS numrows FROM product $sWhere";
     $count_result = $db->query($count_query);
     $row = $count_result->fetch_array();
     $numrows = $row['numrows'];
     $total_pages = ceil($numrows/$per_page);
     $reload = './product.php';
     $sql="SELECT product.product_id, product.product_cod, product.product_name, product.product_image, product.provider_id,
      		product.categories_id, product.quantity, product.price1, product.product_active, product.product_type,
      		providers.prov_name, categories.categories_name FROM product INNER JOIN providers ON product.provider_id = providers.prov_id
            INNER JOIN categories ON product.categories_id = categories.categories_id $sWhere LIMIT $offset,$per_page";
     $query = $db->query($sql);

   //loop through fetched data
     if ($numrows > 0){

         ?>
         <div class="table-responsive">
           <table class="table table-hover table-bordered" id="productsData">
             <tr class="info">
                 <th></th>
                 <th>Codigo</th>
                 <th>Nombre</th>
                 <th>Categoria</th>
                 <th>Proveedor</th>
                 <th>Stock</th>
                 <th>Precio</th>
                 <th>Tipo</th>
                 <th class='text-right'>Acciones</th>

             </tr>
             <?php

             while ($row = $query->fetch_array()){
                     $productId = $row[0];
                     $cod_product = $row[1];
                     $product_name = $row[2];
                     $rate = $row[7];
                     $stock = $row[6];
                     $active = $row[8];
                     $type = $row[9];
                     $brand = $row[10];
                     $categories = $row[11];

                     $button = '<a type="button" class="btn btn-warning" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal" onclick="editProduct('.$productId.')"> <i class="glyphicon glyphicon-edit"></i></a>
                                <a type="button" class="btn btn-danger" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn" onclick="removeProduct('.$productId.')"> <i class="glyphicon glyphicon-trash"></i></a>';

                    $imageUrl = $row[3];
                   	$productImage = "<img class='img-round' src='system/".$imageUrl."' style='height:30px; width:40px;'  />";


                  if($type == 1) {
                      $type = "<label class='label label-info'>Fisico</label>";
                  } else if($type == 2){
                      $type = "<label class='label label-success'>Servicio</label>";
                  } else{
                      $type = "<label class='label label-danger'>No especificado</label>";
                  }

                 ?>
                 <tr>
                     <td style="cursor: pointer;" id="viewProduct" data-toggle="modal" data-target="#viewProductModal" onclick="viewProduct(<?php echo $productId; ?>)"><?php echo $productImage; ?></td>
                     <td style="cursor: pointer;" id="viewProduct" data-toggle="modal" data-target="#viewProductModal" onclick="viewProduct(<?php echo $productId; ?>)"><?php echo $cod_product; ?></td>
                     <td style="cursor: pointer;" id="viewProduct" data-toggle="modal" data-target="#viewProductModal" onclick="viewProduct(<?php echo $productId; ?>)"><?php echo $product_name; ?></td>
                     <td style="cursor: pointer;" id="viewProduct" data-toggle="modal" data-target="#viewProductModal" onclick="viewProduct(<?php echo $productId; ?>)"><?php echo $categories;?></td>
                     <td style="cursor: pointer;" id="viewProduct" data-toggle="modal" data-target="#viewProductModal" onclick="viewProduct(<?php echo $productId; ?>)"><?php echo $brand;?></td>
                     <td style="cursor: pointer;" id="viewProduct" data-toggle="modal" data-target="#viewProductModal" onclick="viewProduct(<?php echo $productId; ?>)"><?php echo $stock;?></td>
                     <td style="cursor: pointer;" id="viewProduct" data-toggle="modal" data-target="#viewProductModal" onclick="viewProduct(<?php echo $productId; ?>)"><?php echo '$'. number_format($rate,2);?></td>
                     <td style="cursor: pointer;" id="viewProduct" data-toggle="modal" data-target="#viewProductModal" onclick="viewProduct(<?php echo $productId; ?>)"><?php echo $type;?></td>
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
               echo "<center>No se encontraron productos o servicios</center>";
             }
         	}
         ?>
