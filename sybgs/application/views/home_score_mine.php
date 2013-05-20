<?php include('home_header.php'); ?>
<div>
	<ul class="breadcrumb">
		<li>
			<?php echo anchor('home','Home')?> <span class="divider">/</span>
		</li>
		<li><?php echo $title;?></li>
	</ul>
</div>
<div class="Toolbar_inbox">
    <a href="<?php echo site_url('home/excel/').'/'.$caid?>" class="btn btn-small"><i class="icon-plus"></i> <span>导出我的评分表</span></a>
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
    <table class="table table-striped table-bordered bootstrap-datatable">
      <thead>
      <tr>
		<th class="line_l">实验报告书名称</th>
        <th class="line_l">作者</th>
        <th class="line_l">备注说明</th>
        <th class="line_l">评分项1</th>
        <th class="line_l">评分项2</th>
		<th class="line_l">评分项3</th>
		<th class="line_l">评分项4</th>
		<th class="line_l">总分</th>
        <th class="line_l">操作</th>
      </tr>
      </thead>
      <tbody>
      <?php if ($works):?>
	  <?php foreach ($works as $row):?>
	  <tr overstyle='on' id="user_<?php echo $row->wid?>">
        <td><?php echo $row->wname?></td>
        <td> <?php echo $row->wauthor?> </td>
		<td> <?php echo $row->wbz?></td>
		<?php 
		$this->load->model('Home_model');
		if($uid == 'admin')$uid = 0;
		$score = $this->Home_model->getScoreOne($uid,$row->caid,$row->wid);
		if($score):
		?>
        <td><?php echo $score->score1?></td>
		<td><?php echo $score->score2?></td>
		<td><?php echo $score->score3?></td>
		<td><?php echo $score->score4?></td>
		<td><?php echo $score->score5?></td>
		<?php else:?>
		<td colspan="5" align="center" style="color:#FF0000">您还没有为该实验报告书评分，请评分~！</td>
		<?php endif;?>
        <td>
		<?php if($score):?>
			<a class="btn btn-small btn-info" href="<?php echo site_url('home/modGrade').'/'.$score->sid?>">重新评分</a>
		<?php else:?>
			<a class="btn btn-small btn-info" href="<?php echo site_url('home/addGrade').'/'.$row->wid?>">评分</a>
		<?php endif;?>
		</td>
      </tr>
	  <?php endforeach;?>
	  <?php else:?>
	  <tr overstyle='on' id="user_0">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="7" align="center">
		抱歉,没有找到您要找的内容~
		</td>
        <td>&nbsp;</td>
      </tr>
	  <?php endif;?>
	  </tbody>
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
</div>
</div>
<?php include('home_footer.php'); ?>
