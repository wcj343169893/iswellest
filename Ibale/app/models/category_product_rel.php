<?php
/**
 * ファイル名：category_product_rel.php
 * 概要：カテゴリと商品関連用のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/01/17
 */
class CategoryProductRel extends AppModel {
    var $name      = 'CategoryProductRel';
    var $useTable  = 'category_product_rel';
    var $belongsTo = array(
                        'Category' => array(
                                            'className'  => 'Category',
                                            'foreignKey' => 'category_id',
                                            'conditions' => array('Category.delete_datetime IS NULL'),
                        ),
    );
    var $hasMany   = array(
                        'Product' => array(
                                            'className'  => 'Product',
                                            'foreignKey' => 'product_cd',
                                            'conditions' => array('Product.delete_datetime IS NULL'),
                        ),
    );

    /**
     * カテゴリ関連商品情報をOMSから取得
     */
    function getListFromOMS($baseTime) {
        $methodPath = 'getcategoryproductrel';
        $params = array(
                        'base_datetime' => $baseTime,
        );
        return $this->requestOmsData($methodPath, $params);
    }

    function getCategoryByProductCd($productCds, $recursive = 0) {
        $ret = array();
        if (!is_array($productCds)) {
            $productCds = array($productCds);
        }
        $conditions = array(
                        'conditions'    => array(
                                                'CategoryProductRel.product_cd ' => $productCds,
                                                'CategoryProductRel.delete_datetime IS NULL',
                        ),
                        'recursive'     => $recursive,
        );
        $recs = $this->find('all', $conditions);
        foreach($recs as $key => $value) {
            $ret[$value['CategoryProductRel']['product_cd']][] = $value;
        }
        return $ret;
    }

    /**
     * カテゴリIDより商品情報を取得
     * @param unknown_type $categoryIds
     * @param unknown_type $productCds
     * @return Ambigous <multitype:, unknown>
     */
    function getProductByCategoryId($categoryIds, $productCds = array()) {
        $ret = array();
        $conditions = array(
                            'conditions'    => array(
                                                    'CategoryProductRel.category_id ' => $categoryIds,
                                                    'CategoryProductRel.delete_datetime IS NULL',
                            ),
                            'joins'         => array(
                                                    array(
                                                        'table'     => 'product',
                                                        'alias'     => 'Product',
                                                        'type'      => 'inner',
                                                        'conditions'=>array(
                                                                        "Product.product_cd = CategoryProductRel.product_cd",
                                                                        "Product.delete_datetime IS NULL",
                                                                        "Product.pub_flg ='".ACTIVE_FLG_TRUE."'",
                                                                        "Product.pub_start_date <='NOW()'",
                                                                        "(Product.pub_end_date   >='NOW()' OR Product.pub_end_date IS NULL)",
                                                                        "Product.sales_status NOT IN ('".PRODUCT_SALES_STATUS_END_SELLING."','".PRODUCT_SALES_STATUS_STOP_SELLING."')",
                                                                        'Product.delete_datetime IS NULL',
                                                        ),
                                                    ),
                            ),
                            'recursive'     => -1,
        );
        if (!empty($productCds)) {
            $conditions['conditions'][] = array('NOT' => array('CategoryProductRel.product_cd ' => $productCds));
        }
        $recs = $this->find('all', $conditions);
        foreach($recs as $key => $value) {
            $ret[$value['CategoryProductRel']['product_cd']][] = $value;
        }
        return $ret;
    }
}
?>