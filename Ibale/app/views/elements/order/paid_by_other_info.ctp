<div id="paidByOtherPop" class="popup display-none z-index-top">
    <h6 class="popupTop">
        <span id="closePop" class="close cursor_pointer" onclick="javaScript:closePaidByOtherPop();" style="top: 5px;">关闭</span> 
        <span class="closeImg"><a href="javaScript:void(0);" onclick="javaScript:closePaidByOtherPop();return false;"><img src="/image/front/close.gif"> </a> </span>
    </h6>
    <div class="popupMain">
        <p class="l_70">
            <span class="w_90">支付者E-Mail:</span>
            <span class="w_210"><?php echo $appHtml->html($orderPayInfo['OrderPay']['pay_person_email']);?></span>
        </p>
        <p class="l_70">
            <span class="w_90" style="vertical-align: top;">留言:</span>
            <span class="w_210"><?php echo $appHtml->html($orderPayInfo['OrderPay']['message_to_pay_person']);?> </span>
        </p>
        <p>
            <button type="button" class="btnImg btnConfirm" onclick="javaScript:closePaidByOtherPop()"></button>
        </p>
    </div>
</div>
<script type="text/javascript">
function showPaidByOtherPop() {
    showPop('paidByOtherPop');
}
function closePaidByOtherPop() {
    $("#paidByOtherPop").hide();
    $("#blockOtherOperation").hide()
}
</script>