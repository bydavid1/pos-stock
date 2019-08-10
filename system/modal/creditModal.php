<!----------------------------- Modal -------------------------------------------------------------------->
<div class="modal fade" id="viewCreditModal" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
  <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4 class="modal-title">Factura</h4>
  </div>
  <div class="modal-body">
       <div id="gif" style="position: absolute;	text-align: center;	top: 55px;	width: 100%;display:none;"></div><!-- Carga gif animado -->

  <div class="data" ></div><!-- Datos ajax Final -->

  </div>
  <div class="modal-footer">
  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

  </div>
</div>
</div>
</div>

<!------------------------------Fin modal----------------------------------------->

<!--------------------------------Remove credit ------------------------------------------->
<div class="modal fade" tabindex="-1" role="dialog" id="removeCreditModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Eliminar credito</h4>
      </div>
      <div class="modal-body">

      	<div class="removeCreditMessages"></div>

        <p id="message">Realmente deseas eliminar esta factura? Se movera a la papelera</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cancelar</button>
        <button type="button" class="btn btn-primary" id="removeCreditBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Eliminar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
