<?php
/**
 * ファイル名：article.php
 * 概要：記事用のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/01/12
 */
class Article extends AppModel {
    var $name      = 'Article';
    var $useTable  = 'article';
    var $belongsTo = array(
                        'ArticleCategory' => array(
                                            'className' => 'ArticleCategory',
                                            'foreignKey' => 'category_id',
                                            'conditions' => array('ArticleCategory.delete_datetime IS NULL'),
                        ),
    );

    var $validate = array(
                        'title' => array(
                                        array('rule' => array('maxLength', 50)),
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'category2_id' => array(
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'content' => array(
                                        //array('rule' => array('maxLength', 500)),
                                        array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
                        'order_number' => array(
                                        array('rule' => array('numeric')),
                                        array('rule' => array('range', 0, 1000)),
                        ),
    );

    /**
     * ヘッダーリストを取得(廃止)
     */
    function ___getListByCategory($categoryId) {
        $ret = array();
        $conditions = array(
                        'fields'        => array(
                                            'Article.*',
                                            'ArticleCategory.name',
                                            'ParentArticleCategory.name',
                        ),
                        'conditions'    => array(
                                            'Article.category_id =' => $categoryId,
                                            'Article.del_flg ='     => ACTIVE_FLG_FALSE,
                        ),
                        'joins'         => array(
                                                array(
                                                    'table'      => 'article_category',
                                                    'alias'      => 'ArticleCategory',
                                                    'type'       => 'Left',
                                                    'conditions' => array(
                                                                        'ArticleCategory.id=Article.category_id',
                                                                        'ArticleCategory.del_flg=\''.  ACTIVE_FLG_FALSE.'\'',
                                                    ),
                                                ),
                                                array(
                                                    'table'      => 'article_category',
                                                    'alias'      => 'ParentArticleCategory',
                                                    'type'       => 'Left',
                                                    'conditions' => array(
                                                                        'ArticleCategory.parent_id=ParentArticleCategory.id',
                                                                        'ParentArticleCategory.del_flg=\''.  ACTIVE_FLG_FALSE.'\'',
                                                    ),
                                                )
                        ),
                        'order'         => array(
                                            'ParentArticleCategory.order_number' => 'ASC',
                                            'ArticleCategory.order_number'       => 'ASC',
                                            'Article.order_number'               => 'ASC',
                        ),
                        'recursive'     => -1,
        );
        $recs = $this->find('all', $conditions);
        return $recs;
    }

    /**
     * 親カテゴリIDより記事を取得
     * @param unknown_type $parentCategoryId
     * @return Ambigous <multitype:, mixed>
     */
    function getListByParentCategoryId($parentCategoryId) {
        $ret = array();
        $sql = "SELECT
                    Article.id,
                    Article.title,
                    ParentArticleCategory.id AS category1_id,
                    ParentArticleCategory.name AS category1_name,
                    ArticleCategory.id AS category2_id,
                    ArticleCategory.name AS category2_name
                FROM
                    {$this->tablePrefix}article_category ParentArticleCategory 
                    ,{$this->tablePrefix}article_category ArticleCategory 
                    ,{$this->tablePrefix}article Article
                WHERE 1=1
                    AND ParentArticleCategory.id = {$parentCategoryId}
                    AND ArticleCategory.parent_id=ParentArticleCategory.id 
                    AND ArticleCategory.del_flg='".ACTIVE_FLG_FALSE."'
                    AND Article.category_id=ArticleCategory.id 
                    AND Article.del_flg='".ACTIVE_FLG_FALSE."'
                ORDER BY
                    ParentArticleCategory.order_number ASC,
                    ArticleCategory.order_number ASC,
                    Article.order_number ASC ";
        $recs = $this->query($sql);
        if (empty($recs)) {
            return $ret;
        }

        foreach($recs as $key => $value) {
            $value = $value[0];
            $ret['ParentArticleCategory']['id'] = $value['category1_id'];
            $ret['ParentArticleCategory']['name'] = $value['category1_name'];
            $ret['ChildArticleCategory'][$value['category2_id']]['name'] = $value['category2_name'];
            $ret['ChildArticleCategory'][$value['category2_id']]['Article'][] = $value;
        }

        return $ret;
    }

    /**
     * 記事情報を取得
     * @param unknown_type $id
     * @param unknown_type $title
     * @return multitype:|unknown
     */
    function getInfo($id = '', $title = '') {
        $ret = array();
        $conditions = array(
                        'conditions'    => array(
                                            'Article.del_flg ='     => ACTIVE_FLG_FALSE,
                        ),
                        'recursive'     => 2,
        );
        if (!empty($id)) {
            $conditions['conditions']['Article.id ='] = $id;
        }
        if (!empty($title)) {
            $conditions['conditions']['Article.title ='] = $title;
        }
        $rec = $this->find('first', $conditions);

        if (empty($rec)) {
            return $ret;
        }

        $ret['Article']                   = $rec['Article'];
        $ret['Article']['category1_id']   = $rec['ArticleCategory']['ParentArticleCategory']['id'];
        $ret['Article']['category1_name'] = $rec['ArticleCategory']['ParentArticleCategory']['name'];
        $ret['Article']['category2_id']   = $rec['ArticleCategory']['id'];
        $ret['Article']['category2_name'] = $rec['ArticleCategory']['name'];
        return $ret;
    }

    /**
     * 順番が存在かどうかことをチェック
     * @return boolean
     */
    function getMaxOrderNumber() {
        $conditions = array(
                        'fields'     => array(
                                        'Max(Article.order_number) AS max_order_number',
                        ),
                        'conditions' => array(
                                        'Article.del_flg'        => ACTIVE_FLG_FALSE,
                        ),
                        'recursive'  => 0,
        );
        $rec = $this->find('first', $conditions);
        if (!empty($rec[0]['max_order_number'])) {
            return $rec[0]['max_order_number'];
        }
        return 0;
    }

    /**
     * 記事情報の検索条件を作成
     * @param unknown_type $conditions
     */
    function loadArticleSearchDefaultConditions(&$conditions) {
        $conditions = array(
                        'fields'        => array(
                                                'Article.*',
                                                'ArticleCategory.id',
                                                'ArticleCategory.name',
                                                'ParentArticleCategory.id',
                                                'ParentArticleCategory.name',
                        ),
                        'conditions'    => array(
                                                'Article.del_flg ='     => ACTIVE_FLG_FALSE,
                        ),
                        'joins'         => array(
                                                array(
                                                    'table'      => 'article_category',
                                                    'alias'      => 'ArticleCategory',
                                                    'type'       => 'Left',
                                                    'conditions' => array(
                                                                        'ArticleCategory.id=Article.category_id',
                                                                        'ArticleCategory.del_flg=\''.  ACTIVE_FLG_FALSE.'\'',
                                                    ),
                                                ),
                                                array(
                                                    'table'      => 'article_category',
                                                    'alias'      => 'ParentArticleCategory',
                                                    'type'       => 'Left',
                                                    'conditions' => array(
                                                                        'ArticleCategory.parent_id=ParentArticleCategory.id',
                                                                        'ParentArticleCategory.del_flg=\''.  ACTIVE_FLG_FALSE.'\'',
                                                    ),
                                                )
                        ),
                        'order'         => array(
                                            'ParentArticleCategory.order_number' => 'ASC',
                                            'ArticleCategory.order_number'       => 'ASC',
                                            'Article.order_number'               => 'ASC',
                        ),
                        'recursive'     => -1,
        );
    }

    /* (non-PHPdoc)
     * @see Model::afterSave()
     */
    function afterSave($created) {
        parent::afterSave($created);
        clearCache('element_cache_article_footer_help','views', '');
        clearCache('article_cached_article_category','views', '');
        clearCache('article_detail_noformat','views', '');
    }

}
?>