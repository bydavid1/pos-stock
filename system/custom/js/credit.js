$(document).ready(function () {
	load(1);
});

function load(page) {
	var q = $("#q").val();
	$("#loader").fadeIn('slow');
	$.ajax({
		url: './php_action/manageCredit.php?action=ajax&page=' + page + '&q=' + q,
		beforeSend: function (objeto) {
			$('#loader').html('<img src="./assests/images/ajax-loader.gif"> Cargando...');
		},
		success: function (data) {
			$(".outer_div").html(data).fadeIn('slow');
			$('#loader').html('');

		}
	});
}

function view(id) {
	$.ajax({
		url: './php_action/view.php?type=credit&id=' + id,
		beforeSend: function (objeto) {
			$('#gif').html('<img src="./assests/images/ajax-loader.gif"> Cargando...');
		},
		success: function (data) {
			$(".data").html(data).fadeIn('slow');
			$('#gif').html('');

		}
	});
}

function remove(id) {
	if (id) {
		$("#removeCreditBtn").unbind('click').bind('click', function () {
			// loading remove button
			$("#removeCreditBtn").button('loading');
			$.ajax({
				url: 'php_action/removeCredit.php',
				type: 'post',
				data: {
					id: id
				},
				dataType: 'json',
				success: function (response) {
					// loading remove button
					$("#removeCreditBtn").button('reset');
					if (response.success == true) {

						// remove success messages
						$(".removeCreditMessages").html('<div class="alert alert-success">' +
							'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
							'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
							'</div>');

						load(1);

						// remove the mesages
						$(".alert-success").delay(500).show(10, function () {
							$(this).delay(2000).hide(10, function () {
								$(this).remove();
							});
						}); // /.alert
					} else {

						// remove success messages
						$(".removeCreditMessages").html('<div class="alert alert-success">' +
							'<button type="button" class="close" data-dismiss="alert">&times;</button>' +
							'<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> ' + response.messages +
							'</div>');

						// remove the mesages
						$(".alert-success").delay(500).show(10, function () {
							$(this).delay(2000).hide(10, function () {
								$(this).remove();
							});
						}); // /.alert

					} // /error
				} // /success function
			}); // /ajax fucntion to remove the product
			return false;
		}); // /remove product btn clicked
	} // /if productid
}