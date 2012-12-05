    <!-- 礼物分类 -->
    <div class="mainLeft">
        <h3 class="giftTitle"></h3>
        <div class="listGifttop clearfix">
            <dl class="listGift">
                <dt>对象X场合</dt>
                <dd>
                <?php foreach($categoryProductOptions as $key => $value):?>
                    <?php $key = explode('X', $key);?>
                    <a href="<?php echo HTTP_HOME_PAGE_URL;?>/gift_top/list/gift_send_to:<?php echo $key[0];?>/gift_send_date:<?php echo $key[1];?>"><?php echo $value;?></a><br>
                <?php endforeach;?>
                </dd>
            </dl>
        <?php $sendToOptionList = array();?>
        <?php if (!empty($giftTypeList[GIFT_TYPE_SEND_TO])):?>
            <dl class="listGift">
                <dt>对象</dt>
            <?php foreach($giftTypeList[GIFT_TYPE_SEND_TO] as $key => $value):?>
                <?php $value = $value['GiftType'];?>
                <?php $sendToOptionList[$value['id']] = $value['name'];?>
                <dd>
                    <a href="<?php echo HTTP_HOME_PAGE_URL;?>/gift_top/list/gift_send_to:<?php echo $value['id']?>"><?php echo $value['name'];?></a>
                </dd>
            <?php endforeach;?>
            </dl>
        <?php endif;?>
        <?php $sendDateOptionList = array();?>
        <?php if (!empty($giftTypeList[GIFT_TYPE_SEND_DATE])):?>
            <dl class="listGift noneBorder">
                <dt>场合</dt>
            <?php foreach($giftTypeList[GIFT_TYPE_SEND_DATE] as $key => $value):?>
                <?php $value = $value['GiftType'];?>
                <?php $sendDateOptionList[$value['id']] = $value['name'];?>
                <dd>
                    <a href="<?php echo HTTP_HOME_PAGE_URL;?>/gift_top/list/gift_send_date:<?php echo $value['id']?>"><?php echo $value['name'];?></a>
                </dd>
            <?php endforeach;?>
            </dl>
        <?php endif;?>
        <?php $this->set('sendToOptionList', $sendToOptionList);?>
        <?php $this->set('sendDateOptionList', $sendDateOptionList);?>
        </div>
        <h3 class="giftTitle2 m_10"></h3>
        <div id="sendMail" class="listGifttop clearfix ">
    <?php if ($appSession->check('Front.GiftTop.SendMail.data')):?>
        <?php echo $this->requestAction('/gift_top/ajax_send_mail')?>
    <?php else:?>
        <?php echo $this->element('gift_top/send_mail');?>
    <?php endif;?>
        </div>
<?php if (!empty($this->data['GiftTop']['left_ad'])):?>
    <?php foreach($this->data['GiftTop']['left_ad'] as $key => $value):?>
        <div class="leftAd">
            <a href="<?php echo $value['url'];?>" title="<?php echo $value['comment'];?>"><img src="<?php echo $value['path'];?>" alt="<?php echo $value['comment'];?>"/></a>
        </div>
    <?php endforeach;?>
<?php endif;?>
    </div>
    <!-- 礼物分类 end -->
<script type="text/javascript">
function sendMailToTA() {
    $.get('/gift_top/ajax_send_mail/', {
            email:$("#GiftTopEmail").val(),
            gift_send_type:$("#GiftTopGiftSendType").val(),
            min_price:$("#GiftTopMinPrice").val(),
            max_price:$("#GiftTopMaxPrice").val()
        }, function(rs){
            if ($(rs).attr('id') == "loginPop") {
                $("#sendMail").append(rs);
            } else {
                $("#sendMail").html(rs);
            }
        }
    );
}

</script>