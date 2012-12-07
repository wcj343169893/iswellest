<?php $this->page_props['title'] = __('info.siteNameCN', true).' - 爱健康,爱美丽,爱芭乐';?>
<?php $this->page_props['keywords'] = "日本药妆，老百姓，老百姓大药房，kenko,日本kenko,化妆品，日本化妆品，日本护理用品，网上药店,价格, 网上合法药店,保健食品,常用药,感冒药,减肥药,避孕药,保键品,网上药房,糖尿病,高血压,小儿用药,医疗器械";?>
<?php $this->page_props['description'] = "爱芭乐是由中国零售药品领域NO.1的老百姓大药房携手日本在线药妆NO.1的Kenko.com共同打造的服务于中国顾客的泛健康商品电子商务网站。主要经营药品，保健品，日用品，医疗器械及日本进口健康类商品。我们期待爱芭乐能使顾客的生活，更健康，更优雅，更积极，更美丽！";?>
<!-- main -->
<div class="mainCenter">
<div class="main_top">
	<div id="category">
	  <div class="content">
	  <?php $indexK1 = 0;?>
	   <?php foreach($categoryAllOptionList['level_1'] as $k1 => $v1):?>
	    <div class="item c_ico_<?php echo $indexK1;?>" onmouseover="loadBrand('<?php echo $k1;?>','category_brand_ul_<?php echo $k1;?>')">
	      <h2> <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/category1_id:<?php echo $k1;?>"><?php echo $text->truncate($v1, 13, array('ending'=>'...'));?></a></h2>
	      <div class="out">
	        <div class="subcategory">
	          <?php $indexK1++;?>
	          <?php if (!empty($categoryAllOptionList['level_2'][$k1])):?>
	          <?php $index = 0;?>
	          <?php foreach($categoryAllOptionList['level_2'][$k1] as $k2 => $v2):?>
	          <div class="dl" <?php if (count($categoryAllOptionList['level_2'][$k1]) == $index+1):?>class="noBorder"<?php endif;?>>
	            <dt><a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/category1_id:<?php echo $k1;?>/category2_id:<?php echo $k2;?>"><?php echo $v2?></a></dt>
	            <dd> 
	            	<?php if (!empty($categoryAllOptionList['level_3'][$k2])):?>
	               	<?php $indexK2 = 0;?>
	               	<?php foreach($categoryAllOptionList['level_3'][$k2] as $k3 => $v3):?>
	               	<a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/category1_id:<?php echo $k1;?>/category2_id:<?php echo $k2;?>/category3_id:<?php echo $k3;?>"><?php echo $v3?></a>
	              	<?php if (count($categoryAllOptionList['level_3'][$k2]) != $indexK2+1):?> |<?php endif;?>
	              	<?php $indexK2++;?>
	               	<?php endforeach;?>
	                <?php endif;?>
	              <div class="clr"></div>
	            </dd>
	            <div class="clr"></div>
	          </div>
	          <?php $index++;?>
	          <?php endforeach;?>
	         <?php endif;?>
	        </div>
	       	<div class="hotview">
	          <h3>热门品牌</h3>
	          <div>作者：口明明口<p><a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/category1_id:<?php echo $k1;?>"><?php echo $text->truncate($v1, 13, array('ending'=>'...'));?></a></p>   </div>
	          <div class="category_recommend_brands">
	          		<p>爱芭乐推荐品牌</p>
	          		<ul id="category_brand_ul_<?php echo $k1;?>">
	          		</ul>
	          </div>
	          
	        </div>
	      </div>
	    </div>
	    <?php endforeach;?>
	  </div>
	 </div>
<!-- category end -->
	<div class="main_top_middle">
		<div class="focusNews">
		<?php echo $this->element('toppage/focus_pic_disp');?>
		</div>
		<div class="pro">
			<ul>
				<?php if (!empty($this->data['Toppage']['under_focus_ad'])):?>
				    <?php $index = 0;$class_arr=array("0"=>"p_zk","1"=>"p_cx","2"=>"p_jf");?>
				    <?php foreach($this->data['Toppage']['under_focus_ad'] as $key => $value):?>
				        <?php $class="";?>
				        <?php if ($index == 3):?>
				            <?php $class="none";?>
				        <?php endif;?>
				        <?php if (!empty($value['path']) && $index<3):?>
				    		<li ><span class="<?php echo $class_arr[$index];?>"></span><a href="<?php echo $value['url'];?>" title="<?php echo $value['comment'];?>"><img src="<?php echo $value['path'];?>" alt="<?php echo $value['comment'];?>" /></a></li>
				            <?php $index++;?>
				        <?php endif;?>
				    <?php endforeach;?>
				<?php endif;?>
			</ul>	
			<div class="clear"></div>
		</div>
	</div>
<!-- main_top_middle end -->
	<div class="main_top_right">
		<div class="f1">
			<ul>
				<li><a href="javascript:;" class="func_1" title="满99元包邮">满99元包邮</a></li>
				<li><a href="javascript:;" class="func_2" title="品质保障">品质保障</a></li>
				<li><a href="javascript:;" class="func_3" title="退货保障">退货保障</a></li>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="f2">
			<ul>
				<li><a href="javascript:;" class="func_1" title="会员积分">会员积分</a></li>
				<li><a href="javascript:;" class="func_2" title="原产地证明">原产地证明</a></li>
				<li><a href="javascript:;" class="func_3" title="500实体店">500实体店</a></li>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="main_top_user ti_999">
			<ul>
				<li><a href="<?php echo HTTPS_HOME_PAGE_URL;?>/member/regist" class="func_1" title="免费注册">免费注册</a></li>
				<li><a href="javascript:login();" class="func_2" title="登录">登录</a></li>
			</ul>
			<div class="clear"></div>
		</div>
		<div class="main_top_news">
			<div class="news_title"><span>新闻与公告</span></div>
			<div class="news_body">
				<?php if(!empty($this->data['Toppage']["pic_article"])):?>
				<span class="m_b_i_more"><a href="javascript:;" title="更多">&nbsp;</a></span>
				<div class="img"><?php $picArticls=$this->data['Toppage']["pic_article"];?>
					<a href="<?php echo HTTP_HOME_PAGE_URL;?>/article/detail/id:<?php echo $picArticls['id'];?>"><img alt="<?php echo $picArticls["title"]?>" src="<?php echo $picArticls["pic_url"]?>"></a>
					<span class="m_b_i_p">&nbsp;</span>
					<p><a href="<?php echo HTTP_HOME_PAGE_URL;?>/article/detail/id:<?php echo $picArticls['id'];?>"><?php echo $picArticls["title"]?></a></p>
				</div>
				<?php endif;?>
				<?php if(!empty($this->data['Toppage']["words_article"])):?>
				<div class="news_lst">
					<ul>
						<?php foreach ($this->data['Toppage']["words_article"] as $k=>$value):?>
						<li><a href="<?php echo HTTP_HOME_PAGE_URL;?>/article/detail/id:<?php echo $value['id'];?>"><?php if(!empty($value["categoryname"])){echo '['.$value["categoryname"].']';}?><?php echo $value["title"]?></a></li>
						<?php endforeach;?>
					</ul>
				</div>
				<?php endif;?>
			</div>
		</div>
	</div>
<div class="clear"></div>
</div>
</div>
<!-- main_top_right end -->
<div class="mainCenter m_10">
	<div class="c_tabs floatL">
		<div class="index_tabs tabls_240">
			<ul id="txtblk01menu">
				<li id="txtblk01menu_t1" class="on"><a href="javascript:;">限时抢购</a></li>
				<li id="txtblk01menu_t2"><a href="javascript:;">最新上架</a></li>
				<li id="txtblk01menu_t3"><a href="javascript:;">我的本地生活</a></li>
				<li id="txtblk01menu_t4"><a href="javascript:;">您可能会喜欢</a></li>
			</ul>
			<div class="txtblk01_con" id="txtblk01_c4">
				<?php $this->set("product_tabs",$this->data['Toppage']['random_product']);?>
				<?php echo $this->element('product/product_tab');?>
			</div>
			<div class="txtblk01_con" id="txtblk01_c3"></div>
			<div class="txtblk01_con" id="txtblk01_c2">
				<?php $this->set("product_tabs",$this->data['Toppage']['newest_product']);?>
				<?php echo $this->element('product/product_tab');?>
			</div>
			<div class="txtblk01_con" id="txtblk01_c1">
				<?php $this->set("product_tabs",$this->data['Toppage']['limit_buy_product']);?>
				<?php echo $this->element('product/product_tab');?>
			</div>
		</div>
	</div>
	<div class="floatL m_l_10">
		<div class="div_head_1"><span>热门品牌中心</span></div>
		<div class="div_body_1 brands">
			<?php if (!empty($this->data['Toppage']['brands'])):?>
			<ul>
				<?php foreach ($this->data['Toppage']['brands'] as $k=>$value):?>
				<li>
					<a href="javascript:;"><img alt="<?php echo empty($value["photo_memo"])?$value["brand_name"]:$value["photo_memo"];?>" src="<?php echo $value["photo_url"];?>"></a>
				</li>
				<?php endforeach;?>
			</ul>
			<?php endif;?>
		</div>
	</div>
	<div class="clear"></div>
</div>
<script type="text/javascript">
	var SubShow_02 = new SubShowClass("txtblk01menu","onmouseover",0,"on","");
    for(var i=1;i<=4;i++){
      SubShow_02.addLabel("txtblk01menu_t"+i,"txtblk01_c"+i,"","","");
    }
</script>
<?php if (!empty($this->data['Toppage']['category_product'])):?>
<?php foreach($this->data['Toppage']['category_product'] as $category_key=> $value):?>
<div class="mainCenter product">
	<?php if (!empty($this->data['Toppage']['category_ads']) && !empty($this->data['Toppage']['category_ads'][$category_key])):?>
    <!-- 广告 -->
    <div class="ad_70 m_10"><a title="<?php echo $this->data['Toppage']['category_ads'][$category_key]["memo"]?>" href="<?php echo $this->data['Toppage']['category_ads'][$category_key]["link_url"]?>"><img src="<?php echo $this->data['Toppage']['category_ads'][$category_key]["pic_url"]?>" alt="<?php echo $this->data['Toppage']['category_ads'][$category_key]["memo"]?>"/></a></div>
    <?php endif;?>
    <!-- 分类商品一 -->
    <div class="productsSort">
	    <div class="titleBg m_10">
	        <h3>
	            <img src="<?php echo $value['icon_url'];?>" width="138" height="34" />
	        </h3>
	        <span class="more"><a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/category1_id:<?php echo $value['category1_id'];?>"></a> </span> 
	        <span class="otherLink"> 
	        <?php $labels = explode(' ', $value['label']);?> 
	        <?php foreach($labels as $k => $v):?> 
	        <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/search/category_id:<?php echo $value['category1_id'];?>/keywords:<?php echo $v;?>"><?php echo $v?> </a> 
	        <?php if ($k != count($labels) - 1):?>|<?php endif;?> <?php endforeach;?> 
	        </span>
	    </div>
        <div class="psLeft " style="padding-top:5px;">
            <a href="<?php echo $value['leftmain_ad']['url'];?>" title="<?php echo $value['leftmain_ad']['comment'];?>">
            <img src="<?php echo $value['leftmain_ad']['path'];?>" alt="<?php echo $value['leftmain_ad']['comment'];?>" width="200" height="200"/> </a>
        </div>
        <ul class="psCenter">
        <?php foreach($value['product'] as $k => $v):?>
            <?php $this->set('productInfo', $v);?>
            <li style="text-align:center;"><?php echo $this->element('product/category_product_info');?></li>
        <?php endforeach;?>
        </ul>
    </div>
    <!-- 分类排行 -->
    <div class="psRight" style="padding-top:5px;">
    	<div class="c_search">
    		<input value="" placeholder="按分类快捷查询" class="s_key"/><span class="s_btn" title="查询"></span>
    	</div>
    	<?php if($value['right_ad']):?>
    	<ul>
    		<?php foreach ($value['right_ad'] as $k=>$v):?>
        	<li>
            	<a href="<?php echo $v["url"];?>">
            		<img src="<?php echo $v["path"];?>" width="55" height="55" alt="<?php echo $v["comment"];?>" /> 
            	</a>
            	<p class="productName">
            		<a href="<?php echo $v["url"];?>"><?php echo $v["comment"];?></a>
			    </p>
			    <?php if(!empty($v["sale_price"])):?>
				    <p>
				    	<b>￥<?php echo $v["sale_price"];?> </b>
				    </p>
			    <?php endif;?>
            </li>
            <?php endforeach;?>
    	</ul>
    	<?php endif;?>
    </div>
    <br class="clear" />
</div>
<?php endforeach;?>

<!-- 分类商品一 end -->
<!-- 我的浏览记录 开始 -->
<div class="mainCenter m_10">
	<div class="w_980 floatL u_record">
		<div class="titleBg">
			<span class="re_ico ti_999" title="我的浏览记录">我的浏览记录</span>
			<span class="otherLink ti_999">   
				<a href="/member/mypage" title="我的个人中心">我的个人中心 </a>
			</span>
		</div>
		<div class="floatL w_200">
			<span class="more"><a href="javascript:;"></a> </span>
			<div class="ur_links_t"><a href="javascript:;" title="爱芭乐购物指导"><span>爱芭乐购物指导</span></a></div>
			<ul class="u_links">
				<li class="lk_1"><a href="javascript:;" title="浏览所有所需商品"><span>浏览所有所需商品</span></a></li>
				<li class="lk_2"><a href="javascript:;" title="将商品加入购物车"><span>将商品加入购物车</span></a></li>
				<li class="lk_3"><a href="javascript:;" title="登录或注册"><span>登录或注册</span></a></li>
				<li class="lk_4"><a href="javascript:;" title="支付并完成购物"><span>支付并完成购物</span></a></li>
			</ul>
		</div>
		<?php $this->set("recs",$this->data['Toppage']['userHistorys']);?>
		<?php echo $this->element('product/cached_browsered_product');?>
	</div>
	<div class="floatL m_l_10 stdxs">
		<div class="div_head_1"><span>实体店销售商品排行</span></div>
		<div class="div_body_1">
			<?php if (!empty($this->data['Toppage']['brands'])):?>
			<ul>
				<?php foreach ($this->data['Toppage']['storeRanks'] as $k=>$value):?>
				<li><span class="icon_<?php echo ($k+1);?>"></span><a href="<?php echo $value["url"];?>"><?php echo $value["name"];?></a></li>
				<?php endforeach;?>
			</ul>
			<?php endif;?>
		</div>
		<div class="link_to_lbx"><span><a href="http://www.lbxdrugs.com/html/store">老百姓大药房实体店位置</a></span></div>
	</div>
    <br class="clear" />
</div>
<!-- 我的浏览记录 结束 -->




<?php /**
    <?php if (!empty($this->data['Toppage']['brand_content'])):?>
    <div class="brand">
        <div class="brandTop"></div>
        <div class="brandMain">
        <?php echo $this->data['Toppage']['brand_content'];?>
        </div>
        <div class="brandBottom"></div>
    </div>
    <?php endif;?>
*/?>
    <!-- 活动广告& 商品排行-->
    <div class="ad2 clearfix">
    <?php if (!empty($this->data['Toppage']['active_ad']) &&!empty($meiyou)):?>
        <!-- 活动广告 -->
        <div class="adLeft">
            <h3 class="actionTitle">活动</h3>
            <p>
            <?php foreach($this->data['Toppage']['active_ad'] as $key => $value):?>
                <a href="<?php echo $value['url'];?>" title="<?php echo $value['comment'];?>"><img src="<?php echo $value['path'];?>" alt="<?php echo $value['comment'];?>" width="210" height="130" /> </a>
            <?php endforeach;?>
            </p>
        </div>
        <!-- 活动广告 end -->
        <?php endif;?>
        <!-- 商品排行 -->
        <div class="adRight" style="display: none">
            <h3 class="interactionTitle">互动</h3>
            <?php $this->set('type', 'hot_sale_product');?>
            <?php echo $this->element('toppage/ranking_products');?>
            <?php $this->set('type', 'otc_product');?>
            <?php echo $this->element('toppage/ranking_products');?>
            <?php $this->set('type', 'hot_enquiry_product');?>
            <?php echo $this->element('toppage/ranking_products');?>
        </div>
        <!-- 商品排行 end -->
    </div>
    <!-- 活动广告& 商品排行 end -->
<?php endif;?>
<!-- main end -->