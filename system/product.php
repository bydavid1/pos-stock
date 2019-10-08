<?php require_once 'includes/load.php' ?>
<?php require_once 'layouts/header.php'; ?>
<?php require_once 'modal/productModal.php'; ?>

<ol class="breadcrumb">
	<li><a href="dashboard.php">Inicio</a></li>
	<li class="active">Productos</li>
</ol>

<div class="panel panel-primary">
	<div class="panel-heading">
			<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Inventario</div>
	</div> <!-- /panel-heading -->
		<div class="panel-body">
		<form class="form-horizontal" role="form" id="products">

			<div class="form-group row">
				<label for="q" class="col-md-2 control-label">Producto</label>
				<div class="col-md-5">
					<input type="text" class="form-control" id="q" placeholder="Ingrese el codigo o nombre del producto" onkeyup='load(1);'>
				</div>
				<div class="col-md-2">
					<button type="button" class="btn btn-default" onclick='load(1);'>
						<span class="glyphicon glyphicon-search" ></span> Buscar</button>
					<span id="loader"></span>
				</div>
				<div class="col-md-2">
					<button type="button" class="btn btn-success" data-toggle="modal" id="addProductModalBtn" data-target="#addProductModal"> <i class="glyphicon glyphicon-plus-sign"></i> Agregar producto </button>
				</div>

			</div>
		</form>
			<div id="resultados"></div><!-- Carga los datos ajax -->
			<div class='outer_div'></div><!-- Carga los datos ajax -->

        </div>
</div>



<script src="custom/js/product.js"></script>

<?php require_once 'layouts/footer.php'; ?>
