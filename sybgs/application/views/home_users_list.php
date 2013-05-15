<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
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
		共<?php echo $total;?>位评分老师&nbsp;&nbsp;&nbsp;<?php echo $pagination;?>
	</div>
    <a href="<?php echo site_url('home/addUsers')?>" class="btn_a"><span>添加老师资料</span></a>
  </div>
  <div class="list">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <th style="width:30px;"> <input type="checkbox" id="checkbox_handle" onclick="checkAll(this)" value="0">
          <label for="checkbox"></label>        </th>
		<th class="line_l">ID</th>
        <th class="line_l">老师姓名</th>
        <th class="line_l">邮箱</th>
        <th class="line_l">电话</th>
        <th class="line_l">科技理念类权限</th>
		<th class="line_l">科技理念类权限</th>
        <th class="line_l">操作</th>
      </tr>
      <?php if ($users):?>
	  <?php foreach ($users as $row):?>
	  <tr overstyle='on' id="user_<?php echo $row->uid?>">
        <td><input type="checkbox" name="checkbox" id="checkbox2" value="<?php echo $row->uid?>"></td>
        <td><?php echo $row->uid?></td>
        <td><?php echo $row->name?></td>
        <td> <?php echo $row->email?> </td>
        <td> <?php echo $row->tel?></td>
		<td> <?php echo $row->qx1 ? '有' : '无';?></td>
        <td><?php echo $row->qx2 ? '有' : '无';?></td>
        <td>
		<a href="<?php echo site_url('home/modUsers').'/'.$row->uid?>">编辑</a>
		<a href="<?php echo site_url('home/delUsers').'/'.$row->uid?>" onclick="return confirm('删除后无法恢复,确定要删除吗?')">删除</a></td>
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
    </table>
  </div>
  <div class="Toolbar_inbox">
    <div class="page right">
		共<?php echo $total;?>位评分老师&nbsp;&nbsp;&nbsp;<?php echo $pagination;?>
	</div>
    <a href="<?php echo site_url('home/addUsers')?>" class="btn_a"><span>添加老师资料</span></a>
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
