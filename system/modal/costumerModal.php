        <!----------------------------- Modal -------------------------------------------------------------------->
        <div class="modal fade" id="searchCostumer" tabindex="-1" role="dialog">
			  <div class="modal-dialog modal-lg">
				<div class="modal-content">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Buscar clientes</h4>
				  </div>
				  <div class="modal-body">

							<div class="panel panel-default">
			<div class="panel-heading">
				<div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Listado de clientes</div>
			</div> <!-- /panel-heading -->
			<div class="modal-body">
					<form class="form-horizontal">
					  <div class="form-group">
						<div class="col-sm-6">
						  <input type="text" class="form-control" id="v" placeholder="Buscar clientes" onkeyup="load(2)">
						</div>
						<button type="button" class="btn btn-default" onclick="load(2)"><span class='glyphicon glyphicon-search'></span> Buscar</button>
					  </div>
					</form>
					<div id="gif" style="position: absolute;	text-align: center;	top: 55px;	width: 100%;display:none;"></div><!-- Carga gif animado -->
					<div class="data" ></div><!-- Datos ajax Final -->
				  </div>
		</div> <!-- /panel -->
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					
				  </div>
				</div>
			</div>
			</div>

			<!------------------------------Fin modal----------------------------------------->