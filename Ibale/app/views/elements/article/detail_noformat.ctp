<?php $detail = $this->requestAction("/article/detail_noformat/title:".base64url_encode($articleTitle));?>
<h3><?php echo $appHtml->html($detail['Article']['title']);?></h3>
<div><?php echo $detail['Article']['content'];?></div>