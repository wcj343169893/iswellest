<div id="box">
   <h3>Products</h3>
    <table width="100%">
	<thead>
		<tr>
	        <th><a href="#">Name</a></th>
	        <th><a href="#">Excerpt</a></th>
	        <th>Status</th>
	        <th>Price</th>
	        <th style="width: 105px;">Action</th>
    	</tr>
	</thead>
	<tbody>
	<?php if(!empty($orders)){foreach($orders as $k=>$v){?>
		<tr>
           <td><a href="/admin/products/view/<?php echo $v["Product"]["id"]?>"><?php echo $v["Product"]["name"]?></a></td>
           <td><?php echo $this->Text->truncate($v["Product"]["excerpt"],20)?></td>
           <td class="t_center"><?php echo $v["Product"]["active"]?"Active":"DisActive" ?></td>
           <td class="t_center"><?php echo $v["Product"]["price"]?></td>
           <td class="t_center">
           	<a href="/admin/products/view/<?php echo $v["Product"]["id"]?>">View</a> | 
           	<a href="/admin/products/edit/<?php echo $v["Product"]["id"]?>">Edit</a> |
           	<a href="/admin/products/delete/<?php echo $v["Product"]["id"]?>">Delete</a>
           </td>
       </tr>
      <?php }}?>
	</tbody>
</table>
<?php echo $this->element("paging",array("paging_url"=>"/admin/products"),array('plugin'=>"admin"));?>
</div>
