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
    <a href="<?php echo site_url('home/excel').'/'.$caid?>" class="btn btn-small"><i class="icon-plus"></i> <span>导出Excel</span></a>
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
	  		<div class="control-group">
			<div class="controls">
			  <select data-rel="chosen" name="caid" onchange="window.location.href='<?php echo site_url('home/scorelist');?>/'+this.value">
				<option value="1" <?php if($caid==1):?>selected="selected"<?php endif;?>>===科技理念类===</option>
				<option value="2" <?php if($caid==2):?>selected="selected"<?php endif;?>>===科技实物类===</option>
			  </select>
			</div>
		  </div>
    <table class="table table-striped table-bordered bootstrap-datatable">
    <thead>
      <tr>
		<th class="line_l">实验报告书名称</th>
        <th class="line_l">作者</th>
        <th class="line_l">科学性</th>
        <th class="line_l">环保理念</th>
        <th class="line_l">创新性</th>
		<th class="line_l">可行性</th>
		<?php if($caid ==1):?>
		<th class="line_l">文字表述</th>
		<?php else:?>
		<th class="line_l">经济性</th>
		<?php endif;?>
		<th class="line_l" style="background:#CCCCCC; font-weight:bold; color:#333333">总分</th>
		<th class="line_l">(是/否)及格</th>
		<th class="line_l">评分人数</th>
        <th class="line_l">详细</th>
      </tr>
      </thead>
      <tbody>
      <?php if ($works):?>
	  <?php foreach ($works as $row):?>
	  <tr overstyle='on' id="user_<?php echo $row->wid?>">
        <td><?php echo $row->wname?></td>
        <td> <?php echo $row->wauthor?> </td>
		<?php 
		$this->load->model('Home_model');
		$score = $this->Home_model->getScores(0,$row->caid,$row->wid);
		$this->db->close();
		if($score):
		$i = 0;$fenshu1=0;$fenshu2=0;$fenshu3=0;$fenshu4=0;$fenshu5=0;$fenshu6=0;$fenshu7=0;$iswin=0;$islose=0;
		foreach ($score as $fen){
			$fenshu1 += $fen->score1;
			$fenshu2 += $fen->score2;
			$fenshu3 += $fen->score3;
			$fenshu4 += $fen->score4;
			$fenshu5 += $fen->score5;
			$fenshu7 += $fen->score7;
			if($fen->iswin)$iswin++;
			else $islose++;
			$i++;
		}
		?>
        <td><?php echo sprintf("%.2f",$fenshu1/$i)?></td>
		<td><?php echo sprintf("%.2f",$fenshu2/$i)?></td>
		<td><?php echo sprintf("%.2f",$fenshu3/$i)?></td>
		<td><?php echo sprintf("%.2f",$fenshu4/$i)?></td>
		<td><?php echo sprintf("%.2f",$fenshu5/$i)?></td>
		<td style="background:#CCCCCC; font-weight:bold"><?php echo sprintf("%.2f",$fenshu7/$i)?></td>
		<td><?php echo $iswin.'/'.$islose?></td>
		<td><?php echo $i?>人</td>
		<?php else:?>
		<td colspan="8" align="center" style="color:#FF0000">老师尚未对该作品评分~！</td>
		<?php endif;?>
        <td>
		<?php if($score):?>
		<a href="<?php echo site_url('home/scoreOne').'/'.$row->wid?>" class="btn btn-info">详细</a>
		<?php endif;?>
		</td>
      </tr>
	  <?php endforeach;?>
	  <?php else:?>
	  <tr overstyle='on' id="user_0">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="9" align="center">抱歉,没有找到您要找的内容~</td>
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