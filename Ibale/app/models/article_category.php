<?php
/**
 * ファイル名：article_category.php
 * 概要：記事種類用のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/01/17
 */
class ArticleCategory extends AppModel {
    var $name      = 'ArticleCategory';
    var $useTable  = 'article_category';
    var $belongsTo = array(
                        'ParentArticleCategory' => array(
                                            'className' => 'ArticleCategory',
                                            'foreignKey' => 'parent_id',
                                            'conditions' => array('ParentArticleCategory.delete_datetime IS NULL'),
                        ),
    );

    var $validate  = array(
                        'name' => array(
                                        array('rule' => array('maxLength', 50)),
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'order_number' => array(
                                        array('rule' => array('numeric')),
                                        array('rule' => array('range', 0, 1000)),
                        ),
    );
    /**
     * カテゴリのリストを取得
     * @return unknown
     */
    function getList() {
        $ret = array();
        $sql = "";
        $conditions = array(
                        'fields'        => array(
                                            "ArticleCategory.*",
                                            "ChildCategory.id",
                                            "ChildCategory.name",
                                            "ChildCategory.order_number",
                                            "(SELECT COUNT(id) FROM ec_article WHERE del_flg='".ACTIVE_FLG_FALSE."' AND category_id=\"ChildCategory\".\"id\") AS \"ChildCategory__article_count\"",
                        ),
                        'conditions'    => array(
                                            'ArticleCategory.parent_id ='   => ACTIVE_FLG_FALSE,
                                            'ArticleCategory.del_flg ='     => ACTIVE_FLG_FALSE,
                        ),
                        'order'         => array(
                                            'ArticleCategory.order_number'  => 'ASC',
                                            'ChildCategory.order_number'  => 'ASC',
                        ),
                        'joins'            => array(
                                                array(
                                                    'table'      => 'article_category',
                                                    'alias'      => 'ChildCategory',
                                                    'type'       => 'Left',
                                                    'conditions' => array(
                                                                        'ArticleCategory.id=ChildCategory.parent_id',
                                                                        'ChildCategory.del_flg=\''.  ACTIVE_FLG_FALSE.'\'',
                                                    ),
                                                )
                        ),
                        'recursive'     => 0,
        );
        $recs = $this->find('all', $conditions);
        if (empty($recs)) {
            return $ret;
        }

        foreach($recs as $key => $value) {
            $parentCategoryId = $value['ArticleCategory']['id'];
            if (empty($ret[$parentCategoryId])) {
                $ret[$parentCategoryId]['ArticleCategory'] = $value['ArticleCategory'];
                $ret[$parentCategoryId]['ArticleCategory']['article_count'] = 0;
            }
            if (empty($value['ChildCategory']['id'])) {
                continue;
            }
            $ret[$parentCategoryId]['ArticleCategory']['article_count'] += $value['ChildCategory']['article_count'];
            $ret[$parentCategoryId]['ChildCategory'][] = $value['ChildCategory'];
        }
        //usort($ret, "cmpOrderNumber");
        return $ret;
    }

    /**
     * プルダウンーボタン用の親カテゴリのリストを取得
     */
    function getCategory1OptionList() {
        $ret = array();
        $conditions = array(
                        'conditions'    => array(
                                            'ArticleCategory.parent_id ='   => ACTIVE_FLG_FALSE,
                                            'ArticleCategory.del_flg ='     => ACTIVE_FLG_FALSE,
                        ),
                        'order'         => array(
                                            'ArticleCategory.order_number'  => 'ASC',
                        ),
                        'recursive'     => -1,
        );
        $recs = $this->find('all', $conditions);
        if (empty($recs)) {
            return $ret;
        }
        foreach($recs as $key => $value) {
            $value = $value['ArticleCategory'];
            $ret[$value['id']] = $value['name'];
        }
        return $ret;
    }

    /**
     * プルダウンーボタン用の子カテゴリのリストを取得
     */
    function getCategory2OptionList($parentId) {
        $ret = array();
        $conditions = array(
                        'conditions'    => array(
                                            'ArticleCategory.parent_id ='   => $parentId,
                                            'ArticleCategory.del_flg ='     => ACTIVE_FLG_FALSE,
                        ),
                        'order'         => array(
                                            'ArticleCategory.order_number'  => 'ASC',
                        ),
                        'recursive'     => -1,
        );
        $recs = $this->find('all', $conditions);
        if (empty($recs)) {
            return $ret;
        }
        foreach($recs as $key => $value) {
            $value = $value['ArticleCategory'];
            $ret[$value['id']] = $value['name'];
        }
        return $ret;
    }
    
    /**
     * カテゴリ名が存在かどうかことをチェック
     * @param unknown_type $id
     * @param unknown_type $name
     * @param unknown_type $parentId
     * @return boolean
     */
    function isExists($data) {
        if (empty($data['associateKeyValue'])) {
            $data['associateKeyValue'] = '0';
        }
        $ret = array();
        $conditions = array(
                        'conditions'    => array(
                                            'ArticleCategory.parent_id ='   => $data['associateKeyValue'],
                                            'ArticleCategory.name ='        => $data['fieldValue'],
                                            'ArticleCategory.del_flg ='     => ACTIVE_FLG_FALSE,
                        ),
                        'order'         => array(
                                            'ArticleCategory.order_number'  => 'ASC',
                        ),
                        'recursive'     => -1,
        );
        if (!empty($data['pKeyValue'])) {
            $conditions['conditions']['ArticleCategory.id <>'] = $data['pKeyValue'];
        }
        $recs = $this->find('all', $conditions);
        if (empty($recs)) {
            return false;
        }
        return true;
    }

    /**
     * 順番が存在かどうかことをチェック
     * @param unknown_type $parentId
     * @return number
     */
    function getMaxOrderNumber($parentId = '0') {
        $conditions = array(
                        'fields'     => array(
                                        'Max(order_number) AS max_order_number',
                        ),
                        'conditions' => array(
                                        'ArticleCategory.parent_id =' => $parentId,
                                        'ArticleCategory.del_flg'     => ACTIVE_FLG_FALSE,
                        ),
                        'recursive'  => -1,
        );
        $rec = $this->find('first', $conditions);
        if (!empty($rec[0]['max_order_number'])) {
            return $rec[0]['max_order_number'];
        }
        return 0;
    }

    /* (non-PHPdoc)
     * @see Model::afterSave()
     */
    function afterSave($created) {
        parent::afterSave($created);
        clearCache('element_cache_article_footer_help','views', '');
        clearCache('article_cached_article_category','views', '');
    }
}
?>