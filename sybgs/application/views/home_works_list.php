<?php include('home_header.php'); ?>
<div>
	<ul class="breadcrumb">
		<li>
			<?php echo anchor('home','Home')?> <span class="divider">/</span>
		</li>
		<li><?php echo $title;?></li>
	</ul>
</div>
<?php if($uid != 'admin'):?>
<div class="Toolbar_inbox">
    <a href="<?php echo site_url('home/addWorks').'/'.$caid?>" class="btn btn-small"><i class="icon-plus"></i> <span>添加实验报告书</span></a>
</div>
<?php endif;?>
<div class="row-fluid sortable">		
	<div class="box span12">
		<div class="box-header well" data-original-title>
			<h2><i class="icon-user"></i> <?php echo $title?></h2>
			<div class="box-icon">
				<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
			</div>
		</div>
		<div class="box-content">
<div class="row-fluid sortable">
  <div class="control-group">
		<div class="controls">
		  <select data-rel="chosen" name="caid" onchange="window.location.href='<?php echo site_url('home/workslist');?>/'+this.value">
			<option value="1" <?php if($caid==1):?>selected="selected"<?php endif;?>>===科技理念类===</option>
			<option value="2" <?php if($caid==2):?>selected="selected"<?php endif;?>>===科技实物类===</option>
		  </select>
		</div>
	  </div>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-striped table-bordered bootstrap-datatable datatable2" data-url="<?php echo site_url('data/getTable')?>">
      <thead>
      <tr>
		<th class="line_l" alt="desc">ID</th>
        <th class="line_l">实验报告书名称</th>
        <th class="line_l">作者</th>
        <th class="line_l">所属类别</th>
		<th class="line_l">备注说明</th>
        <th class="line_l">操作</th>
      </tr>
      </thead>
      <tbody>
      <?php if ($works):?>
	  <?php foreach ($works as $row):?>
	  <tr overstyle='on' id="user_<?php echo $row->wid?>">
        <td><?php echo $row->wid?></td>
        <td><?php echo $row->wname?></td>
        <td> <?php echo $row->wauthor?> </td>
        <td> <?php echo $row->caid ? '科技理念类' : '科技实物类';?></td>
        <td><?php echo $row->wbz?></td>
        <td>
        <?php if($row->uid==$uid){?>
        <a class="btn btn-info" href="<?php echo site_url('home/modWorks').'/'.$row->wid?>"><i class="icon-edit icon-white"></i>  编辑</a>
        <?php }?>
        <a class="btn btn-danger" href="<?php echo site_url('home/delWorks').'/'.$caid.'/'.$row->wid?>" onclick="return confirm('删除后无法恢复,确定要删除吗?')"><i class="icon-trash icon-white"></i> 删除</a>
      </tr>
	  <?php endforeach;?>
	  <?php else:?>
	  <tr overstyle='on' id="user_0">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="4" align="center">
		抱歉,没有找到您要找的内容~
		</td>
        <td>&nbsp;</td>
      </tr>
	  <?php endif;?>
	  </tbody>
	  <tfoot></tfoot>
    </table>
    <div class="row-fluid">
	  	<div class="span12"><div class="dataTables_info" id="DataTables_Table_0_info">总共<?php echo $total?>条</div></div>
	  	<div class="span12 center">
		  <div class="dataTables_paginate paging_bootstrap pagination">
			<?php echo $pagination;?>
		  </div>
	    </div>
  	</div>
</div>
</div></div></div>
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
<?php include('home_footer.php'); ?>