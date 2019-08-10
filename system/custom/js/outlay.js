var manageOutlayTable;
$(document).ready(function() {

	var divRequest = $(".div-request").text();

		// top nav bar
		$("#navOutlay").addClass('active');
		// add order
		// top nav child bar
        $('#managerOutlay').addClass('active');

manageOutlayTable = $('#manageOutlayTable').DataTable({
	'ajax' : 'php_action/fetchOutlay.php',
	 dom: 'Bfrtip',
	 responsive: true,
	  fixedColumns: true,
	buttons: [
			'print', 'excel', 'pdf'
	]
}); // manage outlay Data Table

});

function removeOutlay(outlayId) {
	if(outlayId) {
		$("#removeOutBtn").unbind('click').bind('click', function() {
			$("#removeOutBtn").button('loading');

			console.log(outlayId);
			$.ajax({
				url: 'php_action/removeOutlay.php',
				type: 'post',
				data: {outlayId : outlayId},
				dataType: 'json',
				success:function(response) {
					$("#removeOutBtn").button('reset');
                console.log(response);
					if(response.success == true) {

						manageOutlayTable.ajax.reload(null, false);
						// hide modal
						$("#removeOutModal").modal('hide');
						// success messages
						$("#removeOutMessages").html('<div class="alert alert-success">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert

					} else {
						// error messages
						$(".removeOutMessages").html('<div class="alert alert-warning">'+
	            '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
	            '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.messages +
	          '</div>');

						// remove the mesages
	          $(".alert-success").delay(500).show(10, function() {
							$(this).delay(3000).hide(10, function() {
								$(this).remove();
							});
						}); // /.alert
					} // /else

				} // /success
			});  // /ajax function to remove the order

		}); // /remove order button clicked


	} else {
		alert('error! refresh the page again');
	}
}
