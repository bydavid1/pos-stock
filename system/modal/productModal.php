<!---------------------------------------------- add product --------------------------------------------->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <form class="form-horizontal" id="submitProductForm" action="php_action/createProduct.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="fa fa-plus"></i> Agregar producto</h4>
                </div>

                <div class="modal-body" style="max-height:450px; overflow:auto;">

                    <div id="add-product-messages"></div>

                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#info" aria-controls="home" role="tab" data-toggle="tab">Información del producto</a></li>
                        <li role="presentation"><a href="#prices" aria-controls="profile" role="tab" data-toggle="tab">Precios</a></li>
                        <li role="presentation"><a href="#image" aria-controls="profile" role="tab" data-toggle="tab">Foto</a></li>
                    </ul>

                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane active" id="info">

                            <br>
                            <div class="form-group">
                                <label for="codProduct" class="col-sm-3 control-label">Codigo: </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control input-sm" id="codProduct" placeholder="Codigo del producto" name="codProduct" autocomplete="off">
                                </div>
                            </div>
                            <!-- /form-group-->

                            <div class="form-group">
                                <label for="productName" class="col-sm-3 control-label">Nombre: </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control input-sm" id="productName" placeholder="Nombre del producto" name="productName" autocomplete="off">
                                </div>
                            </div>
                            <!-- /form-group-->

                            <div class="form-group">
                                <label for="provName" class="col-sm-3 control-label">Fabricante: </label>
                                <div class="col-sm-8">
                                    <select class="form-control input-sm" id="provName" name="provName">
                                        <option value="">-- Selecciona --</option>
                                        <?php
				      	$sql = "SELECT prov_id, prov_name, prov_active, prov_status FROM providers WHERE prov_status = 1 AND prov_active = 1";
								$result = $db->query($sql);

								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} // while

				      	?>
                                    </select>
                                </div>
                            </div>
                            <!-- /form-group-->

                            <div class="form-group">
                                <label for="categoryName" class="col-sm-3 control-label">Categoría: </label>
                                <div class="col-sm-8">
                                    <select type="text" class="form-control input-sm" id="categoryName" placeholder="Product Name" name="categoryName">
                                        <option value="">-- Selecciona --</option>
                                        <?php
				      	$sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1 AND categories_active = 1";
								$result = $db->query($sql);

								while($row = $result->fetch_array()) {
									echo "<option value='".$row[0]."'>".$row[1]."</option>";
								} // while

				      	?>
                                    </select>
                                </div>
                            </div>
                            <!-- /form-group-->

                            <div class="form-group">
                                <label for="productStatus" class="col-sm-3 control-label">Estado: </label>
                                <div class="col-sm-8">
                                    <select class="form-control input-sm" id="productStatus" name="productStatus">
                                        <option value="1">Disponible</option>
                                        <option value="2">No disponible</option>
                                    </select>
                                </div>
                            </div>
                            <!-- /form-group-->
                            <div class="form-group">
                                <label for="type" class="col-sm-3 control-label">Tipo: </label>
                                <div class="col-sm-8">
                                    <select class="form-control input-sm" id="type" name="type">
                                        <option value="1">Fisico</option>
                                        <option value="2">Servicio</option>
                                        <option value="3">No especificado</option>
                                    </select>
                                </div>
                            </div>
                            <!-- /form-group-->

                            <div class="form-group">
                                <label for="quantity" class="col-sm-3 control-label">Stock: </label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control input-sm" id="quantity" placeholder="Stock" name="quantity" autocomplete="off">
                                </div>
                            </div>
                            <!-- /form-group-->

                        </div>
                        <div role="tabpanel" class="tab-pane" id="prices">

                            <br>
                            <div class="col-sm-12">
                                <div class="input-group" id="message">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                                    <input type="decimal" class="form-control input-sm" id="purchase_price" placeholder="Precio de compra" name="purchase_price" autocomplete="off" />
                                </div>
                            </div>
                            <!-- /form-group-->

                            <br>
                            <br>

                            <div class="col-sm-4">

                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                                        <input type="decimal" class="form-control input-sm" id="price1" placeholder="Precio 1" name="price1" onkeyup="calculate('price1', 'add')" autocomplete="off" />
                                    </div>
                                </div>
                                <!-- /form-group-->
                                <br>
                                <br>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                                        <input type="decimal" class="form-control input-sm" id="price2" placeholder="Precio 2" name="price2" onkeyup="calculate('price2', 'add')" autocomplete="off" />
                                    </div>
                                </div>
                                <!-- /form-group-->
                                <br>
                                <br>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                                        <input type="decimal" class="form-control input-sm" id="price3" placeholder="Precio 3" name="price3" onkeyup="calculate('price3', 'add')" autocomplete="off" />
                                    </div>
                                </div>
                                <!-- /form-group-->
                                <br>
                                <br>
                                <div class="col-sm-12">
                                    <div class="input-group" id="alert">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                                        <input type="decimal" class="form-control input-sm" id="price4" placeholder="Precio 4" name="price4" onkeyup="calculate('price4', 'add')" autocomplete="off" />
                                    </div>
                                </div>
                                <!-- /form-group-->

                            </div>
                            <div class="col-sm-4">

                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-transfer"></i></span>
                                        <input type="decimal" class="form-control input-sm" id="utility1" placeholder="Utilidad 1" name="utility1" onkeyup="calculate('utility1', 'add')" autocomplete="off" />
                                    </div>
                                </div>
                                <!-- /form-group-->
                                <br>
                                <br>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-transfer"></i></span>
                                        <input type="decimal" class="form-control input-sm" id="utility2" placeholder="Utilidad 2" name="utility2" onkeyup="calculate('utility2', 'add')" autocomplete="off" />
                                    </div>
                                </div>
                                <!-- /form-group-->
                                <br>
                                <br>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-transfer"></i></span>
                                        <input type="decimal" class="form-control input-sm" id="utility3" placeholder="Utilidad 3" name="utility3" onkeyup="calculate('utility3', 'add')" autocomplete="off" />
                                    </div>
                                </div>
                                <!-- /form-group-->
                                <br>
                                <br>
                                <div class="col-sm-12">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-transfer"></i></span>
                                        <input type="decimal" class="form-control input-sm" id="utility4" placeholder="Utilidad 4" name="utility4" onkeyup="calculate('utility4', 'add')" autocomplete="off" />
                                    </div>
                                </div>
                                <!-- /form-group-->

                            </div>

                        </div>

                        <div role="tabpanel" class="tab-pane" id="image">
                            <br>
                            <div class="form-group">
                                <label for="productImage" class="col-sm-3 control-label">Imagen: </label>
                                <div class="col-sm-8">
                                    <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>
                                    <div class="kv-avatar center-block">
                                        <input type="file" class="form-control" id="productImage" placeholder="Imagen del producto" name="productImage" class="file-loading" style="width:auto;" />
                                    </div>

                                </div>
                            </div>
                            <!-- /form-group-->
                        </div>

                    </div>
                    <!--tab content-->
                </div>
                <!-- /modal-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>

                    <button type="submit" class="btn btn-primary" id="createProductBtn" data-loading-text="Loading..." autocomplete="off"> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
                </div>
                <!-- /modal-footer -->
            </form>
            <!-- /.form -->
        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>
<!-- /add categories -->

<!------------------------------------------ edit product ------------------------------------------>
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Editar producto</h4>
            </div>
            <div class="modal-body" style="max-height:450px; overflow:auto;">

                <div class="div-loading">
                    <span class="sr-only">Cargando...</span>
                </div>

                <div class="div-result">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#productInfo" aria-controls="home" role="tab" data-toggle="tab">Informacion</a></li>
                        <li role="presentation"><a href="#photo" aria-controls="profile" role="tab" data-toggle="tab">Foto</a></li>

                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">

                        <div role="tabpanel" class="tab-pane" id="photo">
                            <form action="php_action/editProductImage.php" method="POST" id="updateProductImageForm" class="form-horizontal" enctype="multipart/form-data">

                                <br />
                                <div id="edit-productPhoto-messages"></div>

                                <div class="form-group">
                                    <label for="editProductImage" class="col-sm-3 control-label">Imagen: </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <img src="" id="getProductImage" class="thumbnail" style="width:250px; height:250px;" />
                                    </div>
                                </div>
                                <!-- /form-group-->

                                <div class="form-group">
                                    <label for="editProductImage" class="col-sm-3 control-label">Selecciona imagen: </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <!-- the avatar markup -->
                                        <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>
                                        <div class="kv-avatar center-block">
                                            <input type="file" class="form-control" id="editProductImage" placeholder="Product Name" name="editProductImage" class="file-loading" style="width:auto;" />
                                        </div>

                                    </div>
                                </div>
                                <!-- /form-group-->

                                <div class="modal-footer editProductPhotoFooter">
                                </div>
                                <!-- /modal-footer -->
                            </form>
                            <!-- /form -->
                        </div>
                        <!-- product image -->
                        <div role="tabpanel" class="tab-pane active" id="productInfo">
                            <form class="form-horizontal" id="editProductForm" action="php_action/editProduct.php" method="POST">
                                <br />
                                <div id="edit-product-messages"></div>

                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Editar informacion</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="editProductCode" class="col-sm-2 control-label">Codigo: </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="editProductCode" placeholder="Nombre del producto" name="editProductCode" autocomplete="off">
                                            </div>
                                        </div>
                                        <!-- /form-group-->

                                        <div class="form-group">
                                            <label for="editProductName" class="col-sm-2 control-label">Nombre: </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="editProductName" placeholder="Nombre del producto" name="editProductName" autocomplete="off">
                                            </div>
                                        </div>
                                        <!-- /form-group-->

                                        <div class="form-group">
                                            <label for="editQuantity" class="col-sm-2 control-label">Stock: </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="editQuantity" placeholder="Stock" name="editQuantity" autocomplete="off">
                                            </div>
                                        </div>
                                        <!-- /form-group-->

                                        <div class="form-group">
                                            <label for="editprovName" class="col-sm-2 control-label">Fabricante: </label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="editprovName" name="editprovName">
                                                    <?php
                                  $sql = "SELECT prov_id, prov_name, prov_active, prov_status FROM providers WHERE prov_status = 1 AND prov_active = 1";
                                  $result = $db->query($sql);
                                  while($row = $result->fetch_array()) {
                                    echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                  } // while

                                  ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- /form-group-->

                                        <div class="form-group">
                                            <label for="editCategoryName" class="col-sm-2 control-label">Categoría: </label>
                                            <div class="col-sm-8">
                                                <select type="text" class="form-control" id="editCategoryName" name="editCategoryName">
                                                    <?php
                                  $sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1 AND categories_active = 1";
                                  $result = $db->query($sql);
                                  while($row = $result->fetch_array()) {
                                    echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                  } // while

                                  ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- /form-group-->

                                        <div class="form-group">
                                            <label for="editProductStatus" class="col-sm-2 control-label">Estado: </label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="editProductStatus" name="editProductStatus">
                                                    <option value="1">Disponible</option>
                                                    <option value="2">No disponible</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- /form-group-->
                                        <div class="form-group">
                                            <label for="editType" class="col-sm-2 control-label">Tipo: </label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="editType" name="editType">
                                                    <option value="1">Fisico</option>
                                                    <option value="2">Servicio</option>
                                                    <option value="3">No especificado</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- /form-group-->
                                    </div>
                                </div>

                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Editar precios</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label for="editPurchasePrice" class="col-sm-2 control-label">Precio de compra: </label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="editPurchasePrice" placeholder="precio de compra" name="editPurchasePrice" autocomplete="off">
                                            </div>
                                        </div>
                                        <!-- /form-group-->

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="editPrice1" class="col-sm-3 control-label">Precio 1: </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="editPrice1" placeholder="Precio 1" name="editPrice1" onkeyup="calculate('editPrice1', 'edit')" autocomplete="off">
                                                </div>
                                            </div>
                                            <!-- /form-group-->
                                            <div class="form-group">
                                                <label for="editPrice2" class="col-sm-3 control-label">Precio 2: </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="editPrice2" placeholder="Precio 2" name="editPrice2" onkeyup="calculate('editPrice2', 'edit')" autocomplete="off">
                                                </div>
                                            </div>
                                            <!-- /form-group-->
                                            <div class="form-group">
                                                <label for="editPrice3" class="col-sm-3 control-label">Precio 3: </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="editPrice3" placeholder="Precio 3" name="editPrice3" onkeyup="calculate('editPrice3', 'edit')" autocomplete="off">
                                                </div>
                                            </div>
                                            <!-- /form-group-->
                                            <div class="form-group">
                                                <label for="editPrice4" class="col-sm-3 control-label">Precio 4: </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="editPrice4" placeholder="Precio 4" name="editPrice4" onkeyup="calculate('editPrice4', 'edit')" autocomplete="off">
                                                </div>
                                            </div>
                                            <!-- /form-group-->
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="editUtility1" class="col-sm-4 control-label">Utilidad 1: </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="editUtility1" placeholder="Utilidad 1" name="editUtility1" onkeyup="calculate('editUtility1', 'edit')" autocomplete="off">
                                                </div>
                                            </div>
                                            <!-- /form-group-->
                                            <div class="form-group">
                                                <label for="editUtility2" class="col-sm-4 control-label">Utilidad 2: </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="editUtility2" placeholder="Utilidad 2" name="editUtility2" onkeyup="calculate('editUtility2', 'edit')" autocomplete="off">
                                                </div>
                                            </div>
                                            <!-- /form-group-->
                                            <div class="form-group">
                                                <label for="editUtility3" class="col-sm-4 control-label">Utilidad 3: </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="editUtility3" placeholder="Utilidad 3" name="editUtility3" onkeyup="calculate('editUtility3', 'edit')" autocomplete="off">
                                                </div>
                                            </div>
                                            <!-- /form-group-->
                                            <div class="form-group">
                                                <label for="editUtility4" class="col-sm-4 control-label">Utilidad 4: </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="editUtility4" placeholder="Utilidad 4" name="editUtility4" onkeyup="calculate('editUtility4', 'edit')" autocomplete="off">
                                                </div>
                                            </div>
                                            <!-- /form-group-->
                                            <input type="hidden" class="form-control" id="id" name="id">
                                        </div>
                                    </div>
                                </div>

                        </div>
                        <!-- /product info -->
                    </div>
                </div>
            </div>
            <!-- /modal-body -->

            <div class="modal-footer editProductFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>

                <button type="submit" class="btn btn-success" id="editProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Guardar cambios</button>
            </div>
            <!-- /modal-footer -->
            </form>
            <!-- /.form -->

        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>
<!-- /categories prov -->

<!------------------------------------------ View Product ------------------------------------------>
<div class="modal fade" id="viewProductModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-edit"></i> Informacion</h4>
            </div>
            <div class="modal-body" style="max-height:450px; overflow:auto;">

                <div class="div-result">

                    <form class="form-horizontal">
                        <div class="col-sm-12">
                            <div class="col-sm-4">
                                <div class="form-group" style="margin-top: 20px;">
                                    <div class="col-sm-6">
                                        <img src="" id="imageProduct" class="thumbnail" style="width:220px; height:220px;" />
                                    </div>
                                </div>
                                <!-- /form-group-->
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                    <label for="vCod" class="col-sm-2 control-label">Codigo: </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control input-sm" id="vCod" disabled>
                                    </div>
                                </div>
                                <!-- /form-group-->

                                <div class="form-group">
                                    <label for="vName" class="col-sm-2 control-label">Nombre: </label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control input-sm" id="vName" disabled>
                                    </div>
                                </div>
                                <!-- /form-group-->

                                <div class="form-group">
                                    <label for="vStock" class="col-sm-2 control-label">Stock: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-sm" id="vStock" disabled>
                                    </div>
                                </div>
                                <!-- /form-group-->

                                <div class="form-group">
                                    <label for="vprov" class="col-sm-2 control-label">Fabricante: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-sm" id="vProv" disabled>
                                    </div>
                                </div>
                                <!-- /form-group-->

                                <div class="form-group">
                                    <label for="vCategory" class="col-sm-2 control-label">Categoría: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-sm" id="vCategory" disabled>
                                    </div>
                                </div>
                                <!-- /form-group-->
                                <div class="form-group">
                                    <label for="vType" class="col-sm-2 control-label">Tipo: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-sm" id="vType" disabled>
                                    </div>
                                </div>
                                <!-- /form-group-->
                                <div class="form-group">
                                    <label for="vPurchasePrice" class="col-sm-2 control-label">Precio de compra: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-sm" id="vPurchasePrice" disabled>
                                    </div>
                                </div>
                                <!-- /form-group-->
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="vPrice1" class="col-sm-4 control-label">Precio 1: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-sm" id="vPrice1" disabled>
                                    </div>
                                </div>
                                <!-- /form-group-->
                                <div class="form-group">
                                    <label for="vPrice2" class="col-sm-4 control-label">Precio 2: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-sm" id="vPrice2" disabled>
                                    </div>
                                </div>
                                <!-- /form-group-->
                                <div class="form-group">
                                    <label for="vPrice3" class="col-sm-4 control-label">Precio 3: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-sm" id="vPrice3" disabled>
                                    </div>
                                </div>
                                <!-- /form-group-->
                                <div class="form-group">
                                    <label for="vPrice4" class="col-sm-4 control-label">Precio 4: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-sm" id="vPrice4" disabled>
                                    </div>
                                </div>
                                <!-- /form-group-->
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="vUtility1" class="col-sm-4 control-label">Utilidad 1: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-sm" id="vUtility1" disabled>
                                    </div>
                                </div>
                                <!-- /form-group-->
                                <div class="form-group">
                                    <label for="vUtility2" class="col-sm-4 control-label">Utilidad 2: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-sm" id="vUtility2" disabled>
                                    </div>
                                </div>
                                <!-- /form-group-->
                                <div class="form-group">
                                    <label for="vUtility3" class="col-sm-4 control-label">Utilidad 3: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-sm" id="vUtility3" disabled>
                                    </div>
                                </div>
                                <!-- /form-group-->
                                <div class="form-group">
                                    <label for="vUtility4" class="col-sm-4 control-label">Utilidad 4: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control input-sm" id="vUtility4" disabled>
                                    </div>
                                </div>
                                <!-- /form-group-->
                                <input type="hidden" class="form-control" id="id" placeholder="Utilidad 4" name="id">
                            </div>
                        </div>
                    </form>
                    <!-- /.form -->
                </div>
            </div>
            <!-- /modal-body -->

            <div class="modal-footer editProductFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cerrar</button>
            </div>
            <!-- /modal-footer -->

        </div>
        <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
</div>
<!-- /categories prov -->

<!-------------------------------------Remove Product ------------------------------------------->
<div class="modal fade" tabindex="-1" role="dialog" id="removeProductModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="glyphicon glyphicon-trash"></i> Eliminar producto</h4>
            </div>
            <div class="modal-body">

                <div class="removeProductMessages"></div>

                <p id="message">¿Realmente deseas eliminar el producto? Se movera a la palera</p>
            </div>
            <div class="modal-footer removeProductFooter">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Cancelar</button>
                <button type="button" class="btn btn-primary" id="removeProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Eliminar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->