<?php
/**
 * ファイル名：brand.php
 * 概要：ブランド用のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/01/17
 */
class Brand extends AppModel {
    var $name       = 'Brand';
    var $primaryKey = 'id';
    var $useTable   = 'brand';
    var $hasMany    = array(
                        'BrandPhoto' => array(
                                            'className'  => 'BrandPhoto',
                                            'foreignKey' => 'brand_id',
                                            'conditions' => array('BrandPhoto.delete_datetime IS NULL'),
                        ),
    );

    /**
     * ブランド情報をOMSから取得
     */
    function getListFromOMS($baseTime) {
        $methodPath = 'getbrand';
        $params = array(
                        'base_datetime' => $baseTime,
        );
        return $this->requestOmsData($methodPath, $params);
    }

    /**
     * ヘッダーリストを取得
     */
    function getList($brandIds = null, $recursive = 0) {
        $ret = array();
        $conditions = array(
                        'conditions'    => array(
                                            'Brand.delete_datetime IS NULL',
                        ),
                        'order'         => array(
                                            'Brand.update_datetime'  => 'DESC',
                        ),
                        'recursive'     => $recursive,
        );

        if (!empty($brandIds)) {
            $conditions['conditions'][] = array('Brand.id ' => $brandIds);
        }

        $recs = $this->find('all', $conditions);
        foreach($recs as $key => $value) {
            $ret[$value['Brand']['id']] = $value;
        }
        return $ret;
    }
}

?>
