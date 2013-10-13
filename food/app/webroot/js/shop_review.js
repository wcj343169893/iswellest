function to(url) {
	window.location.href = url;
}
$(document).ready(function(){

	//cardtype($('#OrderCreditcardNumber').val());

	$('#OrderCreditcardNumber').keyup(function() {
		//cardtype($('#OrderCreditcardNumber').val());
	});

	function cardtype(num) {

		if(num.length == 1) {

			if(num == 4){
				$('#ccbox').css('background-position', '0 -23px');
			}
			else if(num == 5){
				$('#ccbox').css('background-position', '0 -46px');
			}
			else if(num == 3){
				$('#ccbox').css('background-position', '0 -69px');
			}
			else if(num == 6){
				$('#ccbox').css('background-position', '0 -92px');
			}

		} else if(num.length < 1){
			$('#ccbox').css('background-position', '0 0');
		}

		return true;

	}
	//增加地址切换 
	$("#change_address_btn").click(function(){
		$("#other_address_part").empty();
		$.get(Shop.basePath+"users/uaddress.json",function(data){
			if(data){
				var html="<table>";
				html+="<thead>";
				html+="<tr>";
				html+="<th>user name</th>";
				html+="<th>phone</th>";
				html+="<th>country</th>";
				html+="<th>state</th>";
				html+="<th>zip</th>";
				html+="<th>city</th>";
				html+="<th>address</th>";
				html+="<th>action</th>";
				html+="</tr>";
				html+="</thead>";
				html+="<tbody>";
				$.each(data,function(index,elem){
					html+="<tr>";
					html+="<td>"+elem["UserAddress"]["first_name"]+elem["UserAddress"]["last_name"]+"</td>";
					html+="<td>"+elem["UserAddress"]["phone"]+"</td>";
					html+="<td>"+elem["UserAddress"]["shipping_country"]+"</td>";
					html+="<td>"+elem["UserAddress"]["shipping_state"]+"</td>";
					html+="<td>"+elem["UserAddress"]["shipping_zip"]+"</td>";
					html+="<td>"+elem["UserAddress"]["shipping_city"]+"</td>";
					html+="<td>"+elem["UserAddress"]["shipping_address"]+"</td>";
					html+="<td><a href='javascript:void(0)' class='btn btn-info add_other_address' data-id='"+elem["UserAddress"]["id"]+"'>Check</a></td>";
					html+="</tr>";
				});
				html+="</tbody>";
				html+="</table>";
				$("#other_address_part").html(html);
			}
		});
	});
	//切换地址
	$("#other_address_part .add_other_address").live("click",function(){
		to(Shop.basePath+"shop/review?change_address="+$(this).data("id"));
	});
});
