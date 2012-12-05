<?php
/**
 * ファイル名：sale_product.php
 * 概要：セール対象商品情報のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/02/17
 */
class SaleProduct extends AppModel {
    var $name       = 'SaleProduct';
    var $primaryKey = 'id';
    var $useTable   = 'sale_product';
//     var $belongsTo = array(
//     		'SaleRule' => array(
//     				'className'  => 'SaleRule',
//     				'foreignKey' => 'salerule_id',
//     				'conditions' => array('SaleRule.delete_datetime IS NULL'),
//     		),
//     );
//     var $hasMany   = array(
//     		'Product' => array(
//     				'className'  => 'Product',
//     				'foreignKey' => 'product_cd',
//     				'conditions' => array('Product.delete_datetime IS NULL'),
//     		),
//     );
    /**
     * セール対象商品情報をOMSから取得
     */
    function getListFromOMS($baseTime) {
        $methodPath = 'getsaleproduct';
        $params = array(
                        'base_datetime' => $baseTime,
        );
        return $this->requestOmsData($methodPath, $params);
    }

    function getListByProduct($productCds) {
        if (!is_array($productCds)) {
            $productCds = array($productCds);
        }
        $conditions = array(
                        'conditions' => array(
                                            'product_cd ' => $productCds,
                                            'delete_datetime IS NULL',
                        ),
                        'recursive'  => 0,
        );
        return $this->find('all', $conditions);
    }
    /**
     * @todo 根据sale规则查询产品
     * */
    function getListByRule($rules) {
        if (!is_array($rules)) {
            $rules = array($rules);
        }
        $conditions = array(
                        'conditions' => array(
                                            'salerule_id ' => $rules,
                                            'delete_datetime IS NULL',
                        ),
                        'recursive'  => 0,
        );
        return $this->find('all', $conditions);
    }
}
?>