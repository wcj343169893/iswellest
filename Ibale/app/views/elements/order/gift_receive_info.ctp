<div id="giftReceiveInfoPop" class="popup display-none z-index-top">
    <h6 class="popupTop">
        <span id="closePop" class="close cursor_pointer" onclick="javaScript:closeGiftReceiveInfoPop();" style="top: 5px;">关闭</span> 
        <span class="closeImg"><a href="javaScript:void(0);" onclick="javaScript:closeGiftReceiveInfoPop();return false;"><img src="/image/front/close.gif"> </a> </span>
    </h6>
    <div class="popupMain">
        <p class="l_70">
            <span class="w_90">TA的邮箱地址:</span>
            <span class="w_210"><?php echo $appHtml->html($orderPayInfo['OrderPay']['receive_person_email']);?></span>
        </p>
        <p class="l_70">
            <span class="w_90">TA的姓名:</span>
            <span class="w_210"><?php echo $appHtml->html($orderPayInfo['OrderPay']['receive_person_name']);?> </span>
        </p>
        <p>
            <button type="button" class="btnImg btnConfirm" onclick="javaScript:closeGiftReceiveInfoPop()"></button>
        </p>
    </div>
</div>
<script type="text/javascript">
function showGiftReceiveInfoPop() {
    showPop('giftReceiveInfoPop');
}
function closeGiftReceiveInfoPop() {
    $("#giftReceiveInfoPop").hide();
    $("#blockOtherOperation").hide()
}
</script>