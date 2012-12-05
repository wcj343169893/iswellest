<?php
/**
 * ファイル名：product_photo.php
 * 概要：商品の写真のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/01/12
 */
class ProductPhoto extends AppModel {
    var $name       = "ProductPhoto";
    var $useTable   = 'product_photo';
    var $primaryKey = 'id';

    /**
     * 商品画像情報をOMSから取得
     */
    function getListFromOMS($baseTime) {
        $methodPath = 'getproductphoto';
        $params = array(
                        'base_datetime' => $baseTime,
        );
        return $this->requestOmsData($methodPath, $params);
    }

    /**
     * Enter description here ...
     * @param unknown_type $productCds
     * @return multitype:
     */
    function getList($productCds, $photoType = PRODUCT_PHOTO_TYPE_PACKAGE) {
        $ret = array();
        $conditions = array(
                        'conditions'    => array(
                                                'ProductPhoto.product_cd ' => $productCds,
                                                'ProductPhoto.photo_type ' => $photoType,
                                                'ProductPhoto.delete_datetime IS NULL',
                        ),
                        'order'         => array('ProductPhoto.display_order' => 'ASC'),
                        'recursive'     => 0,
        );
        $recs = $this->find('all', $conditions);
        if (empty($recs)) {
            return $ret;
        }
        foreach($recs as $key => $value) {
            $ret[$value['ProductPhoto']['product_cd']][] = $value;
        }
        return $ret;
    }

    /* (non-PHPdoc)
     * @see Model::afterSave()
     */
    function afterSave($created) {
        parent::afterSave($created);
        clearCache('element_cache_toppage_cached_products','views', '');
    }
}
?>