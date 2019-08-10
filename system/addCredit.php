<?php require_once 'includes/header.php';
 require_once 'php_action/db_connect.php';
include 'modal/productsOrder.php';
include 'modal/costumerModal.php'; ?>

<div class='div-request div-hide'></div>

<ol class="breadcrumb">
  <li><a href="dashboard.php">Inicio</a></li>
  <li>Ventas</li>
  <li class="active">
    Agregar credito fiscal
   </li>
</ol>

<div class="panel panel-primary">
	<div class="panel-heading">

			<i class='glyphicon glyphicon-circle-arrow-right'></i> Agregar credito fiscal

	</div> <!--/panel-->
	<div class="panel-body">
      <div class="success-messages"></div> <!--/success-messages-->

      <form class="form-horizontal" method="POST" action="php_action/createCredit.php" id="createCreditForm">

  <div class="col-sm-6">
    <div class="form-group">
        <label for="outlayDate" class="col-sm-3 control-label">Fecha de credito</label>
        <div class="col-sm-8">
           <input type="text" class="form-control" id="date" name="date" autocomplete="off" value="<?php echo date("m/d/Y");?>"/>
        </div>
    </div> <!--/form-group-->
    <div class="form-group col-sm-12">
       <label for="clientName" class="col-sm-3 control-label">Vendido a:</label>
        <div class="col-sm-7">
	     <input type="text" class="form-control" id="costumer" name="costumer" placeholder="Vendido a" autocomplete="off" onchange="success()"/>
       </div>
       <div class="col-sm-2">
         <button type="button" class="btn btn-default" data-toggle="modal" data-target="#searchCostumer"> <i class="glyphicon glyphicon-search"></i> </button>
       </div>
    </div><!--/form-group-->
    <div class="form-group">
      <label for="description" class="col-sm-3 control-label">Descripcion</label>
      <div class="col-sm-8">
        <textarea  class="form-control" id="description" name="description" placeholder="Descripcion" autocomplete="off">
        </textarea>
      </div>
    </div> <!--/form-group-->
   </div>

   <div class="col-sm-6">
    <div class="form-group">
    <label class='col-sm-2 control-label'>Pago</label>
    <div class="col-sm-8">
	<select class="form-control text-right" name="paymentType" id="paymentType">
				      	<option value="1" >Efectivo</option>
				      	<option value="2" >Credito</option>
	</select>
    </div>
       </div>
       <div class="form-group">
    <label class='col-sm-2 control-label'>Estado</label>
    <div class="col-sm-8">
	<select class="form-control text-right" name="paymentStatus" id="paymentStatus">
				      	<option value="1" >Pago completo</option>
				      	<option value="2" >Pago por adelantado</option>
				      	<option value="3" >No pagado</option>
	</select>
    </div>
       </div>
       <div class="form-group">
    <label class='col-sm-2 control-label'>Entrega</label>
    <div class="col-sm-8">
	<select class="form-control text-right" name="deliveryStatus" id="deliveryStatus">
				      	<option value="1" >Completa</option>
				      	<option value="2" >Parcial</option>
				      	<option value="3" >Pendiente</option>
	</select>
    </div>
       </div>
       <input type="hidden" class="form-control" id="nit" name="nit"/>
       </div>

	<table class="table table-condensed" id="creditTable">
        <thead>
            <tr class="info">
              <th style="width:10%;">Codigo</th>
              <th style="width:20%;">Producto</th>
              <th style="width:10%;">Precio</th>
              <th style="width:10%;">Cantidad</th>
              <th style="width:8%;">Importe</th>
              <th style="width:10%;">Total</th>
              <th style="width:10%;"></th>
            </tr>
        </thead>
        <tbody>
            <?php
							$arrayNumber = 0;
							for($x = 1; $x < 5; $x++) {
              ?>
                <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">

                 <td>
                    <div class="form-group col-sm-12">
                    <input type="text" name="productCode[]" id="productCode<?php echo $x; ?>" autocomplete="off" class="form-control" onchange='getProductData(<?php echo $x; ?>)' />
                    <input type="hidden" name="productCodeValue[]" id="ProductCodeValue<?php echo $x; ?>" autocomplete="off" class="form-control"/>
                    </div>
                    </td>
				  <td>
                    <div class="form-group col-sm-12">
                    <input type="text" name="productName[]" id="productName<?php echo $x; ?>" autocomplete="off" class="form-control" disabled />
                    <input type="hidden" name="productNameValue[]" id="productNameValue<?php echo $x; ?>" autocomplete="off" class="form-control"/>
                    </div>
                    </td>
                    <td>
                    <div class="form-group col-sm-12">
                        <input type="number" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" class="form-control" step='0.01'  min='0' onkeyup='totalValue(<?php echo $x; ?>)' disabled/>
                        <input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off" class="form-control"/>
                    </div>
                    </td>
					<td>
                    <div class="form-group col-sm-12">
                        <input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" autocomplete="off" class="form-control" min='1' onkeyup='totalValue(<?php echo $x; ?>)' disabled/>
                        <input type="hidden" name="quantityValue[]" id="quantityValue<?php echo $x; ?>" autocomplete="off" class="form-control"/>
                        </div>
                    </td>
                    <td>
                    <div class="form-group col-sm-12">
                        <input type="text" value="13%" class ="form-control" disabled="true"/>
                    </div>
                    </td>
                    <td>
                    <div class="form-group col-sm-12">
                        <input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" step='0.01'  min='0' disabled="true"/>
                        <input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control"/>
                    </div>
                    </td>
                    <td>

                        <button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
                    </td>
                </tr>
            <?php
            $arrayNumber++;
            }
            ?>
        </tbody>
    </table>

    <div class="col-md-6">
        </div>
    <div class="col-md-6">
    <div class="form-group">
          <label for="vat" class="col-sm-3 control-label">Cantidad total</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" id="grandQuantity" name="grandQuantity" disabled="true"/>
            <input type="hidden" class="form-control" id="grandQuantityValue" name="grandQuantityValue"/>
          </div>
        </div> <!--/form-group-->
        <div class="form-group">
          <label for="grandTotal" class="col-sm-3 control-label">Total</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true"/>
            <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue"/>
          </div>
        </div> <!--/form-group-->
        </div>

        <input type="hidden" name="trCount" id="trCount" autocomplete="off" class="form-control"/>

            <div class="form-group submitButtonFooter">
			    <div class="col-sm-offset-2 col-sm-10">
				<button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="cargando..."> <i class="glyphicon glyphicon-plus-sign"></i> Añadir fila </button>

	            <button type="submit" class="btn btn-primary" id="createCredit" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>

                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#addProductsModal"><span class="glyphicon glyphicon-search"></span> Ver productos</button>

          </div>
			  </div>


<!-- Prices Modal -->

<div class="modal fade" id="prices" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">

    	<form class="form-horizontal" id="submitBrandForm" action="php_action/createBrand.php" method="POST">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title"><i class="fa fa-edit"></i> Precios de este producto</h4>
	      </div>
	      <div class="modal-body">

	      	<div id="add-brand-messages"></div>

          <div id="prices-success">

          </div>

	      </div> <!-- /modal-body -->

	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>

	        <button type="button" class="btn btn-primary" id="createBrandBtn" data-loading-text="Loading..." autocomplete="off">Cambiar</button>
	      </div>
	      <!-- /modal-footer -->
     	</form>
	     <!-- /.form -->
    </div>
    <!-- /modal-content -->
  </div>
  <!-- /modal-dailog -->
</div>
<!-- / prices modal -->


     	</form> <!-- /.form -->

			 <script src="custom/js/addCredit.js"></script>

       <?php require_once 'includes/footer.php'; ?>
