<?php 
/**
 * ファイル名：page_setting.php
 * 概要：ページ設定用の関数のコンポーネント
 * 
 * 作成者：shilei
 * 作成日時：2012/02/06
 */
class PageSettingComponent extends Object{
    var $controller = null;

    /**
     * Initialize component
     *
     * @param object $controller Instantiating controller
     * @access public
     */
    function initialize(&$controller, $settings = array()) {
        $this->controller =& $controller;
    }

    /**
     * 検証種類より商品番号をチェック
     * @param unknown_type $type
     * @param unknown_type $index
     * @param unknown_type $errMsg
     * @return boolean
     */
    function checkProductCdByType($type, $index = null, $denyEmpty = false, &$errMsg) {
        $valid = true;

        $validData = array();
        if ($type == 'new_product' || $type == 'hot_product') {
            $category1Id = null;//$this->controller->data[$this->controller->name]['category1_id'];
            $category2Id = null;//$this->controller->data[$this->controller->name]['category2_id'];
            $category3Id = null;
            $validData   = $this->controller->data[$this->controller->name][$type];
        } elseif ($type == 'category_product' && ($this->controller->name == 'CategoryTop' || $this->controller->name == 'Toppage')) {
            $category1Id = null;//$this->controller->data[$this->controller->name]['category_product'][$index]['category1_id'];
            $category2Id = null;//$this->controller->data[$this->controller->name]['category_product'][$index]['category2_id'];
            $category3Id = null;//$this->controller->data[$this->controller->name]['category_product'][$index]['category3_id'];
            $validData   = $this->controller->data[$this->controller->name]['category_product'][$index]['product'];
        } else if ($type == 'category_product' && $this->controller->name == 'GiftTop'){
            $category1Id = null;
            $category2Id = null;
            $category3Id = null;
            $validData   = $this->controller->data[$this->controller->name]['category_product'][$index]['product'];
        } else {
            $category1Id = null;
            $category2Id = null;
            $category3Id = null;
            $validData   = $this->controller->data[$this->controller->name][$type];
        }
        $uniqueProductCds = array();
        foreach($validData as $key => $value) {
            if (empty($value['product_cd']) && !$denyEmpty) {
                continue;
            } elseif(empty($value['product_cd'])) {
                $valid &= false;
                $errMsg[$key]['product_cd'] = __('error.required', true);
                continue;
            }
            if (!empty($value['product_cd']) && !in_array($value['product_cd'], $uniqueProductCds)) {
                $uniqueProductCds[] = $value['product_cd'];
            } else {//商品番号が重複の場合
                $this->controller->Session->setFlash(__('error.productCdIsDuplicate', true), 'default', null, removeUnderLineFromWords($type).'ProductCdIsDuplicate'.$index.'_'.$key);
                $valid &= false;
                continue;
            }
            $errMsg[$key] = $this->controller->Product->invalidFields(array(), $value);
            if (empty($errMsg[$key]) 
                    && !$this->__checkProductCd($type, $value['product_cd'], $category1Id, $category2Id, $category3Id, $errMsg[$key]['product_cd'])) {
                 $valid &= false;
            }
        }
        return $valid;
    }
    /**
     * ページに設定した商品番号の配列を作成
     * @param unknown_type $type
     * @param unknown_type $productCds
     */
    function loadProductCdsByType($type, &$productCds) {
        if ($type == 'category_product' && !empty($this->controller->data[$this->controller->name]['category_product'])) {
            foreach($this->controller->data[$this->controller->name][$type] as $key => $value) {
                foreach($value['product'] as $k => $v) {
                    $productCds[] = $v['product_cd'];
                }
            }
            return;
        }
        if (empty($this->controller->data[$this->controller->name][$type])) {
            return;
        }
        foreach($this->controller->data[$this->controller->name][$type] as $key => $value) {
            if (empty($value['product_cd'])) {
                continue;
            }
            $productCds[] = $value['product_cd'];
        }
        
    }

    /**
     * ページに設定した商品情報を設定
     * @param unknown_type $type
     * @param unknown_type $productInfos
     */
    function loadProductInfosByType($type, &$productInfos) {
        if ($type == 'category_product' && !empty($this->controller->data[$this->controller->name]['category_product'])) {
            foreach($this->controller->data[$this->controller->name][$type] as $key => $value) {
                foreach($value['product'] as $k => $v) {
                    if (empty($v['product_cd']) || empty($productInfos[$v['product_cd']])) {
                        continue;
                    }
                    $this->loadProductInfoByObj($productInfo, $productInfos[$v['product_cd']]);
                    $this->controller->data[$this->controller->name][$type][$key]['product'][$k] = $productInfo;
                }
            }
            return;
        }

        if (!empty($this->controller->data[$this->controller->name][$type])) {
            foreach($this->controller->data[$this->controller->name][$type] as $key => $value) {
                if (empty($value['product_cd']) || empty($productInfos[$value['product_cd']])) {
                    continue;
                }
                $this->loadProductInfoByObj($productInfo, $productInfos[$value['product_cd']]);
                $this->controller->data[$this->controller->name][$type][$key] = $productInfo;
            }
        }
    }

    /**
     * 種類よりランキング商品リストを作成
     * @param unknown_type $type
     */
    function loadRankingProductByType($type, $isMedicine = false){
        $productCds = array();
        foreach($this->controller->data[$this->controller->name][$type] as $key => $value) {
            if (!empty($value['product_cd'])) {
                $productCds[] = $value['product_cd'];
            }
        }

        if (count($productCds) == 10) {
            return;
        }
        $recs = $this->controller->Product->getRankingProduct($productCds, $isMedicine);
        $index = 0;
        foreach($this->controller->data[$this->controller->name][$type] as $key => $value) {
            if (empty($value['product_cd']) && !empty($recs[$index])) {
                $productInfo = array();
                $this->loadProductInfoByObj($productInfo, $recs[$index]);
                $this->controller->data[$this->controller->name][$type][$key] = $productInfo;
                $index++;
            }
        }
    }

    /**
     * 商品番号をチェック
     * @param unknown_type $productCd
     * @param unknown_type $category1Id
     * @param unknown_type $category2Id
     * @param unknown_type $category3Id
     * @param unknown_type $errMsg
     * @return boolean
     */
    function __checkProductCd($type, $productCd, $category1Id = null, $category2Id = null, $category3Id = null, &$errMsg) {
        $rec = $this->controller->Product->getBaseInfo($productCd);
        if (empty($rec['Product'])) {
            $errMsg = __('error.productCdNotMatch', true);
            return false;
        }
        if ($type == 'otc_product' && $rec['Product']['medicine_type'] != MEDICINE_TYPE_MEDICINE_A) {
            $errMsg = __('error.productIsNotMedicine', true);
            return false;
        }

        $categoryMatchFlg = false;
        if (empty($category1Id) && empty($category2Id) && empty($category3Id)) {
            return true;
        }

        if (!empty($rec['Category'])) {
            foreach($rec['Category'] as $key => $value) {
                if (empty($value['CategoryProductRel']['category_id'])) {
                    continue;
                }
                $categoryId = $value['CategoryProductRel']['category_id'];
                $parentId       = $GLOBALS['GLOBALS']['CategoryList'][$categoryId]['parent_id'];
                $parentParentId = !empty($parentId)?$GLOBALS['GLOBALS']['CategoryList'][$parentId]['parent_id']:'0';
                if (!empty($category3Id) 
                        && ($categoryId == $category1Id 
                            || $categoryId == $category2Id 
                            || $categoryId == $category3Id)) {
                    $categoryMatchFlg = true;
                    break;
                }
                elseif (empty($category3Id) && !empty($category2Id) 
                        && ($categoryId == $category1Id 
                            || $categoryId == $category2Id 
                            || $parentId == $category2Id)) {
                    $categoryMatchFlg = true;
                    break;
                }
                elseif (empty($category3Id) && empty($category2Id) 
                        && ($categoryId == $category1Id 
                            || $parentId == $category1Id 
                            || $parentParentId = $category1Id)) {
                    $categoryMatchFlg = true;
                    break;
                }
            }
        }
        if (!$categoryMatchFlg) {
            $errMsg = __('error.categoryProductRelNotMatch', true);
            return false;
        }

        return true;
    }

    /**
     * 表示ような商品の情報を作成
     * @param unknown_type $productInfo
     * @param unknown_type $obj
     */
    function loadProductInfoByObj(&$productInfo, &$obj) {
        //会員ランク
        $memberRank = '';
        if ($this->controller->Session->check('Auth.Member')) {
            $memberRank = strtolower($this->controller->Session->read('Auth.Member.customer_rank'));
        } else {
            $memberRank = strtolower(CUSTOMER_RANK_NORMAL);
        }
        $productInfo['product_cd']      = $obj['Product']['product_cd'];
        $productInfo['product_name']    = $obj['Product']['product_name'];
        $productInfo['update_datetime'] = $obj['Product']['update_datetime'];
        $productInfo['product_pic_url'] = !empty($obj['ProductPhoto'][0]['url'])?$obj['ProductPhoto'][0]['url']:'';
        $productInfo['stock']           = !empty($obj['Product']['stock'])?$obj['Product']['stock']:'0';
        $productInfo['enable_sale']     = !empty($obj['Product']['enable_sale'])?$obj['Product']['enable_sale']:false;
        //価格を取得
        $this->loadSalePrice($productInfo, $obj['Product']);
        //セール情報
        $productInfo['sale_rule_count'] = isset($obj['SaleRule']['count'])?$obj['SaleRule']['count']:0;
        //評価情報
        $productInfo['estimatino_count'] = isset($obj['Estimation']['count'])?$obj['Estimation']['count']:0;
        //販売数量
        $productInfo['sold_number'] = isset($obj['ProductSold']['sold_number'])?$obj['ProductSold']['sold_number']:0;
        //関連商品番号
        $productInfo['relation_product_cd'] = $obj['Product']['relation_product_cd'];
        //カテゴリID
        $productInfo['category_id'] = isset($obj['CategoryProductRel']['category_id'])?$obj['CategoryProductRel']['category_id']:null;
    }

    /**
     * セール価格を取得
     * @param unknown_type $productInfo
     * @param unknown_type $obj
     */
    function loadSalePrice(&$productInfo, &$obj) {
        $memberRank = '';
        if ($this->controller->Session->check('Auth.Member')) {
            $memberRank = strtolower($this->controller->Session->read('Auth.Member.customer_rank'));
        } else {
            $memberRank = strtolower(CUSTOMER_RANK_NORMAL);
        }

        //価格を取得
        if (!empty($memberRank)) {
            $productInfo['sale_price'] = $obj['price_for_'.$memberRank];
            $productInfo['point'] = $obj['point_for_'.$memberRank];
        }
        $productInfo['product_name'] = $obj['product_name'];
        $productInfo['retail_price'] = !empty($obj['retail_price'])?$obj['retail_price']:$productInfo['sale_price'];
    }
}
?>