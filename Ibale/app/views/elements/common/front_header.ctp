<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN" xml:lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo !empty($this->page_props['title'])?$this->page_props['title']:__('info.siteNameCN', true);?></title>
<?php if (isset($this->page_props['description'])):?>
<meta name="description" content="<?php echo $this->page_props['description'];?>">
<?php endif;?>
<?php if (isset($this->page_props['keywords'])):?>
<meta name="keywords" content="<?php echo $this->page_props['keywords'];?>">
<?php endif;?>
<link type="text/css" rel="stylesheet" href="/css/front/global.css" />
<link type="text/css" rel="stylesheet" href="/css/smoothness/jquery-ui-1.7.custom.css" />
<link type="text/css" rel="stylesheet" href="/css/front/main.css" />
<link type="text/css" rel="stylesheet" href="/css/front/sort.css" />
<link type="text/css" rel="stylesheet" href="/css/front/modify.css" />
<!--[if (lt IE 9)]>
<link type="text/css" rel="stylesheet" href="/css/front/ie.css" />
<![endif]-->
<script type="text/javascript" src="/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="/js/jquery-ui-1.7.custom.min.js"></script>
<script type="text/javascript" src="/js/base64.js"></script>
<script src="/js/front/common.js" type="text/javascript"></script>
<script src="/js/front/jquery.idTabs.min.js" type="text/javascript"></script>
<script src="/js/subShowClass.js" type="text/javascript"></script>
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-34819074-1']);
_gaq.push(['_trackPageview']);
</script>
</head>
<body>
        <div id="header">
        	<div class="main_top">
        		<div class="mainCenter">
        			<div class="floatL">
        				<a href="javascript:;">收藏本站</a>
        				<a href="javascript:;" class="top_mobile">手机版</a>
        			</div>
        			 <div class="floatR">
	                    <span class="top_tel">
	                    	 服务热线:<a href="javascript:;">4006-987-286</a> 
	                    </span>
        			</div>
        			<div class="floatR">
        				<span class="txt"> 
	                    <?php if (!$appSession->check('Auth.Member')):?> 
	                    <a href="javascript:login();">登录</a> | <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/member/regist/">注册</a> | 
	                    <?php else:?>
	                    您好，<font class="orange"><?php echo $appHtml->html($appSession->read('Auth.Member.name'));?></font>
	                    <?php echo $msts['sex'][$appSession->read('Auth.Member.sex')];?> !&nbsp;
	                    <?php echo $this->requestAction('/member/get_points');?>
	                    <?php endif;?> 
	                    
	                    <a href="javascript:;">积分</a> 
	                   	| <a href="javascript:;">我的订单</a> | 
	                    
	                    <?php echo $this->element('toppage/cached_headerlink', array('cache'=>STATIC_PAGE_CACHED_DURATION));?>
	                  
	                    <?php if ($appSession->check('Auth.Member')):?>
	                    | <a href="<?php echo HTTP_HOME_PAGE_URL;?>/member/logout">登出</a> 
	                    <?php endif;?>
                    	 | <a href="javascript:;">帮助中心</a> 
                    	 | <a href="http://www.lbxdrugs.com/html/store">老百姓大药房</a> 
	                    </span>
	                 </div>
	                
        			
        		</div>
        	</div>
            <div class="top mainCenter">
                <div class="logo">
                    <a href="<?php echo HTTP_HOME_PAGE_URL;?>"><img src="/image/front/logo.gif" /> </a>
                </div>
                <div class="top_search">
                    <?php $keywords = !empty($this->params['named']['keywords'])?base64url_decode($this->params['named']['keywords']):'';?>
	                <?php if ($this->name == 'CategoryTop'):?>
	                    <?php //$url = '/category_top/list';?>
	                    <?php $url = '/product/search';?>
	                <?php elseif ($this->name == 'GiftTop'):?>
	                    <?php $url = '/gift_top/list';?>
	                <?php else:?>
	                    <?php $url = '/product/search';?>
	                <?php endif;?>
                	<div class="search_input">
	                    <?php echo $appForm->text('keywords', array('id'=>'TopKeywords', 'class'=>'input', 'value'=>$keywords, 'onkeypress'=>"javaScript:searchProductByKeywords2('{$url}', event);"));?>
	                    <input type="button" class="btnImg btnSearch" name="button" id="button" value="&nbsp;" onclick="javaScript:searchProductByKeywords('<?php echo $url;?>');"/> 
                	</div>
                	<div class="search_hot">
		                    <b>热门搜索：</b> 
		                <?php if ($this->name == 'CategoryTop'):?>
		                    <?php echo $this->element('/category_top/cached_keywords', array('cache'=>array('key'=>$this->params['named']['id'],'time'=>STATIC_PAGE_CACHED_DURATION)));?>
		                <?php elseif ($this->name == 'GiftTop'):?>
		                    <?php echo $this->element('/gift_top/cached_keywords', array('cache'=>STATIC_PAGE_CACHED_DURATION));?>
		                <?php else:?>
		                    <?php echo $this->element('toppage/cached_keywords', array('cache'=>STATIC_PAGE_CACHED_DURATION));?>
		                <?php endif;?>
	                </div>
                </div>
                <div class="top_ad">
                    <a href="http://weibo.com/228628234" target="_blank"><img src="/image/front/top_right.jpg" /></a>
                </div>
            </div>
            <div class="clear"></div>
        <?php if (!$this->noHeaderMenu):?>
			<div id="main_menu">
		            <div class="menu mainCenter">
						<div class="nav_category">&nbsp;</div>
						<div class="nav_menu">
			                <ul>
			                    <li><a href="<?php echo HTTP_HOME_PAGE_URL;?>">首&nbsp;&nbsp;页</a></li>
			                    <?php echo $this->element('toppage/cached_category_tag', array('cache'=>STATIC_PAGE_CACHED_DURATION))?>
			                    <li><a href="javascript:;">爱芭乐商城</a></li>
			                    <li><a href="<?php echo HTTP_HOME_PAGE_URL;?>/group_buy/">团购</a></li>
			                    <li><a href="javascript:;">名品特卖</a></li>
			                    <li><a href="javascript:;">夜市抢购</a></li>
			                    <li><a href="<?php echo HTTP_HOME_PAGE_URL;?>/gift_top/">礼品卡</a></li>
			                    <li><a href="javascript:;">生活馆</a></li>
			                    <li><a href="javascript:;">药品商城</a></li>
			                </ul>
		                </div>
		                <div class="shopping_bag">
		                	  <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/shopping/bag">共<span id="shoppingBagCountHeader"><?php echo $this->requestAction('/shopping/get_shopping_product_count');?></span> 件</a> 
		                </div>
		            </div>
			</div>
            <?php if ($this->name == 'CategoryTop'):?>
            <div class="keyword">
                <ul>
                <?php $category1Id = $this->data['CategoryTop']['category1_id'];?>
                <?php $category2Id = $this->data['CategoryTop']['category2_id'];?>
                <?php $categoryList = array();?>
                <?php if (!empty($category2Id) && !empty($categoryAllOptionList['level_3'][$category2Id])):?>
                    <?php $categoryList = $categoryAllOptionList['level_3'][$category2Id];?>
                    <?php foreach($categoryList as $key => $value):?>
                        <li><a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/category1_id:<?php echo $category1Id;?>/category2_id:<?php echo $category2Id;?>/category3_id:<?php echo $key;?>"><?php echo $value;?></a></li>
                    <?php endforeach;?>
                <?php elseif (!empty($category1Id) && !empty($categoryAllOptionList['level_2'][$category1Id])):?>
                    <?php $categoryList = $categoryAllOptionList['level_2'][$category1Id];?>
                    <?php foreach($categoryList as $key => $value):?>
                        <li><a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/category1_id:<?php echo $category1Id;?>/category2_id:<?php echo $key;?>"><?php echo $value;?></a></li>
                    <?php endforeach;?>
                <?php endif;?>
                </ul>
            </div>
            <?php endif;?>
        <?php endif;?>
        </div>
<div class="clear"></div>