<?php /* Smarty version 2.6.18, created on 2012-04-20 15:33:33
         compiled from public/head.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'public/head.html', 55, false),)), $this); ?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['public']; ?>
/js/common.js"></script>
<div id="header">
  <div id="fabHeader">
  <ul id="leftNavToggle" class="floatLeft">
    <li class="mainFabIcon headerhover">
      <a id="homeImage" href="/" class="textHide"><span class="fabShopSprite homeIcon"></span></a>
    </li>
      <li id="todaySaleLink" class="poRel selected">
        <a style="line-height: 17px;height: 54px;" class="todaySaleLink" href="/index.php"><span class="newHeaderSalesIcon fabShopSprite"></span><br><br><span>Sales</span></a>
          <div class="newSaleNav">
            <div style="position: absolute;height: 12px;top:-12px;width:100%"><span class="tagTri" style="left:37px;"></span></div>
            <div class="overflowHidden">
              <div class="col1 floatLeft">
                <h2 style="padding-bottom:18px;">最新产品</h2>
                <ul id="newSalesList">
        			<?php unset($this->_sections['nd']);
$this->_sections['nd']['loop'] = is_array($_loop=$this->_tpl_vars['head_newData']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                    <li>
                      <a href="index.php/index/ware/id/<?php echo $this->_tpl_vars['newData'][$this->_sections['nd']['index']]['id']; ?>
">
                        <h5><?php echo $this->_tpl_vars['newData'][$this->_sections['nd']['index']]['cat_name']; ?>
 </h5>
                        <h6><?php echo $this->_tpl_vars['newData'][$this->_sections['nd']['index']]['goods_name']; ?>
</h6>
                      </a>
                    </li>
                   <?php endfor; endif; ?>
                </ul>
              </div>
              <div class="col2 floatLeft">
                <h2 style="padding-bottom:18px;">即将下架</h2>
                <ul id="upCSalesList">
                	<?php unset($this->_sections['esd']);
$this->_sections['esd']['loop'] = is_array($_loop=$this->_tpl_vars['head_endingsoondata']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
                      <li>
                        <a href="index.php/index/ware/id/<?php echo $this->_tpl_vars['endingsoondata'][$this->_sections['esd']['index']]['id']; ?>
">
                          <h5><?php echo $this->_tpl_vars['endingsoondata'][$this->_sections['esd']['index']]['cat_name']; ?>
</h5>
                          <h6><?php echo $this->_tpl_vars['endingsoondata'][$this->_sections['esd']['index']]['goods_name']; ?>
</h6>
                        </a>
                      </li>
                     <?php endfor; endif; ?>
                </ul>
              </div>
            </div>
          </div>
      </li>
        <li class="poRel " id="popUpShopMenu">
          <a style="line-height: 17px;height: 54px;padding: 0 0.85em;" href="http://fab.com/shops/" class="popupShopLinks"><span class="newHeaderShopsIcon fabShopSprite"></span><br><br><span style="line-height: 17px;display: inline-block;">Shops</span></a>
          <div class="sub shopSubNav popupSalesNav">
            <div style="position: absolute;height: 12px;top:-12px;width:100%"><span class="tagTri" style="left:37px;"></span></div>
              <div class="overflowHidden">
                <div class="shopFirstMenu row floatLeft">
                  <h2 style="padding-top: 2px;">按分类浏览</h2>
                  <div class="floatLeft">
                    <ul style="width:158px;margin-right: 30px;">
                    	<?php unset($this->_sections['cat']);
$this->_sections['cat']['loop'] = is_array($_loop=$this->_tpl_vars['category']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cat']['name'] = 'cat';
$this->_sections['cat']['show'] = true;
$this->_sections['cat']['max'] = $this->_sections['cat']['loop'];
$this->_sections['cat']['step'] = 1;
$this->_sections['cat']['start'] = $this->_sections['cat']['step'] > 0 ? 0 : $this->_sections['cat']['loop']-1;
if ($this->_sections['cat']['show']) {
    $this->_sections['cat']['total'] = $this->_sections['cat']['loop'];
    if ($this->_sections['cat']['total'] == 0)
        $this->_sections['cat']['show'] = false;
} else
    $this->_sections['cat']['total'] = 0;
if ($this->_sections['cat']['show']):

            for ($this->_sections['cat']['index'] = $this->_sections['cat']['start'], $this->_sections['cat']['iteration'] = 1;
                 $this->_sections['cat']['iteration'] <= $this->_sections['cat']['total'];
                 $this->_sections['cat']['index'] += $this->_sections['cat']['step'], $this->_sections['cat']['iteration']++):
$this->_sections['cat']['rownum'] = $this->_sections['cat']['iteration'];
$this->_sections['cat']['index_prev'] = $this->_sections['cat']['index'] - $this->_sections['cat']['step'];
$this->_sections['cat']['index_next'] = $this->_sections['cat']['index'] + $this->_sections['cat']['step'];
$this->_sections['cat']['first']      = ($this->_sections['cat']['iteration'] == 1);
$this->_sections['cat']['last']       = ($this->_sections['cat']['iteration'] == $this->_sections['cat']['total']);
?>
                        <li class="cat_parent">
                          <a href="<?php echo $this->_tpl_vars['url']; ?>
">
                            <?php echo $this->_tpl_vars['category'][$this->_sections['cat']['index']]['cat_name']; ?>

                            <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right"><?php echo count($this->_tpl_vars['category'][$this->_sections['cat']['index']]['subcat']); ?>
</em>
                          </a>
                          <ul class="hide cat_child">
                         	<?php unset($this->_sections['a']);
$this->_sections['a']['loop'] = is_array($_loop=$this->_tpl_vars['category'][$this->_sections['cat']['index']]['subcat']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['a']['name'] = 'a';
$this->_sections['a']['show'] = true;
$this->_sections['a']['max'] = $this->_sections['a']['loop'];
$this->_sections['a']['step'] = 1;
$this->_sections['a']['start'] = $this->_sections['a']['step'] > 0 ? 0 : $this->_sections['a']['loop']-1;
if ($this->_sections['a']['show']) {
    $this->_sections['a']['total'] = $this->_sections['a']['loop'];
    if ($this->_sections['a']['total'] == 0)
        $this->_sections['a']['show'] = false;
} else
    $this->_sections['a']['total'] = 0;
if ($this->_sections['a']['show']):

            for ($this->_sections['a']['index'] = $this->_sections['a']['start'], $this->_sections['a']['iteration'] = 1;
                 $this->_sections['a']['iteration'] <= $this->_sections['a']['total'];
                 $this->_sections['a']['index'] += $this->_sections['a']['step'], $this->_sections['a']['iteration']++):
$this->_sections['a']['rownum'] = $this->_sections['a']['iteration'];
$this->_sections['a']['index_prev'] = $this->_sections['a']['index'] - $this->_sections['a']['step'];
$this->_sections['a']['index_next'] = $this->_sections['a']['index'] + $this->_sections['a']['step'];
$this->_sections['a']['first']      = ($this->_sections['a']['iteration'] == 1);
$this->_sections['a']['last']       = ($this->_sections['a']['iteration'] == $this->_sections['a']['total']);
?>
	                          	<li><a href="<?php echo $this->_tpl_vars['app']; ?>
/search/cat/cid/<?php echo $this->_tpl_vars['category'][$this->_sections['cat']['index']]['subcat'][$this->_sections['a']['index']]['id']; ?>
"><?php echo $this->_tpl_vars['category'][$this->_sections['cat']['index']]['subcat'][$this->_sections['a']['index']]['cat_name']; ?>
</a></li>
							<?php endfor; endif; ?>
                          </ul>
                        </li>
                        <?php endfor; endif; ?>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
        </li>
          <li id="livefeedNav" class="poRel ">
            <a style="line-height: 17px;height: 54px;width: 42px;text-align: center;" href="http://fab.com/feed/" alt="Live Feed" title="Live Feed">
              <span class="newHeaderLiveFeedIcon textHide fabShopSprite"></span><br><br><span style="line-height: 17px;display: inline-block;">Feed</span>
            </a>
          </li>
      <li id="upcomingSaleLink" class="poRel ">
        <a style="line-height: 17px;height: 54px;" class="upcomingSaleLink" href="http://fab.com/upcoming-sales/?tb=cs"><span class="newHeaderCalenderIcon fabShopSprite"></span><br><br><span style="line-height: 17px;display: inline-block;">Calendar</span></a>
      </li>
      <li>
        <a style="line-height: 17px;height: 54px;padding: 0 0.7em;" href="http://fab.com/inspiration/"><span class="newHeaderInspirationIcon fabShopSprite"></span><br><br><span style="line-height: 17px;display: inline-block;">Inspiration</span></a>
      </li>
      <li class="ivtFrndsOpt">
        <a style="line-height: 17px;height: 54px;padding: 0 1.16em;" class="ivtFrndsButton" href="https://fab.com/invites/"><span class="newHeaderInviteIcon fabShopSprite"></span><br><br><span style="line-height: 17px;display: inline-block;">Invite</span></a>
      </li>
      <li title="Get the Fab App!" class="poRel ">
        <a style="line-height: 5px;height: 54px;padding: 0 0.85em;" href="http://fab.com/downloads/"><span class="fabShopSprite newHeaderMobileIcon"></span><br><br><span style="line-height: 12px;display: inline-block;">Mobile</span></a>
      </li>
        <li id="splOfferLinkMadonna" class="poRel" data-params="sale">
          <a style="line-height: 3px;height: 54px;padding: 0 0.82em;" href="javascript:void(0)" alt="Madonna">
            <span class="fabShopSprite musicIcon" style="margin-left: 13px;"></span><br><br>
            <span style="line-height: 15px;display: inline-block;">Madonna</span>
          </a>
        </li>
  </ul>
	
	
  <ul id="rightNavToggle" class="floatRight">
        <li id="cartNav" class="poRel">
	          <a id="scMenu" href="/index.php/car/mycar" style="height: 54px;">
	            <span class="userCartList textHide fabShopSprite" style="margin-top:20px;">购物车</span>
	            <span class="crtLstNotification round7 hide">0</span>
	          </a>
	        <ul id="sCart" class="borderRB12">  <li class="cartEmpty">暂无商品</li>
				<li class="cartLast borderRB12">
				  <span class="fabShopSprite back_icon floatLeft poRel" style="top:8px;margin-right: 8px">&lt;</span>
				  <a class="cartLink floatLeft" href="/">继续购物</a>
				</li>
			</ul>
        </li>
      <li id="userSettingOpt">
        <a style="font-weight:bold;" href="javascript:void(0)" id="fabUserName" title="wcj343169893" alt="wcj343169893">wcj343169893
        <span class="fabShopSprite iRecentIcon"></span>
        </a>
        <div class="userMenuD">
          <ul>
            <li><a class="userSetting" href="http://fab.com/wcj343169893/">Profile</a></li>
            <li><a class="userSetting" href="https://fab.com/settings/">Account Information</a></li>
            <li><a class="userSetting" href="https://fab.com/email-preferences/">Email Preferences</a></li>
            <li><a class="userSetting" href="https://fab.com/my-order/">My Orders</a></li>
            <li><a class="userSetting" href="https://fab.com/my-payment-methods/">Payment Methods</a></li>
            <li><a class="userSetting" href="https://fab.com/my-credits/">My Credits</a></li>
            <li><a class="userSetting" href="https://fab.com/invites/">Invites</a></li>
            <li><a class="userSetting" href="https://fab.com/logout/">Logout</a></li>
          </ul>
        </div>
      </li>
  </ul>
</div>


</div>