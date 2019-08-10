var manageProductTable;

$(document).ready(function() {
    //Data
    load(1);
    // top nav bar
    $('#navProduct').addClass('active');

    // add product modal btn clicked
    $("#addProductModalBtn").unbind('click').bind('click', function() {
        // // product form reset
        $("#submitProductForm")[0].reset();

        // remove text-error
        $(".text-danger").remove();
        // remove from-group error
        $(".form-group").removeClass('has-error').removeClass('has-success');

        $("#productImage").fileinput({
            overwriteInitial: true,
            maxFileSize: 2500,
            showClose: false,
            showCaption: false,
            browseLabel: '',
            removeLabel: '',
            browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>',
            removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
            removeTitle: 'Cancel or reset changes',
            elErrorContainer: '#kv-avatar-errors-1',
            msgErrorClass: 'alert alert-block alert-danger',
            defaultPreviewContent: '<img src="assests/images/photo_default.png" alt="Profile Image" style="width:100%;">',
            layoutTemplates: {
                main2: '{preview} {remove} {browse}'
            },
            allowedFileExtensions: ["jpg", "png", "gif", "JPG", "PNG", "GIF"]
        });

        // submit product form
        $("#submitProductForm").unbind('submit').bind('submit', function() {

            $('.form-group').removeClass('has-error').removeClass('has-success');
            $('.text-danger').remove();

            // form validation
            var codProduct = $("#codProduct").val();
            var productName = $("#productName").val();
            var quantity = $("#quantity").val();
            var price = $("#purchase_price").val();
            var productStatus = $("#productStatus").val();
            var type = $("#type").val();
            var count = 0;
            var validate;
            var price1 = $("#price1").val();
            var price2 = $("#price2").val();
            var price3 = $("#price3").val();
            var price4 = $("#price4").val();

            //prices validation

            if (price1 != '') {
                count++;
            }
            if (price2 != '') {
                count++;
            }
            if (price3 != '') {
                count++;
            }
            if (price4 != '') {
                count++;
            }

            if (count < 1) {
                $("#alert").after('<p class="text-danger"> Ingresa al menos un precio </p>');
                $('#price1').closest('.input-group').addClass('has-error');
                $('#price2').closest('.input-group').addClass('has-error');
                $('#price3').closest('.input-group').addClass('has-error');
                $('#price4').closest('.input-group').addClass('has-error');
                $('#utility1').closest('.input-group').addClass('has-error');
                $('#utility2').closest('.input-group').addClass('has-error');
                $('#utility3').closest('.input-group').addClass('has-error');
                $('#utility4').closest('.input-group').addClass('has-error');

                validate = false;
            } else {
                $('#price1').closest('.input-group').addClass('has-success');
                $('#price2').closest('.input-group').addClass('has-success');
                $('#price3').closest('.input-group').addClass('has-success');
                $('#price4').closest('.input-group').addClass('has-success');
                $('#utility1').closest('.input-group').addClass('has-success');
                $('#utility2').closest('.input-group').addClass('has-success');
                $('#utility3').closest('.input-group').addClass('has-success');
                $('#utility4').closest('.input-group').addClass('has-success');

                validate = true;
            }

            // form validation
            if (type == "") {
                $("#type").after('<p class="text-danger"> Este campo es obligatorio </p>');
                $('#type').closest('.form-group').addClass('has-error');
            } else {
                $('#type').closest('.form-group').addClass('has-success');
            } // /else

            // form validation
            if (codProduct == "") {
                $("#codProduct").after('<p class="text-danger"> Este campo es obligatorio </p>');
                $('#codProduct').closest('.form-group').addClass('has-error');
            } else {
                $('#codProduct').closest('.form-group').addClass('has-success');
            } // /else


            if (productName == "") {
                $("#productName").after('<p class="text-danger">Este campo es obligatorio</p>');
                $('#productName').closest('.form-group').addClass('has-error');
            } else {
                // remov error text field
                $("#productName").find('.text-danger').remove();
                // success out for form
                $("#productName").closest('.form-group').addClass('has-success');
            } // /else

            if (quantity == "") {
                $("#quantity").after('<p class="text-danger">Este campo es obligatorio</p>');
                $('#quantity').closest('.form-group').addClass('has-error');
            } else {
                // remov error text field
                $("#quantity").find('.text-danger').remove();
                // success out for form
                $("#quantity").closest('.form-group').addClass('has-success');
            } // /else

            if (price == "") {
                $("#message").after('<p class="text-danger">Este campo es obligatorio</p>');
                $('#purchase_price').closest('.form-group').addClass('has-error');
            } else {
                // remov error text field
                $("#purchase_price").find('.text-danger').remove();
                // success out for form
                $("#purchase_price").closest('.form-group').addClass('has-success');
            } // /else

            if (productStatus == "") {
                $("#productStatus").after('<p class="text-danger">Este campo es obligatorio</p>');
                $('#productStatus').closest('.form-group').addClass('has-error');
            } else {
                // remov error text field
                $("#productStatus").find('.text-danger').remove();
                // success out for form
                $("#productStatus").closest('.form-group').addClass('has-success');
            } // /else

            if (codProduct && productName && quantity && price && productStatus && type && validate == true) {
                // submit loading button
                $("#createProductBtn").button('loading');

                var form = $(this);
                var formData = new FormData(this);

                $.ajax({
                    url: form.attr('action'),
                    type: form.attr('method'),
                    data: formData,
                    dataType: 'json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        if (response.success == true) {
                            // submit loading button
                            $("#createProductBtn").button('reset');

                            $("#submitProductForm")[0].reset();

                            $("html, body, div.modal, div.modal-content, div.modal-body").animate({
                                scrollTop: '0'
                            }, 100);

                            // shows a successful message after operation
                            $('#add-product-messages').html('<div class="alert alert-success">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                '</div>');
                            load(1);
                            // remove the mesages

                            $("#createProductBtn").button('reset');

                            $("#message").hide();
                            $(".alert-success").delay(500).show(10, function() {
                                $(this).delay(3000).hide(10, function() {
                                    $(this).remove();
                                });
                            }); // /.alert


                            // remove text-error
                            $(".text-danger").remove();
                            // remove from-group error
                            $(".form-group").removeClass('has-error').removeClass('has-success');

                        } else {
                            $('#add-product-messages').html('<div class="alert alert-danger">' +
                                '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                '</div>');

                            $("#createProductBtn").button('reset');
                        } // /if response.success

                    } // /success function
                }); // /ajax function
            } else {
                $('#add-product-messages').html('<div class="alert alert-warning">' +
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                    '<strong><i class="glyphicon glyphicon-exclamation-sign"></i></strong> Faltan datos importantes' +
                    '</div>');

                // remove the mesages
                $(".alert-warning").delay(500).show(10, function() {
                    $(this).delay(3000).hide(10, function() {
                        $(this).remove();
                    });
                }); // /.alert
                $("#createProductBtn").button('reset');
            } // /if validation is ok

            return false;
        }); // /submit product form

    }); // /add product modal btn clicked


    // remove product

}); // document.ready fucntion

function load(page) {
    var q = $("#q").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url: './php_action/manageProduct.php?action=ajax&page=' + page + '&q=' + q,
        beforeSend: function(objeto) {
            $('#loader').html('<img src="./assests/images/ajax-loader.gif"> Cargando...');
        },
        success: function(data) {
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');

        }
    })
}

function editProduct(productId = null) {
    if (productId) {
        $("#productId").remove();
        // remove text-error
        $(".text-danger").remove();
        // remove from-group error
        $(".form-group").removeClass('has-error').removeClass('has-success');

        $('.div-loading').hide();
        // modal div
        $('.div-result').hide();

        $.ajax({
            url: 'php_action/fetchSelectedProduct.php',
            type: 'post',
            data: {
                productId: productId
            },
            dataType: 'json',
            success: function(response) {
                // modal div
                $('.div-loading').show();
                $('.div-result').show();

                $("#getProductImage").attr('src', 'system/' +  response.product_image);

                $("#editProductImage").fileinput({});
                $(".editProductPhotoFooter").append('<input type="hidden" name="productId" id="productId" value="' + response.product_id + '" />');

                $("#id").val(response.product_id);

                $("#editProductCode").val(response.product_cod);
                // product name
                $("#editProductName").val(response.product_name);
                // quantity
                $("#editQuantity").val(response.quantity);
                // rate
                var purchase = parseFloat(response.purchase_price);
                purchase = purchase.toFixed(2);
                $("#editPurchasePrice").val(purchase);
                // prov name
                $("#editprovName").val(response.prov_name);

                $("#editType").val(response.product_type);
                // category name
                $("#editCategoryName").val(response.categories_name);
                // status
                $("#editProductStatus").val(response.product_status);

                var price1 = parseFloat(response.price1);
                price1 = price1.toFixed(2);
                $("#editPrice1").val(price1);

                var price2 = parseFloat(response.price2);
                price2 = price2.toFixed(2);
                $("#editPrice2").val(price2);

                var price3 = parseFloat(response.price3);
                price3 = price3.toFixed(2);
                $("#editPrice3").val(price3);

                var price4 = parseFloat(response.price4);
                price4 = price4.toFixed(2);
                $("#editPrice4").val(price4);

                var utility1 = parseFloat(response.utility1);
                utility1 = utility1.toFixed(2);
                $("#editUtility1").val(utility1);

                var utility2 = parseFloat(response.utility2);
                utility2 = utility2.toFixed(2);
                $("#editUtility2").val(utility2);

                var utility3 = parseFloat(response.utility3);
                utility3 = utility3.toFixed(2);
                $("#editUtility3").val(utility3);

                var utility4 = parseFloat(response.utility4);
                utility4 = utility4.toFixed(2);
                $("#editUtility4").val(utility4);

                // update the product data function
                $("#editProductForm").unbind('submit').bind('submit', function() {

                    // remove text-error
                    $(".text-danger").remove();
                    // remove from-group error
                    $(".form-group").removeClass('has-error').removeClass('has-success');

                    // form validation
                    var productCode = $("#editProductCode").val();
                    var productName = $("#editProductName").val();
                    var quantity = $("#editQuantity").val();
                    var purchase_price = $("#editPurchasePrice").val();
                    var type = $("#editType").val();
                    var productStatus = $("#editProductStatus").val();

                    var count = 0;
                    var validate;
                    var price1 = $("#editprice1").val();
                    var price2 = $("#editprice2").val();
                    var price3 = $("#editprice3").val();
                    var price4 = $("#editprice4").val();

                    //prices validation

                    if (price1 != '') {
                        count++;
                    }
                    if (price2 != '') {
                        count++;
                    }
                    if (price3 != '') {
                        count++;
                    }
                    if (price4 != '') {
                        count++;
                    }


                    if (count < 1) {
                        $('#editPrice1').closest('.form-group').addClass('has-error');
                        $('#editPrice2').closest('.form-group').addClass('has-error');
                        $('#editPrice3').closest('.form-group').addClass('has-error');
                        $('#editPrice4').closest('.form-group').addClass('has-error');
                        $('#editUtility1').closest('.form-group').addClass('has-error');
                        $('#editUtility2').closest('.form-group').addClass('has-error');
                        $('#editUtility3').closest('.form-group').addClass('has-error');
                        $('#editUtility4').closest('.form-group').addClass('has-error');

                        validate = false;
                    } else {
                        $('#editPrice1').closest('.form-group').addClass('has-success');
                        $('#editPrice2').closest('.form-group').addClass('has-success');
                        $('#editPrice3').closest('.form-group').addClass('has-success');
                        $('#editPrice4').closest('.form-group').addClass('has-success');
                        $('#editUtility1').closest('.form-group').addClass('has-success');
                        $('#editUtility2').closest('.form-group').addClass('has-success');
                        $('#editUtility3').closest('.form-group').addClass('has-success');
                        $('#editUtility4').closest('.form-group').addClass('has-success');

                        validate = true;
                    }


                    if (productCode == "") {
                        $("#editProductCode").after('<p class="text-danger">Este campo es obligatorio</p>');
                        $('#editProductCode').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editProductCode").find('.text-danger').remove();
                        // success out for form
                        $("#editProductCode").closest('.form-group').addClass('has-success');
                    } // /else

                    if (productName == "") {
                        $("#editProductName").after('<p class="text-danger">Este campo es obligatorio</p>');
                        $('#editProductName').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editProductName").find('.text-danger').remove();
                        // success out for form
                        $("#editProductName").closest('.form-group').addClass('has-success');
                    } // /else

                    if (quantity == "") {
                        $("#editQuantity").after('<p class="text-danger">Este campo es obligatorio</p>');
                        $('#editQuantity').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editQuantity").find('.text-danger').remove();
                        // success out for form
                        $("#editQuantity").closest('.form-group').addClass('has-success');
                    } // /else

                    if (purchase_price == "") {
                        $("#editPurchasePrice").after('<p class="text-danger">Este campo es obligatorio</p>');
                        $('#editPurchasePrice').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editPurchasePrice").find('.text-danger').remove();
                        // success out for form
                        $("#editPurchasePrice").closest('.form-group').addClass('has-success');
                    } // /else

                    if (productStatus == "") {
                        $("#editProductStatus").after('<p class="text-danger">Este campo es obligatorio</p>');
                        $('#editProductStatus').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editProductStatus").find('.text-danger').remove();
                        // success out for form
                        $("#editProductStatus").closest('.form-group').addClass('has-success');
                    } // /else

                    if (type == "") {
                        $("#editType").after('<p class="text-danger">Este campo es obligatorio</p>');
                        $('#editType').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editType").find('.text-danger').remove();
                        // success out for form
                        $("#editType").closest('.form-group').addClass('has-success');
                    } // /else

                    if (productCode && productName && quantity && purchase_price && productStatus && type && validate == true) {
                        // submit loading button
                        $("#editProductBtn").button('loading');

                        var form = $(this);
                        var formData = new FormData(this);

                        $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: formData,
                            dataType: 'json',
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                if (response.success == true) {
                                    // submit loading button
                                    $("#editProductBtn").button('reset');

                                    $("html, body, div.modal, div.modal-content, div.modal-body").animate({
                                        scrollTop: '0'
                                    }, 100);

                                    // shows a successful message after operation
                                    $('#edit-product-messages').html('<div class="alert alert-success">' +
                                        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                        '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                        '</div>');

                                    load(1);

                                    // remove the mesages
                                    $(".alert-success").delay(500).show(10, function() {
                                        $(this).delay(3000).hide(10, function() {
                                            $(this).remove();
                                        });
                                    }); // /.alert

                                    // remove text-error
                                    $(".text-danger").remove();
                                    // remove from-group error
                                    $(".form-group").removeClass('has-error').removeClass('has-success');


                                } else {
                                    // submit loading button
                                    $("#editProductBtn").button('reset');

                                    $("html, body, div.modal, div.modal-content, div.modal-body").animate({
                                        scrollTop: '0'
                                    }, 100);

                                    // shows a successful message after operation
                                    $('#edit-product-messages').html('<div class="alert alert-danger">' +
                                        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                        '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                        '</div>');

                                    // remove the mesages
                                    $(".alert-success").delay(500).show(10, function() {
                                        $(this).delay(3000).hide(10, function() {
                                            $(this).remove();
                                        });
                                    }); // /.alert
                                } // /if response.success

                            } // /success function
                        }); // /ajax function
                    } else {
                        $('#edit-product-messages').html('<div class="alert alert-danger">' +
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> Hay datos faltantes</div>');
                    } // /if validation is ok

                    return false;
                }); // update the product data function

                // update the product image
                $("#updateProductImageForm").unbind('submit').bind('submit', function() {
                    // form validation
                    var productImage = $("#editProductImage").val();

                    if (productImage == "") {
                        $("#editProductImage").closest('.center-block').after('<p class="text-danger">Este campo es obligatorio</p>');
                        $('#editProductImage').closest('.form-group').addClass('has-error');
                    } else {
                        // remov error text field
                        $("#editProductImage").find('.text-danger').remove();
                        // success out for form
                        $("#editProductImage").closest('.form-group').addClass('has-success');
                    } // /else

                    if (productImae) {
                        // submit loading button
                        $("#editProductImageBtn").button('loading');

                        var form = $(this);
                        var formData = new FormData(this);

                        $.ajax({
                            url: form.attr('action'),
                            type: form.attr('method'),
                            data: formData,
                            dataType: 'json',
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function(response) {

                                if (response.success == true) {
                                    // submit loading button
                                    $("#editProductImageBtn").button('reset');

                                    $("html, body, div.modal, div.modal-content, div.modal-body").animate({
                                        scrollTop: '0'
                                    }, 100);

                                    // shows a successful message after operation
                                    $('#edit-productPhoto-messages').html('<div class="alert alert-success">' +
                                        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                                        '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                                        '</div>');

                                    load(1);

                                    // remove the mesages
                                    $(".alert-success").delay(500).show(10, function() {
                                        $(this).delay(3000).hide(10, function() {
                                            $(this).remove();
                                        });
                                    }); // /.alert


                                    $(".fileinput-remove-button").click();

                                    $.ajax({
                                        url: 'php_action/fetchProductImageUrl.php?i=' + productId,
                                        type: 'post',
                                        success: function(response) {
                                            $("#getProductImage").attr('src', response);
                                        }
                                    });

                                    // remove text-error
                                    $(".text-danger").remove();
                                    // remove from-group error
                                    $(".form-group").removeClass('has-error').removeClass('has-success');

                                } // /if response.success

                            } // /success function
                        }); // /ajax function
                    } // /if validation is ok

                    return false;
                }); // /update the product image

            } // /success function
        }); // /ajax to fetch product image


    } else {
        alert('error please refresh the page');
    }
} // /edit product function

// remove product
function removeProduct(productId = null) {
    if (productId) {

        console.log(productId);
        // remove product button clicked
        $("#removeProductBtn").unbind('click').bind('click', function() {
            // loading remove button
            $("#removeProductBtn").button('loading');
            $.ajax({
                url: 'php_action/removeProduct.php',
                type: 'post',
                data: {
                    productId: productId
                },
                dataType: 'json',
                success: function(response) {
                    // loading remove button
                    $("#removeProductBtn").button('reset');
                    if (response.success == true) {

                        // remove success messages
                        $(".removeProductMessages").html('<div class="alert alert-success">' +
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                            '</div>');

                        load(1);

                        // remove the mesages
                        $(".alert-success").delay(500).show(10, function() {
                            $(this).delay(3000).hide(10, function() {
                                $(this).remove();
                            });
                        }); // /.alert
                    } else {

                        // remove success messages
                        $(".removeProductMessages").html('<div class="alert alert-success">' +
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
                            '</div>');

                        // remove the mesages
                        $(".alert-success").delay(500).show(10, function() {
                            $(this).delay(3000).hide(10, function() {
                                $(this).remove();
                            });
                        }); // /.alert

                    } // /error
                } // /success function
            }); // /ajax fucntion to remove the product
            return false;
        }); // /remove product btn clicked
    } // /if productid
} // /remove product function


function calculate(input, type) {

    if (type == 'add') {
        var value = parseFloat($("#" + input).val());
        var price = parseFloat($("#purchase_price").val());

        if (Number.isNaN(value) != 'TRUE' && Number.isNaN(price) != 'TRUE') {
            if (input == 'price1') {
                var total = value - price;
                total = total.toFixed(2);
                $("#utility1").val(total);
            }
            if (input == 'price2') {
                var total = value - price;
                total = total.toFixed(2);
                $("#utility2").val(total);
            }
            if (input == 'price3') {
                var total = value - price;
                total = total.toFixed(2);
                $("#utility3").val(total);
            }
            if (input == 'price4') {
                var total = value - price;
                total = total.toFixed(2);
                $("#utility4").val(total);
            }
            if (input == 'utility1') {
                var total = price + value;
                total = total.toFixed(2);
                $("#price1").val(total);
            }
            if (input == 'utility2') {
                var total = price + value;
                total = total.toFixed(2);
                $("#price2").val(total);
            }
            if (input == 'utility3') {
                var total = price + value;
                total = total.toFixed(2);
                $("#price3").val(total);
            }
            if (input == 'utility4') {
                var total = price + value;
                total = total.toFixed(2);
                $("#price4").val(total);
            }
        } else {

        }
    }

    if (type == 'edit') {
        var value = parseFloat($("#" + input).val());
        var price = parseFloat($("#editPurchasePrice").val());

        if (Number.isNaN(value) != 'TRUE' && Number.isNaN(price) != 'TRUE') {
            if (input == 'editPrice1') {
                var total = value - price;
                total = total.toFixed(2);
                $("#editUtility1").val(total);
            }
            if (input == 'editPrice2') {
                var total = value - price;
                total = total.toFixed(2);
                $("#editUtility2").val(total);
            }
            if (input == 'editPrice3') {
                var total = value - price;
                total = total.toFixed(2);
                $("#editUtility3").val(total);
            }
            if (input == 'editPrice4') {
                var total = value - price;
                total = total.toFixed(2);
                $("#editUtility4").val(total);
            }
            if (input == 'editUtility1') {
                var total = price + value;
                total = total.toFixed(2);
                $("#editPrice1").val(total);
            }
            if (input == 'editUtility2') {
                var total = price + value;
                total = total.toFixed(2);
                $("#editPrice2").val(total);
            }
            if (input == 'editUtility3') {
                var total = price + value;
                total = total.toFixed(2);
                $("#editPrice3").val(total);
            }
            if (input == 'editUtility4') {
                var total = price + value;
                total = total.toFixed(2);
                $("#editPrice4").val(total);
            }
        } else {

        }
    }


}

function viewProduct(id) {

    $.ajax({
        url: 'php_action/fetchSelectedProduct.php',
        type: 'post',
        data: {
            productId: id
        },
        dataType: 'json',
        success: function(response) {

            $("#imageProduct").attr('src', 'system/' + response.product_image);

            $("#id").val(response.product_id);

            $("#vCod").val(response.product_cod);
            // product name
            $("#vName").val(response.product_name);
            // quantity
            $("#vStock").val(response.quantity);
            // rate
            var price = parseFloat(response.purchase_price);
            price = price.toFixed(2);
            $("#vPurchasePrice").val(price);
            // prov name
            $("#vProv").val(response.providers);
            // category name
            $("#vCategory").val(response.categories);

            var type = response.type;
            if (type == 1) {
                type = "Producto";
            } else if (type = 2) {
                type = "Servicio";
            } else {
                type = "No especificado";
            }

            $("#vType").val(type);

            var price1 = parseFloat(response.price1);
            price1 = price1.toFixed(2);
            $("#vPrice1").val(price1);

            var price2 = parseFloat(response.price2);
            price2 = price2.toFixed(2);
            $("#vPrice2").val(price2);

            var price3 = parseFloat(response.price3);
            price3 = price3.toFixed(2);
            $("#vPrice3").val(price3);

            var price4 = parseFloat(response.price4);
            price4 = price4.toFixed(2);
            $("#vPrice4").val(price4);

            var utility1 = parseFloat(response.utility1);
            utility1 = utility1.toFixed(2);
            $("#vUtility1").val(utility1);

            var utility2 = parseFloat(response.utility2);
            utility2 = utility2.toFixed(2);
            $("#vUtility2").val(utility2);

            var utility3 = parseFloat(response.utility3);
            utility3 = utility3.toFixed(2);
            $("#vUtility3").val(utility3);

            var utility4 = parseFloat(response.utility4);
            utility4 = utility4.toFixed(2);
            $("#vUtility4").val(utility4);
        }
    });

}

function clearForm(oForm) {
    // var frm_elements = oForm.elements;
    // console.log(frm_elements);
    // 	for(i=0;i<frm_elements.length;i++) {
    // 		field_type = frm_elements[i].type.toLowerCase();
    // 		switch (field_type) {
    // 	    case "text":
    // 	    case "password":
    // 	    case "textarea":
    // 	    case "hidden":
    // 	    case "select-one":
    // 	      frm_elements[i].value = "";
    // 	      break;
    // 	    case "radio":
    // 	    case "checkbox":
    // 	      if (frm_elements[i].checked)
    // 	      {
    // 	          frm_elements[i].checked = false;
    // 	      }
    // 	      break;
    // 	    case "file":
    // 	    	if(frm_elements[i].options) {
    // 	    		frm_elements[i].options= false;
    // 	    	}
    // 	    default:
    // 	        break;
    //     } // /switch
    // 	} // for
}