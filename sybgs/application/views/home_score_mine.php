<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>北京林业大学</title>
<base href="<?php echo base_url() ;?>"/>
<link href="resource/home/style2.css" rel="stylesheet" type="text/css">
<link href="resource/home/box.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="resource/home/js/jquery.js"></script>
<script type="text/javascript" src="resource/home/js/common.js"></script>
<script type="text/javascript" src="resource/home/js/box.js"></script>
</head>
<body>
<div class="so_main">
  <div class="page_tit"><?php echo $title?></div>
  <div class="Toolbar_inbox">
    <div class="page right">
		共<?php echo $total;?>个实验报告书&nbsp;&nbsp;&nbsp;<?php echo $pagination;?>
	</div>
	<a href="<?php echo site_url('home/excel/').'/'.$caid?>" class="btn_a"><span>导出我的评分表</span></a>
  </div>
  <div class="list">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th style="width:30px;"><input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
          <label for="checkbox"></label>        </th>
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
      <?php if ($works):?>
	  <?php foreach ($works as $row):?>
	  <tr overstyle='on' id="user_<?php echo $row->wid?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" value="<?php echo $row->wid?>"></td>
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
		<a href="<?php echo site_url('home/modGrade').'/'.$score->sid?>">重新评分</a>
		<?php else:?>
		<a href="<?php echo site_url('home/addGrade').'/'.$row->wid?>">评分</a>
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
    </table>
  </div>
  <div class="Toolbar_inbox">
    <div class="page right">
		共<?php echo $total;?>个实验报告书&nbsp;&nbsp;&nbsp;<?php echo $pagination;?>
	</div>
    <a href="<?php echo site_url('home/excel').'/'.$caid?>" class="btn_a"><span>导出我的评分表</span></a>
  </div>
</div>
<script>
	//鼠标移动表格效果
	$(document).ready(function(){
		$("tr[overstyle='on']").hover(
		  function () {
		    $(this).addClass("bg_hover");
		  },
		  function () {
		    $(this).removeClass("bg_hover");
		  }
		);
	});
	
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
</body>
</html>
