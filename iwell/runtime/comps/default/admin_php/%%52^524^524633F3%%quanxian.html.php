<?php /* Smarty version 2.6.18, created on 2012-04-08 20:54:28
         compiled from user/quanxian.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="<?php echo $this->_tpl_vars['res']; ?>
/css/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['res']; ?>
/css/main.css" rel="stylesheet" type="text/css" />
<title>无标题文档</title>
<style type="text/css">
<!--
body {
	margin-left: 3px;
	margin-top: 0px;
	margin-right: 3px;
	margin-bottom: 0px;
}
.STYLE1 {
	color: #e1e2e3;
	font-size: 12px;
}
.STYLE6 {color: #000000; font-size: 12; }
.STYLE10 {color: #000000; font-size: 12px; }
.STYLE19 {
	color: #344b50;
	font-size: 12px;
}
.STYLE21 {
	font-size: 12px;
	color: #3b6375;
}
.STYLE22 {
	font-size: 12px;
	color: #295568;
}
-->
</style>
</head>
<h1>
<span class="action-span"><a href="<?php echo $this->_tpl_vars['url']; ?>
/add">权限管理</a></span>
<span class="action-span1"><a href="<?php echo $this->_tpl_vars['app']; ?>
/index/info">管理中心</a> </span><span id="search_id" class="action-span1"> - 用户列表</span>
<div style="clear:both"></div>
</h1>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  
        
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>
		<table cellspacing='1' id="list-table">
 <tr>
  <td width="18%" valign="top" class="first-cell">
    <input name="chkGroup" type="checkbox" value="checkbox" onclick="check('goods_manage,remove_back,cat_manage,cat_drop,attr_manage,brand_manage,comment_priv,tag_manage,goods_type,goods_auto,virualcard,picture_batch,goods_export,goods_batch,gen_goods_script',this);" class="checkbox">商品管理  </td>
  <td>
        <div style="width:200px;float:left;">
    <label for="goods_manage"><input type="checkbox" name="action_code[]" value="goods_manage" id="goods_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'goods_manage')" title=""/>
    商品添加/编辑</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="remove_back"><input type="checkbox" name="action_code[]" value="remove_back" id="remove_back" class="checkbox"  checked="true"  onclick="checkrelevance('', 'remove_back')" title=""/>
    商品删除/恢复</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="cat_manage"><input type="checkbox" name="action_code[]" value="cat_manage" id="cat_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'cat_manage')" title=""/>
    分类添加/编辑</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="cat_drop"><input type="checkbox" name="action_code[]" value="cat_drop" id="cat_drop" class="checkbox"  checked="true"  onclick="checkrelevance('cat_manage', 'cat_drop')" title="cat_manage"/>
    分类转移/删除</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="attr_manage"><input type="checkbox" name="action_code[]" value="attr_manage" id="attr_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'attr_manage')" title=""/>
    商品属性管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="brand_manage"><input type="checkbox" name="action_code[]" value="brand_manage" id="brand_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'brand_manage')" title=""/>
    商品品牌管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="comment_priv"><input type="checkbox" name="action_code[]" value="comment_priv" id="comment_priv" class="checkbox"  checked="true"  onclick="checkrelevance('', 'comment_priv')" title=""/>
    用户评论管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="tag_manage"><input type="checkbox" name="action_code[]" value="tag_manage" id="tag_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'tag_manage')" title=""/>
    标签管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="goods_type"><input type="checkbox" name="action_code[]" value="goods_type" id="goods_type" class="checkbox"  checked="true"  onclick="checkrelevance('', 'goods_type')" title=""/>
    商品类型</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="goods_auto"><input type="checkbox" name="action_code[]" value="goods_auto" id="goods_auto" class="checkbox"  checked="true"  onclick="checkrelevance('', 'goods_auto')" title=""/>
    商品自动上下架</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="virualcard"><input type="checkbox" name="action_code[]" value="virualcard" id="virualcard" class="checkbox"  checked="true"  onclick="checkrelevance('', 'virualcard')" title=""/>
    虚拟卡管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="picture_batch"><input type="checkbox" name="action_code[]" value="picture_batch" id="picture_batch" class="checkbox"  checked="true"  onclick="checkrelevance('', 'picture_batch')" title=""/>
    图片批量处理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="goods_export"><input type="checkbox" name="action_code[]" value="goods_export" id="goods_export" class="checkbox"  checked="true"  onclick="checkrelevance('', 'goods_export')" title=""/>
    商品批量导出</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="goods_batch"><input type="checkbox" name="action_code[]" value="goods_batch" id="goods_batch" class="checkbox"  checked="true"  onclick="checkrelevance('', 'goods_batch')" title=""/>
    商品批量上传/修改</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="gen_goods_script"><input type="checkbox" name="action_code[]" value="gen_goods_script" id="gen_goods_script" class="checkbox"  checked="true"  onclick="checkrelevance('', 'gen_goods_script')" title=""/>
    生成商品代码</label>
    </div>
    </td></tr>
 <tr>
  <td width="18%" valign="top" class="first-cell">
    <input name="chkGroup" type="checkbox" value="checkbox" onclick="check('article_cat,article_manage,shopinfo_manage,shophelp_manage,vote_priv,article_auto',this);" class="checkbox">文章管理  </td>
  <td>
        <div style="width:200px;float:left;">
    <label for="article_cat"><input type="checkbox" name="action_code[]" value="article_cat" id="article_cat" class="checkbox"  checked="true"  onclick="checkrelevance('', 'article_cat')" title=""/>
    文章分类管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="article_manage"><input type="checkbox" name="action_code[]" value="article_manage" id="article_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'article_manage')" title=""/>
    文章内容管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="shopinfo_manage"><input type="checkbox" name="action_code[]" value="shopinfo_manage" id="shopinfo_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'shopinfo_manage')" title=""/>
    网店信息管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="shophelp_manage"><input type="checkbox" name="action_code[]" value="shophelp_manage" id="shophelp_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'shophelp_manage')" title=""/>
    网店帮助管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="vote_priv"><input type="checkbox" name="action_code[]" value="vote_priv" id="vote_priv" class="checkbox"  checked="true"  onclick="checkrelevance('', 'vote_priv')" title=""/>
    在线调查管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="article_auto"><input type="checkbox" name="action_code[]" value="article_auto" id="article_auto" class="checkbox"  checked="true"  onclick="checkrelevance('', 'article_auto')" title=""/>
    文章自动发布</label>
    </div>
    </td></tr>
 <tr>
  <td width="18%" valign="top" class="first-cell">
    <input name="chkGroup" type="checkbox" value="checkbox" onclick="check('feedback_priv,integrate_users,sync_users,users_manage,users_drop,user_rank,surplus_manage,account_manage',this);" class="checkbox">会员管理  </td>
  <td>
        <div style="width:200px;float:left;">
    <label for="feedback_priv"><input type="checkbox" name="action_code[]" value="feedback_priv" id="feedback_priv" class="checkbox"  checked="true"  onclick="checkrelevance('', 'feedback_priv')" title=""/>
    会员留言管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="integrate_users"><input type="checkbox" name="action_code[]" value="integrate_users" id="integrate_users" class="checkbox"  checked="true"  onclick="checkrelevance('', 'integrate_users')" title=""/>
    会员数据整合</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="sync_users"><input type="checkbox" name="action_code[]" value="sync_users" id="sync_users" class="checkbox"  checked="true"  onclick="checkrelevance('integrate_users', 'sync_users')" title="integrate_users"/>
    同步会员数据</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="users_manage"><input type="checkbox" name="action_code[]" value="users_manage" id="users_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'users_manage')" title=""/>
    会员管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="users_drop"><input type="checkbox" name="action_code[]" value="users_drop" id="users_drop" class="checkbox"  checked="true"  onclick="checkrelevance('users_manage', 'users_drop')" title="users_manage"/>
    会员删除</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="user_rank"><input type="checkbox" name="action_code[]" value="user_rank" id="user_rank" class="checkbox"  checked="true"  onclick="checkrelevance('', 'user_rank')" title=""/>
    会员等级管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="surplus_manage"><input type="checkbox" name="action_code[]" value="surplus_manage" id="surplus_manage" class="checkbox"  checked="true"  onclick="checkrelevance('account_manage', 'surplus_manage')" title="account_manage"/>
    会员余额管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="account_manage"><input type="checkbox" name="action_code[]" value="account_manage" id="account_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'account_manage')" title=""/>
    会员账户管理</label>
    </div>
    </td></tr>
 <tr>
  <td width="18%" valign="top" class="first-cell">
    <input name="chkGroup" type="checkbox" value="checkbox" onclick="check('template_manage,admin_manage,admin_drop,allot_priv,logs_manage,logs_drop,agency_manage,suppliers_manage,role_manage',this);" class="checkbox">权限管理  </td>
  <td>
        <div style="width:200px;float:left;">
    <label for="template_manage"><input type="checkbox" name="action_code[]" value="template_manage" id="template_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'template_manage')" title=""/>
    模板管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="admin_manage"><input type="checkbox" name="action_code[]" value="admin_manage" id="admin_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'admin_manage')" title=""/>
    管理员添加/编辑</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="admin_drop"><input type="checkbox" name="action_code[]" value="admin_drop" id="admin_drop" class="checkbox"  checked="true"  onclick="checkrelevance('admin_manage', 'admin_drop')" title="admin_manage"/>
    删除管理员</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="allot_priv"><input type="checkbox" name="action_code[]" value="allot_priv" id="allot_priv" class="checkbox"  checked="true"  onclick="checkrelevance('admin_manage', 'allot_priv')" title="admin_manage"/>
    分派权限</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="logs_manage"><input type="checkbox" name="action_code[]" value="logs_manage" id="logs_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'logs_manage')" title=""/>
    管理日志列表</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="logs_drop"><input type="checkbox" name="action_code[]" value="logs_drop" id="logs_drop" class="checkbox"  checked="true"  onclick="checkrelevance('logs_manage', 'logs_drop')" title="logs_manage"/>
    删除管理日志</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="agency_manage"><input type="checkbox" name="action_code[]" value="agency_manage" id="agency_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'agency_manage')" title=""/>
    办事处管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="suppliers_manage"><input type="checkbox" name="action_code[]" value="suppliers_manage" id="suppliers_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'suppliers_manage')" title=""/>
    供货商管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="role_manage"><input type="checkbox" name="action_code[]" value="role_manage" id="role_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'role_manage')" title=""/>
    角色管理</label>
    </div>
    </td></tr>
 <tr>
  <td width="18%" valign="top" class="first-cell">
    <input name="chkGroup" type="checkbox" value="checkbox" onclick="check('shop_config,ship_manage,payment,shiparea_manage,area_manage,friendlink,db_backup,db_renew,flash_manage,navigator,cron,affiliate,affiliate_ck,sitemap,file_priv,file_check,reg_fields,shop_authorized,webcollect_manage',this);" class="checkbox">系统设置  </td>
  <td>
        <div style="width:200px;float:left;">
    <label for="shop_config"><input type="checkbox" name="action_code[]" value="shop_config" id="shop_config" class="checkbox"  checked="true"  onclick="checkrelevance('', 'shop_config')" title=""/>
    商店设置</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="ship_manage"><input type="checkbox" name="action_code[]" value="ship_manage" id="ship_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'ship_manage')" title=""/>
    配送方式管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="payment"><input type="checkbox" name="action_code[]" value="payment" id="payment" class="checkbox"  checked="true"  onclick="checkrelevance('', 'payment')" title=""/>
    支付方式管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="shiparea_manage"><input type="checkbox" name="action_code[]" value="shiparea_manage" id="shiparea_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'shiparea_manage')" title=""/>
    配送区域管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="area_manage"><input type="checkbox" name="action_code[]" value="area_manage" id="area_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'area_manage')" title=""/>
    地区列表管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="friendlink"><input type="checkbox" name="action_code[]" value="friendlink" id="friendlink" class="checkbox"  checked="true"  onclick="checkrelevance('', 'friendlink')" title=""/>
    友情链接管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="db_backup"><input type="checkbox" name="action_code[]" value="db_backup" id="db_backup" class="checkbox"  checked="true"  onclick="checkrelevance('', 'db_backup')" title=""/>
    数据备份</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="db_renew"><input type="checkbox" name="action_code[]" value="db_renew" id="db_renew" class="checkbox"  checked="true"  onclick="checkrelevance('db_backup', 'db_renew')" title="db_backup"/>
    数据恢复</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="flash_manage"><input type="checkbox" name="action_code[]" value="flash_manage" id="flash_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'flash_manage')" title=""/>
    首页主广告管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="navigator"><input type="checkbox" name="action_code[]" value="navigator" id="navigator" class="checkbox"  checked="true"  onclick="checkrelevance('', 'navigator')" title=""/>
    自定义导航栏</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="cron"><input type="checkbox" name="action_code[]" value="cron" id="cron" class="checkbox"  checked="true"  onclick="checkrelevance('', 'cron')" title=""/>
    计划任务</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="affiliate"><input type="checkbox" name="action_code[]" value="affiliate" id="affiliate" class="checkbox"  checked="true"  onclick="checkrelevance('', 'affiliate')" title=""/>
    推荐设置</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="affiliate_ck"><input type="checkbox" name="action_code[]" value="affiliate_ck" id="affiliate_ck" class="checkbox"  checked="true"  onclick="checkrelevance('', 'affiliate_ck')" title=""/>
    分成管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="sitemap"><input type="checkbox" name="action_code[]" value="sitemap" id="sitemap" class="checkbox"  checked="true"  onclick="checkrelevance('', 'sitemap')" title=""/>
    站点地图管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="file_priv"><input type="checkbox" name="action_code[]" value="file_priv" id="file_priv" class="checkbox"  checked="true"  onclick="checkrelevance('', 'file_priv')" title=""/>
    文件权限检验</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="file_check"><input type="checkbox" name="action_code[]" value="file_check" id="file_check" class="checkbox"  checked="true"  onclick="checkrelevance('', 'file_check')" title=""/>
    文件校验</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="reg_fields"><input type="checkbox" name="action_code[]" value="reg_fields" id="reg_fields" class="checkbox"  checked="true"  onclick="checkrelevance('', 'reg_fields')" title=""/>
    会员注册项管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="shop_authorized"><input type="checkbox" name="action_code[]" value="shop_authorized" id="shop_authorized" class="checkbox"  checked="true"  onclick="checkrelevance('', 'shop_authorized')" title=""/>
    授权证书</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="webcollect_manage"><input type="checkbox" name="action_code[]" value="webcollect_manage" id="webcollect_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'webcollect_manage')" title=""/>
    网罗天下管理</label>
    </div>
    </td></tr>
 <tr>
  <td width="18%" valign="top" class="first-cell">
    <input name="chkGroup" type="checkbox" value="checkbox" onclick="check('a4_edit_order_print,a2_order_query,a5_oos,a6_add_order,a7_delivery_list,a8_back_list,a3_order_coalition,a1_order_list',this);" class="checkbox">订单管理  </td>
  <td>
        <div style="width:200px;float:left;">
    <label for="a4_edit_order_print"><input type="checkbox" name="action_code[]" value="a4_edit_order_print" id="a4_edit_order_print" class="checkbox"  checked="true"  onclick="checkrelevance('', 'a4_edit_order_print')" title=""/>
    订单打印</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="a2_order_query"><input type="checkbox" name="action_code[]" value="a2_order_query" id="a2_order_query" class="checkbox"  checked="true"  onclick="checkrelevance('', 'a2_order_query')" title=""/>
    订单查询</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="a5_oos"><input type="checkbox" name="action_code[]" value="a5_oos" id="a5_oos" class="checkbox"  checked="true"  onclick="checkrelevance('', 'a5_oos')" title=""/>
    缺货登记</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="a6_add_order"><input type="checkbox" name="action_code[]" value="a6_add_order" id="a6_add_order" class="checkbox"  checked="true"  onclick="checkrelevance('', 'a6_add_order')" title=""/>
    添加订单(编辑订单)</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="a7_delivery_list"><input type="checkbox" name="action_code[]" value="a7_delivery_list" id="a7_delivery_list" class="checkbox"  checked="true"  onclick="checkrelevance('', 'a7_delivery_list')" title=""/>
    发货单列表</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="a8_back_list"><input type="checkbox" name="action_code[]" value="a8_back_list" id="a8_back_list" class="checkbox"  checked="true"  onclick="checkrelevance('', 'a8_back_list')" title=""/>
    退货单列表</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="a3_order_coalition"><input type="checkbox" name="action_code[]" value="a3_order_coalition" id="a3_order_coalition" class="checkbox"  checked="true"  onclick="checkrelevance('', 'a3_order_coalition')" title=""/>
    合并订单</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="a1_order_list"><input type="checkbox" name="action_code[]" value="a1_order_list" id="a1_order_list" class="checkbox"  checked="true"  onclick="checkrelevance('', 'a1_order_list')" title=""/>
    订单列表</label>
    </div>
    </td></tr>
 <tr>
  <td width="18%" valign="top" class="first-cell">
    <input name="chkGroup" type="checkbox" value="checkbox" onclick="check('topic_manage,snatch_manage,ad_manage,gift_manage,card_manage,pack,bonus_manage,auction,group_by,favourable,whole_sale,package_manage,exchange_goods',this);" class="checkbox">营销管理  </td>
  <td>
        <div style="width:200px;float:left;">
    <label for="topic_manage"><input type="checkbox" name="action_code[]" value="topic_manage" id="topic_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'topic_manage')" title=""/>
    专题管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="snatch_manage"><input type="checkbox" name="action_code[]" value="snatch_manage" id="snatch_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'snatch_manage')" title=""/>
    夺宝奇兵</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="ad_manage"><input type="checkbox" name="action_code[]" value="ad_manage" id="ad_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'ad_manage')" title=""/>
    广告管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="gift_manage"><input type="checkbox" name="action_code[]" value="gift_manage" id="gift_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'gift_manage')" title=""/>
    赠品管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="card_manage"><input type="checkbox" name="action_code[]" value="card_manage" id="card_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'card_manage')" title=""/>
    祝福贺卡</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="pack"><input type="checkbox" name="action_code[]" value="pack" id="pack" class="checkbox"  checked="true"  onclick="checkrelevance('', 'pack')" title=""/>
    商品包装</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="bonus_manage"><input type="checkbox" name="action_code[]" value="bonus_manage" id="bonus_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'bonus_manage')" title=""/>
    优惠券管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="auction"><input type="checkbox" name="action_code[]" value="auction" id="auction" class="checkbox"  checked="true"  onclick="checkrelevance('', 'auction')" title=""/>
    拍卖活动</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="group_by"><input type="checkbox" name="action_code[]" value="group_by" id="group_by" class="checkbox"  checked="true"  onclick="checkrelevance('', 'group_by')" title=""/>
    团购活动</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="favourable"><input type="checkbox" name="action_code[]" value="favourable" id="favourable" class="checkbox"  checked="true"  onclick="checkrelevance('', 'favourable')" title=""/>
    专区上架</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="whole_sale"><input type="checkbox" name="action_code[]" value="whole_sale" id="whole_sale" class="checkbox"  checked="true"  onclick="checkrelevance('', 'whole_sale')" title=""/>
    批发管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="package_manage"><input type="checkbox" name="action_code[]" value="package_manage" id="package_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'package_manage')" title=""/>
    优惠套餐</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="exchange_goods"><input type="checkbox" name="action_code[]" value="exchange_goods" id="exchange_goods" class="checkbox"  checked="true"  onclick="checkrelevance('', 'exchange_goods')" title=""/>
    积分商城商品</label>
    </div>
    </td></tr>
 <tr>
  <td width="18%" valign="top" class="first-cell">
    <input name="chkGroup" type="checkbox" value="checkbox" onclick="check('attention_list,email_list,magazine_list,view_sendlist',this);" class="checkbox">邮件管理  </td>
  <td>
        <div style="width:200px;float:left;">
    <label for="attention_list"><input type="checkbox" name="action_code[]" value="attention_list" id="attention_list" class="checkbox"  checked="true"  onclick="checkrelevance('', 'attention_list')" title=""/>
    关注管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="email_list"><input type="checkbox" name="action_code[]" value="email_list" id="email_list" class="checkbox"  checked="true"  onclick="checkrelevance('', 'email_list')" title=""/>
    邮件订阅管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="magazine_list"><input type="checkbox" name="action_code[]" value="magazine_list" id="magazine_list" class="checkbox"  checked="true"  onclick="checkrelevance('', 'magazine_list')" title=""/>
    杂志管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="view_sendlist"><input type="checkbox" name="action_code[]" value="view_sendlist" id="view_sendlist" class="checkbox"  checked="true"  onclick="checkrelevance('', 'view_sendlist')" title=""/>
    邮件队列管理</label>
    </div>
    </td></tr>
 <tr>
  <td width="18%" valign="top" class="first-cell">
    <input name="chkGroup" type="checkbox" value="checkbox" onclick="check('template_select,template_setup,library_manage,lang_edit,backup_setting,mail_template',this);" class="checkbox">模板管理  </td>
  <td>
        <div style="width:200px;float:left;">
    <label for="template_select"><input type="checkbox" name="action_code[]" value="template_select" id="template_select" class="checkbox"  checked="true"  onclick="checkrelevance('', 'template_select')" title=""/>
    模板选择</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="template_setup"><input type="checkbox" name="action_code[]" value="template_setup" id="template_setup" class="checkbox"  checked="true"  onclick="checkrelevance('', 'template_setup')" title=""/>
    模板设置</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="library_manage"><input type="checkbox" name="action_code[]" value="library_manage" id="library_manage" class="checkbox"  checked="true"  onclick="checkrelevance('', 'library_manage')" title=""/>
    库项目管理</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="lang_edit"><input type="checkbox" name="action_code[]" value="lang_edit" id="lang_edit" class="checkbox"  checked="true"  onclick="checkrelevance('', 'lang_edit')" title=""/>
    语言项编辑</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="backup_setting"><input type="checkbox" name="action_code[]" value="backup_setting" id="backup_setting" class="checkbox"  checked="true"  onclick="checkrelevance('', 'backup_setting')" title=""/>
    模板设置备份</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="mail_template"><input type="checkbox" name="action_code[]" value="mail_template" id="mail_template" class="checkbox"  checked="true"  onclick="checkrelevance('', 'mail_template')" title=""/>
    邮件模板管理</label>
    </div>
    </td></tr>
 <tr>
  <td width="18%" valign="top" class="first-cell">
    <input name="chkGroup" type="checkbox" value="checkbox" onclick="check('db_backup,db_renew,db_optimize,sql_query,convert',this);" class="checkbox">数据库管理  </td>
  <td>
        <div style="width:200px;float:left;">
    <label for="db_backup"><input type="checkbox" name="action_code[]" value="db_backup" id="db_backup" class="checkbox"  checked="true"  onclick="checkrelevance('', 'db_backup')" title=""/>
    数据备份</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="db_renew"><input type="checkbox" name="action_code[]" value="db_renew" id="db_renew" class="checkbox"  checked="true"  onclick="checkrelevance('', 'db_renew')" title=""/>
    数据恢复</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="db_optimize"><input type="checkbox" name="action_code[]" value="db_optimize" id="db_optimize" class="checkbox"  checked="true"  onclick="checkrelevance('', 'db_optimize')" title=""/>
    数据表优化</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="sql_query"><input type="checkbox" name="action_code[]" value="sql_query" id="sql_query" class="checkbox"  checked="true"  onclick="checkrelevance('', 'sql_query')" title=""/>
    SQL查询</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="convert"><input type="checkbox" name="action_code[]" value="convert" id="convert" class="checkbox"  checked="true"  onclick="checkrelevance('', 'convert')" title=""/>
    转换数据</label>
    </div>
    </td></tr>
 <tr>
  <td width="18%" valign="top" class="first-cell">
    <input name="chkGroup" type="checkbox" value="checkbox" onclick="check('sms_send',this);" class="checkbox">短信管理  </td>
  <td>
        <div style="width:200px;float:left;">
    <label for="sms_send"><input type="checkbox" name="action_code[]" value="sms_send" id="sms_send" class="checkbox"  checked="true"  onclick="checkrelevance('', 'sms_send')" title=""/>
    发送短信</label>
    </div>
    </td></tr>
 <tr>
  <td width="18%" valign="top" class="first-cell">
    <input name="chkGroup" type="checkbox" value="checkbox" onclick="check('order_edit_info,order_exits,order_look',this);" class="checkbox">订单专员  </td>
  <td>
        <div style="width:200px;float:left;">
    <label for="order_edit_info"><input type="checkbox" name="action_code[]" value="order_edit_info" id="order_edit_info" class="checkbox"  checked="true"  onclick="checkrelevance('', 'order_edit_info')" title=""/>
    订单详情查看</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="order_exits"><input type="checkbox" name="action_code[]" value="order_exits" id="order_exits" class="checkbox"  checked="true"  onclick="checkrelevance('', 'order_exits')" title=""/>
    取消订单</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="order_look"><input type="checkbox" name="action_code[]" value="order_look" id="order_look" class="checkbox"  checked="true"  onclick="checkrelevance('', 'order_look')" title=""/>
    订单审核</label>
    </div>
    </td></tr>
 <tr>
  <td width="18%" valign="top" class="first-cell">
    <input name="chkGroup" type="checkbox" value="checkbox" onclick="check('caiwu_info,a1_caiwu_list,a2_caiwu_refundment,caiwu_affirms',this);" class="checkbox">财务专员  </td>
  <td>
        <div style="width:200px;float:left;">
    <label for="caiwu_info"><input type="checkbox" name="action_code[]" value="caiwu_info" id="caiwu_info" class="checkbox"  checked="true"  onclick="checkrelevance('', 'caiwu_info')" title=""/>
    财务订单详情</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="a1_caiwu_list"><input type="checkbox" name="action_code[]" value="a1_caiwu_list" id="a1_caiwu_list" class="checkbox"  checked="true"  onclick="checkrelevance('', 'a1_caiwu_list')" title=""/>
    财务往来订单</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="a2_caiwu_refundment"><input type="checkbox" name="action_code[]" value="a2_caiwu_refundment" id="a2_caiwu_refundment" class="checkbox"  checked="true"  onclick="checkrelevance('', 'a2_caiwu_refundment')" title=""/>
    财务退款</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="caiwu_affirms"><input type="checkbox" name="action_code[]" value="caiwu_affirms" id="caiwu_affirms" class="checkbox"  checked="true"  onclick="checkrelevance('', 'caiwu_affirms')" title=""/>
    到账确认</label>
    </div>
    </td></tr>
 <tr>
  <td width="18%" valign="top" class="first-cell">
    <input name="chkGroup" type="checkbox" value="checkbox" onclick="check('lipin_viewka,lipin_viewjuan',this);" class="checkbox">礼品卡/卷管理  </td>
  <td>
        <div style="width:200px;float:left;">
    <label for="lipin_viewka"><input type="checkbox" name="action_code[]" value="lipin_viewka" id="lipin_viewka" class="checkbox"  checked="true"  onclick="checkrelevance('', 'lipin_viewka')" title=""/>
    礼品卡</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="lipin_viewjuan"><input type="checkbox" name="action_code[]" value="lipin_viewjuan" id="lipin_viewjuan" class="checkbox"  checked="true"  onclick="checkrelevance('', 'lipin_viewjuan')" title=""/>
    优惠券</label>
    </div>
    </td></tr>
 <tr>
  <td width="18%" valign="top" class="first-cell">
    <input name="chkGroup" type="checkbox" value="checkbox" onclick="check('dingdanliuzhuan_view',this);" class="checkbox">订单流转管理  </td>
  <td>
        <div style="width:200px;float:left;">
    <label for="dingdanliuzhuan_view"><input type="checkbox" name="action_code[]" value="dingdanliuzhuan_view" id="dingdanliuzhuan_view" class="checkbox"  checked="true"  onclick="checkrelevance('', 'dingdanliuzhuan_view')" title=""/>
    订单流转</label>
    </div>
    </td></tr>
 <tr>
  <td width="18%" valign="top" class="first-cell">
    <input name="chkGroup" type="checkbox" value="checkbox" onclick="check('z_clicks_stats,flow_stats,searchengine_stats,report_order,report_sell,sell_stats,sale_list,report_guest,report_users,visit_buy_per',this);" class="checkbox">报表统计  </td>
  <td>
        <div style="width:200px;float:left;">
    <label for="z_clicks_stats"><input type="checkbox" name="action_code[]" value="z_clicks_stats" id="z_clicks_stats" class="checkbox"  checked="true"  onclick="checkrelevance('', 'z_clicks_stats')" title=""/>
    站外投放JS</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="flow_stats"><input type="checkbox" name="action_code[]" value="flow_stats" id="flow_stats" class="checkbox"  checked="true"  onclick="checkrelevance('', 'flow_stats')" title=""/>
    流量分析</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="searchengine_stats"><input type="checkbox" name="action_code[]" value="searchengine_stats" id="searchengine_stats" class="checkbox"  checked="true"  onclick="checkrelevance('', 'searchengine_stats')" title=""/>
    搜索引擎</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="report_order"><input type="checkbox" name="action_code[]" value="report_order" id="report_order" class="checkbox"  checked="true"  onclick="checkrelevance('', 'report_order')" title=""/>
    订单统计</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="report_sell"><input type="checkbox" name="action_code[]" value="report_sell" id="report_sell" class="checkbox"  checked="true"  onclick="checkrelevance('', 'report_sell')" title=""/>
    销售概况</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="sell_stats"><input type="checkbox" name="action_code[]" value="sell_stats" id="sell_stats" class="checkbox"  checked="true"  onclick="checkrelevance('', 'sell_stats')" title=""/>
    销售排行</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="sale_list"><input type="checkbox" name="action_code[]" value="sale_list" id="sale_list" class="checkbox"  checked="true"  onclick="checkrelevance('', 'sale_list')" title=""/>
    销售明细</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="report_guest"><input type="checkbox" name="action_code[]" value="report_guest" id="report_guest" class="checkbox"  checked="true"  onclick="checkrelevance('', 'report_guest')" title=""/>
    客户统计</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="report_users"><input type="checkbox" name="action_code[]" value="report_users" id="report_users" class="checkbox"  checked="true"  onclick="checkrelevance('', 'report_users')" title=""/>
    会员排行</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="visit_buy_per"><input type="checkbox" name="action_code[]" value="visit_buy_per" id="visit_buy_per" class="checkbox"  checked="true"  onclick="checkrelevance('', 'visit_buy_per')" title=""/>
    访问购买率</label>
    </div>
    </td></tr>
 <tr>
  <td width="18%" valign="top" class="first-cell">
    <input name="chkGroup" type="checkbox" value="checkbox" onclick="check('add_invoice,order_edit_info,invoice_info,invoice_affirm,invoice_affirm_signin',this);" class="checkbox">库管专员  </td>
  <td>
        <div style="width:200px;float:left;">
    <label for="add_invoice"><input type="checkbox" name="action_code[]" value="add_invoice" id="add_invoice" class="checkbox"  checked="true"  onclick="checkrelevance('', 'add_invoice')" title=""/>
    生成发货单</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="order_edit_info"><input type="checkbox" name="action_code[]" value="order_edit_info" id="order_edit_info" class="checkbox"  checked="true"  onclick="checkrelevance('', 'order_edit_info')" title=""/>
    订单详情查看</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="invoice_info"><input type="checkbox" name="action_code[]" value="invoice_info" id="invoice_info" class="checkbox"  checked="true"  onclick="checkrelevance('', 'invoice_info')" title=""/>
    发货单详细页</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="invoice_affirm"><input type="checkbox" name="action_code[]" value="invoice_affirm" id="invoice_affirm" class="checkbox"  checked="true"  onclick="checkrelevance('', 'invoice_affirm')" title=""/>
    发货确认</label>
    </div>
        <div style="width:200px;float:left;">
    <label for="invoice_affirm_signin"><input type="checkbox" name="action_code[]" value="invoice_affirm_signin" id="invoice_affirm_signin" class="checkbox"  checked="true"  onclick="checkrelevance('', 'invoice_affirm_signin')" title=""/>
    签收确认</label>
    </div>
    </td></tr>
 <tr>
  <td width="18%" valign="top" class="first-cell">
    <input name="chkGroup" type="checkbox" value="checkbox" onclick="check('',this);" class="checkbox">关键词与排行  </td>
  <td>
    </td></tr>
  <tr>
    <td align="center" colspan="2" >
      <input type="checkbox" name="checkall" value="checkbox" onclick="checkAll(this.form, this);" class="checkbox" />全选      &nbsp;&nbsp;&nbsp;&nbsp;
      <input type="submit"   name="Submit"   value=" 保存 " class="button" />
      <input type="hidden"   name="id"    value="33" />
      <input type="hidden"   name="act"   value="update_allot" />
    </td>
  </tr>
</table>

	</td>
  </tr>
  <tr>
    <td height="30"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="33%"><div align="left"><span class="STYLE22"></span></div></td>

          <tr>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>