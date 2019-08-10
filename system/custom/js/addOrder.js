var addProductsOrder;

$(document).ready(function() {

	load(1);

	var divRequest = $(".div-request").text();

	// top nav bar 
	$("#navOrder").addClass('active');
		// add order	
		// top nav child bar 
		$('#topNavAddOrder').addClass('active');	

		// order date picker
		$("#orderDate").datepicker();

		//Mostrar datos
		$.ajax({
			type: "POST",
			url: "./php_action/showTmp.php",
			 beforeSend: function(){
				$("#resultados").html("Mensaje: Cargando...");
			  },
			success: function(data){
			$("#resultados").html(data);
			}
				});

		// create order form function
		$("#createOrderForm").unbind('submit').bind('submit', function() {
			var form = $(this);

			$('.form-group').removeClass('has-error').removeClass('has-success');
			$('.text-danger').remove();
				
			var orderDate = $("#orderDate").val();
			var clientName = $("#clientName").val();
			var subTotal = $("#subTotal").val();
			var iva = $("#iva").val();
			var total = $("#total").val();
			var paymentStatus = $("#paymentStatus").val();

			// form validation 
			if(orderDate == "") {
				$("#orderDate").after('<p class="text-danger"> Este campo es obligatorio </p>');
				$('#orderDate').closest('.form-group').addClass('has-error');
			} else {
				$('#orderDate').closest('.form-group').addClass('has-success');
			} // /else

			if(clientName == "") {
				$("#clientName").after('<p class="text-danger"> Este campo es obligatorio </p>');
				$('#clientName').closest('.form-group').addClass('has-error');
			} else {
				$('#clientName').closest('.form-group').addClass('has-success');
			} // /else
			if(subTotal == 0.00) {
				$("#subTotal").after('<p class="text-danger"> Parece que no hay ningun producto </p>');
				$('#subTotal').closest('.form-group').addClass('has-error');
			} else {
				$('#subTotal').closest('.form-group').addClass('has-success');
			} // /else
			if(iva == "") {
				$("#iva").after('<p class="text-danger"> Parece que no hay ningun producto </p>');
				$('#iva').closest('.form-group').addClass('has-error');
			} else {
				$('#iva').closest('.form-group').addClass('has-success');
			} // /else
			if(total == 0.00) {
				$("#total").after('<p class="text-danger"> Parece que no hay ningun producto </p>');
				$('#total').closest('.form-group').addClass('has-error');
			} else {
				$('#total').closest('.form-group').addClass('has-success');
			} // /else
			if(paymentStatus == "") {
				$("#paymentStatus").after('<p class="text-danger"> Este campo es obligatorio </p>');
				$('#paymentStatus').closest('.form-group').addClass('has-error');
			} else {
				$('#paymentStatus').closest('.form-group').addClass('has-success');
			} // /else
				
			if(orderDate  && clientName && subTotal && iva && total && paymentStatus) {
			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: "orderDate="+orderDate+"&&clientName="+clientName+"&&subTotal="+subTotal+"&&iva="+iva+"&&total="+total+"&&paymentStatus="+paymentStatus,					
				success:function(response) {
					console.log(response);
					$(".text-danger").remove();
					$('.form-group').removeClass('has-error').removeClass('has-success');

					if(response.success == true) {
								
						$(".success-messages").html('<div class="alert alert-success">'+
						'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
						'<strong><i class="glyphicon glyphicon-ok"></i></strong>'+ response.messages +'</div>');
						
					}else {
						$(".success-messages").html('<div class="alert alert-info">'+
						'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
						'<strong><i class="glyphicon glyphicon-info-sign"></i></strong>'+ response +'</div>');
					}
						
				} // /response
			});
		}
        return false;
		}); 
	  
});

	//Modal
function load(page){
			var q= $("#q").val();
			$("#loader").fadeIn('slow');
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
		}

function agregar(id){
	var cantidad = document.getElementById('cantidad_'+id).value;
	//Inicia validacion
	if (isNaN(cantidad))
	{
	alert('Esto no es un numero');
	document.getElementById('cantidad_'+id).focus();
	return false;
	}
	//Fin validacion
	$.ajax({
		type: "POST",
		url: "./php_action/addOrder.php",
		data: "id="+id+"&&cantidad="+cantidad,
		 beforeSend: function(){
			$("#resultados").html("Mensaje: Cargando...");
		  },
		success: function(data){
		$("#resultados").html(data);
		}
			});
}

function eliminar(id)
	{
		$.ajax({
	type: "GET",
	url: "php_action/addOrder.php",
	data: "id="+id,
	 beforeSend: function(objeto){
		$("#resultados").html("Mensaje: Cargando...");
	  },
	success: function(datos){
	$("#resultados").html(datos);
	}
		});

	}

	function resetOrderForm()
	{
		$.ajax({
	type: "GET",
	url: "php_action/resetOrder.php",
	 beforeSend: function(objeto){
		$("#resultados").html("Mensaje: Cargando...");
	  },
	success: function(datos){
	$("#resultados").html(datos);
	}
		});

	}