<?php include('home_header.php'); ?>
<div>
	<ul class="breadcrumb">
		<li><?php echo anchor('home','Home')?> <span class="divider">/</span></li>
		<li><?php echo $title?></li>
	</ul>
</div>
<div class="Toolbar_inbox">
    <a href="<?php echo site_url('home/addUsers/'.$role)?>" class="btn btn-small"><i class="icon-plus"></i> <span>添加<?php echo $role_name?>信息</span></a>
</div>
<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i> <?php echo $title?></h2>
			<div class="box-icon">
				<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
			</div>
		</div>
		<div class="box-content">
  <div class="list">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped table-bordered bootstrap-datatable datatable dataTable">
     <thead>
	      <tr>
			<th class="line_l">ID</th>
	        <th class="line_l"><?php echo $role_name?>姓名</th>
	        <th class="line_l">邮箱</th>
	        <th class="line_l">电话</th>
	        <?php if(empty($role)){?>
	        <th class="line_l">科技理念类权限</th>
			<th class="line_l">科技理念类权限</th><?php }?>
	        <th class="line_l">操作</th>
	      </tr>
      </thead>
      <tbody>
	      <?php if ($users):?>
		  <?php foreach ($users as $row):?>
		  <tr overstyle='on' id="user_<?php echo $row->uid?>">
	        <td><?php echo $row->uid?></td>
	        <td><?php echo $row->name?></td>
	        <td> <?php echo $row->email?> </td>
	        <td> <?php echo $row->tel?></td>
	        <?php if(empty($role)){?>
			<td> <?php echo $row->qx1 ? '有' : '无';?></td>
	        <td><?php echo $row->qx2 ? '有' : '无';?></td><?php }?>
	        <td>
	        <a class="btn btn-info" href="<?php echo site_url('home/modUsers').'/'.$row->uid?>">
				<i class="icon-edit icon-white"></i>  
				编辑                                          
			</a>
			<a class="btn btn-danger" href="<?php echo site_url('home/delUsers').'/'.$row->uid?>" onclick="return confirm('删除后无法恢复,确定要删除吗?')">
				<i class="icon-trash icon-white"></i> 
				删除
			</a>
	      </tr>
		  <?php endforeach;?>
		  <?php else:?>
		  <tr overstyle='on' id="user_0">
	        <td>&nbsp;</td>
	        <td>&nbsp;</td>
	        <td colspan="5" align="center">
			抱歉,没有找到您要找的内容~
			</td>
	        <td>&nbsp;</td>
	      </tr>
		  <?php endif;?>
	  </tbody>
    </table>
  </div>
</div>
<script>
	function checkon(o){
		if( o.checked == true ){
			$(o).parents('tr').addClass('bg_on') ;
		}else{
			$(o).parents('tr').removeClass('bg_on') ;
		}
	}
	
	function checkAll(o){
		if( o.checked == true ){
			$('input[name="checkbox"]').attr('checked','true');
			$('tr[overstyle="on"]').addClass("bg_on");
		}else{
			$('input[name="checkbox"]').removeAttr('checked');
			$('tr[overstyle="on"]').removeClass("bg_on");
		}
	}
</script>
</div></div>
<?php include('home_footer.php'); ?>