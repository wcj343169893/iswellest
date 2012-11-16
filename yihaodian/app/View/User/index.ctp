<div><a href="/user/add" class="btn btn-info">新增</a></div>
<table>
	<tr>
		<th><?php echo $this->Paginator->sort('id',"编号");?></th>
		<th>用户名</th>
		<th>密码</th>
		<th>生日</th>
		<th>操作</th>
	</tr>
	<?php foreach ($data as $k => $v): ?>
	<tr>
		<td><?php echo $v["User"]["id"];?></td>
		<td><?php echo $v["User"]["username"];?></td>
		<td><?php echo $v["User"]["password"];?></td>
		<td><?php echo $v["User"]["birthday"];?></td>
		<td>
			<a href="/user/view/<?php echo $v["User"]["id"];?>" class="btn btn-info">查看</a>
			<a href="/user/edit/<?php echo $v["User"]["id"];?>" class="btn btn-warning">修改</a>
			<a href="/user/delete/<?php echo $v["User"]["id"];?>" class="btn btn-danger" onclick="if (confirm('Are you sure?')) { return true;} return false;">删除</a>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
<div>
	<?php echo $this->Paginator->first();?>
	<?php echo $this->Paginator->prev();?>
	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->last();?>
	<?php echo $this->Paginator->counter('Page {:page} of {:pages}');?>
</div>