var manageBrandTable;

$(document).ready(function() {
	// top bar active
	//$('#navBrand').addClass('active');
    load(1);
	// submit brand form function
	$("#submitBrandForm").unbind('submit').bind('submit', function() {
		// remove the error text
		$(".text-danger").remove();
		// remove the form error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		var brandName = $("#brandName").val();
		var brandStatus = $("#brandStatus").val();
		var brandCode = $("#brandCode").val();
		var nit = $("#nit").val();
		var address = $("#address").val();
		var phone = $("#phone").val();

		if(brandName == "") {
			$("#brandName").after('<p class="text-danger">Este campo es obligatorio</p>');
			$('#brandName').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#brandName").find('.text-danger').remove();
			// success out for form
			$("#brandName").closest('.form-group').addClass('has-success');
		}

		if(brandStatus == "") {
			$("#brandStatus").after('<p class="text-danger">Este campo es obligatorio</p>');

			$('#brandStatus').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#brandStatus").find('.text-danger').remove();
			// success out for form
			$("#brandStatus").closest('.form-group').addClass('has-success');
		}
		if(brandCode == "") {
			$("#brandCode").after('<p class="text-danger">Este campo es obligatorio</p>');
			$('#brandCode').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#brandCode").find('.text-danger').remove();
			// success out for form
			$("#brandCode").closest('.form-group').addClass('has-success');
		}
		if(nit == "") {
			$("#nit").after('<p class="text-danger">Este campo es obligatorio</p>');
			$('#nit').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#nit").find('.text-danger').remove();
			// success out for form
			$("#nit").closest('.form-group').addClass('has-success');
		}
		if(phone == "") {
			$("#phone").after('<p class="text-danger">Este campo es obligatorio</p>');
			$('#phone').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#phone").find('.text-danger').remove();
			// success out for form
			$("#phone").closest('.form-group').addClass('has-success');
		}

		if(address == "") {
			$("#address").after('<p class="text-danger">Este campo es obligatorio</p>');
			$('#address').closest('.form-group').addClass('has-error');
		} else {
			// remov error text field
			$("#address").find('.text-danger').remove();
			// success out for form
			$("#address").closest('.form-group').addClass('has-success');
		}

		if(brandName && brandStatus && brandCode && phone && nit && address) {
			var form = $(this);
			// button loading
			$("#createBrandBtn").button('loading');

			$.ajax({
				url : form.attr('action'),
				type: form.attr('method'),
				data: form.serialize(),
				dataType: 'json',
				success:function(response) {
					// button loading
					$("#createBrandBtn").button('reset');

					if(response.success == true) {
						// reload the manage member table
						manageBrandTable.ajax.reload(null, false);

  	  			// reset the form text
						$("#submitBrandForm")[0].reset();
						// remove the error text
						$(".text-danger").remove();
						// remove the form error
						$('.form-group').removeClass('has-error').removeClass('has-success');

  	  			$('#add-brand-messages').html('<div class="alert alert-success">'+
            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
          '</div>');

  	  			$(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					}  // if

				} // /success
			}); // /ajax
		} // if

		return false;
	}); // /submit brand form function

});

function load(page){
    var q= $("#q").val();
    $("#loader").fadeIn('slow');
    $.ajax({
        url:'./php_action/manageProviders.php?action=ajax&page='+page+'&q='+q,
         beforeSend: function(objeto){
         $('#loader').html('<img src="./assests/images/ajax-loader.gif"> Cargando...');
      },
        success:function(data){
            $(".outer_div").html(data).fadeIn('slow');
            $('#loader').html('');

        }
    })
}

function editBrands(brandId = null) {
	if(brandId) {
		// remove hidden brand id text
		$('#brandId').remove();

		// remove the error
		$('.text-danger').remove();
		// remove the form-error
		$('.form-group').removeClass('has-error').removeClass('has-success');

		// modal loading
		$('.modal-loading').removeClass('div-hide');
		// modal result
		$('.edit-brand-result').addClass('div-hide');
		// modal footer
		$('.editBrandFooter').addClass('div-hide');

		$.ajax({
			url: 'php_action/fetchSelectedBrand.php',
			type: 'post',
			data: {brandId : brandId},
			dataType: 'json',
			success:function(response) {
				// modal loading
				$('.modal-loading').addClass('div-hide');
				// modal result
				$('.edit-brand-result').removeClass('div-hide');
				// modal footer
				$('.editBrandFooter').removeClass('div-hide');
				// setting the brand name value
				$('#editBrandName').val(response.brand_name);
				// setting the brand status value
				$('#editBrandStatus').val(response.brand_active);
				// brand id
				$(".editBrandFooter").after('<input type="hidden" name="brandId" id="brandId" value="'+response.brand_id+'" />');

				// update brand form
				$('#editBrandForm').unbind('submit').bind('submit', function() {
					// remove the error text
					$(".text-danger").remove();
					// remove the form error
					$('.form-group').removeClass('has-error').removeClass('has-success');

					var brandName = $('#editBrandName').val();
					var brandStatus = $('#editBrandStatus').val();

					if(brandName == "") {
						$("#editBrandName").after('<p class="text-danger">Este campo es obligatorio</p>');
						$('#editBrandName').closest('.form-group').addClass('has-error');
					} else {
						// remov error text field
						$("#editBrandName").find('.text-danger').remove();
						// success out for form
						$("#editBrandName").closest('.form-group').addClass('has-success');
					}

					if(brandStatus == "") {
						$("#editBrandStatus").after('<p class="text-danger">Este campo es obligatorio</p>');

						$('#editBrandStatus').closest('.form-group').addClass('has-error');
					} else {
						// remove error text field
						$("#editBrandStatus").find('.text-danger').remove();
						// success out for form
						$("#editBrandStatus").closest('.form-group').addClass('has-success');
					}

					if(brandName && brandStatus) {
						var form = $(this);

						// submit btn
						$('#editBrandBtn').button('loading');

						$.ajax({
							url: form.attr('action'),
							type: form.attr('method'),
							data: form.serialize(),
							dataType: 'json',
							success:function(response) {

								if(response.success == true) {
									console.log(response);
									// submit btn
									$('#editBrandBtn').button('reset');

									// reload the manage member table
									manageBrandTable.ajax.reload(null, false);
									// remove the error text
									$(".text-danger").remove();
									// remove the form error
									$('.form-group').removeClass('has-error').removeClass('has-success');

			  	  			$('#edit-brand-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
								} // /if

							}// /success
						});	 // /ajax
					} // /if

					return false;
				}); // /update brand form

			} // /success
		}); // ajax function

	} else {
		alert('error!! Refresh the page again');
	}
} // /edit brands function

function removeBrands(brandId = null) {
	if(brandId) {
		$('#removeBrandId').remove();
		$.ajax({
			url: 'php_action/fetchSelectedBrand.php',
			type: 'post',
			data: {brandId : brandId},
			dataType: 'json',
			success:function(response) {
				$('.removeBrandFooter').after('<input type="hidden" name="removeBrandId" id="removeBrandId" value="'+response.brand_id+'" /> ');

				// click on remove button to remove the brand
				$("#removeBrandBtn").unbind('click').bind('click', function() {
					// button loading
					$("#removeBrandBtn").button('loading');

					$.ajax({
						url: 'php_action/removeBrand.php',
						type: 'post',
						data: {brandId : brandId},
						dataType: 'json',
						success:function(response) {
							console.log(response);
							// button loading
							$("#removeBrandBtn").button('reset');
							if(response.success == true) {

								// hide the remove modal
								$('#removeMemberModal').modal('hide');

								// reload the brand table
								manageBrandTable.ajax.reload(null, false);

								$('.remove-messages').html('<div class="alert alert-success">'+
			            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
			            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
			          '</div>');

			  	  			$(".alert-success").delay(500).show(10, function() {
										$(this).delay(3000).hide(10, function() {
											$(this).remove();
										});
									}); // /.alert
							} else {

							} // /else
						} // /response messages
					}); // /ajax function to remove the brand

				}); // /click on remove button to remove the brand

			} // /success
		}); // /ajax

		$('.removeBrandFooter').after();
	} else {
		alert('error!! Refresh the page again');
	}
} // /remove brands function
