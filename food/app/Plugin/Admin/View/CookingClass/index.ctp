<div id="box">
   <h3>CookingClass</h3>
    <table width="100%">
	<thead>
		<tr>
	        <th><a href="#">Name</a></th>
	        <th width="70px"><a href="#">Start Order</a></th>
	        <th width="90px"><a href="#">Start Learning</a></th>
	        <th width="70px"><a href="#">End Learning</a></th>
	        <th width="50px"><a href="#">Status</a></th>
	        <th width="70px"><a href="#">Action</a></th>
    	</tr>
	</thead>
	<tbody>
	<?php if(!empty($cooking)){foreach($cooking as $k=>$v){?>
		<tr>
           <td><a href="<?php echo $webroot?>admin/cookingclass/view/<?php echo $v["Cooking"]["id"]?>"><?php echo $v["Cooking"]["name"]?></a></td>
           <td><?php echo $this->Time->format("Y-m-d",$v["Cooking"]["start_order"])?></td>
           <td><?php echo $this->Time->format("Y-m-d",$v["Cooking"]["start_learning"])?></td>
           <td><?php echo $this->Time->format("Y-m-d",$v["Cooking"]["end_learning"])?></td>
           <td><?php echo empty($v["Cooking"]["active"])?"DisActive":"Active"?></td>
           <td><a href="<?php echo $webroot?>admin/cookingclass/edit/<?php echo $v["Cooking"]["id"]?>">Edit</a></td>
       </tr>
      <?php }}?>
	</tbody>
</table>
<?php echo $this->element("paging",array("paging_url"=>$webroot."admin/cookingclass"),array('plugin'=>"admin"));?>
</div>
