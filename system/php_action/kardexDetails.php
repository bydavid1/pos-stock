<?php
require_once '../includes/load.php';

$id = $_POST['id'];
$sql = "SELECT * FROM product WHERE product_id = $id";
$result = $db->query($sql);

while($row = $result->fetch_array()) {

    if($row['product_type'] == 1) {
        // activate member
        $type = "Fisico";
    } else if($row['product_type'] == 2){
        // deactivate member
        $type = "Servicio";
    } else{
        $type = "No especificado";
    }
?>

<form class="form-horizontal">
                        
                <div class='col-sm-6'>
                    <div class="form-group">
                 <label for="code" class="col-sm-3 control-label">Codigo</label>
                   <div class="col-sm-8">
                  <input type="text" class="form-control" id="code" name="code" disabled value="<?php echo $row['product_cod']?>" />
                 </div>
                  </div> <!--/form-group-->
                  <div class="form-group">
                 <label for="code" class="col-sm-3 control-label">Nombre</label>
                   <div class="col-sm-8">
                  <input type="text" class="form-control" id="name" name="name" disabled value="<?php echo $row['product_name']?>" />
                 </div>
                  </div> <!--/form-group-->
                 </div>
                <div class='col-sm-6'>
                    <div class="form-group">
                 <label for="code" class="col-sm-3 control-label">Precio</label>
                   <div class="col-sm-8">
                  <input type="text" class="form-control" id="rate" name="rate" disabled value="<?php echo '$'.number_format($row['price1'], 2)?>"  />
                 </div>
                  </div> <!--/form-group-->
                  <div class="form-group">
                 <label for="code" class="col-sm-3 control-label">Tipo</label>
                   <div class="col-sm-8">
                  <input type="text" class="form-control" id="type" name="type" disabled value="<?php echo $type?>"  />
                 </div>
                  </div> <!--/form-group-->
                 </div>

	</form>

    <?php
}
    include 'pagination.php'; 
    $page = 1;
    $per_page = 10; 
    $adjacents  = 4; 
    $offset = ($page - 1) * $per_page;
    $query = "SELECT count(*) AS numrows FROM kardex WHERE product_id = $id";
    $count_query = $db->query($query);
    $row= $count_query->fetch_array();
    $numrows = $row['numrows'];
    $total_pages = ceil($numrows/$per_page);
    $reload = './kardex.php';
    $sql="SELECT * FROM  kardex WHERE product_id = $id LIMIT $offset,$per_page";
    $res = $db->query($sql);

    if ($numrows>0){
        ?>
        <div class="table-responsive">
          <table class="table">
            <tr  class="info">
                <th>Fecha</th>
                <th>Concepto</th>
                <th>Unidades</th>
                <th>Balance</th>   
            </tr>
            <?php
            while ($row=$res->fetch_array()){
                    $id = $row['kardex_id'];
                    $date=$row['kardex_date'];
                    $concept=$row['kardex_concept'];
                    $quantity=$row['quantity'];
                    $balance=$row['balance'];                 
                ?>
                
                <input type="hidden" value="<?php echo $date;?>" id="date<?php echo $id;?>">
                <input type="hidden" value="<?php echo $concept;?>" id="concept<?php echo $id;?>">
                <input type="hidden" value="<?php echo $quantity;?>" id="quantity<?php echo $id;?>">
                <input type="hidden" value="<?php echo $balance;?>" id="balance<?php echo $id;?>">
                
                <tr>
                    
                    <td><?php echo $date; ?></td>
                    <td ><?php echo $concept; ?></td>
                    <td><?php echo $quantity;?></td>
                    <td><?php echo $balance;?></td>
                    
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
    }else{
        ?>
  
        No se encontraron registros.

      <?php
    }

    ?>