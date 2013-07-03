<div id="pager" class="paging">
Page 
<a href="javascript:;" class="paging_prev"><img src="/img/icons/arrow_left.gif" width="16" height="16" /></a> 
<input size="1" value="<?php echo $paging["page"]?>" readonly="readonly" type="text" name="page" id="page" /> 
<a href="javascript:;" class="paging_next"><img src="/img/icons/arrow_right.gif" width="16" height="16" /></a>
of <?php echo $paging["allPage"]?>
pages | View 
<select name="pageSize" id="paging_pageSize">
	<option <?php echo $paging["pageSize"]==10?"selected":""?>>10</option>
	<option <?php echo $paging["pageSize"]==20?"selected":""?>>20</option>
	<option <?php echo $paging["pageSize"]==50?"selected":""?>>50</option>
	<option <?php echo $paging["pageSize"]==100?"selected":""?>>100</option>
</select> 
per page | Total <strong><?php echo $paging["count"]?></strong> records found
</div>
<script type="text/javascript">
	$(document).ready(function(){
			<?php if($paging["page"]>1){?>
			//上一页
			$(".paging .paging_prev").bind("click",function(){to("<?php echo $paging_url?>?page=<?php echo $paging["page"]-1?>&psize="+$("#paging_pageSize").val());});
			<?php }?>
			<?php if($paging["page"]<$paging["allPage"]){?>
			//下一页
			$(".paging .paging_next").bind("click",function(){to("<?php echo $paging_url?>?page=<?php echo $paging["page"]+1?>&psize="+$("#paging_pageSize").val());});
			<?php }?>
		});
</script>