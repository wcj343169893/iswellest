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
    <span style="padding-left:10px; color:#FF0000; font-size:12px">您的评分进度：<?php echo $complete?>项已评，<?php echo $left;?>项待评</span>
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
			<th class="line_l">作品名称</th>
	        <th class="line_l">科学性</th>
	        <th class="line_l">环保理念</th>
	        <th class="line_l">创新性</th>
			<th class="line_l">可行性</th>
			<?php if($caid ==1):?>
			<th class="line_l">文字表述</th>
			<?php else:?>
			<th class="line_l">经济性</th>
			<?php endif;?>
			<th class="line_l" style="background:#CCCCCC; font-weight:bold">总分</th>
			<th class="line_l">及格</th>
	        <th class="line_l" style="width:200px;">操作</th>
	      </tr>
      </thead>
      <tbody>
      <?php if ($works):?>
	  <?php foreach ($works as $row):?>
	  <tr overstyle='on' id="user_<?php echo $row->wid?>">
        <td><?php echo $row->wname?></td>
		<?php 
		$this->load->model('Home_model');
		if($uid == 'admin')$uid = 0;
		$score = $this->Home_model->getScoreOne($uid,$row->caid,$row->wid);
		$this->db->close();
		if($score):
		?>
        <td><?php echo $score->score1?></td>
		<td><?php echo $score->score2?></td>
		<td><?php echo $score->score3?></td>
		<td><?php echo $score->score4?></td>
		<td><?php echo $score->score5?></td>
		<td style="background:#CCCCCC; font-weight:bold"><?php echo $score->score7?></td>
		<td><span id="iswin_<?php echo $score->sid?>"><?php echo $score->iswin ? '<font color="red">是</font>' : '否'?></span></td>
		<?php else:?>
		<td colspan="7" align="center" style="color:#FF0000">您还没有为该实验报告书评分，请评分~！</td>
		<?php endif;?>
        <td>
		<?php if($score):?>
		<a href="<?php echo site_url('home/modGrade').'/'.$score->sid?>" class="btn btn-small btn-inverse">重新评分</a><span id="isallow_<?php echo $score->sid?>" style="padding-left:10px;">
		<?php if($score->iswin):?>
		<a href="javascript:void(0);" class="btn btn-small btn-warning" onClick="isWin(<?php echo $score->sid.','.$score->iswin?>)">撤消及格推荐</a>
		<?php else:?>
		<a href="javascript:void(0);" class="btn btn-small btn-primary" onClick="isWin(<?php echo $score->sid.','.$score->iswin?>)">推荐进入及格线</a>
		<?php endif;?></span>
		<?php else:?>
		<a href="<?php echo site_url('home/addGrade').'/'.$row->wid?>" class="btn btn-small btn-info">评分</a>
		<?php endif;?>
		</td>
      </tr>
	  <?php endforeach;?>
	  <?php else:?>
	  <tr overstyle='on' id="user_0">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td colspan="8" align="center">
		抱歉,没有找到您要找的内容~
		</td>
        <td>&nbsp;</td>
      </tr>
	  <?php endif;?>
	  </tbody>
    </table>
    <div class="row-fluid">
	  	<div class="span12"><div class="dataTables_info" id="DataTables_Table_0_info">总共<?php echo $total?>个实验报告书</div></div>
	  	<div class="span12 center">
		  <div class="dataTables_paginate paging_bootstrap pagination">
			<?php echo $pagination;?>
		  </div>
	    </div>
  	</div>
  </div>
</div></div>
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
function isWin(sid,iswin) {
	var sids = sid;
	var iswins = iswin;
	$.ajax({
		type: "POST",
		url: "<?php echo site_url('home/isWin'); ?>",
		data: {sid:sids,iswin:iswins},
		success: function(data){
			if(data == 'OK'){
				if(iswin){
					$("#iswin_"+sids).html('否');
					var links = "<a href=\"javascript:void(0);\" class=\"btn btn-small btn-primary\" onClick=\"isWin("+sids+",0)\">推荐进入及格线</a>";
					$("#isallow_"+sids).html(links);
				}else{
					$("#iswin_"+sids).html('<font color="red">是</font>');
					var links = "<a href=\"javascript:void(0);\" class=\"btn btn-small btn-warning\" onClick=\"isWin("+sids+",1)\">撤消及格线推荐</a>";
					$("#isallow_"+sids).html(links);
				}
			}else{
				$(".page_tit").html(data);
			}
		}
	});
}
</script>
<?php include('home_footer.php'); ?>
