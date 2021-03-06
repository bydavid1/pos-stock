var manageOrderTable;

$(document).ready(function () {

	load(1);

	var divRequest = $(".div-request").text();

	// top nav bar 
	$("#navOrder").addClass('active');

	// top nav child bar 
	$('#topNavManageOrder').addClass('active');

	$("#orderDate").datepicker();

	// edit order form function
	$("#editOrderForm").unbind('submit').bind('submit', function () {

		var form = $(this);

		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		var orderDate = $("#orderDate").val();
		var clientName = $("#clientName").val();
		var iva = $("#iva").val();
		var total = $("#grandTotal").val();
		var paymentStatus = $("#paymentStatus").val();

		// form validation 
		if (orderDate == "") {
			$("#orderDate").after('<p class="text-danger"> Este campo es obligatorio </p>');
			$('#orderDate').closest('.form-group').addClass('has-error');
		} else {
			$('#orderDate').closest('.form-group').addClass('has-success');
		} // /else

		if (clientName == "") {
			$("#clientName").after('<p class="text-danger"> Este campo es obligatorio </p>');
			$('#clientName').closest('.form-group').addClass('has-error');
		} else {
			$('#clientName').closest('.form-group').addClass('has-success');
		} // /else

		if (total == "") {
			$("#grandTotal").after('<p class="text-danger"> Este campo es obligatorio </p>');
			$('#grandTotal').closest('.form-group').addClass('has-error');
		} else {
			$('#grandTotal').closest('.form-group').addClass('has-success');
		} // /else

		if (iva == "") {
			$("#iva").after('<p class="text-danger"> Este campo es obligatorio </p>');
			$('#iva').closest('.form-group').addClass('has-error');
		} else {
			$('#iva').closest('.form-group').addClass('has-success');
		} // /else

		if (paymentStatus == "") {
			$("#paymentStatus").after('<p class="text-danger"> Este campo es obligatorio </p>');
			$('#paymentStatus').closest('.form-group').addClass('has-error');
		} else {
			$('#paymentStatus').closest('.form-group').addClass('has-success');
		} // /else


		// array validation
		var productName = document.getElementsByName('productName[]');
		var validateProduct;
		for (var x = 0; x < productName.length; x++) {
			var productNameId = productName[x].id;
			if (productName[x].value == '') {
				$("#" + productNameId + "").after('<p class="text-danger"> Este campo es obligatorio </p>');
				$("#" + productNameId + "").closest('.form-group').addClass('has-error');
			} else {
				$("#" + productNameId + "").closest('.form-group').addClass('has-success');
			}
		} // for

		for (var x = 0; x < productName.length; x++) {
			if (productName[x].value) {
				validateProduct = true;
			} else {
				validateProduct = false;
			}
		} // for       		   	

		var quantity = document.getElementsByName('quantity[]');
		var validateQuantity;
		for (var x = 0; x < quantity.length; x++) {
			var quantityId = quantity[x].id;
			if (quantity[x].value == '') {
				$("#" + quantityId + "").after('<p class="text-danger"> Este campo es obligatorio </p>');
				$("#" + quantityId + "").closest('.form-group').addClass('has-error');
			} else {
				$("#" + quantityId + "").closest('.form-group').addClass('has-success');
			}
		} // for

		for (var x = 0; x < quantity.length; x++) {
			if (quantity[x].value) {
				validateQuantity = true;
			} else {
				validateQuantity = false;
			}
		} // for       	


		if (orderDate && clientName && iva && total && paymentStatus) {
			if (validateProduct == true && validateQuantity == true) {
				// create order button
				// $("#createOrderBtn").button('loading');

				$.ajax({
					url: form.attr('action'),
					type: form.attr('method'),
					data: form.serialize(),
					dataType: 'json',
					success: function (response) {
						console.log(response);
						// reset button
						$("#editOrderBtn").button('reset');

						$(".text-danger").remove();
						$('.form-group').removeClass('has-error').removeClass('has-success');

						if (response.success == true) {

							// create order button
							$(".success-messages").html('<div class="alert alert-success">' +
								'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
								'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
								'</div>');

							$("html, body, div.panel, div.pane-body").animate({
								scrollTop: '0px'
							}, 100);

							// disabled te modal footer button
							$(".editButtonFooter").addClass('div-hide');
							// remove the product row
							$(".removeProductRowBtn").addClass('div-hide');

						} else {
							$(".success-messages").html('<div class="alert alert-danger">' +
								'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
								'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
								'</div>');
						}
					} // /response
				}); // /ajax
			} // if array validate is true
		} // /if field validate is true


		return false;
	}); // /edit order form function	 	

});

function load(page) {
	var q = $("#q").val();
	$("#loader").fadeIn('slow');
	$.ajax({
		url: './php_action/manageSales.php?action=ajax&page=' + page + '&q=' + q,
		beforeSend: function (objeto) {
			$('#loader').html('<img src="./assests/images/ajax-loader.gif"> Cargando...');
		},
		success: function (data) {
			$(".outer_div").html(data).fadeIn('slow');
			$('#loader').html('');

		}
	})
}

// print order function
function printOrder(orderId = null) {
	if (orderId) {

		$.ajax({
			url: 'php_action/printOrder.php',
			type: 'post',
			data: {
				orderId: orderId
			},
			dataType: 'text',
			success: function (response) {

				var mywindow = window.open('', 'Stock Management System', 'height=400,width=600');
				mywindow.document.write('<html><head><title>Order Invoice</title>');
				mywindow.document.write('</head><body>');
				mywindow.document.write(response);
				mywindow.document.write('</body></html>');

				mywindow.document.close(); // necessary for IE >= 10
				mywindow.focus(); // necessary for IE >= 10

				mywindow.print();
				mywindow.close();

			} // /success function
		}); // /ajax function to fetch the printable order
	} // /if orderId
} // /print order function

// remove order from server
function removeOrder(orderId = null) {
	if (orderId) {
		$("#removeOrderBtn").unbind('click').bind('click', function () {
			$("#removeOrderBtn").button('loading');

			$.ajax({
				url: 'php_action/removeOrder.php',
				type: 'post',
				data: {
					orderId: orderId
				},
				dataType: 'json',
				success: function (response) {
					$("#removeOrderBtn").button('reset');

					if (response.success == true) {

						manageOrderTable.ajax.reload(null, false);
						// hide modal
						$("#removeOrderModal").modal('hide');
						// success messages
						$("#success-messages").html('<div class="alert alert-success">' +
							'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
							'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
							'</div>');

						// remove the mesages
						$(".alert-success").delay(500).show(10, function () {
							$(this).delay(3000).hide(10, function () {
								$(this).remove();
							});
						}); // /.alert	          

					} else {
						// error messages
						$(".removeOrderMessages").html('<div class="alert alert-warning">' +
							'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
							'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
							'</div>');

						// remove the mesages
						$(".alert-success").delay(500).show(10, function () {
							$(this).delay(3000).hide(10, function () {
								$(this).remove();
							});
						}); // /.alert	          
					} // /else

				} // /success
			}); // /ajax function to remove the order

		}); // /remove order button clicked


	} else {
		alert('error! refresh the page again');
	}
}
// /remove order from server

function addRow() {
	$("#addRowBtn").button("loading");

	var tableLength = $("#productTable tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if (tableLength > 0) {
		tableRow = $("#productTable tbody tr:last").attr('id');
		arrayNumber = $("#productTable tbody tr:last").attr('class');
		count = tableRow.substring(3);
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;
	} else {
		// no table row
		count = 1;
		arrayNumber = 0;
	}

	$.ajax({
		url: 'php_action/fetchProductData.php',
		type: 'post',
		dataType: 'json',
		success: function (response) {
			$("#addRowBtn").button("reset");

			var tr = '<tr id="row' + count + '" class="' + arrayNumber + '">' +
				'<td>' +
				'<div class="form-group">' +

				'<select class="form-control" name="productName[]" id="productName' + count + '" onchange="getProductData(' + count + ')" >' +
				'<option value="">~~SELECT~~</option>';
			// console.log(response);
			$.each(response, function (index, value) {
				tr += '<option value="' + value[0] + '">' + value[1] + '</option>';
			});

			tr += '</select>' +
				'</div>' +
				'</td>' +
				'<td style="padding-left:20px;"">' +
				'<input type="text" name="rate[]" id="rate' + count + '" autocomplete="off" disabled="true" class="form-control" />' +
				'<input type="hidden" name="rateValue[]" id="rateValue' + count + '" autocomplete="off" class="form-control" />' +
				'</td style="padding-left:20px;">' +
				'<td style="padding-left:20px;">' +
				'<div class="form-group">' +
				'<input type="number" name="quantity[]" id="quantity' + count + '" onkeyup="getTotal(' + count + ')" autocomplete="off" class="form-control" min="1" />' +
				'</div>' +
				'</td>' +
				'<td style="padding-left:20px;">' +
				'<input type="text" name="total[]" id="total' + count + '" autocomplete="off" class="form-control" disabled="true" />' +
				'<input type="hidden" name="totalValue[]" id="totalValue' + count + '" autocomplete="off" class="form-control" />' +
				'</td>' +
				'<td>' +
				'<button class="btn btn-default removeProductRowBtn" type="button" onclick="removeProductRow(' + count + ')"><i class="glyphicon glyphicon-trash"></i></button>' +
				'</td>' +
				'</tr>';
			if (tableLength > 0) {
				$("#productTable tbody tr:last").after(tr);
			} else {
				$("#productTable tbody").append(tr);
			}

		} // /success
	}); // get the product data

} // /add row


function removeProductRow(row = null) {
	if (row) {
		$("#row" + row).remove();


		subAmount();
	} else {
		alert('error! Refresh the page again');
	}
}

function getProductData(row = null) {
	if (row) {
		var productId = $("#productName" + row).val();

		if (productId == "") {
			$("#rate" + row).val("");

			$("#quantity" + row).val("");
			$("#total" + row).val("");

		} else {
			$.ajax({
				url: 'php_action/fetchSelectedProduct.php',
				type: 'post',
				data: {
					productId: productId
				},
				dataType: 'json',
				success: function (response) {
					// setting the rate value into the rate input field

					$("#rate" + row).val(response.rate);
					$("#rateValue" + row).val(response.rate);

					$("#quantity" + row).val(1);

					var total = Number(response.rate) * 1;
					total = total.toFixed(2);
					$("#total" + row).val(total);
					$("#totalValue" + row).val(total);

					subAmount();
				} // /success
			}); // /ajax function to fetch the product data	
		}

	} else {
		alert('no row! please refresh the page');
	}
} // /select on product data

function getTotal(row = null) {
	if (row) {
		var total = Number($("#rate" + row).val()) * Number($("#quantity" + row).val());
		total = total.toFixed(2);
		$("#total" + row).val(total);
		$("#totalValue" + row).val(total);

		subAmount();

	} else {
		alert('no row !! please refresh the page');
	}
}

function subAmount() {
	var tableProductLength = $("#productTable tbody tr").length;
	var totalSubAmount = 0;
	for (x = 0; x < tableProductLength; x++) {
		var tr = $("#productTable tbody tr")[x];
		var count = $(tr).attr('id');
		count = count.substring(3);

		totalSubAmount = Number(totalSubAmount) + Number($("#total" + count).val());
	} // /for

	totalSubAmount = totalSubAmount.toFixed(2);

	// sub total
	$("#subTotal").val(totalSubAmount);
	$("#subTotalValue").val(totalSubAmount);

	// vat
	var iva = Number(totalSubAmount) * 0.13;
	iva = iva.toFixed(2);
	$("#iva").val(iva);
	$("#ivaValue").val(iva);


	var grandTotal = Number(totalSubAmount) + Number(iva);
	grandTotal = grandTotal.toFixed(2);
	$("#grandTotal").val(grandTotal);
	$("#grandTotalValue").val(grandTotal);




} // /sub total amount