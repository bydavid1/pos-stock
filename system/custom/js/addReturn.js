$(document).ready(function() {

	load(1);
	load(2);

	var divRequest = $(".div-request").text();

		// top nav bar
		$("#addReturn").addClass('active');
		// add order
		// top nav child bar
		$('#navReturn').addClass('active');

	$("#returnDate").datepicker();

    $("#createReturnForm").unbind('submit').bind('submit', function() {

        var form = $(this);

        $('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();


			var costumer = $("#costumer").val();
			var nit = $("#nit").val();
			var returnDate = $("#returnDate").val();
			var grandQuantity = $("#grandQuantity").val();
			var grandTotal = $("#grandTotal").val();


			// form validation
			if(costumer == "") {
				$("#costumer").after('<p class="text-danger"> Este campo es obligatorio </p>');
				$('#costumer').closest('.form-group').addClass('has-error');
			} else {
				$('#costumer').closest('.form-group').addClass('has-success');
			} // /else

			// form validation
			if(nit == "") {
				$("#nit").after('<p class="text-danger"> Este campo es obligatorio </p>');
				$('#nit').closest('.form-group').addClass('has-error');
			} else {
				$('#nit').closest('.form-group').addClass('has-success');
			} // /else

			if(returnDate == "") {
				$("#returnDate").after('<p class="text-danger"> Este campo es obligatorio </p>');
				$('#returnDate').closest('.form-group').addClass('has-error');
			} else {
				$('#returnDate').closest('.form-group').addClass('has-success');
			} // /else

			if(grandQuantity == "") {
				$("#grandQuantity").after('<p class="text-danger"> Este campo es obligatorio </p>');
				$('#grandQuantity').closest('.form-group').addClass('has-error');
			} else {
				$('#grandQuantity').closest('.form-group').addClass('has-success');
			} // /else

			if(grandTotal == "") {
				$("#grandTotal").after('<p class="text-danger"> Este campo es obligatorio </p>');
				$('#grandTotal').closest('.form-group').addClass('has-error');
			} else {
				$('#grandTotal').closest('.form-group').addClass('has-success');
			} // /else

			// array validation
			var productName = document.getElementsByName('productName[]');
			var validateProduct;
			for (var x = 0; x < productName.length; x++) {
				var productNameId = productName[x].id;
		    if(productName[x].value == ''){
		    	$("#"+productNameId+"").after('<p class="text-danger"> Este campo es obligatorio </p>');
		    	$("#"+productNameId+"").closest('.form-group').addClass('has-error');
	      } else {
		    	$("#"+productNameId+"").closest('.form-group').addClass('has-success');
	      }
	   	} // for

	   	for (var x = 0; x < productName.length; x++) {
		    if(productName[x].value){
		    	validateProduct = true;
	      } else {
		    	validateProduct = false;
	      }
        } // for  



    	// array validation
			var rateValue = document.getElementsByName('rate[]');
			var validateRate;
			for (var x = 0; x < rateValue.length; x++) {
				var rateValueId = rateValue[x].id;
		    if(rateValue[x].value == ''){
		    	$("#"+rateValueId+"").after('<p class="text-danger"> Este campo es obligatorio </p>');
		    	$("#"+rateValueId+"").closest('.form-group').addClass('has-error');
	      } else {
		    	$("#"+rateValueId+"").closest('.form-group').addClass('has-success');
	      }
	   	} // for

	   	for (var x = 0; x < rateValue.length; x++) {
		    if(rateValue[x].value){
		    	validateRate = true;
	      } else {
                validateRate = false;
	      }
           } // for

            // array validation
			var quantityValue = document.getElementsByName('quantity[]');
			var validateQuantity;
			for (var x = 0; x < quantityValue.length; x++) {
				var quantityValueId = quantityValue[x].id;
		    if(quantityValue[x].value == ''){
		    	$("#"+quantityValueId+"").after('<p class="text-danger"> Este campo es obligatorio </p>');
		    	$("#"+quantityValueId+"").closest('.form-group').addClass('has-error');
	      } else {
		    	$("#"+quantityValueId+"").closest('.form-group').addClass('has-success');
	      }
	   	} // for

	   	for (var x = 0; x < quantityValue.length; x++) {
		    if(quantityValue[x].value){
		    	validateQuantity = true;
	      } else {
                validateQuantity = false;
	      }
		   } // for

		 // array validation
			var totalValue = document.getElementsByName('total[]');
			var validateTotal;
			for (var x = 0; x < totalValue.length; x++) {
				var totalValueId = totalValue[x].id;
		    if(totalValue[x].value == ''){
		    	$("#"+totalValueId+"").after('<p class="text-danger"> Este campo es obligatorio </p>');
		    	$("#"+totalValueId+"").closest('.form-group').addClass('has-error');
	      } else {
		    	$("#"+totalValueId+"").closest('.form-group').addClass('has-success');
	      }
	   	} // for

	   	for (var x = 0; x < totalValue.length; x++) {
		    if(totalValue[x].value){
		    	validateTotal = true;
	      } else {
                validateTotal = false;
	      }
		   } // for

		   tableRow = $("#outlayTable tbody tr:last").attr('id');
		   count = tableRow.substring(3);
		   $('#trCount').val(count);
		  if(returnDate && grandQuantity && grandTotal && nit && costumer){
			if(validateProduct == true && validateQuantity == true  && validateRate == true && validateTotal == true) {

				$.ajax({
					url : form.attr('action'),
					type: form.attr('method'),
					data: form.serialize(),
					dataType: 'json',
					beforeSend: function(){
						console.log(count);
					},
					success:function(response) {
						// reset button
						console.log(response);
						$("#createReturn").button('reset');

						$(".text-danger").remove();
						$('.form-group').removeClass('has-error').removeClass('has-success');

						if(response.success == true) {

							// create order button
							$(".success-messages").html('<div class="alert alert-success">'+
				'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
				'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
				  '</div>');

						} else {
							$(".success-messages").html('<div class="alert alert-danger">'+
							'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
							'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
							  '</div>');
						}
					} // /response
				}); // /ajax
			} // if array validate is true
		}// /if field validate is true

		return false;

    });
}); //Document

function load(page){
	var q= $("#q").val();
	var v= $("#v").val();
	$("#loader").fadeIn('slow');
	$("#gif").fadeIn('slow');

	if(page == 1){
		$.ajax({
			url:'./php_action/fetchAddProduct.php?action=ajax&page='+page+'&q='+q,
			 beforeSend: function(objeto){
			 $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
		  },
			success:function(data){
				$(".outer_div").html(data).fadeIn('slow');
				$('#loader').html('');

			}
		})
	}else{
		 var num = 1;
		$.ajax({
			url:'./php_action/fetchCostumerData.php?action=ajax&page='+num+'&q='+v,
			 beforeSend: function(objeto){
			 $('#gif').html('<img src="./img/ajax-loader.gif"> Cargando...');
		  },
			success:function(data){
				$(".data").html(data).fadeIn('slow');
				$('#gif').html('');

			}
		})
	}

}

function addRow() {
	$("#addRowBtn").button("loading");

	var tableLength = $("#outlayTable tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if(tableLength > 0) {
		tableRow = $("#outlayTable tbody tr:last").attr('id');
		arrayNumber = $("#outlayTable tbody tr:last").attr('class');
		count = tableRow.substring(3);
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;
	} else {
		// no table row
		count = 1;
		arrayNumber = 0;
	}

			$("#addRowBtn").button("reset");

			var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+
			'<td>'+
			'<div class="form-group col-sm-12">'+
			'<input type="text" name="productCode[]" id="productCode'+count+'" autocomplete="off" class="form-control" onchange="getProductData('+count+')"/>'+
			'<input type="hidden" name="productCodeValue[]" id="ProductCodeValue'+count+'" autocomplete="off" class="form-control"/>'+
			'</div>'+
			'</td>'+
			'<td>'+
			'<div class="form-group col-sm-12">'+
			'<input type="text" name="productName[]" id="productName'+count+'" autocomplete="off" class="form-control" disabled />'+
			'<input type="hidden" name="productNameValue[]" id="productNameValue'+count+'" autocomplete="off" class="form-control"/>'+
			'</div>'+
			'</td>'+
				'<td>'+
				' <div class="form-group col-sm-12">'+
					'<input type="number" name="rate[]" id="rate'+count+'" autocomplete="off"  class="form-control" step="0.01"  min="0" onkeyup="totalValue('+count+')" disabled/>'+
					'<input type="hidden" name="rateValue[]" id="rateValue'+count+'" autocomplete="off" class="form-control" />'+
				'</div>'+
					'</td>'+
				'<td>'+
				'<div class="form-group col-sm-12">'+
					'<input type="number" name="quantity[]" id="quantity'+count+'" onkeyup="totalValue('+count+')" autocomplete="off" disabled class="form-control" value="1"  min="1" onkeyup="totalValue('+count+')" />'+
                    '<input type="hidden" name="quantityValue[]" id="quantityValue'+count+'" autocomplete="off" class="form-control" />'+
				'</div>'+
					'</td>'+
					'<td>'+
                    '<div class="form-group col-sm-12">'+
						'<input type="text" value="13%" class ="form-control" disabled="true"/>'+
                    '</div>'+
                    '</td>'+
				'<td>'+
				' <div class="form-group col-sm-12">'+
					'<input type="text" name="total[]" id="total'+count+'" autocomplete="off" class="form-control" step="0.01"  min="0" disabled="true" />'+
					'<input type="hidden" name="totalValue[]" id="totalValue'+count+'" autocomplete="off" class="form-control" />'+
				'</div>'+
					'</td>'+
				'<td>'+
					'<button class="btn btn-default removeProductRowBtn" type="button" onclick="removeProductRow('+count+')"><i class="glyphicon glyphicon-trash"></i></button>'+
				'</td>'+
			'</tr>';
			if(tableLength > 0) {
				$("#outlayTable tbody tr:last").after(tr);
			} else {
				$("#outlayTable tbody").append(tr);
			}

		} // /success

		function removeProductRow(row = null) {
			if(row) {
				$("#row"+row).remove();

			} else {
				alert('error! Refresh the page again');
			}
		}

		function getProductData(row = null) {
			if(row) {
				var code = $("#productCode"+row).val();
				var type = 'get';
				if(code == "") {
					$("#rate"+row).val("");
					$("#quantity"+row).val("");
					$("#total"+row).val("");
					$("#productName"+row).prop('disabled', true);
					$("#rate"+row).prop('disabled', true);
					$("#quantity"+row).prop('disabled', true);
				} else {
					$.ajax({
						url: './php_action/fetchSelectedDataProduct.php',
						type: 'post',
						data: {'code': code, 'type': type},
						dataType: 'json',
						beforeSend:function(){
						   console.log(code, type);
						},
						success:function(response) {
							console.log(response);
							if(response.success == true){
								$("#productName"+row).val(response.messages1);
								$("#productNameValue"+row).val(response.messages1);
								$("#quantity"+row).prop('disabled', false);
								$("#rate"+row).prop('disabled', false);
							}else{
								$("#productName"+row).val(response);
								$("#productName"+row).prop('disabled', true);
								$("#rate"+row).prop('disabled', true);
								$("#quantity"+row).prop('disabled', true);
							}


						} // /success
					}); // /ajax function to fetch the product data
				}

			} else {
				alert('no row! please refresh the page');
			}
		} // /select on product data


		function totalValue(row = null) {
		 var rate = Number($("#rate"+row).val());
		 var quantity = Number($("#quantity"+row).val());

		 total = rate * quantity;
		 total = total.toFixed(2);

		 $("#total"+row).val(total);
		 $("#totalValue"+row).val(total);

		 subAmount();
		}


		function subAmount() {
			var tableProductLength = $("#outlayTable tbody tr").length;
			var total = 0;
			var quantity = 0;
			for(x = 0; x < tableProductLength; x++) {
				var tr = $("#outlayTable tbody tr")[x];
				var count = $(tr).attr('id');
				count = count.substring(3);

				total = Number(total) + Number($("#total"+count).val());
				quantity = Number(quantity) + Number($("#quantity"+count).val());
			} // /for


			total = total.toFixed(2);
			$("#grandTotal").val(total);
			$("#grandTotalValue").val(total);


			$("#grandQuantity").val(quantity);
			$("#grandQuantityValue").val(quantity);


		} // /sub total amount

		function success(value){
				$.ajax({
					url:'./php_action/fetchCostumerData.php?action=add&valueSend='+value,
					dataType: 'json',
					 beforeSend: function(objeto){
					console.log(value);
				  },
					success:function(data){
						console.log(data);
						$("#costumer").val(data.name);
						$("#nit").val(data.nit);
					}
				})

		}

		function agregar(id) {

			var tableLength = $("#outlayTable tbody tr").length;

			var tableRow;
			var arrayNumber;
			var count;
			var tr = '' ;

			if(tableLength > 0) {
				tableRow = $("#outlayTable tbody tr:last").attr('id');
				arrayNumber = $("#outlayTable tbody tr:last").attr('class');
				count = tableRow.substring(3);
				count = Number(count) + 1;
				arrayNumber = Number(arrayNumber) + 1;
			} else {
				// no table row
				count = 1;
				arrayNumber = 0;
			}

			var type = 'add';

			$.ajax({
				type: 'post',
				url: './php_action/fetchSelectedDataProduct.php',
				data: {'id': id, 'type': type},
				dataType: 'json',
				 beforeSend: function(objeto){
				// $('#loader').html('<img src="./img/ajax-loader.gif"> Cargando...');
			  },
				success:function(response){
					console.log(response);

					if(response.success == true){
					tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+
					'<td>'+
					'<div class="form-group col-sm-12">'+
					'<input type="text" name="productCode[]" id="productCode'+count+'" autocomplete="off" value="'+response.messages1+'" class="form-control" onchange="getProductData('+count+')"/>'+
					'<input type="hidden" name="productCodeValue[]" id="ProductCodeValue'+count+'" autocomplete="off" class="form-control"/>'+
					'</div>'+
					'</td>'+
					'<td>'+
					'<div class="form-group col-sm-12">'+
					'<input type="text" name="productName[]" id="productName'+count+'" value="'+response.messages2+'" autocomplete="off" class="form-control" disabled />'+
					'<input type="hidden" name="productNameValue[]" id="productNameValue'+count+'" autocomplete="off" class="form-control"/>'+
					'</div>'+
					'</td>'+
						'<td>'+
						' <div class="form-group col-sm-12">'+
							'<input type="number" name="rate[]" id="rate'+count+'" autocomplete="off"  class="form-control" step="0.01"  min="0" onkeyup="totalValue('+count+')" />'+
							'<input type="hidden" name="rateValue[]" id="rateValue'+count+'" autocomplete="off" class="form-control" />'+
						'</div>'+
							'</td>'+
						'<td>'+
						'<div class="form-group col-sm-12">'+
							'<input type="number" name="quantity[]" id="quantity'+count+'" onkeyup="totalValue('+count+')" autocomplete="off" class="form-control" value="1"  min="1" onkeyup="totalValue('+count+')" />'+
							'<input type="hidden" name="quantityValue[]" id="quantityValue'+count+'" autocomplete="off" class="form-control" />'+
						'</div>'+
							'</td>'+
							'<td>'+
							'<div class="form-group col-sm-12">'+
								'<input type="text" value="13%" class ="form-control" disabled="true"/>'+
							'</div>'+
							'</td>'+
						'<td>'+
						' <div class="form-group col-sm-12">'+
							'<input type="text" name="total[]" id="total'+count+'" autocomplete="off" class="form-control" step="0.01"  min="0" disabled="true" />'+
							'<input type="hidden" name="totalValue[]" id="totalValue'+count+'" autocomplete="off" class="form-control" />'+
						'</div>'+
							'</td>'+
						'<td>'+
							'<button class="btn btn-default removeProductRowBtn" type="button" onclick="removeProductRow('+count+')"><i class="glyphicon glyphicon-trash"></i></button>'+
						'</td>'+
					'</tr>';

					if(tableLength > 0) {
						$("#outlayTable tbody tr:last").after(tr);
					} else {
						$("#outlayTable tbody").append(tr);
					}
				}else{

				}
				}
			})

				} // /success
