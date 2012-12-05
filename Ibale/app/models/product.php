<?php
/**
 * ファイル名：product.php
 * 概要：商品情報のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/01/12
 */
App::import('Component', 'page_setting');

class Product extends AppModel {
    var $name       = "Product";
    var $useTable   = 'product';
    var $primaryKey = 'product_cd';
    var $hasMany    = array(
                        'ProductPhoto' => array(
                                            'className'  => 'ProductPhoto',
                                            'foreignKey' => 'product_cd',
                                            'conditions' => array("photo_type='PACKAGE'","ProductPhoto.delete_datetime IS NULL"),
                                            'order'      => array('display_order' => 'ASC'),
                        ),
    );
    var $validate = array(
                        'product_cd' => array(
                                            array('rule' => array('maxLength', 15)),
                                            array('rule' => array('notEmpty'), 'message' => 'error.required'),
                        ),
    );

    /**
     * 商品情報をOMSから取得
     */
    function getListFromOMS($baseTime) {
        $methodPath = 'getproduct';
        $params = array(
                        'base_datetime' => $baseTime,
        );
        return $this->requestOmsData($methodPath, $params);
    }

    /**
     * 予約商品の販売可否を参照する。
     * @param unknown_type $productCds
     */
    function getSubScriptionStatus($productCds) {
        if (!is_array($productCds)) {
            $productCds = array($productCds);
        }
        foreach($productCds as $key => $value) {
            $productCds[$key] = intval($value);
        }
        $methodPath = 'getsubscriptionstatus';
        $params = array(
                        'product_cd' => $productCds,
        );
        $recs = $this->requestOmsData($methodPath, $params);
        if (empty($recs['results'])) {
            return array();
        }
        $ret = array();
        foreach($recs['results']['products'] as $key => $value) {
            $ret[$value['product_cd']] = $value;
        }
        return $ret;
    }

    /**
     * 商品番号より商品詳細と商品写真情報を取得
     * @param unknown_type $productCd
     * @return multitype:|Ambigous <multitype:, unknown>
     */
    function getSimpleInfo($productCd) {
        $ret = array();
        if (!is_array($productCd)) {
            $productCds = array($productCd);
        } else {
            $productCds = $productCd;
        }
        $conditions = array(
                        'conditions'    => array(
                                                'Product.product_cd ' => $productCds,
                                                'Product.delete_datetime IS NULL',
                        ),
                        'recursive'     => 1,
        );
        $recs = $this->find('all', $conditions);
        if (empty($recs)) {
            return $ret;
        }
        foreach($recs as $key => $value) {
            $ret[$value['Product']['product_cd']] = $value;
        }
        return $ret;
    }

    /**
     * 注文情報より商品情報を取得
     * @param unknown_type $orderInfo
     * @param unknown_type $productInfoList
     */
    function getSimpleInfoByOrder(&$orderInfo, &$productInfoList = array()) {
        $productCds = array();
        foreach($orderInfo['orders'] as $key => $value) {
            foreach($value['product_info_list'] as $k => $v) {
                $productCds[] = $v['product_cd'];
            }
        }
        //価格を取得
        $productInfoList = $this->getSimpleInfo($productCds);
        $this->loadEnableSaleByProductList($productInfoList, $productCds);
    }

    /**
     * 商品情報を取得
     */
    function getBaseInfo($productCd) {
        $ret = array();
        if (!is_array($productCd)) {
            $productCds = array($productCd);
        } else {
            $productCds = $productCd;
        }

        //商品に対するカテゴリIDを取得
        $categoryProductRelModel = ClassRegistry::init('CategoryProductRel');
        $categoryProductRels = $categoryProductRelModel->getCategoryByProductCd($productCds);

        $conditions = array(
                        'fields'        => array(
                                            "Product.*",
                                            "(SELECT COUNT(id) FROM {$this->tablePrefix}estimation Estimation WHERE Estimation.product_cd = \"Product\".\"product_cd\" AND Estimation.del_flg='".ACTIVE_FLG_FALSE."' AND Estimation.status='".ESTIMATION_STATUS_PASSED."') AS \"Estimation__count\" ",
                                            "(SELECT COUNT(*) FROM {$this->tablePrefix}sale_rule SaleRule, {$this->tablePrefix}sale_product SaleProduct WHERE SaleProduct.product_cd = \"Product\".\"product_cd\" AND SaleRule.sale_start_datetime <= 'NOW()' AND SaleRule.sale_end_datetime >='NOW()' AND SaleRule.id=SaleProduct.salerule_id AND SaleProduct.delete_datetime IS NULL AND SaleRule.delete_datetime IS NULL ) AS \"SaleRule__count\" ",
                                            "ProductSold.sold_number",
                        ),
                        'conditions'    => array(
                                                'Product.product_cd ' => $productCds,
                                                'Product.delete_datetime IS NULL',
                        ),
                        'joins'         => array(
                                                "LEFT JOIN {$this->tablePrefix}product_sold AS \"ProductSold\" ON \"ProductSold\".\"product_cd\" = \"Product\".\"product_cd\" AND \"ProductSold\".\"del_flg\"='".ACTIVE_FLG_FALSE."'",
                        ),
                        'recursive'     => 1,
        );

        if (is_array($productCd)) {
            $recs = $this->find('all', $conditions);
            foreach($recs as $key => $value) {
                $productCd = $value['Product']['product_cd'];
                $ret[$productCd] = $value;
                if (!empty($categoryProductRels[$productCd])) {
                    foreach($categoryProductRels[$productCd] as $key => $value) {
                        $parentId       = isset($GLOBALS['GLOBALS']['CategoryList'][$value['CategoryProductRel']['category_id']])?$GLOBALS['GLOBALS']['CategoryList'][$value['CategoryProductRel']['category_id']]['parent_id']:null;
                        $parentParentId = !empty($parentId)?$GLOBALS['GLOBALS']['CategoryList'][$parentId]['parent_id']:'0';
                        $categoryProductRels[$productCd][$key]['CategoryProductRel']['parent_id'] = $parentId;
                        $categoryProductRels[$productCd][$key]['CategoryProductRel']['parent_parent_id'] = $parentParentId;
                    }
                    $ret[$productCd]['Category'] = $categoryProductRels[$productCd];
                }
            }
        } else {
            $ret = $this->find('first', $conditions);
            if (!empty($categoryProductRels[$productCds[0]])) {
                foreach($categoryProductRels[$productCd] as $key => $value) {
                    $parentId       = isset($GLOBALS['GLOBALS']['CategoryList'][$value['CategoryProductRel']['category_id']]['parent_id'])?$GLOBALS['GLOBALS']['CategoryList'][$value['CategoryProductRel']['category_id']]['parent_id']:null;
                    $parentParentId = !empty($parentId)?$GLOBALS['GLOBALS']['CategoryList'][$parentId]['parent_id']:'0';
                    $categoryProductRels[$productCd][$key]['CategoryProductRel']['parent_id'] = $parentId;
                    $categoryProductRels[$productCd][$key]['CategoryProductRel']['parent_parent_id'] = $parentParentId;
                }
                $ret['Category'] = $categoryProductRels[$productCds[0]];
            }
        }

        return $ret;
    }

    /**
     * 商品番号より関連商品情報を取得
     * @param unknown_type $productCds
     * @param unknown_type $ret
     */
    function getRelationProduct($relationProductCds) {
        $productCds  = array();
        $categoryIds = array();
        foreach($relationProductCds as $key => $value) {
            if (!empty($value['category_id'])) {
                $categoryIds[] = $value['category_id'];
            }
            $exceptedProductCds[] = $key;
            if (empty($value['relation_product_cd'])) {
                continue;
            }
            foreach(explode(',', $value['relation_product_cd']) as $k => $v) {
                $productCds[] = $v;
            }
        }
        $count = count($productCds);
        if ($count >= PRODUCT_DETAIL_RELATION_PRODUCT_LIMIT) {
            return array_slice($productCds, 0, PRODUCT_DETAIL_RELATION_PRODUCT_LIMIT);
        }

        $otherProductCds = array();
        //同一カテゴリの商品をランダム表示
        if ($count < PRODUCT_DETAIL_RELATION_PRODUCT_LIMIT && !empty($categoryIds)) {
            $modelCategoryProductRel = ClassRegistry::init('CategoryProductRel');
            $exceptedProductCds = array_merge($exceptedProductCds, $productCds);
            $recs = $modelCategoryProductRel->getProductByCategoryId($categoryIds, $exceptedProductCds);
            $otherProductCds = array_keys($recs);

        }
        $count += count($otherProductCds);
        if ($count >= PRODUCT_DETAIL_RELATION_PRODUCT_LIMIT) {
            $otherProductCds = $this->__getRandProductCds(array_keys($recs), PRODUCT_DETAIL_RELATION_PRODUCT_LIMIT - count($productCds));
            addArray($productCds, $otherProductCds);
            return $productCds;
        }
        addArray($productCds, $otherProductCds);

        $modelProductSold = ClassRegistry::init('ProductSold');
        $exceptedProductCds = array_merge($exceptedProductCds, $productCds);
        $otherProductCds = $modelProductSold->getProductCdOrderBySold($exceptedProductCds);
        $otherProductCds = array_slice($otherProductCds, 0, PRODUCT_DETAIL_RELATION_PRODUCT_LIMIT - count($productCds));
        //productCds + $otherProductCds
        addArray($productCds, $otherProductCds);

        return $productCds;
    }

    /**
     * ランキング商品リスト（トップページに設定しない商品情報）を取得
     * @param unknown_type $productCds
     * @return Ambigous <multitype:, NULL, boolean, mixed>
     */
    function getRankingProduct($productCds, $isMedicine = false) {
        $conditions = array(
                        'fields'        => array(
                                            "Product.*",
                                            "(SELECT COUNT(id) FROM {$this->tablePrefix}estimation Estimation WHERE Estimation.product_cd = \"Product\".\"product_cd\" AND Estimation.del_flg='".ACTIVE_FLG_FALSE."' AND Estimation.status='".ESTIMATION_STATUS_PASSED."') AS \"Estimation__count\" ",
                                            "(SELECT COUNT(*) FROM {$this->tablePrefix}sale_rule SaleRule, {$this->tablePrefix}sale_product SaleProduct WHERE SaleProduct.product_cd = \"Product\".\"product_cd\" AND SaleRule.sale_start_datetime <= 'NOW()' AND SaleRule.sale_end_datetime >='NOW()' AND SaleRule.id=SaleProduct.salerule_id AND SaleProduct.delete_datetime IS NULL AND SaleRule.delete_datetime IS NULL ) AS \"SaleRule__count\" ",
                        ),
                        'conditions'    => array(
                                                'Product.delete_datetime IS NULL',
                        ),
                        'order'         => array(
                                                'Product.sale_start_date' => 'DESC',
                        ),
                        'recursive'     => 2,
                        'limit'         => 10 - count($productCds),
        );
        if (!empty($productCds)) {
            $conditions['conditions'][] = array( 'NOT' => array('Product.product_cd' => $productCds));
        }
        if ($isMedicine) {
            $conditions['conditions'][] = array('Product.medicine_type =' => MEDICINE_TYPE_MEDICINE_A);
        } else {
            $conditions['conditions'][] = array('Product.medicine_type =' => MEDICINE_TYPE_NOT_MEDICINE);
        }

        $recs = $this->find('all', $conditions);
        return $recs;
    }

    /**
     * 商品詳細情報を取得
     * @param unknown_type $productCd
     * @return Ambigous <multitype:, mixed>
     */
    function getInfo($productCd) {
/**
        $this->bindModel(array('hasMany' => array(
                                                'ProductDesc' => array(
                                                                    'className'  => 'ProductDesc',
                                                                    'foreignKey' => 'product_cd'
                                                ),
                                                'ProductPhotoDesc' => array(
                                                                    'className'  => 'ProductPhoto',
                                                                    'foreignKey' => 'product_cd',
                                                                    'conditions' => "photo_type='".PRODUCT_PHOTO_TYPE_DESC."'",
                                                ),
                                            ),
                        )
        );
*/
        $conditions = array(
                        'fields'        => array(
                                            "Product.*",
                                            "Manufacturer.manufacturer_name",
                                            "Estimation.point",
                                            "Estimation.count",
                                            "Enquiry.count",
                                            //"ProductSold.sold_number",
                                            "CategoryProductRel.category_id",
                        ),
                        'conditions'    => array(
                                                'Product.delete_datetime IS NULL',
                                                'Product.product_cd =' => $productCd,
                        ),
                        'joins'         => array(
                                                array(
                                                    'table'     => 'manufacturer',
                                                    'alias'     => 'Manufacturer',
                                                    'type'      => 'Left',
                                                    'conditions'=>array(
                                                                    'Manufacturer.id=Product.manufacturer_id',
                                                                    'Manufacturer.delete_datetime IS NULL',
                                                    ),
                                                ),
                                                "LEFT JOIN (SELECT AVG(point) AS point, COUNT(id) AS count FROM {$this->tablePrefix}estimation Estimation WHERE Estimation.product_cd = '{$productCd}' AND Estimation.del_flg='".ACTIVE_FLG_FALSE."' AND Estimation.status='".ESTIMATION_STATUS_PASSED."') AS \"Estimation\" ON 1=1",
                                                "LEFT JOIN (SELECT COUNT(id) AS count FROM {$this->tablePrefix}enquiry Enquiry WHERE Enquiry.product_cd = '{$productCd}' AND Enquiry.del_flg='".ACTIVE_FLG_FALSE."' AND Enquiry.status='".ENQUIRY_STATUS_ANSWERED."') AS \"Enquiry\" ON 1=1",
                                                //"LEFT JOIN {$this->tablePrefix}product_sold AS \"ProductSold\" ON \"ProductSold\".\"product_cd\" = '{$productCd}' AND \"ProductSold\".\"del_flg\"='".ACTIVE_FLG_FALSE."'",
                                                "LEFT JOIN {$this->tablePrefix}category_product_rel AS \"CategoryProductRel\" ON \"CategoryProductRel\".\"product_cd\" = '{$productCd}' AND \"CategoryProductRel\".\"delete_datetime\" IS NULL ",
                        ),
                        'recursive'     => 2,
        );
        $ret = $this->find('first', $conditions);
        if (empty($ret)) {
            return array();
        }

        //商品に対するカテゴリIDを取得
        $categoryProductRelModel = ClassRegistry::init('CategoryProductRel');
        $categoryProductRels = $categoryProductRelModel->getCategoryByProductCd($productCd);
        $ret['Category'] = !empty($categoryProductRels[$productCd])?$categoryProductRels[$productCd]:array();

        //セール情報を取得
        $sqlForSaleRule = "SELECT 
                                SaleProduct.salerule_id AS \"SaleRule__salerule_id\",
                                SaleProduct.product_cd  AS \"SaleRule__product_cd\",
                                Product.product_name    AS \"SaleRule__product_name\",
                                SaleRule.salerule_type AS \"SaleRule__salerule_type\",
                                SaleRule.display_string AS \"SaleRule__display_string\"
                            FROM 
                                (SELECT salerule_id, product_cd, delete_datetime FROM {$this->tablePrefix}sale_product WHERE salerule_id IN (SELECT  salerule_id FROM {$this->tablePrefix}sale_product where product_cd='{$productCd}')) SaleProduct,
                                {$this->tablePrefix}sale_rule SaleRule,
                                {$this->tablePrefix}product Product
                            WHERE 1=1
                                AND SaleProduct.salerule_id = SaleRule.id
                                AND SaleProduct.delete_datetime IS NULL
                                AND Product.product_cd = SaleProduct.product_cd
                                AND Product.delete_datetime IS NULL
                                AND SaleRule.delete_datetime IS NULL
                                AND SaleRule.sale_start_datetime <= 'NOW()'
                                AND SaleRule.sale_end_datetime >= 'NOW()'
                            ORDER BY
                                SaleRule.update_datetime DESC,SaleProduct.product_cd ASC";
        $recs = $this->query($sqlForSaleRule);
        $saleRules = array();
        foreach($recs as $key => $value) {
            $value = $value['SaleRule'];
            $saleRules[$value['salerule_id']]['display_string'] = $value['display_string'];
            $k = isset($saleRules[$value['salerule_id']]['product_list'])?count($saleRules[$value['salerule_id']]['product_list']):0;
            if (!in_array($value['salerule_type'], array(SALERULE_TYPE_DISCOUNT_PER_SET, SALERULE_TYPE_DISCOUNT_PER_ASSORT))){
                continue;
            }
            $saleRules[$value['salerule_id']]['product_list'][$k]['product_cd']   = $value['product_cd'];
            $saleRules[$value['salerule_id']]['product_list'][$k]['product_name'] = $value['product_name'];
        }
        $ret['SaleRule'] = $saleRules;

        return $ret;
    }

    /**
     * おまけ商品情報を取得
     * @param unknown_type $productInfos
     * @param unknown_type $bonusProductList
     */
    function getOmakeProductInfo(&$productInfos, &$bonusProductList = array()) {
        //TODO:2012-08-24 検証のため
        return array();
        if (empty($productInfos)) {
            return;
        }

        $bonusProductCds = '';
        $productCdsWithBonus = array();
        foreach($productInfos as $key => $value) {
            if (!empty($value['Product']['bonus_product_cds'])) {
                $bonusProductCds .= !empty($bonusProductCds)?','.$value['Product']['bonus_product_cds']:$value['Product']['bonus_product_cds'];
                $productCdsWithBonus[$value['Product']['product_cd']] = explode(',', $value['Product']['bonus_product_cds']);
            }
        }
        if (!empty($bonusProductCds)) {
            $bonusProductCds   = explode(',', $bonusProductCds);
            //商品情報
            $recs = $this->getSimpleInfo($bonusProductCds);
            //在庫数
            $stockInfoModel = ClassRegistry::init('StockInfo');
            $stockInfos = $stockInfoModel->getInfo($bonusProductCds);
            //予約状態
            $subScriptStatus = $this->getSubScriptionStatus($bonusProductCds);
            foreach($productCdsWithBonus as $key => $value) {
                foreach($value as $k => $v) {
                    $subStatus = isset($subScriptStatus[$v])?$subScriptStatus[$v]['subscription_status']:false;
                    $stockInfos[$v] = !empty($stockInfos[$v])?$stockInfos[$v]:0;
                    //販売できる
                    $ret = $this->enableSale($recs[$v], $stockInfos[$v], false, false, $subStatus);
                    if ($ret) {
                        $bonusProductList[$key][$v] = $recs[$v];
                    }
                }
            }
        }
    }

    /**
     * 価格合計よりおまけ商品情報を取得
     * @param unknown_type $bonusType
     * @param unknown_type $bonusProductList
     * @return multitype:
     */
    function getOmakeProductByTotalPrice($bonusType, &$bonusProductList = array()) {
        //TODO:2012-08-24 検証のため
        return array();
        $conditions = array(
                            'conditions' => array(
                                                "bonus_type " => str_replace('_LINE', '', $bonusType),
                                                "delete_datetime IS NULL",
                            ),
                            'order'      => array(
                                                "update_datetime" => 'DESC',
                            ),
        );
        $recs = $this->find('all', $conditions);
        if (empty($recs)) {
            return array();
        }

        $productList     = array();
        $bonusProductCds = array();
        foreach($recs as $key => $value) {
            $productList[$value['Product']['product_cd']] = $value;
            $bonusProductCds[] = $value['Product']['product_cd'];
        }
        //在庫数
        $stockInfoModel = ClassRegistry::init('StockInfo');
        $stockInfos = $stockInfoModel->getInfo($bonusProductCds);
        //予約状態
        $subScriptStatus = $this->getSubScriptionStatus($bonusProductCds);

        foreach($productList as $productCd => $productInfo) {
            $subStatus = isset($subScriptStatus[$productCd])?$subScriptStatus[$productCd]['subscription_status']:false;
            $stockInfos[$productCd] = !empty($stockInfos[$productCd])?$stockInfos[$productCd]:0;
            //販売できる
            $ret = $this->enableSale($productInfo, $stockInfos[$productCd], false, false, $subStatus);
            if ($ret) {
                $bonusProductList[$productCd] = $productInfo;
            }
        }
    }

    /**
     * 販売かどうかことをチェック
     * @param unknown_type $productInfo
     * @param unknown_type $stockCount
     * @return boolean
     */
    function enableSale(&$productInfo, $stockCount = null, $pubFlg = true, $customerRank = false, $subScriptStatus = false) {
        if ($customerRank !== false && !$this->__checkCustomerRank($customerRank, $productInfo['Product']['require_customer_rank'])) {
            return false;
        }
        if ($pubFlg && !($productInfo['Product']['pub_flg'] == ACTIVE_FLG_TRUE && $productInfo['Product']['pub_start_date'] <= date('Y-m-d') && ($productInfo['Product']['pub_end_date'] >= date('Y-m-d') || empty($productInfo['Product']['pub_end_date'])))) {
            return false;
        } 
        if ($stockCount === null) {
            return true;
        }
        if (($stockCount > 0 && in_array($productInfo['Product']['product_type'], array(PRODUCT_TYPE_NO_LIMIT, PRODUCT_TYPE_JIT, PRODUCT_TYPE_STOCK_ONLY)) && in_array($productInfo['Product']['sales_status'], array(PRODUCT_SALES_STATUS_NORMAL, PRODUCT_SALES_STATUS_STOCK_ONLY, PRODUCT_SALES_STATUS_WILL_END_SELLING))) 
                 || ($stockCount <= 0 && in_array($productInfo['Product']['product_type'], array(PRODUCT_TYPE_NO_LIMIT, PRODUCT_TYPE_JIT)) && $productInfo['Product']['sales_status'] == PRODUCT_SALES_STATUS_NORMAL)
                 || ($subScriptStatus && in_array($productInfo['Product']['sales_status'], array(PRODUCT_SALES_STATUS_NORMAL, PRODUCT_SALES_STATUS_STOCK_ONLY, PRODUCT_SALES_STATUS_WILL_END_SELLING)))) {
             return true;
        }
        return false;
    }

    function loadEnableSaleByProductList(&$productList, $productCds = array()) {
        if (empty($productList)) {
            return;
        }
        if (empty($productCds)) {
            foreach($productList as $key => $value) {
                $productCds[] = $value['Product']['product_cd'];
            }
        }
        //販売できることをチェック
        //在庫数を取得
        $stockInfoModel = ClassRegistry::init('StockInfo');
        $stockInfo= $stockInfoModel->getInfo($productCds);
        //販売可能
        $customerRank = isset($_SESSION[FRONT_AUTH_SESSION_KEY])?$_SESSION[FRONT_AUTH_SESSION_KEY.'.customer_rank']:CUSTOMER_RANK_NORMAL;
        //予約商品の販売可否
        $subScriptStatus = $this->getSubScriptionStatus($productCds);

        foreach($productList as $k => $v) {
            $productCd = $v['Product']['product_cd'];
            $stock = !empty($stockInfo[$productCd])?$stockInfo[$productCd]:0;
            $subStatus = isset($subScriptStatus[$productCd]['subscription_status'])?$subScriptStatus[$productCd]['subscription_status']:false;
            $productList[$k]['Product']['stock'] = $stock;
            $productList[$k]['Product']['enable_sale'] = $this->enableSale($v, $stock, true, $customerRank, $subStatus);
        }
    }

    /**
     * フロント側の検索条件より、商品番号・カテゴリIDとブランドIDを作成
     * @param unknown_type $params
     * @param unknown_type $member_rank
     * @param unknown_type $ret
     */
    function loadSearchProductCd(&$params = array(), $member_rank = CUSTOMER_RANK_NORMAL, &$ret) {
        $this->__loadForProductCdSQL($params , $member_rank, $sql);
        $recs = $this->query($sql);

        $ret['product_cd'] = array();
        $ret['category_id'] = array();
        $ret['brand_id'] = array();
        foreach($recs as $key => $value) {
            if (!in_array($value[0]['product_cd'], $ret['product_cd'])) {
                $ret['product_cd'][] = $value[0]['product_cd'];
            }
            if (!empty($value[0]['category_id']) && !empty($ret['category_id'][$value[0]['category_id']][$value[0]['product_cd']])) {
                $ret['category_id'][$value[0]['category_id']][$value[0]['product_cd']] += 1;
            } else if(!empty($value[0]['category_id'])) {
                $ret['category_id'][$value[0]['category_id']][$value[0]['product_cd']] = 1;
            }
            if (!empty($value[0]['brand_id']) && !empty($ret['brand_id'][$value[0]['brand_id']][$value[0]['product_cd']])) {
                $ret['brand_id'][$value[0]['brand_id']][$value[0]['product_cd']] += 1;
            } else if(!empty($value[0]['brand_id'])) {
                $ret['brand_id'][$value[0]['brand_id']][$value[0]['product_cd']] = 1;
            }
        }
    }

    /**
     * フロント側の商品番号を取得する用のSQLを作成
     * @return string
     */
    function __loadForProductCdSQL(&$params = array(), $member_rank = CUSTOMER_RANK_NORMAL, &$sql) {
        //会員ランク
        $memberRank = strtolower(CUSTOMER_RANK_NORMAL);

        $tablePrefix = $this->tablePrefix;
        $sql = "SELECT 
                                    Product.product_cd, 
                                    Product.brand_id, 
                                    Category.id AS category_id
                                FROM 
                                    {$tablePrefix}product Product 
                                    LEFT JOIN {$tablePrefix}brand Brand ON Product.brand_id=Brand.id 
                                    LEFT JOIN {$tablePrefix}category_product_rel CategoryProductRel ON CategoryProductRel.product_cd=Product.product_cd 
                                    LEFT JOIN {$tablePrefix}category Category ON Category.id=CategoryProductRel.category_id
                                    LEFT JOIN {$tablePrefix}product_sold ProductSold ON ProductSold.product_cd=Product.product_cd 
                                WHERE 1=1
                                        AND Product.delete_datetime IS NULL
                                        AND Product.pub_flg ='".ACTIVE_FLG_TRUE."'
                                        AND Product.pub_start_date <='NOW()'
                                        AND (Product.pub_end_date   >='NOW()' OR Product.pub_end_date IS NULL)
                                        AND Product.sales_status NOT IN ('".PRODUCT_SALES_STATUS_END_SELLING."','".PRODUCT_SALES_STATUS_STOP_SELLING."')
                                        AND CategoryProductRel.delete_datetime IS NULL
                                        AND Category.delete_datetime IS NULL
                                        AND Brand.delete_datetime IS NULL ";
                                        //AND Product.bonus_type = '".BONUS_TYPE_NOT_BONUS."'
            //キーワードがある場合
        if (!empty($params['keywords'])) {
            //$keywords = pg_escape_bytea($params['keywords']);
            $keywords = base64url_decode($params['keywords']);
            $keywords = pg_escape_string($keywords);
            $sql .= "
                                        AND (
                                            UPPER(Product.product_cd) LIKE UPPER('%{$keywords}%') OR
                                            UPPER(Product.product_name) LIKE UPPER('%{$keywords}%') OR
                                            UPPER(Product.keyword1) LIKE UPPER('%{$keywords}%') OR
                                            UPPER(Product.keyword2) LIKE UPPER('%{$keywords}%') OR
                                            UPPER(Category.category_title) LIKE UPPER('%{$keywords}%') OR
                                            UPPER(Brand.brand_name) LIKE UPPER('%{$keywords}%') OR
                                            UPPER(Brand.brand_name_pinyin) LIKE UPPER('%{$keywords}%')
                                        ) ";
        }
        //商品番号がある場合
        if (isset($params['product_cd'])) {
            arrayToStringForSQL($params['product_cd'], $productCds);
            if (empty($productCds)) {
                $productCds = 'NULL';
            }
            $sql .= "AND Product.product_cd IN ({$productCds}) ";
        }
        //カテゴリIDがある場合
        if (!empty($params['category3_id'])) {
            $categoryIdsStr = $params['category3_id'];
        }
        elseif (!empty($params['category2_id'])) {
            $categoryIdsStr = "SELECT id FROM {$this->tablePrefix}category WHERE 1=1 AND parent_id={$params['category2_id']} UNION SELECT {$params['category2_id']} AS id ";
        }
        else if (!empty($params['category1_id'])) {
            $categoryIdsStr = "SELECT id FROM {$this->tablePrefix}category WHERE 1=1 AND parent_id IN (SELECT id FROM {$this->tablePrefix}category WHERE 1=1 AND parent_id={$params['category1_id']}) UNION SELECT id FROM {$this->tablePrefix}category WHERE 1=1 AND parent_id={$params['category1_id']} UNION SELECT {$params['category1_id']} AS id ";
        }
        if (!empty($categoryIdsStr)) {
            //arrayToStringForSQL($categoryIds, $categoryIdsStr);
            $sql .= "AND CategoryProductRel.category_id IN({$categoryIdsStr}) ";
        }
        //ブランドIDがある場合
        if (!empty($params['brand_id'])) {
            $brandId = $params['brand_id'];
            $sql .= "AND Brand.id ={$brandId} ";
        }

        //最小価格がある場合
        if (!empty($params['min_price'])) {
            $minPrice = $params['min_price'];
            $sql .= "AND Product.price_for_{$memberRank} >= {$minPrice} ";
        }
        //最大価格がある場合
        if (!empty($params['max_price'])) {
            $maxPrice = $params['max_price'];
            $sql .= "AND Product.price_for_{$memberRank} <= {$maxPrice} ";
        }
        //表示順
        $orderBy = array();
        //価格
        if (!empty($params['sort_key']) && $params['sort_key'] == '1') {
            $orderBy = "ProductSold.sold_number::integer DESC ";
        } elseif(!empty($params['sort_key']) && $params['sort_key'] == '2') {
            $orderBy = "Product.update_datetime DESC ";
        }else if (!empty($params['sort_key']) && $params['sort_key'] == '3') {
            $orderBy = "Product.price_for_{$memberRank} DESC ";
        }else if (!empty($params['sort_key']) && $params['sort_key'] == '4') {
            $orderBy = "Product.price_for_{$memberRank} ASC ";
        } else {
            $orderBy = "ProductSold.sold_number DESC ";
        }

        $sql .= 'ORDER BY '.$orderBy;
        $recs = $this->query($sql);

        $productCds = array();
        $categoryIds = array();
        $brandIds = array();
        foreach($recs as $key => $value) {
            if (!in_array($value[0]['product_cd'], $productCds)) {
                $productCds[] = $value[0]['product_cd'];
            }
            if (!empty($value[0]['category_id']) && !empty($categoryIds[$value[0]['category_id']][$value[0]['product_cd']])) {
                $categoryIds[$value[0]['category_id']][$value[0]['product_cd']] += 1;
            } else if(!empty($value[0]['category_id'])) {
                $categoryIds[$value[0]['category_id']][$value[0]['product_cd']] = 1;
            }
            if (!empty($value[0]['brand_id']) && !empty($brandIds[$value[0]['brand_id']][$value[0]['product_cd']])) {
                $brandIds[$value[0]['brand_id']][$value[0]['product_cd']] += 1;
            } else if(!empty($value[0]['brand_id'])) {
                $brandIds[$value[0]['brand_id']][$value[0]['product_cd']] = 1;
            }
        }
        //return $sql;
    }

    /**
     * ランダム商品番号を取得
     * @param unknown_type $relationProductCds
     * @return Ambigous <multitype:, unknown>
     */
    function __getRandProductCds($relationProductCds, $productCdLimit) {
        $productCds = array();

        while(count($productCds) < $productCdLimit):
            $key = rand(0, count($relationProductCds)-1);
            if (in_array($relationProductCds[$key], $productCds)) {
                continue;
            }
            $productCds[] = $relationProductCds[$key];
        endwhile;

        return $productCds;
    }

    function __checkCustomerRank($customerRank, $requireCustomerRank) {
        $customerRanks = array(
                            CUSTOMER_RANK_NONE,
                            CUSTOMER_RANK_NORMAL,
                            CUSTOMER_RANK_GOLD,
                            CUSTOMER_RANK_PLATINUM
        );
        if (array_search($customerRank, $customerRanks) < array_search($requireCustomerRank, $customerRanks)) {
            return false;
        } else {
            return true;
        }
    }

    /* (non-PHPdoc)
     * @see Model::afterSave()
     */
    function afterSave($created) {
        parent::afterSave($created);
        clearCache('element_cache_toppage_cached_products','views', '');
        clearCache('product_cached_product_comment','views', '');
        clearCache('product_cached_relation_product','views', '');
    }

}
?>
