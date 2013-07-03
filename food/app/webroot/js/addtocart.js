var quantity=1;
$(document).ready(function(){
	$('.addtocart').on('click', function(event) {
		$.ajax({
			type: "POST",
			url: Shop.basePath + "shop/itemupdate",
			data: {
				id: $(this).attr("id"),
				quantity: quantity,
			},
			dataType: "json",
			success: function(data) {
				$('#msg').html('<div class="alert alert-success" id="flash_msg">Product Added to Shopping Cart</div>');
				$('#flash_msg').delay(2000).fadeOut('slow');
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) {
				alert('big problems !!!'+textStatus+" . "+errorThrown);
			}
		});
		return false;
	});
});
