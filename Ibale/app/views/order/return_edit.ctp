<?php $this->page_props['title'] = __('info.siteNameCN', true).' - 退货・换货申请';?>
<!-- main -->
<div class="titleBg m_10">
    <h3 class="mypageTitle"></h3>
</div>
<div class="mainCenter clearfix m10">
    <!-- 左侧个人信息导航栏 -->
    <?php echo $this->requestAction('/member/customer_center_navi/breadcrumb:order');?>
    <!-- 左侧个人信息导航栏 end -->
    <!-- 右侧详细信息 -->
    <div class=" mainRight">
        <!-- 送货地址 -->
        <h3 class="tableTop">
            <span class="tableTitle">退货・换货申请</span>
        </h3>
        <div class="clear"></div>
        <div class="personalInfo clearfix">
        <?php echo $appForm->create('Order', array('id'=>'OrderReturnForm', 'url'=>'/order/return_edit_comp'));?>
        <?php echo $appForm->hidden('order_no');?>
        <?php echo $appForm->hidden('record_num');?>
            <!-- 退换货申请 -->
            <ul class="addressInfo">
                <li><span class="tit">退货・换货理由：</span>
                <?php echo $appForm->select('return_reason', $msts['return_reason'], null, array('empty' => __('label.pleaseSelect', true)));?>
                <?php echo $appForm->error('Order.return_reason', '退货・换货理由');?>
                </li>
                <li><span class="tit txtTop">备注：</span> 
                <?php echo $appForm->textarea('comment', array('class'=>'textarea'));?>
                <?php echo $appForm->error('Order.comment', '备注');?>
                </li>
            </ul>
            <table cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <th>商品</th>
                        <th>名称</th>
                        <th>购物数量</th>
                        <th>退货</th>
                        <th>换货</th>
                    </tr>
            <?php foreach($productList as $key => $value):?>
                    <?php $picUrl = !empty($value['ProductPhoto'][0]['url'])?OMS_API_PHOTO_ROOT_URL.$value['ProductPhoto'][0]['url']:'/image/front/none_90.jpg';?>
                    <tr>
                        <td><img src="<?php echo $picUrl;?>" width="60" height="60" /></td>
                        <td>
                        <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/detail/product_cd:<?php echo $key;?>"><?php echo $value['Product']['product_name'];?></a>
                    <?php if ($appSession->check('Message.returnNumLargeThanEnabled'.$key)):?>
                        <br/><?php echo $appSession->flash('returnNumLargeThanEnabled'.$key);?>
                    <?php endif;?>
                        </td>
                        <td><?php echo $enableReturnList[$key];?></td>
                        <td>
                        <?php echo $appForm->text("Order.{$key}.return_number", array('class'=>'w_25', 'maxlength'=>'2', 'style'=>'ime-mode:disabled !important;', 'onkeydown'=>'javaScript:digitInput(this,event)'));?> 件
                        <?php echo $appForm->error("Order.{$key}.return_number", '退货');?>
                        </td>
                        <td>
                        <?php echo $appForm->text("Order.{$key}.exchange_number", array('class'=>'w_25', 'maxlength'=>'2', 'style'=>'ime-mode:disabled !important;', 'onkeydown'=>'javaScript:digitInput(this,event)'));?> 件
                        <?php echo $appForm->error("Order.{$key}.exchange_number", '换货');?>
                        </td>
                    </tr>
            <?php endforeach;?>
                </tbody>
            </table>
            
            <?php echo $appSession->flash('returnNumIsEmpty');?>
            <div class="center m_10">
                <button type="button" class="btnImg btnSubmit" onclick="javaScript:submitForm('OrderReturnForm');"></button>
            </div>
        <?php echo $appForm->end();?>
        </div>
    </div>
    <!-- 右侧详细信息 end -->
</div>
<!-- main end -->
