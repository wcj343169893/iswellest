<?php $dataList = $this->requestAction('/article/cached_footer_help');?>
<?php $index = 0;?>
<?php foreach($dataList as $key => $value):?>
    <?php if ($index >= 5):break;endif;?>
        <dl <?php if ($index+1 == count($dataList)):?>class="noneBorder"<?php endif;?>>
            <dt class="service-icon"><?php echo $value[0]['ArticleCategory']['name'];?></dt>
        <?php if ($value[0]['ArticleCategory']['id'] == 4):?>
            <?php /**
            <dd>
                <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/order/list/">查询订单</a>
            </dd>
            */?>
        <?php elseif ($value[0]['ArticleCategory']['id'] == 6):?>
            <dd>
                <a href="<?php echo HTTPS_HOME_PAGE_URL;?>/member/forget_password">忘记密码</a>
            </dd>
        <?php endif;?>
        <?php foreach($value as $k => $v):?>
            <dd>
                <a href="<?php echo HTTP_HOME_PAGE_URL;?>/article/detail/id:<?php echo $v['Article']['id'];?>"><?php echo $appHtml->html($v['Article']['title']);?></a>
            </dd>
        <?php endforeach;?>
        </dl>
    <?php $index++;?>
<?php endforeach;?>