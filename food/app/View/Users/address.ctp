<?php echo $this->element("user_menu")?>
<?php //echo $this->Html->css(array('jquery-ui-1.9.2.custom.min'), array('inline' => false)); ?>
<?php echo $this->Html->script(array('jquery.form.min'), array('inline' => false)); ?>
<div id="product-detail" class="box_p">
 	<h2><?php  echo __('My Addresses'); ?><a href="javascript:void(0)" class="btn btn-link add_address_btn">Add Address</a></h2>
 	<table style="width: 100%" class="user_address">
 		<thead>
 			<tr>
 				<th>user name</th>
 				<th>country</th>
 				<th>state</th>
 				<th>zip</th>
 				<th>city</th>
 				<th>address</th>
 				<th>action</th>
 			</tr>
 		</thead>
 		<?php if(!empty($address)){?>
 		<tbody>
 		<?php foreach($address as $k=>$v){?>
 			<tr>
 				<td><?php echo $v["UserAddress"]["first_name"]?> <?php echo $v["UserAddress"]["last_name"]?></td>
 				<td><?php echo $v["UserAddress"]["shipping_country"]?></td>
 				<td><?php echo $v["UserAddress"]["shipping_state"]?></td>
 				<td><?php echo $v["UserAddress"]["shipping_zip"]?></td>
 				<td><?php echo $v["UserAddress"]["shipping_city"]?></td>
 				<td><?php echo $v["UserAddress"]["shipping_address"]?></td>
 				<td></td>
 			</tr>
 		<?php }?>
 		</tbody>
 		<?php }?>
 	</table>
</div>

<div id="dialog" title="<?php  echo __('Address Information'); ?>">
  <div id="add_address_content"></div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$( "#dialog" ).dialog({
			width: 480,
			autoOpen: false,
	      	modal: true,
	      	buttons:{
		      	"Save Address":function(){
			      		$("#address_add_submit").click();
			      },
	      		 Cancel: function() {
	      	          $( this ).dialog( "close" );
	      	          //刷新页面
		      	        location.reload();
	      	       }
		    }
	      });
	$("a.add_address_btn").click(function(){
		$.get("<?php echo $webroot?>users/address",function(data){
			$("#add_address_content").html(data);
			$( "#dialog" ).dialog("open");
			$('#UserAddressAddressForm').ajaxForm({
				complete : function(xhr) {
					$("#add_address_content").html(xhr.responseText);
				}
			}); 
		})
	});
});
</script>