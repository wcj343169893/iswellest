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
    <a href="<?php echo site_url('home/excel2').'/'.$wid?>" class="btn btn-small"><i class="icon-plus"></i> <span>导出Excel</span></a>
</div>
<div class="form-horizontal">
      <dl class="lineD">
        <dt>一、所属类别：</dt>
        <dd><?php if($works->caid == 1)echo '科技理念类';else echo '科技实物类';?></dd>
      </dl>
      <dl class="lineD">
        <dt>二、实验报告书名称：</dt>
        <dd><?php echo $works->wname?></dd>
      </dl>
	  <dl class="lineD">
        <dt>三、作者：</dt>
        <dd><?php echo $works->wauthor?></dd>
      </dl>
	  <dl class="lineD">
        <dt>四、实验报告书详情：</dt>
        <dd><p id="files"><?php echo $play;?></p></dd>
      </dl>
      <div class="page_btm">
      </div>
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
			<th class="line_l">老师姓名</th>
			<th class="line_l">科学性</th>
	        <th class="line_l">环保理念</th>
	        <th class="line_l">创新性</th>
			<th class="line_l">可行性</th>
			<?php if($works->caid == 1):?>
			<th class="line_l">文字表述</th>
			<?php else:?>
			<th class="line_l">经济性</th>
			<?php endif;?>
			<th class="line_l" style="background:#CCCCCC; font-weight:bold">总分</th>
			<th class="line_l">(是/否)及格</th>
	      </tr>
	      </thead>
	      <tbody>
	  <?php 
	  $i=0;$fs1=0;$fs2=0;$fs3=0;$fs4=0;$fs5=0;$fs6=0;$fs7=0;$iswin=0;$islose=0;
	  foreach ($score as $row):?>
	  <tr overstyle='on' id="user_<?php echo $row->sid?>">
        <td><?php $user = $this->Home_model->getDataOne('users','uid',$row->uid);echo $user->name;?></td>
        <td><?php echo $row->score1?> </td>
        <td><?php echo $row->score2?></td>
		<td><?php echo $row->score3?></td>
		<td><?php echo $row->score4?></td>
		<td><?php echo $row->score5?></td>
        <td style="background:#CCCCCC; font-weight:bold"><?php echo $row->score7?></td>
		<td><?php echo $row->iswin ? '是' : '否'?></td>
      </tr>
	  <?php
	  $fs1+=$row->score1;
	  $fs2+=$row->score2;
	  $fs3+=$row->score3;
	  $fs4+=$row->score4;
	  $fs5+=$row->score5;
	  $fs7+=$row->score7;
	  if($row->iswin)$iswin++;
	  else $islose++;	  
	  $i++;
	  endforeach;?>
	  <tr overstyle='on' id="user_0" style="color:#FF0000; font-weight:bold;">
        <td align="center">平均得分:</td>
        <td><?php echo sprintf("%.2f",$fs1/$i)?> </td>
        <td><?php echo sprintf("%.2f",$fs2/$i)?></td>
		<td><?php echo sprintf("%.2f",$fs3/$i)?></td>
		<td><?php echo sprintf("%.2f",$fs4/$i)?></td>
		<td><?php echo sprintf("%.2f",$fs5/$i)?></td>
		<td style="background:#EEEEEE"><?php echo sprintf("%.2f",$fs7/$i)?></td>
		<td><?php echo $iswin.'/'.$islose;?></td>
      </tr>
      </tbody>
    </table>
  </div>
</div>
</div>
<?php include('home_footer.php'); ?>
