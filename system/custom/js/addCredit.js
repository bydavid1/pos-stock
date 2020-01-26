$(document).ready(function () {

	load(1);
	load(2);
	$('#loader').hide();
	$("#date").datepicker();

	$("#createCreditForm").unbind('submit').bind('submit', function () {
		var form = $(this);

		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		var costumer = $("#costumer").val();
		var date = $("#date").val();
		var grandQuantity = $("#grandQuantity").val();
		var grandTotal = $("#grandTotal").val();

		if (costumer == "") {
			$("#costumer").after('<p class="text-danger"> Este campo es obligatorio </p>');
			$('#costumer').closest('.form-group').addClass('has-error');
		} else {
			$('#costumer').closest('.form-group').addClass('has-success');
		} 

		if (date == "") {
			$("#date").after('<p class="text-danger"> Este campo es obligatorio </p>');
			$('#date').closest('.form-group').addClass('has-error');
		} else {
			$('#date').closest('.form-group').addClass('has-success');
		} 

		if (grandQuantity == "") {
			$("#grandQuantity").after('<p class="text-danger"> Este campo es obligatorio </p>');
			$('#grandQuantity').closest('.form-group').addClass('has-error');
		} else {
			$('#grandQuantity').closest('.form-group').addClass('has-success');
		} 

		if (grandTotal == "") {
			$("#grandTotal").after('<p class="text-danger"> Este campo es obligatorio </p>');
			$('#grandTotal').closest('.form-group').addClass('has-error');
		} else {
			$('#grandTotal').closest('.form-group').addClass('has-success');
		} 

		// array validation
		var productName = document.getElementsByName('productName[]');
		var rateValue = document.getElementsByName('rate[]');
		var validateRate;
		var quantityValue = document.getElementsByName('quantity[]');
		var validateQuantity;
		var totalValue = document.getElementsByName('total[]');
		var validateTotal;
		for (var x = 0; x < productName.length; x++) {
			var productNameId = productName[x].id;
			if (productName[x].value != '') {

				//Validate rateValue
				var rateValueId = rateValue[x].id;
				if (rateValue[x].value == '') {
					$("#" + rateValueId + "").after('<p class="text-danger"> Este campo es obligatorio </p>');
					$("#" + rateValueId + "").closest('.form-group').addClass('has-error');
				} else {
					$("#" + rateValueId + "").closest('.form-group').addClass('has-success');
				}

				if (rateValue[x].value) {
					validateRate = true;
				} else {
					validateRate = false;
				}

				//Validate quantityValue
				var quantityValueId = quantityValue[x].id;
				if (quantityValue[x].value == '') {
					$("#" + quantityValueId + "").after('<p class="text-danger"> Este campo es obligatorio </p>');
					$("#" + quantityValueId + "").closest('.form-group').addClass('has-error');
				} else {
					$("#" + quantityValueId + "").closest('.form-group').addClass('has-success');
				}

				if (quantityValue[x].value) {
					validateQuantity = true;
				} else {
					validateQuantity = false;
				}

				//validate totalValue

				var totalValueId = totalValue[x].id;
				if (totalValue[x].value == '') {
					$("#" + totalValueId + "").after('<p class="text-danger"> Este campo es obligatorio </p>');
					$("#" + totalValueId + "").closest('.form-group').addClass('has-error');
				} else {
					$("#" + totalValueId + "").closest('.form-group').addClass('has-success');
				}

				if (totalValue[x].value) {
					validateTotal = true;
				} else {
					validateTotal = false;
				}
			} else {

			}
		} // for

		tableRow = $(Table + " tbody tr:last").attr('id');
		count = tableRow.substring(3);
		$('#trCount').val(count);

		if (date && grandQuantity && grandTotal && costumer) {
			if (validateQuantity == true && validateRate == true && validateTotal == true) {

				$.ajax({
					url: form.attr('action'),
					type: form.attr('method'),
					data: form.serialize(),
					dataType: 'json',
					beforeSend: function () {

					},
					success: function (response) {
						console.log(response);
						$("#createCredit").button('reset');

						$(".text-danger").remove();
						$('.form-group').removeClass('has-error').removeClass('has-success');

						if (response.success == true) {

							// create order button
							$(".success-messages").html('<div class="alert alert-success">' +
								'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
								'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
								'</div>');

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
	});
}); //Document

