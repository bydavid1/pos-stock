<?php require_once 'includes/header.php'; ?>
<?php require_once 'php_action/db_connect.php'; ?> 
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

				<div class="remove-messages"></div>

				<div class="div-action pull pull-right" style="padding-bottom:20px;">
					<button class="btn btn-default button1" > <i class="glyphicon glyphicon-plus-sign"></i> Agregar compra </button>
				</div> <!-- /div-action -->				
				
				<table class="table" id="manageOutlayTable">
					<thead>
						<tr>							
							<th>#</th>
							<th>Fecha</th>
                            <th>Proveedor</th>
							<th>Cantidad</th>
							<th>Estado</th>
							<th>Total</th>
							<th style="width:15%;">Opciones</th>
						</tr>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
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
<script src="custom/js/outlay.js"></script>

<?php require_once 'includes/footer.php'; ?>