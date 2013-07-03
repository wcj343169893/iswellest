<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Blu Water Seafood</title>
    <meta name="keywords" content="Blu Water, Seafood, Cooking Class" />
    <meta name="description" content="Blu Water, Seafood, Cooking Class" />
    <?php echo $this->Html->charset(); ?>
    <title>
        <?php echo $title_for_layout; ?>
    </title>
    <?php
    echo $this->Html->meta('icon');
    echo $this->Html->css('admin/theme') ;
    echo $this->Html->css('admin/style') ;
    echo $this->Html->script('jquery-1.7.1.min');
    echo $this->Html->script('admin/common');
    echo $this->fetch('meta');
    echo $this->fetch('css');
    echo $this->fetch('script');
    echo $scripts_for_layout;
    ?>
<script>
   //var StyleFile = "theme" + document.cookie.charAt(6) + ".css";
   //document.writeln('<link rel="stylesheet" type="text/css" href="/css/admin/' + StyleFile + '">');
</script>
<!--[if IE]>
<link rel="stylesheet" type="text/css" href="/css/admin/ie-sucks.css" />
<![endif]-->
</head>
<body><?php $controller=$this->request->params["controller"];$select=1;
switch ($controller) {
	case "orders":
	$select=2;
	break;
	case "users":
	$select=3;
	break;
	case "manage":
	$select=4;
	break;
	case "products":
	$select=8;
	break;
	default:
		$select=1;
	break;
}
?>
<div id="container">
    	<div id="header">
        	<h2>My eCommerce Admin area</h2>
    <div id="topmenu">
            	<ul>
                	<li<?php echo $select==1?" class='current'":"" ?>><a href="/admin">Dashboard</a></li>
                    <li<?php echo $select==2?" class='current'":"" ?>><a href="/admin/orders">Orders</a></li>
                    <li<?php echo $select==8?" class='current'":"" ?>><a href="/admin/products">Products</a></li>
                	<li<?php echo $select==3?" class='current'":"" ?>><a href="/admin/users">Users</a></li>
                    <li<?php echo $select==4?" class='current'":"" ?>><a href="#">Manage</a></li>
                    <li<?php echo $select==5?" class='current'":"" ?>><a href="#">CMS</a></li>
                    <li<?php echo $select==6?" class='current'":"" ?>><a href="#">Statistics</a></li>
                    <li<?php echo $select==7?" class='current'":"" ?>><a href="#">Settings</a></li>
              </ul>
          </div>
      </div>
     <?php if(!empty($subMenu[$controller])){?>
        <div id="top-panel">
            <div id="panel">
                <ul>
                <?php foreach($subMenu[$controller] as $k=>$v){?>
                    <li><a href="<?php echo $v["url"]?>" class="<?php echo $v["className"]?>"><?php echo $v["title"]?></a></li>
                 <?php }?>
                </ul>
            </div>
      </div><?php }?>
        <div id="wrapper">
            <div id="content">
            	<?php echo $this->Session->flash(); ?>
        		<?php echo $this->fetch('content'); ?>
            </div>
            <div id="sidebar">
  				<ul>
                	<li><h3><a href="#" class="house">Dashboard</a></h3>
                        <ul><?php if(!empty($subMenu["dashboard"])){?>
                        <?php foreach($subMenu["dashboard"] as $k=>$v){?>
		                    <li><a href="<?php echo $v["url"]?>" class="<?php echo $v["className"]?>"><?php echo $v["title"]?></a></li>
		                 <?php }}?>
                        </ul>
                    </li>
                    <li><h3><a href="#" class="folder_table">Orders</a></h3>
          				<ul><?php if(!empty($subMenu["orders"])){?>
                        <?php foreach($subMenu["orders"] as $k=>$v){?>
		                    <li><a href="<?php echo $v["url"]?>" class="<?php echo $v["className"]?>"><?php echo $v["title"]?></a></li>
		                 <?php }}?>
                        </ul>
                    </li>
                    <li><h3><a href="#" class="manage">Manage</a></h3>
          				<ul><?php if(!empty($subMenu["manage"])){?>
                        <?php foreach($subMenu["manage"] as $k=>$v){?>
		                    <li><a href="<?php echo $v["url"]?>" class="<?php echo $v["className"]?>"><?php echo $v["title"]?></a></li>
		                 <?php }}?>
                        </ul>
                    </li>
                  <li><h3><a href="#" class="user">Users</a></h3>
          				<ul><?php if(!empty($subMenu["users"])){?>
                        <?php foreach($subMenu["users"] as $k=>$v){?>
		                    <li><a href="<?php echo $v["url"]?>" class="<?php echo $v["className"]?>"><?php echo $v["title"]?></a></li>
		                 <?php }}?>
                        </ul>
                    </li>
				</ul>       
          </div>
      </div>
        <div id="footer">
        <div id="credits">
   		<p>&copy; 2013 Design by Carp-e-Diem.</p>
        </div>
        <div id="styleswitcher">
            <ul>
                <li><a href="javascript: document.cookie='theme='; window.location.reload();" title="Default" id="defswitch">d</a></li>
                <li><a href="javascript: document.cookie='theme=1'; window.location.reload();" title="Blue" id="blueswitch">b</a></li>
                <li><a href="javascript: document.cookie='theme=2'; window.location.reload();" title="Green" id="greenswitch">g</a></li>
                <li><a href="javascript: document.cookie='theme=3'; window.location.reload();" title="Brown" id="brownswitch">b</a></li>
                <li><a href="javascript: document.cookie='theme=4'; window.location.reload();" title="Mix" id="mixswitch">m</a></li>
                <li><a href="javascript: document.cookie='theme=5'; window.location.reload();" title="Mix" id="defswitch">m</a></li>
            </ul>
        </div><br />
        </div>
</div>
</body>
</html>