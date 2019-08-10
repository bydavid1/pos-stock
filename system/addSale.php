<?php 
require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; 
include 'modal/productsOrder.php';
?>

<div class='div-request div-hide'>add</div>

<ol class="breadcrumb">
  <li><a href="dashboard.php">Inicio</a></li>
  <li>Ventas</li>
  <li class="active">
    Agregar ventas
   </li>
</ol>

<div class="panel panel-primary">
	<div class="panel-heading">

			<i class='glyphicon glyphicon-circle-arrow-right'></i> Agregar venta

	</div> <!--/panel-->	
	<div class="panel-body">

<div class="success-messages"></div> <!--/success-messages-->


<form class="form-horizontal" method="POST" action="php_action/createOrder.php" id="createOrderForm">

<div class="form-group">
  <label for="orderDate" class="col-sm-2 control-label">Fecha de venta</label>
  <div class="col-sm-10">
	<input type="text" class="form-control" id="orderDate" name="orderDate" autocomplete="off" value="<?php echo date("m/d/Y");?>"/>
  </div>
</div> <!--/form-group-->
<div class="form-group">
  <label for="clientName" class="col-sm-2 control-label">Nombre del cliente</label>
  <div class="col-sm-10">
	<input type="text" class="form-control" id="clientName" name="clientName" placeholder="Cliente" autocomplete="off" />
  </div>
</div> <!--/form-group-->
			
      <div id="resultados" class='col-md-12' style="margin-top:20px">

		</div><!-- Carga los datos ajax -->

		<div class="form-group submitButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
			      <button type="submit" id="createOrderBtn" data-loading-text="Cargando..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Agregar venta</button>

			      <button type="reset" class="btn btn-default" onclick="resetOrderForm()"><i class="glyphicon glyphicon-erase"></i> Reiniciar</button>

						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#addProductsModal"><span class="glyphicon glyphicon-search"></span> Agregar productos</button>
			    </div>
			  </div>
			</form>

          <script src="custom/js/addOrder.js"></script>

            <?php require_once 'includes/footer.php'; ?>