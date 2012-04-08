<?php /* Smarty version 2.6.18, created on 2012-04-08 19:02:42
         compiled from index/info.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="<?php echo $this->_tpl_vars['res']; ?>
/css/general.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $this->_tpl_vars['res']; ?>
/css/main.css" rel="stylesheet" type="text/css" />
<style>

</style>
</head>
<body>
<div class="list-div">
<table cellspacing='1' cellpadding='3'>
    <th colspan="4" class="group-title">订单统计信息</th>
  </tr>
  <tr>
    <td width="20%">待发货订单:</td>
    <td width="30%"><font color='red'><?php echo $this->_tpl_vars['d'][0]; ?>
</font></td>
    <td width="20%">未确认订单:</td>
    <td width="30%"><?php echo $this->_tpl_vars['d'][1]; ?>
</td>
  </tr>
  <tr>
    <td>待支付订单:</td>
    <td><?php echo $this->_tpl_vars['d'][2]; ?>
</td>
    <td>已成交订单数:</td>
    <td><?php echo $this->_tpl_vars['d'][3]; ?>
</td>
  </tr>
  <tr>
    <td>新缺货登记:</td>
    <td><?php echo $this->_tpl_vars['d'][4]; ?>
</td>
    <td>退款申请:</td>
    <td><?php echo $this->_tpl_vars['d'][5]; ?>
</td>
  </tr>
</table>
</div>
<div class="list-div">
<table cellspacing='1' cellpadding='3'>
  <tr>
    <th colspan="4" class="group-title">实体商品统计信息</th>
  </tr>
  <tr>
    <td width="20%">商品总数:</td>
    <td width="30%"><?php echo $this->_tpl_vars['w'][0]; ?>
</td>
    <td width="20%">库存商品警告数:</td>
    <td width="30%"><?php echo $this->_tpl_vars['w'][1]; ?>
</td>
  </tr>
  <tr>
    <td>促销商品数:</td>
    <td></td>
    <td>热销商品数:</td>
    <td></td>
  </tr>
  <tr>
    <td>推荐商品数:</td>
    <td></td>
    <td>新品推荐数:</td>
    <td></td>
  </tr>
</table>
</div>
<div class="list-div">
<table cellspacing='1' cellpadding='3'>
  <tr>
    <th colspan="4" class="group-title">访问统计</th>
  </tr>
  <tr>
    <td width="20%">今日访问：</td>
    <td width="30%"></td>
    <td width="20%">在线人数：</td>
    <td width="30%"></td>
  </tr>
  <tr>
    <td>最新留言</td>
    <td></td>
    <td>未审核评论</td>
    <td></td>
  </tr>
</table>
</div>
<div class="list-div">
<table cellspacing='1' cellpadding='3'>
  <tr>

<div class="list-div">
<table cellspacing='1' cellpadding='3'>
  <tr>
    <th colspan="4" class="group-title">系统信息</th>
  </tr>
  <tr>
    <td width="20%">服务器操作系统:</td>
    <td width="30%"><?php echo $this->_tpl_vars['info'][0]; ?>
</td>
    <td width="20%">Web 服务器:</td>
    <td width="30%"><?php echo $this->_tpl_vars['info'][2]; ?>
</td>
  </tr>
  <tr>
    <td>PHP 版本:</td>
    <td><?php echo $this->_tpl_vars['info'][1]; ?>
</td>
    <td>MySQL 版本:</td>
    <td><?php echo $this->_tpl_vars['info'][3]; ?>
</td>
  </tr>
  <tr>
    <td>安全模式:</td>
    <td>否</td>
    <td>安全模式GID:</td>
    <td>否</td>
  </tr>
  <tr>
    <td>Socket 支持:</td>
    <td>是</td>
    <td>时区设置:</td>
    <td>PRC</td>
  </tr>
  <tr>
    <td>GD 版本:</td>
    <td>GD2 ( JPEG GIF PNG)</td>
    <td>Zlib 支持:</td>
    <td>是</td>
  </tr>
  <tr>
    <td>IP 库版本:</td>
    <td>20071024</td>
    <td>文件上传的最大大小:</td>
    <td>2M</td>
  </tr>
  <tr>
    <td>版本:</td>
    <td>v2.7.2 RELEASE 20100604</td>
    <td>安装日期:</td>
    <td>2010-11-16</td>
  </tr>
  <tr>
    <td>编码:</td>
    <td>UTF-8</td>
    <td></td>
    <td></td>
  </tr>
</table>
</div>
</body>