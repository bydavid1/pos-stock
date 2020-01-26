
	const Table = "#productTable";
	const PRICE = "#rate";
	const PRODUCTNAME = "#productName";
	const PRODUCTCODE = "#productCode";
	const QUANTITY = "#quantity";
    const TOTAL = "#total";
    
function load(page) {
	$('#loader').show();
	var q = $("#q").val();
	var v = $("#v").val();

	if (page == 1) {
		$.ajax({
			url: './php_action/fetchAddProduct.php?action=ajax&page=' + page + '&q=' + q,
			beforeSend: function (objeto) {
				//$('#loader').show();
			},
			success: function (data) {
				$(".outer_div").html(data).fadeIn('slow');
			  //  $('#loader').hide();
			}
		})
	} else {
		var num = 1;
		$.ajax({
			url: './php_action/fetchCostumerData.php?action=ajax&page=' + num + '&q=' + v,
			beforeSend: function (objeto) {
				//$('#loader').show();
			},
			success: function (data) {
				$(".data").html(data).fadeIn('slow');
			//	$('#loader').hide();
			}
		})
	}
}

function addRow() {
	$("#addRowBtn").button("loading");

	var tableLength = $(Table + " tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if (tableLength > 0) {
		tableRow = $(Table + " tbody tr:last").attr('id');
		arrayNumber = $(Table + " tbody tr:last").attr('class');
		count = tableRow.substring(3);
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;
	} else {
		// no table row
		count = 1;
		arrayNumber = 0;
	}

	$("#addRowBtn").button("reset");

	var tr = '<tr id="row' + count + '" class="' + arrayNumber + '">' +
		'<td>' +
		'<div class="form-group col-sm-12">' +
		'<input type="text" name="productCode[]" id="productCode' + count + '" autocomplete="off" class="form-control" onchange="getProductData(' + count + ')"/>' +
		'</div>' +
		'</td>' +
		'<td>' +
		'<div class="form-group col-sm-12">' +
		'<input type="text" name="productName[]" id="productName' + count + '" autocomplete="off" class="form-control" disabled />' +
		'</div>' +
		'</td>' +
		'<td>' +
		' <div class="input-group col-sm-12">' +
		'<span class="input-group-addon">$</span>' +
		'<input type="number" name="rate[]" id="rate' + count + '" autocomplete="off"  class="form-control" step="0.01"  min="0" onchange="totalValue(' + count + ')" disabled/>' +
		'</div>' +
		'</td>' +
		'<td>' +
		'<div class="form-group col-sm-12">' +
		'<input type="number" name="quantity[]" id="quantity' + count + '"  autocomplete="off" disabled class="form-control"   min="1" onchange="totalValue(' + count + ')" />' +
		'</div>' +
		'</td>' +
		'<td>' +
		'<div class="form-group col-sm-12">' +
		'<input type="text" value="13%" class ="form-control" disabled="true"/>' +
		'</div>' +
		'</td>' +
		'<td>' +
		' <div class="input-group col-sm-12">' +
		'<span class="input-group-addon">$</span>' +
		'<input type="text" name="total[]" id="total' + count + '" autocomplete="off" class="form-control" step="0.01"  min="0" disabled="true" />' +
		'</div>' +
		'</td>' +
		'<td>' +
		'<button class="btn btn-default removeProductRowBtn" type="button" onclick="removeProductRow(' + count + ')"><i class="glyphicon glyphicon-trash"></i></button>' +
		'</td>' +
		'</tr>';
	if (tableLength > 0) {
		$(Table + " tbody tr:last").after(tr);
	} else {
		$(Table + " tbody").append(tr);
	}
}

function removeProductRow(row = null) {
	if (row) {
		$("#row" + row).remove();

	} else {
		alert('error! Refresh the page again');
	}
}

function getProductData(row = null) {
	if (row) {
		var code = $("#productCode" + row).val();
		var type = 'get';
		if (code == "") {
			$(PRICE + row).val("");
			$(QUANTITY + row).val("");
			$("#total" + row).val("");
			$(PRODUCTNAME + row).prop('disabled', true);
			$(PRICE + row).prop('disabled', true);
			$(QUANTITY + row).prop('disabled', true);
		} else {
			$.ajax({
				url: './php_action/fetchSelectedDataProduct.php',
				type: 'post',
				data: {
					'code': code,
					'type': type
				},
				dataType: 'json',
				beforeSend: function () {
					console.log(code, type);
				},
				statusCode: {
					200: function (response) {
						//console.log(response);
						var res = response[0];
						var price = parseFloat(res.price1);
						$(PRODUCTNAME + row).val(res.product_name);
						$(PRICE + row).val(price.toFixed(2));
						$(PRICE + row).prop('disabled', false);
						$(QUANTITY + row).prop('disabled', false);
					},
					204: function () {
						$(PRODUCTNAME + row).val("");
						$(PRICE + row).val("");
						$(PRICE + row).prop('disabled', true);
						$(QUANTITY + row).prop('disabled', true);
					},
					500: function () {
						$(PRODUCTNAME + row).val("");
						$(PRICE + row).val("");
						$(PRICE + row).prop('disabled', true);
						$(QUANTITY + row).prop('disabled', true);

						$(".success-messages").html('<div class="alert alert-warning">' +
							'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
							'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong>Ocurrio un error en el servidor'+
							'</div>');
					}
				}
			}); 
		}

	} else {
		alert('no row! please refresh the page');
	}
} // /select on product data


function totalValue(row = null) {
	var rate = Number($(PRICE + row).val());
	var quantity = Number($(QUANTITY + row).val());

	total = rate * quantity;
	total = total.toFixed(2);

	$("#total" + row).val(total);
	$("#totalValue" + row).val(total);

	subAmount();
}

function subAmount() {
	var tableProductLength = $(Table + " tbody tr").length;
	var total = 0;
	var quantity = 0;
	for (x = 0; x < tableProductLength; x++) {
		var tr = $(Table + " tbody tr")[x];
		var count = $(tr).attr('id');
		count = count.substring(3);

		total = Number(total) + Number($("#total" + count).val());
		quantity = Number(quantity) + Number($(QUANTITY + count).val());
	} // /for


	total = total.toFixed(2);
	$("#grandTotal").val(total);
	$("#grandTotalValue").val(total);


	$("#grandQuantity").val(quantity);
	$("#grandQuantityValue").val(quantity);

} 

function success(value) {

	$.ajax({
		url: './php_action/fetchCostumerData.php?action=add&valueSend=' + value,
		dataType: 'json',
		beforeSend: function (objeto) {
			 $('#loader').show();
		},
		success: function (data) {
			console.log(data);
			$("#costumer").val(data.name);
		}
	})
}

function agregar(id) {

	var tableLength = $(Table + " tbody tr").length;
	var tableRow;
	var arrayNumber;
	var count;
	var tr = '';
	var quantityvalue = $("#cantidad_" + id).val();
	var pricevalue = $("#precio_venta_" + id).val();

	if (tableLength > 0) {
		tableRow = $(Table + " tbody tr:last").attr('id');
		arrayNumber = $(Table + " tbody tr:last").attr('class');
		count = tableRow.substring(3);
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;
	} else {
		count = 1;
		arrayNumber = 0;
	}

	var type = 'add';

	$.ajax({
		type: 'post',
		url: './php_action/fetchSelectedDataProduct.php',
		data: {
			'id': id,
			'type': type
		},
		dataType: 'json',
		beforeSend: function (objeto) {
			 $('#loader').show();
		},
		statusCode: {
			200: function (response) {
				var res = response[0];
				var price = parseFloat(res.price1);
				tr = '<tr id="row' + count + '" class="' + arrayNumber + '">' +
					'<td>' +
					'<div class="form-group col-sm-12">' +
					'<input type="text" name="productCode[]" id="productCode' + count + '" autocomplete="off" value="' + res.product_cod + '" class="form-control" onchange="getProductData(' + count + ')"/>' +
					'</div>' +
					'</td>' +
					'<td>' +
					'<div class="form-group col-sm-12">' +
					'<input type="text" name="productName[]" id="productName' + count + '" value="' + res.product_name + '" autocomplete="off" class="form-control" disabled />' +
					'</div>' +
					'</td>' +
					'<td>' +
					' <div class="input-group col-sm-12">' +
					'<span class="input-group-addon">$</span>' +
					'<input type="number" name="rate[]" id="rate' + count + '" value="' + price + '" autocomplete="off"  class="form-control" step="0.01"  min="0" onchange="totalValue(' + count + ')" />' +
					'</div>' +
					'</td>' +
					'<td>' +
					'<div class="form-group col-sm-12">' +
					'<input type="number" name="quantity[]" id="quantity' + count + '" value="' + quantityvalue + '" autocomplete="off" class="form-control" min="1" onchange="totalValue(' + count + ')" />' +
					'</div>' +
					'</td>' +
					'<td>' +
					'<div class="form-group col-sm-12">' +
					'<input type="text" value="13%" class ="form-control" disabled="true"/>' +
					'</div>' +
					'</td>' +
					'<td>' +
					' <div class="input-group col-sm-12">' +
					'<span class="input-group-addon">$</span>' +
					'<input type="text" name="total[]" id="total' + count + '" value="' + pricevalue + '" autocomplete="off" class="form-control" step="0.01"  min="0" disabled="true" />' +
					'</div>' +
					'</td>' +
					'<td>' +
					'<button class="btn btn-default removeProductRowBtn" type="button" onclick="removeProductRow(' + count + ')"><i class="glyphicon glyphicon-trash"></i></button>' +
					'</td>' +
					'</tr>';

				if (tableLength > 1) {
					$(Table + " tbody tr:last").after(tr);
				}else if(tableLength == 1 && $(PRODUCTNAME + 1).val() == ""){
					$(PRODUCTCODE + 1).val(res.product_cod);
					$(PRODUCTNAME + 1).val(res.product_name);
					$(PRICE + 1).val(price.toFixed(2));
					$(QUANTITY + 1).val(quantityvalue);
					$(TOTAL + 1).val(pricevalue);
					$(PRICE + 1).prop('disabled', false);
					$(QUANTITY + 1).prop('disabled', false);
				} else {
					$(Table + " tbody").append(tr);
				}
					$('#loader').hide();
				subAmount();
			},
			204: function () {
					$('#loader').hide();
			},
			500: function () {
					$('#loader').hide();
			}
		}
	})

} // /success