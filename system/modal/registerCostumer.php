<!-- Modal -->
<div class="modal fade" id="nuevoCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar nuevo cliente</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_cliente" name="guardar_cliente">
			<div id="resultados_ajax"></div>
			<div class='col-sm-6' style='margin-top: 10px;'>
			<div class="form-group">
				<label for="telefono" class="col-sm-3 control-label">Codigo</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="code" name="code" autocomplete='off'>
				</div>
			  </div>
				<div class="form-group">
				<label for="telefono" class="col-sm-3 control-label">NIT</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nit" name="nit" autocomplete='off'>
				</div>
			  </div>
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="nombre" name="nombre" required autocomplete='off'>
				</div>
			  </div>
			  <div class="form-group">
				<label for="telefono" class="col-sm-3 control-label">Teléfono</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="telefono" name="telefono" autocomplete='off'>
				</div>
			  </div>
			   <div class="form-group">
				<label for="telefono" class="col-sm-3 control-label">Contacto</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="contact" name="contact" autocomplete='off'>
				</div>
			  </div>
			  <div class="form-group">
				<label for="email" class="col-sm-3 control-label">Email</label>
				<div class="col-sm-8">
					<input type="email" class="form-control" id="email" name="email" autocomplete='off'>
				</div>
			  </div>

        </div>
				<div class='col-sm-6' style='margin-top: 10px;'>

				<div class="form-group">
				<label for="direccion" class="col-sm-3 control-label">Dirección</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="direccion" name="direccion"   maxlength="255" ></textarea>
				  
				</div>
			  </div>
			  
				<div class="form-group">
				<label for="telefono" class="col-sm-3 control-label">Ciudad</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="ciudad" name="ciudad" autocomplete='off'>
				</div>
			  </div>
				<div class="form-group">
				<label for="telefono" class="col-sm-3 control-label">Departamento</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="departament" name="departament" autocomplete='off'>
				</div>
			  </div>

				<div class="form-group">
				<label for="telefono" class="col-sm-3 control-label">Max. Credito</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="credito" name="credito" autocomplete='off'>
				</div>
			  </div>
			 
				<div class="form-group">
				<label for="estado" class="col-sm-3 control-label">Terminos</label>
				<div class="col-sm-8">
				 <select class="form-control" id="terminos" name="terminos" required>
					<option value="1" selected>Efectivo</option>
					<option value="credito">Credito</option>
					<option value="15 dias">15 dias</option>
					<option value="30 dias">30 dias</option>
					<option value="60 dias">60 dias</option>
					<option value="90 dias">90 dias</option>
				  </select>
				</div>
			  </div>

				</div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>