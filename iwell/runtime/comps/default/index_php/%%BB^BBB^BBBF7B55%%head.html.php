<?php /* Smarty version 2.6.18, created on 2012-04-08 19:07:14
         compiled from public/head.html */ ?>
<div id="header">
  <div id="fabHeader">
  <ul id="leftNavToggle" class="floatLeft">
    <li class="mainFabIcon headerhover">
      <a id="homeImage" href="http://fab.com/sale/" class="textHide"><span class="fabShopSprite homeIcon"></span></a>
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
                    <li>
                      <a href="index.php/index/ware/id/<?php echo $this->_tpl_vars['newData'][$this->_sections['nd']['index']]['id']; ?>
">
                        <h5><?php echo $this->_tpl_vars['newData'][$this->_sections['nd']['index']]['c_name']; ?>
 </h5>
                        <h6><?php echo $this->_tpl_vars['newData'][$this->_sections['nd']['index']]['w_name']; ?>
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
                      <li>
                        <a href="index.php/index/ware/id/<?php echo $this->_tpl_vars['endingsoondata'][$this->_sections['esd']['index']]['id']; ?>
">
                          <h5><?php echo $this->_tpl_vars['endingsoondata'][$this->_sections['esd']['index']]['c_name']; ?>
</h5>
                          <h6><?php echo $this->_tpl_vars['endingsoondata'][$this->_sections['esd']['index']]['w_name']; ?>
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
                  <h2 style="padding-top: 2px;">BROWSE BY SHOPS</h2>
                  <div class="floatLeft">
                    <ul style="width:158px;margin-right: 30px;">
                        <li>
                          <a href="http://fab.com/shops/23/">
                            Art
                            <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">403</em>
                          </a>

                        </li>
                        <li>
                          <a href="http://fab.com/shops/25/">
                            Bed &amp; Bath
                            <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">35</em>
                          </a>

                        </li>
                        <li>
                          <a href="http://fab.com/shops/39/">
                            Books &amp; Media
                            <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">212</em>
                          </a>

                        </li>
                        <li>
                          <a href="http://fab.com/shops/34/">
                            Cook &amp; Prep
                            <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">91</em>
                          </a>

                        </li>
                        <li>
                          <a href="http://fab.com/weekly-shops/fashion/">
                            Fashion
                            <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">257</em>
                          </a>

                        </li>
                        <li>
                          <a href="http://fab.com/shops/29/">
                            Fitness &amp; Sports
                            <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">25</em>
                          </a>

                        </li>
                        <li>
                          <a href="http://fab.com/weekly-shops/foodie/">
                            Foodie
                            <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">78</em>
                          </a>

                        </li>
                        <li>
                          <a href="http://fab.com/shops/31/">
                            Furniture
                            <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">185</em>
                          </a>

                        </li>
                        <li>
                          <a href="http://fab.com/shops/52/">
                            Gifts
                            <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">434</em>
                          </a>

                        </li>
                        <li>
                          <a href="http://fab.com/sale/4127/">
                            Glass House
                            <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">23</em>
                          </a>

                        </li>
                        <li>
                          <a href="http://fab.com/shops/24/">
                            Home Accessories
                            <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">592</em>
                          </a>

                        </li>
                        <li>
                          <a href="http://fab.com/shops/32/">
                            Jewelry
                            <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">303</em>
                          </a>

                        </li>
                        <li>
                          <a href="http://fab.com/weekly-shops/kids/">
                            Kids
                            <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">235</em>
                          </a>

                        </li>
                    </ul>
                  </div>
                    <div class="floatLeft">
                      <ul style="width:158px;">
                          <li>
                            <a href="http://fab.com/sale/4520/">
                              MADONNA MDNA
                              <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">2</em>
                            </a>

                          </li>
                          <li>
                            <a href="http://fab.com/shops/40/">
                              Magazines
                              <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">34</em>
                            </a>

                          </li>
                          <li>
                            <a href="http://fab.com/shops/36/">
                              Makes You Smile
                              <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">198</em>
                            </a>

                          </li>
                          <li>
                            <a href="http://fab.com/shops/27/">
                              Men's Shop
                              <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">390</em>
                            </a>

                          </li>
                          <li>
                            <a href="http://fab.com/shops/41/">
                              Outdoor
                              <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">42</em>
                            </a>

                          </li>
                          <li>
                            <a href="http://fab.com/weekly-shops/pets/">
                              Pets
                              <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">299</em>
                            </a>

                          </li>
                          <li>
                            <a href="http://fab.com/shops/46/">
                              Rugs &amp; Textiles
                              <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">259</em>
                            </a>

                          </li>
                          <li>
                            <a href="http://fab.com/shops/44/">
                              Tabletop
                              <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">94</em>
                            </a>

                          </li>
                          <li>
                            <a href="http://fab.com/shops/38/">
                              Tech &amp; Gadgets
                              <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">102</em>
                            </a>

                          </li>
                          <li>
                            <a href="http://fab.com/weekly-shops/vintage/">
                              Vintage
                              <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">606</em>
                            </a>

                          </li>
                          <li>
                            <a href="http://fab.com/sale/3320/">
                              Warhol Pop
                              <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">136</em>
                            </a>

                          </li>
                          <li>
                            <a href="http://fab.com/shops/48/">
                              Women's Shop
                              <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">779</em>
                            </a>

                          </li>
                          <li>
                            <a href="http://fab.com/shops/35/">
                              Workspace
                              <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">69</em>
                            </a>

                          </li>
                      </ul>
                    </div>
                </div>
                <div class="row shopSecondMenu floatLeft">
                  <h2 style="padding-top: 2px;">BROWSE BY PRICE</h2>
                  <ul>
                      <li>
                        <a href="http://fab.com/shops/15/">
                          $1.00 - $49.99
                          <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">1698</em>
                        </a>
                      </li>
                      <li>
                        <a href="http://fab.com/shops/16/">
                          $50.00 - $99.99
                          <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">954</em>
                        </a>
                      </li>
                      <li>
                        <a href="http://fab.com/shops/17/">
                          $100.00 - $199.99
                          <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">294</em>
                        </a>
                      </li>
                      <li>
                        <a href="http://fab.com/shops/18/">
                          $200.00 - $499.99
                          <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">159</em>
                        </a>
                      </li>
                      <li>
                        <a href="http://fab.com/shops/19/">
                          $500.00 - $999.99
                          <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">145</em>
                        </a>
                      </li>
                      <li>
                        <a href="http://fab.com/shops/20/">
                          $1000.00+
                          <em style="text-align: right;font-size: 12px;font-style: normal;color: #ccc;float: right">171</em>
                        </a>
                      </li>
                  </ul>
                </div>
              </div>
              <div style="margin: 0px;" class="row" id="colorOption">
                <h2>BROWSE BY COLORS</h2>
                <ul>
                    <li>
                      <a href="http://fab.com/shops/4/" class="iColor red " title="Red">
                      </a>
                    </li>
                    <li>
                      <a href="http://fab.com/shops/11/" class="iColor pink " title="Pink">
                      </a>
                    </li>
                    <li>
                      <a href="http://fab.com/shops/14/" class="iColor purple " title="Purple">
                      </a>
                    </li>
                    <li>
                      <a href="http://fab.com/shops/8/" class="iColor blue " title="Blue">
                      </a>
                    </li>
                    <li>
                      <a href="http://fab.com/shops/9/" class="iColor green " title="Green">
                      </a>
                    </li>
                    <li>
                      <a href="http://fab.com/shops/10/" class="iColor yellow " title="Yellow">
                      </a>
                    </li>
                    <li>
                      <a href="http://fab.com/shops/13/" class="iColor orange " title="Orange">
                      </a>
                    </li>
                    <li>
                      <a href="http://fab.com/shops/3/" class="iColor brown " title="Brown">
                      </a>
                    </li>
                    <li>
                      <a href="http://fab.com/shops/6/" class="iColor gray " title="Gray">
                      </a>
                    </li>
                    <li>
                      <a href="http://fab.com/shops/1/" class="iColor black " title="Black">
                      </a>
                    </li>
                    <li>
                      <a href="http://fab.com/shops/2/" class="iColor white " title="White">
                      </a>
                    </li>
                    <li>
                      <a href="http://fab.com/shops/7/" class="iColor silver " title="Silver">
                          <span class="startForTags fabShopSprite"></span>
                      </a>
                    </li>
                    <li>
                      <a href="http://fab.com/shops/5/" class="iColor gold " title="Gold">
                          <span class="startForTags fabShopSprite"></span>
                      </a>
                    </li>
                    <li>
                      <a href="http://fab.com/shops/12/" class="iColor multi  fabShopSprite dIB " title="Multi-color">
                      </a>
                    </li>
                </ul>
                <div id="viewAllShops">
                  <a class="floatRight" href="http://fab.com/shops/">View All Shops &nbsp;&nbsp;&nbsp;<span class="round20 fabGrad viewMore"><span class="fabShopSprite gtIcon imgInfoArrow"></span></span></a>
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
          <a id="scMenu" href="http://fab.com/cart/" style="*height: 54px;	padding-top:20px;">
            <span class="userCartList textHide fabShopSprite" style="*margin-top:20px;">Cart List</span>
            <span class="crtLstNotification round7 hide">0</span>
          </a>
          <ul id="sCart" class="borderRB12">  <li class="cartEmpty">There are no items in your cart</li>
<li class="cartLast borderRB12">
  <span class="fabShopSprite back_icon floatLeft poRel" style="top:8px;margin-right: 8px">&lt;</span>
  <a class="cartLink floatLeft" href="http://fab.com/sale/">Continue Shopping</a>
</li></ul>
        </li>
      <li id="userSettingOpt">
        <a style="font-weight:bold;" href="javascript:void(0)" id="fabUserName" title="wcj343169893" alt="wcj343169893">wcj343169893<span class="fabShopSprite iRecentIcon"></span></a>
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