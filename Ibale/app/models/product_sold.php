<?php
/**
 * ファイル名：product_sold.php
 * 概要：商品購入実績情報のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/02/15
 */
class ProductSold extends AppModel {
    var $name       = 'ProductSold';
    var $primaryKey = 'id';
    var $useTable   = 'product_sold';

    /* (non-PHPdoc)
     * @see Model::save()
     */
    function save($data = null, $validate = true, $fieldList = array()) {
        $conditions = array(
                            'conditions' => array(
                                        'product_cd =' => $data['product_cd'],
                                        'del_flg ='    => ACTIVE_FLG_FALSE,
                            ),
                            'recursive'  => -1,
        );
        $rec = $this->find('first', $conditions);
        if (!empty($rec)) {
            $data['id']           = $rec['ProductSold']['id'];
            $data['sold_number'] += $rec['ProductSold']['sold_number'];
        } else {
            $data['create_datetime'] = 'NOW()';
        }
        $data['update_datetime'] = 'NOW()';
        return parent::save($data, $validate, $fieldList);
    }

    /**
     * 売れている順より商品情報を取得
     * @param unknown_type $ret
     */
    function getProductCdOrderBySold($productCds = array()) {
        $ret = array();
        $conditions = array(
                            'conditions' => array(
                                            'ProductSold.del_flg ='    => ACTIVE_FLG_FALSE,
                            ),
                            'joins'         => array(
                                                    array(
                                                        'table'     => 'product',
                                                        'alias'     => 'Product',
                                                        'type'      => 'inner',
                                                        'conditions'=>array(
                                                                        "Product.product_cd = ProductSold.product_cd",
                                                                        "Product.delete_datetime IS NULL",
                                                                        "Product.pub_flg ='".ACTIVE_FLG_TRUE."'",
                                                                        "Product.pub_start_date <='NOW()'",
                                                                        "(Product.pub_end_date   >='NOW()' OR Product.pub_end_date IS NULL)",
                                                                        "Product.sales_status NOT IN ('".PRODUCT_SALES_STATUS_END_SELLING."','".PRODUCT_SALES_STATUS_STOP_SELLING."')",
                                                                        'Product.delete_datetime IS NULL',
                                                        ),
                                                    ),
                            ),
                            'order'      => array(
                                            'ProductSold.sold_number'    => 'DESC',
                            ),
                            'recursive'  => -1,
        );
        if (!empty($productCds)) {
            $conditions['conditions'][] = array('NOT' => array('ProductSold.product_cd ' => $productCds));
        }
        $recs = $this->find('all', $conditions);
        foreach($recs as $key => $value) {
            $ret[] = $value['ProductSold']['product_cd'];
        }

        return $ret;
    }
}