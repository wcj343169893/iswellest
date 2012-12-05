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
        <!-- 我的收藏 -->
        <h3 class="tableTop">
            <span class="tableTitle">发表评论</span>
        </h3>
        <?php echo $appForm->create('Estimation', array('id'=>'EstimationForm', 'url'=>'/estimation/add_comp'));?>
        <?php echo $appForm->hidden('order_no');?>
        <?php echo $appForm->hidden('record_num');?>
        <?php echo $appForm->hidden('product_cd');?>
        <?php echo $appForm->hidden('referer', array('value' => HTTPS_HOME_PAGE_URL.'/estimation/add/order_no:'.$this->data['Estimation']['order_no'].'/record_num:'.$this->data['Estimation']['record_num'].'/product_cd:'.$this->data['Estimation']['product_cd']));?>
        <?php echo $appForm->hidden('comp_url', array('value' => HTTPS_HOME_PAGE_URL.'/order/detail/order_no:'.$this->data['Estimation']['order_no']));?>
        <ul class="messageInfo">
            <li><span class="tit">
                <?php $picUrl = !empty($productInfo[$this->data['Estimation']['product_cd']]['ProductPhoto'][0]['url'])?OMS_API_PHOTO_ROOT_URL.$productInfo[$this->data['Estimation']['product_cd']]['ProductPhoto'][0]['url']:'/image/front/none_90.jpg';?>
                <img src="<?php echo $picUrl;?>" width="60" height="60" />
                </span>
                <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/detail/product_cd:<?php echo $this->data['Estimation']['product_cd'];?>" class="middel"><?php echo $productInfo[$this->data['Estimation']['product_cd']]['Product']['product_name'];?></a>
            </li>
            <li><span class="tit">购物时间：</span><?php echo substr($orderDatetime, 0, 19);?></li>
            <li><span class="tit">评论内容：</span> 
                <?php for($i=5;$i>=1;$i--):?>
                    <?php $types[$i] = $i;?> 
                <?php endfor;?> 
                <?php echo $appForm->select('point', $types, null, array('empty'=>false));?>
            </li>
            <li><span class="tit txtTop">评论内容：</span> 
                <?php echo $appForm->textarea('content', array('cols'=>'45', 'rows'=>'5'));?>
                <?php echo renderMsg($appSession->flash('estimationCreateFailurecontent'), '评价内容');?>
            </li>
            <li class="center"><button type="button" class="btnImg btnMes" onclick="javaScript:$('#EstimationForm').submit();"></button></li>
        </ul>
        <?php echo $appForm->end();?>
    </div>
    <!-- 右侧详细信息 end -->
</div>
<!-- main end -->
