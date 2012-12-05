<?php $keywords = $this->requestAction('/toppage/cached_keywords');?>
<?php if (!empty($keywords)):?>
    <?php foreach($keywords as $value):?>
        <a href="<?php echo HTTP_HOME_PAGE_URL;?>/product/list/keywords:<?php echo base64url_encode($value);?>"><?php echo $value;?></a>
    <?php endforeach;?>
<?php endif;?>