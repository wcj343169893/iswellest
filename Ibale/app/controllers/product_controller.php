<?php
class ProductController extends AppController {
	var $name = 'Product';
	var $uses = array (
			'Product',
			'Category',
			'Brand',
			'ProductPhoto',
			'ProductDesc',
			'StockInfo' 
	);
	var $components = array (
			'Query',
			'PageSetting',
			'ConfigIni' 
	);
	var $helpers = array (
			'AppSession',
			'Paginator' 
	);
	
	function beforeFilter() {
		$this->AppAuth->allowedActions = array (
				'index',
				'search',
				'detail',
				'ajax_get_info',
				'cached_product',
				'cached_product_comment',
				'cached_relation_product' 
		);
		parent::beforeFilter ();
	}
	
	/**
	 * 商品一覧画面
	 */
	function index() {
		$this->layout = 'front';
		
		// 検索条件に対する商品番号を取得
		$this->Product->loadSearchProductCd ( $this->params ['named'], $this->Session->read ( 'Auth.Member.customer_rank' ), $ret );
		$productCds = $ret ['product_cd'];
		$categoryIds = $ret ['category_id'];
		$brandIds = $ret ['brand_id'];
		$recommend_product = $ret ['recommend_product'];
		$this->set(compact("recommend_product"));
		// カテゴリ情報
		$categoryList = $this->Category->getAllOptionList ();
		$this->set ( 'categoryAllOptionList', $categoryList );
		if (! empty ( $this->params ['named'] ['brand_id'] )) {
			
			$brandCategoryList ['level_1'] = array ();
			$brandCategoryList ['level_2'] = array ();
			// ブランドに対するカテゴリ情報
			foreach ( $categoryIds as $key => $value ) {
				if (in_array ( $key, array_keys ( $categoryList ['level_1'] ) )) {
					$brandCategoryList ['level_1'] [$key] = $categoryList [$key] ['category_title'];
					$brandCategoryList ['level_2'] [$key] = isset ( $categoryList ['level_2'] [$key] ) ? $categoryList ['level_2'] [$key] : array ();
					echo 1;
				} else if (in_array ( $key, array_keys ( $categoryList ['level_2'] ) )) {
					$brandCategoryList ['level_2'] [$parentId] [$key] = $categoryList [$key] ['category_title'];
					$brandCategoryList ['level_1'] [$parentId] = $categoryList [$parentId] ['category_title'];
				} else {
					$parentId = $categoryList [$key] ['parent_id'];
					$parentParentId = $categoryList [$parentId] ['parent_id'];
					$brandCategoryList ['level_2'] [$parentParentId] [$parentId] = $categoryList [$parentId] ['category_title'];
					$brandCategoryList ['level_1'] [$parentParentId] = $categoryList [$parentParentId] ['category_title'];
				}
			}
			$this->set ( 'brandCategoryList', $brandCategoryList );
			// ブランド情報
			$brandList = $this->Brand->getList ( array (
					$this->params ['named'] ['brand_id'] 
			), 1 );
			$this->set ( 'brandList', $brandList );
			
			// バナー情報
			$this->__loadBannerList ( PAGE_SETTING_TYPE_BRAND_TOP_BANNER );
		} else {
			// ブランド情報
			$brandList = $this->Brand->getList ( array (), 1 );
			$this->set ( 'brandList', $brandList );
			// バナー情報
			$this->__loadBannerList ( PAGE_SETTING_TYPE_PRODUCT_LIST_BANNER );
		}
		
		$this->data ['Product'] ['min_price'] = ! empty ( $this->params ['named'] ['min_price'] ) ? $this->params ['named'] ['min_price'] : '';
		$this->data ['Product'] ['max_price'] = ! empty ( $this->params ['named'] ['max_price'] ) ? $this->params ['named'] ['max_price'] : '';
		if (empty ( $this->params ['named'] ['sort_key'] )) {
			$this->params ['named'] ['sort_key'] = '';
		}
		$this->data ['Product'] ['sort_key'] = ! empty ( $this->params ['named'] ['sort_key'] ) ? $this->params ['named'] ['sort_key'] : '';
		
		$this->set ( 'categoryIds', $categoryIds );
		$this->set ( 'brandIds', $brandIds );
		
		// ページ送りパーラムを設定
		$ret = array ();
		$this->__loadPaging ( $productCds, $ret );
		
		$this->set ( 'dataList', $ret );
		
		$this->render ( 'index' );
	}
	
	/**
	 * 商品検索・一覧画面
	 */
	function search() {
		$this->index ();
	}
	
	/**
	 * 商品詳細画面
	 */
	function detail() {
		$this->layout = 'front';
		$this->Session->delete ( 'Auth.redirect' );
		
		if (empty ( $this->params ['named'] ['product_cd'] )) {
			$this->redirect ( '/' );
			return;
		}
		
		// 商品番号
		$productCd = $this->params ['named'] ['product_cd'];
		$productInfo = $this->Product->getInfo ( $productCd );
		$pub_flg = trim ( $productInfo ['Product'] ['pub_flg'] );
		if (empty ( $productInfo ) || empty ( $pub_flg ) || ! ($productInfo ['Product'] ['pub_start_date'] <= date ( 'Y-m-d' ) && ($productInfo ['Product'] ['pub_end_date'] >= date ( 'Y-m-d' ) || empty ( $productInfo ['Product'] ['pub_end_date'] )))) {
			$this->redirect ( '/' );
			return;
		}
		$this->PageSetting->loadSalePrice ( $productInfo ['Product'], $productInfo ['Product'] );
		// 在庫数を取得
		$this->loadModel ( 'StockInfo' );
		$stockInfo = $this->StockInfo->getInfo ( $productCd );
		$productInfo ['StockInfo'] ['count'] = ! empty ( $stockInfo [$productCd] ) ? $stockInfo [$productCd] : 0;
		$this->set ( 'detail', $productInfo );
		// 販売可能
		$customerRank = $this->Session->check ( $this->AppAuth->sessionKey ) ? $this->Session->read ( $this->AppAuth->sessionKey . '.customer_rank' ) : CUSTOMER_RANK_NORMAL;
		// 予約商品の販売可否
		if ($productInfo ['Product'] ['product_type'] == PRODUCT_TYPE_RESERVATION) {
			$subScriptStatus = $this->Product->getSubScriptionStatus ( $productInfo ['Product'] ['product_cd'] );
			$subStatus = $subScriptStatus [$productInfo ['Product'] ['product_cd']] ['subscription_status'];
		} else {
			$subStatus = null;
			$subScriptStatus = array ();
		}
		$ret = $this->Product->enableSale ( $productInfo, $productInfo ['StockInfo'] ['count'], true, $customerRank, $subStatus );
		$this->set ( 'enableSale', $ret );
		
		// おまけ商品を取得
		if (! empty ( $productInfo ['Product'] ['bonus_product_cds'] )) {
			$productInfos = array (
					$productInfo ['Product'] ['product_cd'] => $productInfo 
			);
			$this->Product->getOmakeProductInfo ( $productInfos, $bonusProductList );
			$this->set ( 'bonusProductList', $bonusProductList [$productInfo ['Product'] ['product_cd']] );
		}
		
		// お届け日数
		$deliveryDay = $this->__getDeliveryDay ( $productInfo, $subStatus );
		$this->set ( 'deliveryDay', $deliveryDay );
		
		if (! empty ( $_COOKIE ['browsed_product_cd'] )) {
			$browsedProductCds = explode ( ',', $_COOKIE ['browsed_product_cd'] );
		}
		if (empty ( $browsedProductCds ) || (! empty ( $browsedProductCds ) && ! in_array ( $productCd, $browsedProductCds ))) {
			$browsedProductCds [] = $productCd;
			setcookie ( 'browsed_product_cd', implode ( ',', $browsedProductCds ), time () + 60 * 60 * 24 * 7 );
			// clearCache('element_'.$this->Session->id().'_product_cached_browsered_product','views',
			// '');
		}
		
		if (! isset ( $this->data ['Product'] ['order_amount'] )) {
			$this->data ['Product'] ['order_amount'] = 1;
		}
		
		$this->render ( 'detail' );
	}
	
	/**
	 * 情報一覧
	 */
	function admin_index() {
		$this->layout = "admin";
		
		$this->paginate = $this->__loadDefaultSearchCondition ();
		$this->set ( 'dataList', $this->paginate () );
		
		$this->render ( 'admin_index' );
	}
	
	/**
	 * 情報を検索
	 */
	function admin_search() {
		$this->layout = 'admin';
		
		if (! empty ( $this->data )) {
			$conditions = $this->__loadDefaultSearchCondition ();
			$conditions ['conditions'] = array (
					'Product.delete_datetime IS NULL',
					'OR' => array (
							'Product.product_name like \'%###data.Search.product_cd###%\'',
							'Product.product_cd like \'%###data.Search.product_cd###%\'' 
					) 
			);
			$this->Query->renderSearchConditions ( $conditions );
			$this->Session->write ( 'Admin.Product.Search.Conditions', $conditions );
			$this->Session->write ( 'Admin.Product.Search.Data', $this->data );
		} else {
			$conditions = $this->Session->read ( 'Admin.Product.Search.Conditions' );
			$this->data = $this->Session->read ( 'Admin.Product.Search.Data' );
		}
		$this->paginate = $conditions;
		$dataList = $this->paginate ();
		$this->set ( 'dataList', $dataList );
		$this->render ( 'admin_index' );
	}
	
	/**
	 * 情報追加画面を初期化
	 */
	
	function admin_edit() {
		$this->layout = "admin";
		
		if (empty ( $this->params ['named'] ['product_cd'] )) {
			$this->redirect ( '/admin/product/search/' );
			return;
		}
		
		// 商品番号をチェック
		$conditions ['conditions'] = array (
				'product_cd' => $this->params ['named'] ['product_cd'],
				'custom_page_flg ' => ACTIVE_FLG_TRUE,
				'delete_datetime IS NULL' 
		);
		$rec = $this->Product->find ( 'first', $conditions );
		if (empty ( $rec )) {
			$this->redirect ( 'admin_search' );
			return;
		}
		$this->set ( 'detail', $rec );
		$this->data ['Product'] ['product_cd'] = $rec ['Product'] ['product_cd'];
		$this->data ['Product'] ['custom_content'] = $rec ['Product'] ['custom_content'];
		
		$this->loadBackListReferer ();
		$this->render ( 'admin_edit' );
	}
	
	/**
	 * 情報を更新
	 */
	function admin_edit_comp() {
		$this->layout = "admin";
		
		$errMsg = $this->Product->invalidFields ( array (), $this->data );
		if (! empty ( $errMsg )) {
			$this->admin_edit ();
			return;
		}
		
		$userId = $this->Session->read ( $this->AppAuth->sessionKey . '.id' );
		$updateData ['product_cd'] = $this->data ['Product'] ['product_cd'];
		$updateData ['custom_content'] = $this->data ['Product'] ['custom_content'];
		$updateData ['update_user'] = $userId;
		$updateData ['update_datetime'] = 'NOW()';
		$this->Product->save ( $updateData );
		
		$this->redirect ( $this->getBackListReferer () );
	}
	
	/**
	 * 関連商品情報画面初期化
	 */
	function admin_edit_relation_product() {
		$this->layout = "admin";
		if (empty ( $this->params ['named'] ['product_cd'] )) {
			$this->redirect ( '/admin/product/search/' );
			return;
		}
		
		// 商品番号をチェック
		$product_cd = $this->params ['named'] ['product_cd'];
		$conditions ['conditions'] = array (
				'product_cd' => $product_cd,
				'delete_datetime IS NULL' 
		);
		$rec = $this->Product->find ( 'first', $conditions );
		if (empty ( $rec )) {
			$this->redirect ( '/admin/product/search/' );
			return;
		}
		$this->data ['Product'] ['product_cd'] = $product_cd;
		
		// 関連商品番号を取得
		$relation_product_cds = $this->__getRelationProductCdString ( $rec ['Product'] ['relation_product_cd'] );
		// 関連できる商品を検索
		$conditions ['conditions'] = array (
				"Product.product_cd <> '{$product_cd}'",
				"Product.delete_datetime IS NULL",
				'OR' => array (
						"Product.product_name like '%###data.Search.product_cd###%'",
						"Product.product_cd like '%###data.Search.product_cd###%'" 
				) 
		);
		if (! empty ( $relation_product_cds )) {
			$conditions ['conditions'] [] = "Product.product_cd NOT IN ({$relation_product_cds})";
		}
		$this->Query->renderSearchConditions ( $conditions );
		$recs = $this->Product->find ( 'all', $conditions );
		$enableRelationList = array ();
		foreach ( $recs as $key => $value ) {
			$value = $value ['Product'];
			$enableRelationList [$value ['product_cd']] = $value ['product_cd'] . '  ' . $value ['product_name'];
		}
		$this->set ( 'enableRelationList', $enableRelationList );
		
		// 関連した商品を検索
		$recs = array ();
		if (! empty ( $relation_product_cds )) {
			$uniqueProductCds = array ();
			$sqlSort = "CASE ";
			foreach ( explode ( ',', $rec ['Product'] ['relation_product_cd'] ) as $key => $value ) {
				if (empty ( $value )) {
					continue;
				}
				
				if (in_array ( trim ( $value ), $uniqueProductCds )) {
					continue;
				}
				$uniqueProductCds [] = trim ( $value );
				$sqlSort .= "WHEN p.product_cd='{$value}' THEN {$key} ";
			}
			$sqlSort .= "END AS sort_key ";
			
			$sql = "SELECT 
                            a.product_cd, 
                            p.product_name,
                            {$sqlSort}
                        FROM 
                            (SELECT UNNEST(array[{$relation_product_cds}]) AS product_cd) a
                            LEFT JOIN {$this->Product->tablePrefix}product p ON a.product_cd = p.product_cd
                        ORDER BY sort_key ASC ";
			$recs = $this->Product->query ( $sql );
		}
		$relationList = array ();
		foreach ( $recs as $key => $value ) {
			$value = $value [0];
			$relationList [$value ['product_cd']] = $value ['product_cd'] . '  ' . $value ['product_name'];
		}
		$this->set ( 'relationList', $relationList );
		
		$this->loadBackListReferer ();
		$this->render ( 'admin_edit_relation_product' );
	}
	
	/**
	 * * 関連商品情報を更新
	 */
	function admin_update_relation_product() {
		$this->layout = "admin";
		
		if (! isset ( $this->data ['Product'] ['relation_product_cd'] )) {
			$this->redirect ( '/admin/product/search/' );
			return;
		}
		
		$relationProductCds = $this->data ['Product'] ['relation_product_cd'];
		$relationProductCds = ! empty ( $relationProductCds ) ? implode ( ',', $relationProductCds ) : '';
		
		$userId = $this->Session->read ( $this->AppAuth->sessionKey . '.id' );
		$updateData = array ();
		$updateData ['product_cd'] = $this->data ['Product'] ['product_cd'];
		$updateData ['relation_product_cd'] = $relationProductCds;
		$updateData ['update_user'] = $userId;
		$updateData ['update_datetime'] = 'NOW()';
		$this->Product->save ( $updateData );
		
		$this->redirect ( $this->getBackListReferer () );
	}
	
	/**
	 * 商品情報を取得（AJAX用の関数）
	 */
	function ajax_get_info() {
		Configure::write ( 'debug', 0 );
		$this->layout = 'empty';
		
		if (empty ( $this->params ['url'] ['product_cd'] )) {
			die ();
		}
		$productCd = $this->params ['url'] ['product_cd'];
		$rec = $this->Product->getBaseInfo ( $productCd );
		if (! empty ( $rec ) && ! empty ( $this->params ['url'] ['enable_sale'] )) {
			// 在庫Ｃｈｅｃｋ、販売ステータスＣｈｅｃｋ、エラーの場合
			$stockInfo = $this->StockInfo->getInfo ( $productCd );
			$stockInfo [$productCd] = ($stockInfo [$productCd] == null) ? 0 : $stockInfo [$productCd];
			$ret = $this->Product->enableSale ( $rec, $stockInfo [$productCd], false );
			if (! $ret) {
				$rec ['msg'] = sprintf ( __ ( 'error.productSaleDisabled', true ), $productCd );
				// echo json_encode($ret);
				// die();
			}
		}
		echo json_encode ( $rec );
		die ();
	}
	
	/**
	 * 商品リスト情報を取得
	 *
	 * @return multitype:
	 */
	function cached_product() {
		$ret = array ();
		
		if (empty ( $this->params ['named'] ['product_cds'] )) {
			return array ();
		}
		$productCds = explode ( ',', $this->params ['named'] ['product_cds'] );
		$recs = $this->Product->getBaseInfo ( $productCds );
		
		if (empty ( $recs )) {
			return array ();
		}
		foreach ( $recs as $key => $value ) {
			$this->PageSetting->loadProductInfoByObj ( $productInfo, $value );
			$ret [] = $productInfo;
		}
		
		return $ret;
	}
	
	/**
	 * 関連商品を取得
	 *
	 * @return multitype:
	 */
	function cached_relation_product() {
		$ret = array ();
		
		if (empty ( $this->params ['named'] ['product_cd'] ) || empty ( $this->params ['named'] ['relation_product_cds'] )) {
			return array ();
		}
		
		$productCd = $this->params ['named'] ['product_cd'];
		$relationProductCds = $this->params ['named'] ['relation_product_cds'];
		$categoryId = $this->params ['named'] ['category_id'];
		
		$productCds = $this->Product->getRelationProduct ( array (
				$productCd => array (
						'relation_product_cd' => $relationProductCds,
						'category_id' => $categoryId 
				) 
		) );
		$recs = $this->Product->getBaseInfo ( $productCds );
		foreach ( $productCds as $key => $value ) {
			$productInfo = array ();
			$this->PageSetting->loadProductInfoByObj ( $productInfo, $recs [$value] );
			$ret [] = $productInfo;
		}
		return $ret;
	}
	
	/**
	 * 商品詳細画面の商品説明詳細
	 */
	function cached_product_comment() {
		$productCd = $this->params ['named'] ['product_cd'];
		$recs = $this->ProductPhoto->getList ( $productCd, PRODUCT_PHOTO_TYPE_DESC );
		$ret ['productPhotoList'] [$productCd] = ! empty ( $recs [$productCd] ) ? $recs [$productCd] : array ();
		$ret ['productDescList'] = $this->ProductDesc->getList ( $productCd );
		return $ret;
	}
	
	/**
	 * 順番が存在かどうかことをチェック
	 *
	 * @return boolean
	 */
	function __isExsitsSortNumber() {
		$conditions = array (
				'conditions' => array (
						'order_number' => $this->data ['Product'] ['order_number'],
						'del_flg' => ACTIVE_FLG_FALSE 
				),
				'recursive' => 0 
		);
		$recs = $this->Product->find ( 'all', $conditions );
		if (! empty ( $recs )) {
			$this->Session->setFlash ( __ ( 'error.orderNumberIsExists', true ), 'default', null, 'orderNumberIsExists' );
			return true;
		}
		return false;
	}
	
	/**
	 * プロパティ名前が存在かどうかことをチェック
	 *
	 * @param unknown_type $data        	
	 * @return boolean
	 */
	function __isExistsProductName() {
		$checkData ['pKeyName'] = 'id';
		$checkData ['pKeyValue'] = null;
		$checkData ['fieldName'] = 'name';
		$checkData ['fieldValue'] = $this->data ['Product'] ['name'];
		$ret = $this->Product->isExists ( $checkData );
		if ($ret) {
			$this->Session->setFlash ( str_replace ( '{0}', '名称', __ ( 'error.isExists', true ) ), 'default', null, 'nameIsExists' );
			return true;
		}
		return false;
	}
	
	/**
	 * 検索条件を作成
	 *
	 * @return 検索条件
	 */
	function __loadDefaultSearchCondition() {
		$conditions = array (
				'conditions' => array (
						'Product.delete_datetime IS NULL' 
				),
				'order' => array (
						'Product.update_datetime' => 'DESC' 
				),
				'recursive' => 0,
				'limit' => ADMIN_PAGE_LIMIT_COMM 
		);
		return $conditions;
	}
	
	/**
	 * 検索用の関連商品番号文字列を作成
	 */
	function __getRelationProductCdString($strProductCds) {
		$unique_product_cds = array ();
		$productCds = "";
		foreach ( explode ( ',', $strProductCds ) as $key => $value ) {
			if (empty ( $value )) {
				continue;
			}
			
			if (in_array ( trim ( $value ), $unique_product_cds )) {
				continue;
			}
			$unique_product_cds [] = trim ( $value );
			
			if (! empty ( $productCds )) {
				$productCds .= ",";
			}
			$productCds .= "'{$value}'";
		}
		return $productCds;
	}
	
	function __loadPaging($productCds, &$ret = array()) {
		$count = count ( $productCds );
		$pageCount = intval ( ceil ( $count / FRONT_PAGE_LIMIT_COMM ) );
		
		$page = 1;
		if (! empty ( $this->params ['named'] ['page'] )) {
			$page = $this->params ['named'] ['page'];
		}
		if ($page === 'last' || $page >= $pageCount) {
			$page = $pageCount;
		} elseif (intval ( $page ) < 1) {
			$page = 1;
		}
		
		$subProductCds = array_slice ( $productCds, ($page - 1) * FRONT_PAGE_LIMIT_COMM, FRONT_PAGE_LIMIT_COMM );
		$recs = array ();
		if (! empty ( $subProductCds )) {
			$recs = $this->Product->getBaseInfo ( $subProductCds );
			foreach ( $subProductCds as $key => $value ) {
				$productInfo = array ();
				$this->PageSetting->loadProductInfoByObj ( $productInfo, $recs [$value] );
				$ret [] = $productInfo;
			}
		}
		
		$paging = array (
				'page' => $page,
				'current' => count ( $recs ),
				'count' => $count,
				'prevPage' => ($page > 1),
				'nextPage' => ($count > ($page * FRONT_PAGE_LIMIT_COMM)),
				'pageCount' => $pageCount,
				'defaults' => array (
						'limit' => FRONT_PAGE_LIMIT_COMM,
						'step' => 1 
				),
				'options' => array (
						'limit' => FRONT_PAGE_LIMIT_COMM 
				) 
		);
		$this->params ['paging'] ['Product'] = $paging;
	}
	
	/**
	 * バナー情報を取得
	 */
	function __loadBannerList($type) {
		$conditions = array (
				'conditions' => array (
						'Banner.type =' => $type,
						'Banner.del_flg =' => ACTIVE_FLG_FALSE 
				),
				'recursive' => 0 
		);
		$this->loadModel ( 'Banner' );
		$rec = $this->Banner->find ( 'first', $conditions );
		$bannerList = objectToArray ( json_decode ( $rec ['Banner'] ['content'] ) );
		$this->set ( 'bannerList', $bannerList );
	}
	
	function __getDeliveryDay(&$productInfo, $subScriptStatus) {
		$xmlObj = @simplexml_load_file ( CONFIGS . 'delivery_day.xml' );
		$xmlArr = objectToArray ( $xmlObj );
		
		foreach ( $xmlArr ['productType'] as $key => $value ) {
			if ($value ['@attributes'] ['value'] == strtolower ( $productInfo ['Product'] ['product_type'] )) {
				break;
			}
		}
		$deliveryDay = '';
		if ($subScriptStatus || ($subScriptStatus === null && $productInfo ['StockInfo'] ['count'] > 0)) {
			$stockType = 'hasStock';
		} else {
			$stockType = 'noStock';
		}
		foreach ( $value [$stockType] ['deliveryDay'] as $k => $v ) {
			if ($v ['@attributes'] ['saleStatus'] == strtolower ( $productInfo ['Product'] ['sales_status'] )) {
				$deliveryDay = $v ['@attributes'] ['value'];
				break;
			}
		}
		
		if ($productInfo ['Product'] ['product_type'] == PRODUCT_TYPE_NO_LIMIT && $productInfo ['Product'] ['sales_status'] == PRODUCT_SALES_STATUS_NORMAL) {
			$deliveryDay = sprintf ( $deliveryDay, $productInfo ['Product'] ['default_stock_leadtime'], $productInfo ['Product'] ['default_stock_leadtime'] + 2 );
		} else if ($productInfo ['Product'] ['product_type'] == PRODUCT_TYPE_RESERVATION && in_array ( $productInfo ['Product'] ['sales_status'], array (
				PRODUCT_SALES_STATUS_NORMAL,
				PRODUCT_SALES_STATUS_STOCK_ONLY,
				PRODUCT_SALES_STATUS_WILL_END_SELLING 
		) )) {
			$deliveryDay = sprintf ( $deliveryDay, $subScriptStatus [$productInfo ['Product'] ['product_cd']] ['shipping_plan_date'] );
		}
		return $deliveryDay;
	}
}
?>