<?php
/**
 * ファイル名：product_bookmark.php
 * 概要：お気商品情報のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/01/20
 */
class ProductBookmark extends AppModel {
    var $name       = 'ProductBookmark';
    var $primaryKey = 'id';
    var $useTable   = 'product_bookmark';
    var $belongsTo  = array(
                        'Product' => array(
                                            'className'  => 'Product',
                                            'foreignKey' => 'product_cd',
                                            'conditions' => array('Product.delete_datetime IS NULL'),
                        ),
    );

    /**
     * 会員IDよりお気商品情報を取得
     * @param unknown_type $customerId
     * @return Ambigous <multitype:, NULL, boolean, mixed>
     */
    function getInfoByCustomerId($customerId, $productCd = null) {
        $conditions = array(
                        'conditions'    => array(
                                                'ProductBookmark.customer_id ' => $customerId,
                                                'ProductBookmark.delete_datetime IS NULL',
                        ),
                        'recursive'     => 0,
        );
        if (!empty($productCd)) {
            $conditions['conditions']['ProductBookmark.product_cd ='] = $productCd;
        }
        $recs = $this->find('all', $conditions);
        return $recs;
    }

    function getListConditionsByCustomerId($customerId, $limit = FRONT_PAGE_LIMIT_COMM, $recursive = 0) {
        $conditions = array(
                        'conditions'    => array(
                                                'ProductBookmark.customer_id ' => $customerId,
                                                'ProductBookmark.delete_datetime IS NULL',
                        ),
                        'order'         => array(
                                                'ProductBookmark.update_datetime' => 'ASC',
                        ),
                        'limit'         => $limit,
                        'recursive'     => $recursive,
        );
        return $conditions;
    }

    /**
     * 会員IDよりお気に入りリストを取得
     * @param unknown_type $customerId
     * @param unknown_type $productCd
     * @param unknown_type $limit
     * @param unknown_type $recursive
     * @return Ambigous <multitype:, NULL, boolean, mixed>
     */
    function getListByCustomerId($customerId, $limit = FRONT_PAGE_LIMIT_COMM, $recursive = 0) {
        $conditions = $this->getListConditionsByCustomerId($customerId, $limit, $recursive);
        $recs = $this->find('all', $conditions);
        return $recs;
    }
}
?>