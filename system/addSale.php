<?php 
require_once 'includes/load.php';
require_once 'layouts/header.php';  
include 'modal/productsOrder.php';
?>

<div class='div-request div-hide'></div>

<ol class="breadcrumb">
	<li><a href="dashboard.php">Inicio</a></li>
	<li>Ventas</li>
	<li class="active">
		Agregar ventas
	</li>
</ol>

<div class="panel panel-primary">
	<div class="panel-heading">

		<i class='glyphicon glyphicon-circle-arrow-right'></i> Agregar venta

	</div>
	<!--/panel-->
	<div class="panel-body">

		<div class="success-messages"></div>
		<!--/success-messages-->


		<form class="form-horizontal" method="POST" action="php_action/createOrder.php" id="createOrderForm">

			<div class="form-group">
				<label for="orderDate" class="col-sm-2 control-label">Fecha de venta</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="orderDate" name="orderDate" autocomplete="off"
						value="<?php echo date("m/d/Y");?>" />
				</div>
			</div>
			<!--/form-group-->
			<div class="form-group">
				<label for="clientName" class="col-sm-2 control-label">Nombre del cliente</label>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="clientName" name="clientName" placeholder="Cliente"
						autocomplete="off" />
				</div>
			</div>
			<!--/form-group-->

			<!--<div id="resultados" class='col-md-12' style="margin-top:20px">

			</div> Carga los datos ajax -->
			<table class="table table-condensed" id="creditTable">
        <thead>
          <tr>
            <th style="width:10%;">Codigo</th>
            <th style="width:20%;">Producto</th>
            <th style="width:10%;">Precio</th>
            <th style="width:10%;">Cantidad</th>
            <th style="width:8%;">Importe</th>
            <th style="width:10%;">Total</th>
            <th style="width:10%;">Eliminar</th>
          </tr>
        </thead>
        <tbody>
          <?php
							$arrayNumber = 0;
							for($x = 1; $x < 2; $x++) {
              ?>
          <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">

            <td>
              <div class="form-group col-sm-12">
                <input type="text" name="productCode[]" id="productCode<?php echo $x; ?>" autocomplete="off"
                  class="form-control" onchange='getProductData(<?php echo $x; ?>)' />
                <input type="hidden" name="productCodeValue[]" id="ProductCodeValue<?php echo $x; ?>" autocomplete="off"
                  class="form-control" />
              </div>
            </td>
            <td>
              <div class="form-group col-sm-12">
                <input type="text" name="productName[]" id="productName<?php echo $x; ?>" autocomplete="off"
                  class="form-control" disabled />
                <input type="hidden" name="productNameValue[]" id="productNameValue<?php echo $x; ?>" autocomplete="off"
                  class="form-control" />
              </div>
            </td>
            <td>
              <div class="form-group col-sm-12">
                <input type="number" name="rate[]" id="rate<?php echo $x; ?>" autocomplete="off" class="form-control"
                  step='0.01' min='0' onkeyup='totalValue(<?php echo $x; ?>)' disabled />
                <input type="hidden" name="rateValue[]" id="rateValue<?php echo $x; ?>" autocomplete="off"
                  class="form-control" />
              </div>
            </td>
            <td>
              <div class="form-group col-sm-12">
                <input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" autocomplete="off"
                  class="form-control" min='1' onkeyup='totalValue(<?php echo $x; ?>)' disabled />
                <input type="hidden" name="quantityValue[]" id="quantityValue<?php echo $x; ?>" autocomplete="off"
                  class="form-control" />
              </div>
            </td>
            <td>
              <div class="form-group col-sm-12">
                <input type="text" value="13%" class="form-control" disabled="true" />
              </div>
            </td>
            <td>
              <div class="form-group col-sm-12">
                <input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control"
                  step='0.01' min='0' disabled="true" />
                <input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off"
                  class="form-control" />
              </div>
            </td>
            <td>

              <button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn"
                onclick="removeProductRow(<?php echo $x; ?>)"><i class="glyphicon glyphicon-trash"></i></button>
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
            <input type="text" class="form-control" id="grandQuantity" name="grandQuantity" disabled="true" />
            <input type="hidden" class="form-control" id="grandQuantityValue" name="grandQuantityValue" />
          </div>
        </div>
        <!--/form-group-->
        <div class="form-group">
          <label for="grandTotal" class="col-sm-3 control-label">Total</label>
          <div class="col-sm-5">
            <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" />
            <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue" />
          </div>
        </div>
        <!--/form-group-->
      </div>

      <input type="hidden" name="trCount" id="trCount" autocomplete="off" class="form-control" />

			<div class="form-group submitButtonFooter">
				<div class="col-sm-offset-2 col-sm-10">
					<button type="submit" id="createOrderBtn" data-loading-text="Cargando..." class="btn btn-success"><i
							class="glyphicon glyphicon-ok-sign"></i> Agregar venta</button>

					<button type="reset" class="btn btn-default" onclick="resetOrderForm()"><i
							class="glyphicon glyphicon-erase"></i> Reiniciar</button>

					<button type="button" class="btn btn-default" data-toggle="modal"
						data-target="#addProductsModal"><span class="glyphicon glyphicon-search"></span> Agregar
						productos</button>
				</div>
			</div>
		</form>

		<script src="custom/js/addOrder.js"></script>

		<?php require_once 'layouts/footer.php'; ?>