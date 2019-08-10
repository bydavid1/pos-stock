<?php require_once 'layouts/header.php'; ?>
<?php include('modal/categoriesModal.php');?>

<div class="row">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Inicio</a></li>		  
		  <li class="active">Categorías</li>
		</ol>

		<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Categorias</div>
		</div> <!-- /panel-heading -->
		<div class="panel-body">
		<form class="form-horizontal" role="form" id="categories">

			<div class="form-group row">
				<label for="q" class="col-md-2 control-label">Categoria</label>
				<div class="col-md-5">
					<input type="text" class="form-control" id="q" placeholder="Ingrese nombre de la categoria" onkeyup='load(1);'>
				</div>
				<div class="col-md-2">
					<button type="button" class="btn btn-default" onclick='load(1);'>
						<span class="glyphicon glyphicon-search" ></span> Buscar</button>
					<span id="loader"></span>
				</div>
				<div class="col-md-2">
					<button type="button" class="btn btn-success" data-toggle="modal" id="addCategorieModalBtn" data-target="#addCategoriesModal"> <i class="glyphicon glyphicon-plus-sign"></i> Agregar categoria </button>
				</div>

			</div>



		</form>
			<div id="resultados"></div><!-- Carga los datos ajax -->
			<div class='outer_div'></div><!-- Carga los datos ajax -->

</div>
</div>	
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->





<script src="custom/js/categories.js"></script>

<?php require_once 'layouts/footer.php'; ?>