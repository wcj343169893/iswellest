<?php $naviTop ="<a href=\"".HTTP_HOME_PAGE_URL."/product/list/category1_id:0\" class='crumbList_all'>全部结果</a>";?>
<?php $naviStr = "";?>
<?php if (!empty($this->params['named']['category1_id']) && isset($categoryAllOptionList['level_1'][$this->params['named']['category1_id']])):?>
    <?php $naviStr .= "> <a href=\"".HTTP_HOME_PAGE_URL."/product/list/category1_id:{$this->params['named']['category1_id']}\" title=\"{$categoryAllOptionList[$this->params['named']['category1_id']]['category_title']}\">{$text->truncate($categoryAllOptionList[$this->params['named']['category1_id']]['category_title'],10, array('ending'=>'...'))}</a>";?>
<?php endif;?>
<?php if (!empty($this->params['named']['category2_id']) && isset($categoryAllOptionList['level_2'][$this->params['named']['category1_id']][$this->params['named']['category2_id']])):?>
    <?php $naviStr .= " > <a href=\"".HTTP_HOME_PAGE_URL."/product/list/category1_id:{$this->params['named']['category1_id']}/category2_id:{$this->params['named']['category2_id']}\" title=\"{$categoryAllOptionList[$this->params['named']['category2_id']]['category_title']}\">{$text->truncate($categoryAllOptionList[$this->params['named']['category2_id']]['category_title'],10, array('ending'=>'...'))}</a>";?>
<?php endif;?>
<?php if (!empty($this->params['named']['category3_id']) && isset($categoryAllOptionList['level_3'][$this->params['named']['category2_id']][$this->params['named']['category3_id']])):?>
    <?php $naviStr .= " > <a href=\"".HTTP_HOME_PAGE_URL."/product/list/category1_id:{$this->params['named']['category1_id']}/category2_id:{$this->params['named']['category2_id']}/category3_id:{$this->params['named']['category3_id']}\" title=\"{$categoryAllOptionList[$this->params['named']['category3_id']]['category_title']}\">{$text->truncate($categoryAllOptionList[$this->params['named']['category3_id']]['category_title'],10, array('ending'=>'...'))}</a>";?>
<?php endif;?>
<?php // elseif (!empty($this->params['named']['brand_id'])):?>
    <?php //$naviStr = "<a href=\"".HTTP_HOME_PAGE_URL."/product/list/brand_id:{$this->params['named']['brand_id']}\">{$brandList[$this->params['named']['brand_id']]['Brand']['brand_name']}</a>";?>
<?php //endif;?>
<?php echo !empty($naviStr)?$naviTop.$naviStr:$naviTop;?>