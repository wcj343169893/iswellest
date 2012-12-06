<link type="text/css" rel="stylesheet" href="/css/front/jquery.treeview.css" />
<script src="/js/jquery.treeview.js" type="text/javascript"></script>
<script type="text/javascript">
	$(function() {
		$("#category_tree").treeview({
			collapsed: true,
			animated: "medium",
			control:"#sidetreecontrol",
			persist: "location"
		});
	})
</script>
<ul id="category_tree">
 <?php $indexK1 = 0;?>
    <?php foreach($categoryList['level_1'] as $k1 => $v1):?>
    	<?php if(!empty($k1)):?>
           <li><a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/category1_id:<?php echo $k1;?>"><strong><?php echo $v1;?></strong></a>
        <?php if (!empty($categoryList['level_2'][$k1])):?>
        	<ul>
            <?php foreach($categoryList['level_2'][$k1] as $k2 => $v2):?>
            	<?php if(!empty($k2)):?>
	               <li><?php if(!empty($v2) && is_array($v2)):?>
	                    <?php foreach($v2 as $k3 => $v3):?>
	                      	<a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/category1_id:<?php echo $k1;?>/category2_id:<?php echo $k2;?>/category3_id:<?php echo $k3;?>"><?php echo $v3;?></a>
	                    <?php endforeach;?>
	                <?php else:?>
	                        <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/category1_id:<?php echo $k1;?>/category2_id:<?php echo $k2;?>"><?php echo $v2;?></a>
	                <?php endif;?></li>
            	<?php endif;?>
            <?php endforeach;?>
         </ul>
        <?php endif;?>
        <?php $indexK1++;?>
        </li>
       <?php endif;?>
    <?php endforeach;?>
</ul>