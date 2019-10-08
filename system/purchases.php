<?php require_once 'layouts/header.php'; ?>
<?php require_once 'includes/load.php'; ?> 
<?php require_once 'modal/outlayModal.php'; ?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Inicio</a></li>		  
		  <li class="active">Compras</li>
		</ol>

		<div class="panel panel-primary">
	<div class="panel-heading">
			<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Listado de compras</div>
	</div> <!-- /panel-heading -->
		<div class="panel-body">
		<form class="form-horizontal" role="form" id="orders">

			<div class="form-group row">
				<label for="q" class="col-md-2 control-label">Compras</label>
				<div class="col-md-5">
					<input type="text" class="form-control" id="q" placeholder="Ingrese el nombre del cliente" onkeyup='load(1);'>
				</div>
				<div class="col-md-2">
					<button type="button" class="btn btn-default" onclick='load(1);'>
						<span class="glyphicon glyphicon-search" ></span> Buscar</button>
					<span id="loader"></span>
				</div>
			</div>
		</form>
			<div id="resultados"></div><!-- Carga los datos ajax -->
			<div class='outer_div'></div><!-- Carga los datos ajax -->

        </div>
</div>	
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->

	 <!-- remove order -->
	 <div class="modal fade" tabindex="-1" role="dialog" id="removeOutModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Eliminar compra</h4>
      </div>
      <div class="modal-body">

      	<div class="removeOutMessages"></div>

        <p>Realmente deseas eliminar este registro?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
        <button type="button" class="btn btn-primary" id="removeOutBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Eliminar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove order-->

<?php require_once 'layouts/footer.php'; ?>

<script src="custom/js/purchase.js"></script>

