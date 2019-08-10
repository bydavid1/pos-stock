<?php
	require_once 'core.php';

	$action = (isset($_REQUEST['type'])&& $_REQUEST['type'] !=NULL)?$_REQUEST['type']:'';
	if($action == 'credit'){
         $id = mysqli_real_escape_string($connect,(strip_tags($_REQUEST['id'], ENT_QUOTES)));

         $sql = "SELECT * FROM credits WHERE credit_id = $id";
         $res = $connect->query($sql);
         $row = $res->fetch_array();
         ?>
   <div class="panel panel-success">
     <div class="panel-heading">
       <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Factura Numero <?php echo $row['credit_id'];?></div>
        </div> <!-- /panel-heading -->
      <div class="panel-body">
        <div class="col-sm-12">
          <div class="col-sm-6" style="margin-top: 5px;">
          <b>Cliente: </b><span><?php echo $row['costumer'];?></span><br><br>
          <b>Fecha: </b><span><?php echo $row['credit_date'];?></span>
          </div>
          <div class="col-sm-6" style="margin-top: 5px;">
          <b>Cantidad total: </b><span><?php echo $row['quantity'];?></span><br><br>
          <b>Total $: </b><span><?php echo number_format($row['total'], 2);?></span>
          </div>
        </div>
        <div class="col-sm-12" style="margin-top: 20px;">
      <div class="table-responsive">
			  <table class="table table-striped table-condensed">
				<tr class="info">
				  <th>Codigo</th>
					<th>Producto</th>
					<th>Precio</th>
					<th>Cantidad</th>
          <th>Total</th>
				</tr>
      <?php
      $query = "SELECT * FROM credit_item WHERE credit_id = $id";
      $result = $connect->query($query);

      while ($data = $result->fetch_array()) {
        $code = $data['product_code'];
        $name = $data['product_name'];
        $quantity = $data['quantity'];
        $rate = $data['rate'];
        $total = $data['total'];
     ?>
    <tr>
      <td><?php echo $code;?></td>
      <td><?php echo $name;?></td>
      <td><?php echo $quantity;?></td>
      <td><?php echo $rate;?></td>
      <td><?php echo $total;?></td>
    </tr>
      <?php
      }
       ?>
        </table>
       </div>
      </div>
     </div>
    </div>
    <?php
	}
?>
