<?php //$keywords = $this->requestAction('/category_top/cached_keywords/id:'.$this->params['named']['id']);?>
<?php $keywords = explode(' ', $this->data['GiftTop']['keywords']);?>
<?php if (!empty($keywords)):?>
    <?php foreach($keywords as $value):?>
        <a href="<?php echo HTTP_HOME_PAGE_URL;?>/gift_top/list/keywords:<?php echo base64url_encode($value);?>"><?php echo $value;?></a>
    <?php endforeach;?>
<?php endif;?>