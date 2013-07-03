<div id="box">
   <h3>Orders</h3>
    <table width="100%">
	<thead>
		<tr>
	        <th><a href="#">Full Name</a></th>
	        <th><a href="#">STATUS</a></th>
	        <th width="70px"><a href="#">WEIGHT</a></th>
	        <th width="50px"><a href="#">TOTAL</a></th>
	        <th width="120px"><a href="#">DATE</a></th>
	        <th width="90px"><a href="#">DETAIL</a></th>
    	</tr>
	</thead>
	<tbody>
	<?php if(!empty($orders)){foreach($orders as $k=>$v){?>
		<tr>
           <td><a href="#"><?php echo $v["Order"]["first_name"]." ".$v["Order"]["last_name"]?></a></td>
           <td><?php echo $v["Order"]["authorization"]?></td>
           <td><?php echo $v["Order"]["weight"]?></td>
           <td><?php echo $v["Order"]["total"]?></td>
           <td><?php echo $v["Order"]["created"]?></td>
           <td class="itemdetail"><a href="javascript:void(0);" data-id="<?php echo $v["Order"]["id"]?>" class="showItemDetail">Detail</a>
           		<div id="order_items_<?php echo $v["Order"]["id"]?>" class="orderitems">
           			<table>
           				<tr>
           					<td>NAME</td>
           					<td>WEIGHT</td>
           					<td>SUBTOTAL</td>
           				</tr>
           				<?php if(!empty($v["OrderItem"])){foreach($v["OrderItem"] as $items){?>
           				<tr>
           					<td><?php echo $items["name"]?></td>
           					<td><?php echo $items["weight"]?></td>
           					<td><?php echo $items["subtotal"]?></td>
           				</tr>
           				<?php }}?>
           			</table>
           		</div>
           </td>
       </tr>
      <?php }}?>
	</tbody>
</table>
<?php echo $this->element("paging",array("paging_url"=>"/admin/orders"),array('plugin'=>"admin"));?>
</div>
<script type="text/javascript">
	$(document).ready(function(){
			$(".showItemDetail").bind("click",function(){
					var id="order_items_"+$(this).data("id");
					$("#"+id).show();
				});
		});
</script>
