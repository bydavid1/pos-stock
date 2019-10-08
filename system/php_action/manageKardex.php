<?php
require_once '../includes/load.php';

    $action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';

    if($action == 'ajax'){
        $q = remove_junk($_REQUEST['q']);
        $aColumns = array('product_name', 'product_code');//Columnas de busqueda
        $sTable = "product";
        $sWhere = "";
       if ( $_GET['q'] != "" )
       {
           $sWhere = "WHERE status = 1 AND (";
           for ( $i=0 ; $i<count($aColumns) ; $i++ )
           {
               $sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
           }
           $sWhere = substr_replace( $sWhere, "", -3 );
           $sWhere .= ')';
       }
       $sWhere.="order by product_status";
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
       $reload = './kardex.php';
       $sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
       $query = $db->query($sql);
       if ($numrows>0){

           ?>
           <div class="table-responsive">
             <table class="table">
               <tr  class="info">
                   <th>Codigo</th>
                   <th>Nombre</th>
                   <th>Estado</th>
                   <th>Tipo</th>
                   <th class='text-right'>Acciones</th>

               </tr>
               <?php
               while ($row=mysqli_fetch_array($query)){
                       $product_id = $row['product_id'];
                       $cod_product=$row['product_cod'];
                       $produc_name=$row['product_name'];
                       $active=$row['product_status'];
                       $type=$row['product_type'];

                       if($active == 1) {
                        // activate member
                        $active = "<label class='label label-success'>Disponible</label>";
                    } else {
                        // deactivate member
                        $active = "<label class='label label-danger'>No disponible</label>";
                    } // /else


                    if($type == 1) {
                        // activate member
                        $type = "<label class='label label-info'>Fisico</label>";
                    } else if($type == 2){
                        // deactivate member
                        $type = "<label class='label label-success'>Servicio</label>";
                    } else{
                        $type = "<label class='label label-danger'>No especificado</label>";
                    }

                   ?>

                   <input type="hidden" value="<?php echo $cod_product;?>" id="nombre_cliente<?php echo $product_id;?>">
                   <input type="hidden" value="<?php echo $produc_name;?>" id="telefono_cliente<?php echo $product_id;?>">
                   <input type="hidden" value="<?php echo $status;?>" id="email_cliente<?php echo $product_id;?>">
                   <input type="hidden" value="<?php echo $type;?>" id="direccion_cliente<?php echo $product_id;?>">

                   <tr>

                       <td><?php echo $cod_product; ?></td>
                       <td ><?php echo $produc_name; ?></td>
                       <td><?php echo $active;?></td>
                       <td><?php echo $type;?></td>

                   <td ><span class="pull-right">
                   <a href="#" class='btn btn-default' title='Ver kardex' onclick="details('<?php echo $product_id;?>');" data-toggle="modal" data-target="#kardex"><i class="glyphicon glyphicon-folder-open"></i></a>
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
