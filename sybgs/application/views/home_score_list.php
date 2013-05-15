<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $title?></title>
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
	<select name="caid" onchange="window.location.href='<?php echo site_url('home/scorelist');?>/'+this.value">
	<option value="1" <?php if($caid==1):?>selected="selected"<?php endif;?>>===科技理念类===</option>
	<option value="2" <?php if($caid==2):?>selected="selected"<?php endif;?>>===科技实物类===</option>
    </select>
    <a href="<?php echo site_url('home/excel').'/'.$caid?>" class="btn_a"><span>导出Excel</span></a>
  </div>
  <div class="list">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th style="width:30px;"><input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
          <label for="checkbox"></label>        </th>
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
      <?php if ($works):?>
	  <?php foreach ($works as $row):?>
	  <tr overstyle='on' id="user_<?php echo $row->wid?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" value="<?php echo $row->wid?>"></td>
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
		<a href="<?php echo site_url('home/scoreOne').'/'.$row->wid?>">详细>></a>
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
    </table>
  </div>
  <div class="Toolbar_inbox">
    <div class="page right">
		共<?php echo $total;?>个实验报告书&nbsp;&nbsp;&nbsp;<?php echo $pagination;?>
	</div>
	<select name="caid" onchange="window.location.href='<?php echo site_url('home/scorelist');?>/'+this.value">
	<option value="1" <?php if($caid==1):?>selected="selected"<?php endif;?>>===科技理念类===</option>
	<option value="2" <?php if($caid==2):?>selected="selected"<?php endif;?>>===科技实物类===</option>
    </select>
    <a href="<?php echo site_url('home/excel').'/'.$caid?>" class="btn_a"><span>导出Excel</span></a>
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