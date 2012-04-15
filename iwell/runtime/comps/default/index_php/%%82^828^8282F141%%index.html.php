<?php /* Smarty version 2.6.18, created on 2012-04-15 21:01:05
         compiled from index/index.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'compareDate', 'index/index.html', 68, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<title><?php echo $this->_tpl_vars['lan']['site_title']; ?>
-首页</title>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/index.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/timeCountDown.js"></script>
<link rel="stylesheet" href="<?php echo $this->_tpl_vars['public']; ?>
/css/sales.min.css" media="all" type="text/css"/>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/common.js"></script>
</head>
<body>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'public/head.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="fabWrapper" class="wrapperMesh">
<div id="contentWrapper">
  <div class="fabBorderSpace"></div>
<div class="clear"></div>
  <div id="featuredShop" class="poRel" style="*margin-bottom: 6px">
    <h2 class="salesTitle salesTitleEndSn"><em class="redText">推荐商品</em></h2>
    <div id="featuredShopSliderContent">
      <div class="imgSliderWrap">
        <div class="buttonBg floatLeft"><span id="nextButton" class="displayNone buttons floatLeft" style="display: inline; "><span class="nextIcon fabShopSprite"></span></span></div>
        <div id="featuredAlbumSlidesContainer">
          <!--<div id="shop_img_loader" class="poAbs" style="bottom: 87px;left:50%"></div>-->
          <ul id="foundImages" class="">
          		<?php unset($this->_sections['ls']);
$this->_sections['ls']['loop'] = is_array($_loop=$this->_tpl_vars['data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['ls']['name'] = 'ls';
$this->_sections['ls']['show'] = true;
$this->_sections['ls']['max'] = $this->_sections['ls']['loop'];
$this->_sections['ls']['step'] = 1;
$this->_sections['ls']['start'] = $this->_sections['ls']['step'] > 0 ? 0 : $this->_sections['ls']['loop']-1;
if ($this->_sections['ls']['show']) {
    $this->_sections['ls']['total'] = $this->_sections['ls']['loop'];
    if ($this->_sections['ls']['total'] == 0)
        $this->_sections['ls']['show'] = false;
} else
    $this->_sections['ls']['total'] = 0;
if ($this->_sections['ls']['show']):

            for ($this->_sections['ls']['index'] = $this->_sections['ls']['start'], $this->_sections['ls']['iteration'] = 1;
                 $this->_sections['ls']['iteration'] <= $this->_sections['ls']['total'];
                 $this->_sections['ls']['index'] += $this->_sections['ls']['step'], $this->_sections['ls']['iteration']++):
$this->_sections['ls']['rownum'] = $this->_sections['ls']['iteration'];
$this->_sections['ls']['index_prev'] = $this->_sections['ls']['index'] - $this->_sections['ls']['step'];
$this->_sections['ls']['index_next'] = $this->_sections['ls']['index'] + $this->_sections['ls']['step'];
$this->_sections['ls']['first']      = ($this->_sections['ls']['iteration'] == 1);
$this->_sections['ls']['last']       = ($this->_sections['ls']['iteration'] == $this->_sections['ls']['total']);
?>
              <li class="alignCenter foundImagesSlide poRel">
                <a href="<?php echo $this->_tpl_vars['url']; ?>
/ware/id/<?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['id']; ?>
" class="gimg" data-img-url="">
                  <img src="<?php echo $this->_tpl_vars['public']; ?>
/images/ware/<?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['w_pic']; ?>
" alt="">
                    <span class="imgInfoBottom imgInfoBottomShopsMain">
                      <span class="floatLeft popUpShopTitle poRel" style="top: 2px;position: relative">
                        <span class="floatLeft popTitleWrap"><em class="popShopTitle desc_111"><?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['w_name']; ?>
</em>
                          <h3 class=""><span class="mainTitlePopUp"><strong class="f14">￥<?php echo $this->_tpl_vars['data'][$this->_sections['ls']['index']]['w_price']; ?>
</strong></span></h3>
                        </span>
                      </span>
                    </span>
                </a>
              </li>
              <?php endfor; endif; ?>
          </ul>
        </div>
        <div class="buttonBg floatRight"><span id="prvButton" class="displayNone buttons floatRight" style="display: inline; "><span class="prvIcon fabShopSprite"></span></span></div>
      </div>
      <div class="clear"></div>
    </div>
  </div>
  <div class="fabBorderSpace"></div>

  <div id="salesListPage">
    <h1 class="salesTitle salesTitleEndSn "><em class="redText"></em>最新商品</h1>
    <ul class="salesWrap" style="width: 938px;">
    	<?php unset($this->_sections['nd']);
$this->_sections['nd']['loop'] = is_array($_loop=$this->_tpl_vars['newData']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['nd']['name'] = 'nd';
$this->_sections['nd']['show'] = true;
$this->_sections['nd']['max'] = $this->_sections['nd']['loop'];
$this->_sections['nd']['step'] = 1;
$this->_sections['nd']['start'] = $this->_sections['nd']['step'] > 0 ? 0 : $this->_sections['nd']['loop']-1;
if ($this->_sections['nd']['show']) {
    $this->_sections['nd']['total'] = $this->_sections['nd']['loop'];
    if ($this->_sections['nd']['total'] == 0)
        $this->_sections['nd']['show'] = false;
} else
    $this->_sections['nd']['total'] = 0;
if ($this->_sections['nd']['show']):

            for ($this->_sections['nd']['index'] = $this->_sections['nd']['start'], $this->_sections['nd']['iteration'] = 1;
                 $this->_sections['nd']['iteration'] <= $this->_sections['nd']['total'];
                 $this->_sections['nd']['index'] += $this->_sections['nd']['step'], $this->_sections['nd']['iteration']++):
$this->_sections['nd']['rownum'] = $this->_sections['nd']['iteration'];
$this->_sections['nd']['index_prev'] = $this->_sections['nd']['index'] - $this->_sections['nd']['step'];
$this->_sections['nd']['index_next'] = $this->_sections['nd']['index'] + $this->_sections['nd']['step'];
$this->_sections['nd']['first']      = ($this->_sections['nd']['iteration'] == 1);
$this->_sections['nd']['last']       = ($this->_sections['nd']['iteration'] == $this->_sections['nd']['total']);
?>
        <li class="imgList <?php if ($this->_sections['nd']['index']%2 == 1): ?>even<?php else: ?>odd<?php endif; ?> filler">
          <a href="index.php/index/ware/id/<?php echo $this->_tpl_vars['newData'][$this->_sections['nd']['index']]['id']; ?>
" title=""><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/ware/<?php echo $this->_tpl_vars['newData'][$this->_sections['nd']['index']]['w_pic']; ?>
" alt="<?php echo $this->_tpl_vars['newData'][$this->_sections['nd']['index']]['w_name']; ?>
" style="width:460px;height: 460px;"/></a>
          <a class="dB" href="index.php/index/ware/id/<?php echo $this->_tpl_vars['newData'][$this->_sections['nd']['index']]['id']; ?>
" title="" style="*cursor: pointer">
            <span class="imgInfoTop">
              <span class="floatLeft">
                <h3><?php echo $this->_tpl_vars['newData'][$this->_sections['nd']['index']]['c_name']; ?>
</h3>
                <span class="imgDescription desc_345"><?php echo $this->_tpl_vars['newData'][$this->_sections['nd']['index']]['w_name']; ?>
</span>
              </span>
              <span class="viewDet floatRight round20 fabGrad" href="index.php/index/ware/id/<?php echo $this->_tpl_vars['newData'][$this->_sections['nd']['index']]['id']; ?>
"><span class="fabShopSprite gtIcon imgInfoArrow"></span></span>
            </span>
          </a>
          <a class="dB" href="index.php/index/ware/id/<?php echo $this->_tpl_vars['newData'][$this->_sections['nd']['index']]['id']; ?>
" title="" style="*cursor: pointer">
            <span class="imgInfoBottomHov hide">
              <h3 class="imgDesEndSn">
                <?php echo ((is_array($_tmp=$this->_tpl_vars['newData'][$this->_sections['nd']['index']]['sale_end'])) ? $this->_run_mod_handler('compareDate', true, $_tmp) : compareDate($_tmp)); ?>
 
              </h3>
              <span class="fabShopSprite greyClockBig marginLeft5"></span>
            </span>
          </a>
        </li>
        <?php endfor; endif; ?>
    </ul>
    <div class="clear"></div>
  </div>
  <div class="fabBorderSpace" id="pop-up-shop"></div>
  <div class="clear"></div>

  <div class="endingSoonWrap">
    <h2 class="salesTitle salesTitleEndSn ">即将<em class="redText"> 下架</em></h2>
    <ul class="endSoonWrap">
    <?php unset($this->_sections['esd']);
$this->_sections['esd']['loop'] = is_array($_loop=$this->_tpl_vars['endingsoondata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['esd']['name'] = 'esd';
$this->_sections['esd']['show'] = true;
$this->_sections['esd']['max'] = $this->_sections['esd']['loop'];
$this->_sections['esd']['step'] = 1;
$this->_sections['esd']['start'] = $this->_sections['esd']['step'] > 0 ? 0 : $this->_sections['esd']['loop']-1;
if ($this->_sections['esd']['show']) {
    $this->_sections['esd']['total'] = $this->_sections['esd']['loop'];
    if ($this->_sections['esd']['total'] == 0)
        $this->_sections['esd']['show'] = false;
} else
    $this->_sections['esd']['total'] = 0;
if ($this->_sections['esd']['show']):

            for ($this->_sections['esd']['index'] = $this->_sections['esd']['start'], $this->_sections['esd']['iteration'] = 1;
                 $this->_sections['esd']['iteration'] <= $this->_sections['esd']['total'];
                 $this->_sections['esd']['index'] += $this->_sections['esd']['step'], $this->_sections['esd']['iteration']++):
$this->_sections['esd']['rownum'] = $this->_sections['esd']['iteration'];
$this->_sections['esd']['index_prev'] = $this->_sections['esd']['index'] - $this->_sections['esd']['step'];
$this->_sections['esd']['index_next'] = $this->_sections['esd']['index'] + $this->_sections['esd']['step'];
$this->_sections['esd']['first']      = ($this->_sections['esd']['iteration'] == 1);
$this->_sections['esd']['last']       = ($this->_sections['esd']['iteration'] == $this->_sections['esd']['total']);
?>
        <li class="imgList">
          <a class="filler" href="index.php/index/ware/id/<?php echo $this->_tpl_vars['endingsoondata'][$this->_sections['esd']['index']]['id']; ?>
"  title=""><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/ware/<?php echo $this->_tpl_vars['endingsoondata'][$this->_sections['esd']['index']]['w_pic']; ?>
" alt="" title=""/></a>
          <a class="dB" href="index.php/index/ware/id/<?php echo $this->_tpl_vars['endingsoondata'][$this->_sections['esd']['index']]['id']; ?>
" title="" style="*cursor: pointer">
            <span class="imgInfoBottom">
              <span class="floatLeft">
                <h3><?php echo $this->_tpl_vars['endingsoondata'][$this->_sections['esd']['index']]['c_name']; ?>
</h3>
                <span class="imgDescription desc_226"><?php echo $this->_tpl_vars['endingsoondata'][$this->_sections['esd']['index']]['w_name']; ?>
</span>
              </span>
              <span class="viewDet floatRight round20 fabGrad" href="index.php/index/ware/id/<?php echo $this->_tpl_vars['endingsoondata'][$this->_sections['esd']['index']]['id']; ?>
"><span class="fabShopSprite gtIcon imgInfoArrow"></span></span>
            </span>
          </a>
          <a class="dB" href="index.php/index/ware/id/<?php echo $this->_tpl_vars['endingsoondata'][$this->_sections['esd']['index']]['id']; ?>
" title="" style="*cursor: pointer">
            <span class="imgInfoTopHov hide">
              <h3 class="imgDesEndSn">
                <?php echo ((is_array($_tmp=$this->_tpl_vars['endingsoondata'][$this->_sections['esd']['index']]['sale_end'])) ? $this->_run_mod_handler('compareDate', true, $_tmp) : compareDate($_tmp)); ?>

              </h3>
              <span class="fabShopSprite greyClockBig marginLeft5"></span>
            </span>
          </a>
        </li>
       <?php endfor; endif; ?>
    </ul>
    <div class="clear"></div>
  </div>
  <div class="fabBorderSpace"></div>
  <div class="clear"></div>
  <div class="upcommingWrap forIndex">
    <h2 class="salesTitle salesTitleEndSn floatLeft"><em class="redText">即将</em> 上架</h2>
    <span class="floatRight viewAllButton">
      <a class="" href="http://fab.com/upcoming-sales/">
        	更多
        <span class="buyNowBg round20 viewAllBg floatRight">
          <span class="fabShopSprite gtIcon imgInfoArrow"></span>
        </span>
      </a>
    </span>
    <div class="clear"></div>
        <div class="fstDySale" style="padding-bottom:10px;">
					<span class="salesDateTime" style="padding-bottom:10px;">
						<?php echo $this->_tpl_vars['tr1']; ?>

						<span class="salesTagIcon fabShopSprite"></span>
					</span>
					<ul>
  								<li class="noBorderBottom">
  									<span class="salesDailyWeeklyShop" style="display: block;">
  										<span class="weeklyShopsUpCominSalesDollarIcon fabShopSprite floatLeft dIB"></span>
  										<span style="color:black; font-size: 22px">&nbsp;&nbsp;Daily Sales</span>
  									</span>
  									<span class="salesDateBox borderR9">
  										<span class="triIcon"></span>
  										<span class="salesWatchIcon fabShopSprite"></span>
                      					<span>starts <?php echo $this->_tpl_vars['tr1']; ?>
 11am ET</span>
  									</span>
  									<ul id="upcmgContent" class="showHideToggleClass">
  									<?php unset($this->_sections['td']);
$this->_sections['td']['loop'] = is_array($_loop=$this->_tpl_vars['tr1Data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['td']['name'] = 'td';
$this->_sections['td']['show'] = true;
$this->_sections['td']['max'] = $this->_sections['td']['loop'];
$this->_sections['td']['step'] = 1;
$this->_sections['td']['start'] = $this->_sections['td']['step'] > 0 ? 0 : $this->_sections['td']['loop']-1;
if ($this->_sections['td']['show']) {
    $this->_sections['td']['total'] = $this->_sections['td']['loop'];
    if ($this->_sections['td']['total'] == 0)
        $this->_sections['td']['show'] = false;
} else
    $this->_sections['td']['total'] = 0;
if ($this->_sections['td']['show']):

            for ($this->_sections['td']['index'] = $this->_sections['td']['start'], $this->_sections['td']['iteration'] = 1;
                 $this->_sections['td']['iteration'] <= $this->_sections['td']['total'];
                 $this->_sections['td']['index'] += $this->_sections['td']['step'], $this->_sections['td']['iteration']++):
$this->_sections['td']['rownum'] = $this->_sections['td']['iteration'];
$this->_sections['td']['index_prev'] = $this->_sections['td']['index'] - $this->_sections['td']['step'];
$this->_sections['td']['index_next'] = $this->_sections['td']['index'] + $this->_sections['td']['step'];
$this->_sections['td']['first']      = ($this->_sections['td']['iteration'] == 1);
$this->_sections['td']['last']       = ($this->_sections['td']['iteration'] == $this->_sections['td']['total']);
?>
  											<li>
  												<a href="index.php/index/ware/id/<?php echo $this->_tpl_vars['tr1Data'][$this->_sections['td']['index']]['id']; ?>
">
  													<span class="title"><?php echo $this->_tpl_vars['tr1Data'][$this->_sections['td']['index']]['c_name']; ?>
</span>
  													<span class="des"><?php echo $this->_tpl_vars['tr1Data'][$this->_sections['td']['index']]['w_name']; ?>
</span>
  												</a>
  												<span class="imgList transBrd transBrdHvr hide">
  													<span class="hoverArrow"></span>
  													<a href="index.php/index/ware/id/<?php echo $this->_tpl_vars['tr1Data'][$this->_sections['td']['index']]['id']; ?>
" class="filler"><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/ware/<?php echo $this->_tpl_vars['tr1Data'][$this->_sections['td']['index']]['w_pic']; ?>
" alt="" width="300" height="300" title="" /></a>
  													<span class="imgInfoBottom">
  														<span class="floatLeft">
  															<h3><?php echo $this->_tpl_vars['tr1Data'][$this->_sections['td']['index']]['c_name']; ?>
</h3>
  															<span class="imgDescription desc_236"><?php echo $this->_tpl_vars['tr1Data'][$this->_sections['td']['index']]['w_name']; ?>
</span>
  														</span>
  														<a class="viewDet floatRight round20 fabGrad" href="index.php/index/ware/id/<?php echo $this->_tpl_vars['tr1Data'][$this->_sections['td']['index']]['id']; ?>
"><span class="fabShopSprite gtIcon imgInfoArrow"></span></a>
  													</span>
  													<span class="imgInfoTopHov hide">
  														<h3 class="imgDesEndSn">
  															<?php echo ((is_array($_tmp=$this->_tpl_vars['tr1Data'][$this->_sections['td']['index']]['sale_end'])) ? $this->_run_mod_handler('compareDate', true, $_tmp) : compareDate($_tmp)); ?>

  														</h3>
  														<span class="fabShopSprite greyClockBig marginLeft5"></span>
  													</span>
  												</span>
  											</li>
  											<?php endfor; endif; ?>
  									</ul>
  								</li>
								
								
                      <li class="noBorderBottom">
                        <span class="salesDailyWeeklyShop" style="display : block;padding-bottom: 6px;">
                          <span class="fabShopSprite floatLeft dIB weeklyShopsUpCominSalesPetsIcon"></span>
                          <span style="font-size: 22px">&nbsp;&nbsp;The <b style="color: #363636;">Pets Shop</b></span>
                              <span class="weeklyShopsUpcominSalesPlusIcon fabShopSprite dIB floatRight toggleWeekShpIcon" data-popup-sale="false"></span>
                        </span>
                        <span class="salesDateBox borderR9">
                          <span class="triIcon"></span>
                          <span class="salesWatchIcon fabShopSprite"></span>
                          <span>starts 03/29 7pm ET</span>
                        </span>
                      </li>
                      <li class="noBorderBottom">
                      <ul class="showHideToggleClass upcmgContentShow weekShopToggleContent">
                            <li>
                              <a href="http://fab.com/sale/4577/" alt="">
                                <span class="title">pEi Pod</span>
                                <span class="des">Mod and Comfy Pet Enclosures</span>
                              </a>
                              <span class="imgList transBrd transBrdHvr hide">
                                <span class="hoverArrow"></span>
                                <a href="http://fab.com/sale/4577/" class="filler" alt=""><img src="./fab.com_files/4577-300x300-1332825285.png" alt="" width="300" height="300" title=""></a>
                                <span class="imgInfoBottom">
                                  <span class="floatLeft">
                                    <h3>pEi Pod</h3>
                                    <span class="imgDescription">
                                      Mod and Comfy Pet Enclosures
                                    </span>
                                  </span>
                                  <a class="viewDet floatRight round20 fabGrad" href="http://fab.com/sale/4577/"><span class="fabShopSprite gtIcon imgInfoArrow"></span></a>
                                </span>
                                <span class="imgInfoTopHov hide">
                                  <h3 class="imgDesEndSn">
                                    Sale Ends in 7 days and 8 hours
                                  </h3>
                                  <span class="fabShopSprite greyClockBig marginLeft5"></span>
                                </span>
                              </span>
                            </li>
                        </ul>
                      </li>
						</ul>
        </div>

        <div class="secDySale" style="padding-bottom:10px;">
					<span class="salesDateTime" style="padding-bottom:10px;">
						<?php echo $this->_tpl_vars['tr2']; ?>

						<span class="salesTagIcon fabShopSprite"></span>
					</span>
					<ul>
  								<li class="noBorderBottom">
  									<span class="salesDailyWeeklyShop" style="display: block;">
  										<span class="weeklyShopsUpCominSalesDollarIcon fabShopSprite floatLeft dIB"></span>
  										<span style="color:black; font-size: 22px">&nbsp;&nbsp;Daily Sales</span>
  									</span>
  									<span class="salesDateBox borderR9">
  										<span class="triIcon"></span>
  										<span class="salesWatchIcon fabShopSprite"></span>
                     		 		<span>starts <?php echo $this->_tpl_vars['tr2']; ?>
 11am ET</span>
  									</span>
  									<ul id="upcmgContent" class="showHideToggleClass">
  										<?php unset($this->_sections['t2d']);
$this->_sections['t2d']['loop'] = is_array($_loop=$this->_tpl_vars['tr2Data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['t2d']['name'] = 't2d';
$this->_sections['t2d']['show'] = true;
$this->_sections['t2d']['max'] = $this->_sections['t2d']['loop'];
$this->_sections['t2d']['step'] = 1;
$this->_sections['t2d']['start'] = $this->_sections['t2d']['step'] > 0 ? 0 : $this->_sections['t2d']['loop']-1;
if ($this->_sections['t2d']['show']) {
    $this->_sections['t2d']['total'] = $this->_sections['t2d']['loop'];
    if ($this->_sections['t2d']['total'] == 0)
        $this->_sections['t2d']['show'] = false;
} else
    $this->_sections['t2d']['total'] = 0;
if ($this->_sections['t2d']['show']):

            for ($this->_sections['t2d']['index'] = $this->_sections['t2d']['start'], $this->_sections['t2d']['iteration'] = 1;
                 $this->_sections['t2d']['iteration'] <= $this->_sections['t2d']['total'];
                 $this->_sections['t2d']['index'] += $this->_sections['t2d']['step'], $this->_sections['t2d']['iteration']++):
$this->_sections['t2d']['rownum'] = $this->_sections['t2d']['iteration'];
$this->_sections['t2d']['index_prev'] = $this->_sections['t2d']['index'] - $this->_sections['t2d']['step'];
$this->_sections['t2d']['index_next'] = $this->_sections['t2d']['index'] + $this->_sections['t2d']['step'];
$this->_sections['t2d']['first']      = ($this->_sections['t2d']['iteration'] == 1);
$this->_sections['t2d']['last']       = ($this->_sections['t2d']['iteration'] == $this->_sections['t2d']['total']);
?>
  											<li>
  												<a href="index.php/index/ware/id/<?php echo $this->_tpl_vars['tr2Data'][$this->_sections['t2d']['index']]['id']; ?>
" alt="">
  													<span class="title desc_246"><?php echo $this->_tpl_vars['tr2Data'][$this->_sections['t2d']['index']]['c_name']; ?>
</span>
  													<span class="des"><?php echo $this->_tpl_vars['tr2Data'][$this->_sections['t2d']['index']]['w_name']; ?>
</span>
  												</a>
  												<span class="imgList transBrd transBrdHvr hide">
  													<span class="hoverArrow"></span>
  													<a href="index.php/index/ware/id/<?php echo $this->_tpl_vars['tr2Data'][$this->_sections['t2d']['index']]['id']; ?>
" class="filler" alt=""><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/ware/<?php echo $this->_tpl_vars['tr2Data'][$this->_sections['t2d']['index']]['w_pic']; ?>
" alt="" width="300" height="300" title=""></a>
  													<span class="imgInfoBottom">
  														<span class="floatLeft ">
  															<h3><?php echo $this->_tpl_vars['tr2Data'][$this->_sections['t2d']['index']]['c_name']; ?>
</h3>
  															<span class="imgDescription desc_236"><?php echo $this->_tpl_vars['tr2Data'][$this->_sections['t2d']['index']]['w_name']; ?>
</span>
  														</span>
  														<a class="viewDet floatRight round20 fabGrad" href="index.php/index/ware/id/<?php echo $this->_tpl_vars['tr2Data'][$this->_sections['t2d']['index']]['id']; ?>
"><span class="fabShopSprite gtIcon imgInfoArrow"></span></a>
  													</span>
  													<span class="imgInfoTopHov hide">
  														<h3 class="imgDesEndSn">
  															<?php echo ((is_array($_tmp=$this->_tpl_vars['tr2Data'][$this->_sections['t2d']['index']]['sale_end'])) ? $this->_run_mod_handler('compareDate', true, $_tmp) : compareDate($_tmp)); ?>

  														</h3>
  														<span class="fabShopSprite greyClockBig marginLeft5"></span>
  													</span>
  												</span>
  											</li>
 										<?php endfor; endif; ?>
  									</ul>
  								</li>
								
								
                      <li class="noBorderBottom">
                        <span class="salesDailyWeeklyShop" style="display : block;padding-bottom: 6px;">
                          <span class="fabShopSprite floatLeft dIB weeklyShopsUpCominSalesFoodieIcon"></span>
                          <span style="font-size: 22px">&nbsp;&nbsp;The <b style="color: #363636;">Foodie Shop</b></span>
                              <span class="weeklyShopsUpcominSalesPlusIcon fabShopSprite dIB floatRight toggleWeekShpIcon" data-popup-sale="false"></span>
                        </span>
                        <span class="salesDateBox borderR9">
                          <span class="triIcon"></span>
                          <span class="salesWatchIcon fabShopSprite"></span>
                          <span>starts 03/30 7pm ET</span>
                        </span>
                      </li>
                      <li class="noBorderBottom">
                      <ul class="showHideToggleClass upcmgContentShow weekShopToggleContent ">
                            <li>
                              <a href="http://fab.com/sale/4579/" alt="">
                                <span class="title">Mercer Cutlery</span>
                                <span class="des">Sleek Professional Blades and Sets</span>
                              </a>
                              <span class="imgList transBrd transBrdHvr hide">
                                <span class="hoverArrow"></span>
                                <a href="http://fab.com/sale/4579/" class="filler" alt=""><img src="./fab.com_files/4579-300x300-1332963137.png" alt="" width="300" height="300" title=""></a>
                                <span class="imgInfoBottom">
                                  <span class="floatLeft">
                                    <h3>Mercer Cutlery</h3>
                                    <span class="imgDescription">
                                      Sleek Professional Blades and Sets
                                    </span>
                                  </span>
                                  <a class="viewDet floatRight round20 fabGrad" href="http://fab.com/sale/4579/"><span class="fabShopSprite gtIcon imgInfoArrow"></span></a>
                                </span>
                                <span class="imgInfoTopHov hide">
                                  <h3 class="imgDesEndSn">
                                    Sale Ends in 8 days and 8 hours
                                  </h3>
                                  <span class="fabShopSprite greyClockBig marginLeft5"></span>
                                </span>
                              </span>
                            </li>
                        </ul>
                      </li>
						</ul>
        </div>

        <div class="trdDySale" style="padding-bottom:10px;">
					<span class="salesDateTime" style="padding-bottom:10px;">
						<?php echo $this->_tpl_vars['tr3']; ?>

						<span class="salesTagIcon fabShopSprite"></span>
					</span>
					<ul>
  								<li class="noBorderBottom">
  									<span class="salesDailyWeeklyShop" style="display: block;">
  										<span class="weeklyShopsUpCominSalesDollarIcon fabShopSprite floatLeft dIB"></span>
  										<span style="color:black; font-size: 22px">&nbsp;&nbsp;Daily Sales</span>
  									</span>
  									<span class="salesDateBox borderR9">
  										<span class="triIcon"></span>
  										<span class="salesWatchIcon fabShopSprite"></span>
                      					<span>starts <?php echo $this->_tpl_vars['tr3']; ?>
 11am ET</span>
  									</span>
  									<ul id="upcmgContent" class="showHideToggleClass">
  									<?php unset($this->_sections['t3d']);
$this->_sections['t3d']['loop'] = is_array($_loop=$this->_tpl_vars['tr3Data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['t3d']['name'] = 't3d';
$this->_sections['t3d']['show'] = true;
$this->_sections['t3d']['max'] = $this->_sections['t3d']['loop'];
$this->_sections['t3d']['step'] = 1;
$this->_sections['t3d']['start'] = $this->_sections['t3d']['step'] > 0 ? 0 : $this->_sections['t3d']['loop']-1;
if ($this->_sections['t3d']['show']) {
    $this->_sections['t3d']['total'] = $this->_sections['t3d']['loop'];
    if ($this->_sections['t3d']['total'] == 0)
        $this->_sections['t3d']['show'] = false;
} else
    $this->_sections['t3d']['total'] = 0;
if ($this->_sections['t3d']['show']):

            for ($this->_sections['t3d']['index'] = $this->_sections['t3d']['start'], $this->_sections['t3d']['iteration'] = 1;
                 $this->_sections['t3d']['iteration'] <= $this->_sections['t3d']['total'];
                 $this->_sections['t3d']['index'] += $this->_sections['t3d']['step'], $this->_sections['t3d']['iteration']++):
$this->_sections['t3d']['rownum'] = $this->_sections['t3d']['iteration'];
$this->_sections['t3d']['index_prev'] = $this->_sections['t3d']['index'] - $this->_sections['t3d']['step'];
$this->_sections['t3d']['index_next'] = $this->_sections['t3d']['index'] + $this->_sections['t3d']['step'];
$this->_sections['t3d']['first']      = ($this->_sections['t3d']['iteration'] == 1);
$this->_sections['t3d']['last']       = ($this->_sections['t3d']['iteration'] == $this->_sections['t3d']['total']);
?>
  											<li>
  												<a href="index.php/index/ware/id/<?php echo $this->_tpl_vars['tr3Data'][$this->_sections['t3d']['index']]['id']; ?>
">
  													<span class="title"><?php echo $this->_tpl_vars['tr3Data'][$this->_sections['t3d']['index']]['c_name']; ?>
</span>
  													<span class="des"><?php echo $this->_tpl_vars['tr3Data'][$this->_sections['t3d']['index']]['w_name']; ?>
</span>
  												</a>
  												<span class="imgList transBrd transBrdHvr hide">
  													<span class="hoverArrow"></span>
  													<a href="index.php/index/ware/id/<?php echo $this->_tpl_vars['tr3Data'][$this->_sections['t3d']['index']]['id']; ?>
" class="filler" alt=""><img src="<?php echo $this->_tpl_vars['public']; ?>
/images/ware/<?php echo $this->_tpl_vars['tr3Data'][$this->_sections['t3d']['index']]['w_pic']; ?>
" alt="" width="300" height="300" title=""></a>
  													<span class="imgInfoBottom">
  														<span class="floatLeft">
  															<h3><?php echo $this->_tpl_vars['tr3Data'][$this->_sections['t3d']['index']]['c_name']; ?>
</h3>
  															<span class="imgDescription desc_236"><?php echo $this->_tpl_vars['tr3Data'][$this->_sections['t3d']['index']]['w_name']; ?>
</span>
  														</span>
  														<a class="viewDet floatRight round20 fabGrad" href="index.php/index/ware/id/<?php echo $this->_tpl_vars['tr3Data'][$this->_sections['t3d']['index']]['id']; ?>
"><span class="fabShopSprite gtIcon imgInfoArrow"></span></a>
  													</span>
  													<span class="imgInfoTopHov hide">
  														<h3 class="imgDesEndSn">
  															<?php echo ((is_array($_tmp=$this->_tpl_vars['tr3Data'][$this->_sections['t3d']['index']]['sale_end'])) ? $this->_run_mod_handler('compareDate', true, $_tmp) : compareDate($_tmp)); ?>

  														</h3>
  														<span class="fabShopSprite greyClockBig marginLeft5"></span>
  													</span>
  												</span>
  											</li>
 										<?php endfor; endif; ?>
  									</ul>
  								</li>
								
								
						</ul>
        </div>

    <div class="clear"></div>
  </div>
  <div class="fabBorderSpace"></div>
  <div class="clear"></div>
  <div class="getInspiredWrap">
    <h2 class="salesTitle salesTitleEndSn floatLeft"> <em class="redText">创意</em></h2>
    <a href="javascript:void(0)" onclick="window.location.href =;" class="positionRel floatRight">
      <span class="buyNowBg round20 viewAllBg floatRight">
        <span class="fabShopSprite gtIcon imgInfoArrow"></span>
      </span>
    </a>
    <div class="clear"></div>
    <ul>
    <?php unset($this->_sections['dr']);
$this->_sections['dr']['loop'] = is_array($_loop=$this->_tpl_vars['datar']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['dr']['name'] = 'dr';
$this->_sections['dr']['show'] = true;
$this->_sections['dr']['max'] = $this->_sections['dr']['loop'];
$this->_sections['dr']['step'] = 1;
$this->_sections['dr']['start'] = $this->_sections['dr']['step'] > 0 ? 0 : $this->_sections['dr']['loop']-1;
if ($this->_sections['dr']['show']) {
    $this->_sections['dr']['total'] = $this->_sections['dr']['loop'];
    if ($this->_sections['dr']['total'] == 0)
        $this->_sections['dr']['show'] = false;
} else
    $this->_sections['dr']['total'] = 0;
if ($this->_sections['dr']['show']):

            for ($this->_sections['dr']['index'] = $this->_sections['dr']['start'], $this->_sections['dr']['iteration'] = 1;
                 $this->_sections['dr']['iteration'] <= $this->_sections['dr']['total'];
                 $this->_sections['dr']['index'] += $this->_sections['dr']['step'], $this->_sections['dr']['iteration']++):
$this->_sections['dr']['rownum'] = $this->_sections['dr']['iteration'];
$this->_sections['dr']['index_prev'] = $this->_sections['dr']['index'] - $this->_sections['dr']['step'];
$this->_sections['dr']['index_next'] = $this->_sections['dr']['index'] + $this->_sections['dr']['step'];
$this->_sections['dr']['first']      = ($this->_sections['dr']['iteration'] == 1);
$this->_sections['dr']['last']       = ($this->_sections['dr']['iteration'] == $this->_sections['dr']['total']);
?>
        <li>
          <div class="insImgCont filler">
            <a style="display: block;" href="index.php/index/ware/id/<?php echo $this->_tpl_vars['datar'][$this->_sections['dr']['index']]['id']; ?>
">
              <span style="height: 306px; width: 306px; background-image: url(&quot;<?php echo $this->_tpl_vars['public']; ?>
/images/ware/<?php echo $this->_tpl_vars['datar'][$this->_sections['dr']['index']]['w_pic']; ?>
&quot;);" class="insImg"></span>
            </a>
          </div>
          <div class="imageInfoWrap">
            <a href="index.php/index/ware/id/<?php echo $this->_tpl_vars['datar'][$this->_sections['dr']['index']]['id']; ?>
" data-image-id="weiner-dog-oil-vinegar-set" class="fabShopSprite infoIconBG">
              <span class="fabShopSprite infoIcon"></span>
            </a>
            <span class="imageInfoContent round5"></span>
          </div>
          <p class="overflowHidden imgAuthInfo">
            <span class="floatLeft">
							<span class="imgBy floatLeft"><a href="http://fab.com/adamwillis/"><?php echo $this->_tpl_vars['datar'][$this->_sections['dr']['index']]['c_name']; ?>
</a></span>
              <span class="upldTimeInfo">
                <span class="upldTime fabShopSprite floatLeft"></span>
                <span class="upldTimeCount floatLeft"><?php echo ((is_array($_tmp=$this->_tpl_vars['datar'][$this->_sections['dr']['index']]['sale_end'])) ? $this->_run_mod_handler('compareDate', true, $_tmp) : compareDate($_tmp)); ?>
</span>
              </span>
              <span class="fabSeprator fabShopSprite"></span>

              <span class="imgFabCount">
                  <a href="http://fab.com/inspiration/87531/fab" rel="fabInspImg" title="FAB this photo" class="showLoginBox">
                    <span class="imgFab fabShopSprite"></span>
                  </a>
                <span class="fabIcon">462</span>
              </span>
              <span class="imgCountDetails">
                <a title="Comment on this photo" href="http://fab.com/inspiration/weiner-dog-oil-vinegar-set">
                  <span class="imgCount fabShopSprite"></span>
                </a>
                <span>
                  <fb:comments-count href="http://fab.com/inspiration/weiner-dog-oil-vinegar-set" class="fb_comments_count_zero"><span class="fb_comments_count" style="vertical-align: top !important;"></span></fb:comments-count>
              </span>
            </span>
            </span>
          </p>
        </li>
        <?php endfor; endif; ?>
    </ul>
    <div class="clear"></div>
  </div>
  </div>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'public/foot.html', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>