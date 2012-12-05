<?php
/**
 * ファイル名：product_desc.php
 * 概要：商品説明情報のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/01/12
 */
class ProductDesc extends AppModel {
    var $name       = "ProductDesc";
    var $useTable   = 'product_desc';
    var $primaryKey = 'id';

    /**
     * 商品情報をOMSから取得
     */
    function getListFromOMS($baseTime) {
        $methodPath = 'getproductdesc';
        $params = array(
                        'base_datetime' => $baseTime,
        );
        return $this->requestOmsData($methodPath, $params);
    }

    /**
     * 商品番号より商品説明を取得
     * @param unknown_type $productCds
     * @return multitype:
     */
    function getList($productCd) {
        $conditions = array(
                        'conditions'    => array(
                                                'ProductDesc.product_cd =' => $productCd,
                                                'ProductDesc.delete_datetime IS NULL',
                        ),
                        'order'         => array('ProductDesc.display_order' => 'ASC'),
                        'recursive'     => 0,
        );
        $recs = $this->find('all', $conditions);
        return $recs;
    }

    /* (non-PHPdoc)
     * @see Model::afterSave()
     */
    function afterSave($created) {
        parent::afterSave($created);
        //clearCache('element_cache_toppage_cached_products','views', '');
    }
}
?>