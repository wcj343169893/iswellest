<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<base href="<?php echo base_url() ;?>"/>
<title>实验报告书提交网站</title>
<link href="resource/home/style2.css" rel="stylesheet" type="text/css">
<link href="resource/home/box.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="resource/home/js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="resource/home/js/jwc.js"></script>
<script type="text/javascript" src="resource/home/js/jquery.js"></script>
<script type="text/javascript" src="resource/home/js/common.js"></script>
<script type="text/javascript" src="resource/home/js/box.js"></script>
</head>
<body>
<div class="so_main">
    <div class="page_tit"><?php echo $title;?></div>
	<div class="form2">	
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
  <div class="Toolbar_inbox">
    <a href="<?php echo site_url('home/excel2').'/'.$wid?>" class="btn_a"><span>导出到Excel</span></a>
  </div>
  <div class="list">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th style="width:30px;"><input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
          <label for="checkbox"></label>        </th>
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
	  <?php 
	  $i=0;$fs1=0;$fs2=0;$fs3=0;$fs4=0;$fs5=0;$fs6=0;$fs7=0;$iswin=0;$islose=0;
	  foreach ($score as $row):?>
	  <tr overstyle='on' id="user_<?php echo $row->sid?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" value="<?php echo $row->sid?>"></td>
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
        <td colspan="2" align="center">平均得分:</td>
        <td><?php echo $fs1/$i?> </td>
        <td><?php echo $fs2/$i?></td>
		<td><?php echo $fs3/$i?></td>
		<td><?php echo $fs4/$i?></td>
		<td><?php echo $fs5/$i?></td>
		<td style="background:#EEEEEE"><?php echo $fs7/$i?></td>
		<td><?php echo $iswin.'/'.$islose;?></td>
      </tr>
    </table>
  </div>
  <div class="Toolbar_inbox">
    <a href="<?php echo site_url('home/excel2').'/'.$wid?>" class="btn_a"><span>导出到Excel</span></a>
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
<div style="text-align:center; color:#666666;font-size:12px; padding:50px 0 10px;">

</div>
</body>
</html>
