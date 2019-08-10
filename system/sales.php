<?php 
require_once 'php_action/db_connect.php'; 
require_once 'includes/header.php'; 

	echo "<div class='div-request div-hide'>manord</div>";
?>


<div class="panel panel-primary">
	<div class="panel-heading">

		<?php 
		echo	'<i class="glyphicon glyphicon-edit"></i> Gestionar ventas';
		 ?>

	</div> <!--/panel-->	
	<div class="panel-body">

			<div id="success-messages"></div>
			
			<table class="table" id="manageOrderTable">
				<thead>
					<tr>
						<th>#</th>
						<th>Fecha</th>
						<th>Cliente</th>
						<th>Productos</th>
						<th>Sub Total</th>
						<th>Total</th>
						<th>Pago</th>
						<th>Opciones</th>
					</tr>
				</thead>
			</table>

	 
	 <!-- remove order -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeOrderModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Eliminar orden</h4>
      </div>
      <div class="modal-body">

      	<div class="removeOrderMessages"></div>

        <p>Realmente deseas eliminar este registro?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
        <button type="button" class="btn btn-primary" id="removeOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Eliminar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove order-->


<script src="custom/js/order.js"></script>

<?php require_once 'includes/footer.php'; ?>


	