<?php 
require_once 'includes/load.php';
require_once 'layouts/header.php';    
?>
<ol class="breadcrumb">
	<li><a href="dashboard.php">Inicio</a></li>
	<li class="active">Kardex</li>
</ol>

	<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Listado productos</div>
			</div> <!-- /panel-heading -->
			<div class="panel-body">
			<form class="form-horizontal" role="form" id="datos_cotizacion">
				
						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Buscar producto</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Nombre del producto" onkeyup='load(1);'>
							</div>
							<div class="col-md-3">
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
    <?php 
    include("modal/kardexModal.php");
	include("layouts/footer.php");
	?>
	<script type="text/javascript" src="custom/js/kardex.js"></script>