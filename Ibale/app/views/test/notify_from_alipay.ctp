<form action="/order/notify_from_alipay" method="post" accept-charset="utf-8">
<div style="display:none;">
<input type="hidden" name="_method" value="POST" />
</div>
<input type="hidden" name="out_trade_no" value="<?php echo $this->data['out_trade_no'];?>" id="OrderOutTradeNo" />
<input type="hidden" name="trade_status" value="<?php echo $this->data['trade_status'];?>" id="OrderTradeStatus" />
<div class="submit"><input type="submit" value="submit" /></div>
</form>