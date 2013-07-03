<div id="box">
   <h3>Users</h3>
    <table width="100%">
	<thead>
		<tr>
	        <th width="40px"><a href="#">ID<img src="/img/icons/arrow_down_mini.gif" width="16" height="16" align="absmiddle" /></a></th>
	        <th><a href="#">Full Name</a></th>
	        <th><a href="#">Email</a></th>
	        <th width="70px"><a href="#">Group</a></th>
	        <th width="50px"><a href="#">ZIP</a></th>
	        <th width="90px"><a href="#">Registered</a></th>
	        <th width="60px"><a href="#">Action</a></th>
    	</tr>
	</thead>
	<tbody>
	<?php if(!empty($users)){foreach($users as $k=>$v){?>
		<tr>
           <td class="a-center"><?php echo $v["User"]["id"]?></td>
           <td><a href="#"><?php echo $v["User"]["first_name"]." ".$v["User"]["last_name"]?></a></td>
           <td><?php echo $v["User"]["email"]?></td>
           <td>General</td>
           <td><?php echo $v["User"]["zip"]?></td>
           <td><?php echo $v["User"]["join_date"]?></td>
           <td>
	           <a href="/admin/users/show/<?php echo $v["User"]["id"]?>"><img src="/img/icons/user.png" title="Show profile" width="16" height="16" /></a>
	           <a href="/admin/users/edit/<?php echo $v["User"]["id"]?>"><img src="/img/icons/user_edit.png" title="Edit user" width="16" height="16" /></a>
	           <a href="/admin/users/delete/<?php echo $v["User"]["id"]?>"><img src="/img/icons/user_delete.png" title="Delete user" width="16" height="16" /></a>
           </td>
       </tr>
      <?php }}?>
	</tbody>
</table>
<?php echo $this->element("paging",array("paging_url"=>"/admin/users"),array('plugin'=>"admin"));?>
</div>
