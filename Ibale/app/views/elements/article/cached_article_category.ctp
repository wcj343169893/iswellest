<?php $ret = $this->requestAction('/article/cached_article_category/category1_id:'.$detail['Article']['category1_id']);?>
    <!-- 所有文章分类 -->
    <div class="mainLeft">
        <h3 class="helpTitle">所有分类</h3>
        <div class="listHelp clearfix">
        <?php $index = 0;?>
        <?php foreach($ret['ChildArticleCategory'] as $key => $value):?>
            <dl class="listPersonal2 <?php if ($index == count($ret['ChildArticleCategory']) -1):?>noneBorder<?php endif;?>" >
                <dt><?php echo $value['name'];?></dt>
            <?php foreach($value['Article'] as $k => $v):?>
                <dd>
                    <a href="<?php echo HTTP_HOME_PAGE_URL;?>/article/detail/id:<?php echo $v['id'];?>"><?php echo $v['title'];?></a>
                </dd>
            <?php endforeach;?>
            </dl>
            <?php $index++;?>
        <?php endforeach;?>
        </div>
    </div>
    <!-- 所有文章分类 end -->