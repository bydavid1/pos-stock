var addProductsOrder;

$(document).ready(function () {

	load(1);

	var divRequest = $(".div-request").text();
	$("#navOrder").addClass('active');
	$('#topNavAddOrder').addClass('active');
	$("#date").datepicker();
	$("#createSale").unbind('submit').bind('submit', function () {
		var form = $(this);

		$('.form-group').removeClass('has-error').removeClass('has-success');
		$('.text-danger').remove();

		var date = $("#date").val();
		var clientName = $("#clientName").val();
		var subTotal = $("#subTotal").val();
		var total = $("#total").val();

		// form validation 
		if (date == "") {
			$("#date").after('<p class="text-danger"> Este campo es obligatorio </p>');
			$('#date').closest('.form-group').addClass('has-error');
		} else {
			$('#date').closest('.form-group').addClass('has-success');
		} // /else

		if (clientName == "") {
			$("#clientName").after('<p class="text-danger"> Este campo es obligatorio </p>');
			$('#clientName').closest('.form-group').addClass('has-error');
		} else {
			$('#clientName').closest('.form-group').addClass('has-success');
		} // /else
		if (subTotal == 0.00) {
			$("#subTotal").after('<p class="text-danger"> Parece que no hay ningun producto </p>');
			$('#subTotal').closest('.form-group').addClass('has-error');
		} else {
			$('#subTotal').closest('.form-group').addClass('has-success');
		} // /else
		if (total == 0.00) {
			$("#total").after('<p class="text-danger"> Parece que no hay ningun producto </p>');
			$('#total').closest('.form-group').addClass('has-error');
		} else {
			$('#total').closest('.form-group').addClass('has-success');
		} // /else
		if (date && clientName && subTotal && total) {
			$.ajax({
				url: form.attr('action'),
				type: form.attr('method'),
				data: "date=" + date + "&&clientName=" + clientName + "&&subTotal=" + subTotal + "&&total=" + total,
				success: function (response) {
					console.log(response);
					$(".text-danger").remove();
					$('.form-group').removeClass('has-error').removeClass('has-success');

					if (response.success == true) {

						$(".success-messages").html('<div class="alert alert-success">' +
							'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
							'<strong><i class="glyphicon glyphicon-ok"></i></strong>' + response.messages + '</div>');

					} else {
						$(".success-messages").html('<div class="alert alert-info">' +
							'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
							'<strong><i class="glyphicon glyphicon-info-sign"></i></strong>' + response + '</div>');
					}

				} // /response
			});
		}
		return false;
	});

});

function resetOrderForm() {
	$.ajax({
		type: "GET",
		url: "php_action/resetOrder.php",
		beforeSend: function (objeto) {
			$("#resultados").html("Mensaje: Cargando...");
		},
		success: function (datos) {
			$("#resultados").html(datos);
		}
	});
}