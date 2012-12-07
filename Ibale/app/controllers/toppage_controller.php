<?php
class ToppageController extends AppController {
	var $name = 'Toppage';
	var $uses = array (
			'Toppage',
			'Category',
			'Brand',
			'Article',
			'Ad',
			'StoreRank',
			'UserHistory',
			'Product' 
	);
	var $components = array (
			'Query',
			'PageSetting' 
	);
	var $helpers = array (
			'AppSession',
			'Paginator',
			'AppNumber' 
	);
	
	function beforeFilter() {
		$this->AppAuth->allowedActions = array (
				'index',
				'cached_keywords',
				'cached_friendlink',
				'cached_headerlink',
				'cached_copyright',
				'cached_category_tag',
				'ranking_products' 
		);
		parent::beforeFilter ();
	}
	/**
	 *
	 * @todo 首页
	 *      
	 */
	function index() {
		$this->layout = 'front';
		
		$this->__loadToppageContent ();
		$this->__loadToppageData ();
		
		// $this->__loadRankingProduct ();
		// 查询最新上架产品
		$this->__loadNewestProduct ();
		// 猜你喜欢
		$this->__loadRandomProduct ();
		// 限时抢购
		$this->__loadLimitbuy ();
		// 新闻与公告
		$this->__loadArticle ();
		// 推荐品牌
		$this->__loadBrand ();
		// 首页分类处广告
		$this->__loadAd ();
		// 首页实体店排行
		$this->__loadStoreRank ();
		// 如果用户已经登录，则查询此用户浏览记录
// 		$login_user = $this->AppAuth->user ();
// 		if ($login_user) {
		$login_user["id"]=1;
			$this->__loadHistory ( $login_user );
// 		}
		$this->render ( 'index' );
	}
	
	/**
	 * ページ設定内容編集画面を初期化
	 */
	function admin_edit() {
		$this->layout = 'admin';
		
// 		if (empty ( $this->data ['Toppage'] ['mode'] )) {
			$this->__loadToppageContent ();
// 		}
		$this->__loadToppageData ();
		
		$this->set ( 'pageSettingType', $this->name );
		
		$this->render ( 'admin_edit' );
	}
	
	/**
	 * ページ設定内容をDBに保存
	 */
	function admin_edit_comp() {
		$this->layout = "admin";
		
		$valid = $this->__validateContent ();
		if (! $valid) {
			$this->admin_edit ();
			return;
		}
		// カテゴリ商品を順番で保存
		$categoryProducts = $this->data ['Toppage'] ['category_product'];
		unset ( $this->data ['Toppage'] ['category_product'] );
		foreach ( $categoryProducts as $key => $value ) {
			$this->data ['Toppage'] ['category_product'] [$value ['order_number'] - 1] = $value;
		}
		$userId = $this->Session->read ( $this->AppAuth->sessionKey . '.id' );
		$updateData ['id'] = $this->data ['Toppage'] ['id'];
		$updateData ['name'] = __ ( 'label.toppage', true );
		$updateData ['type'] = PAGE_SETTING_TYPE_TOP;
		$updateData ['order_number'] = 1;
		$updateData ['content'] = json_encode ( $this->data ['Toppage'] );
		if (empty ( $this->data ['Toppage'] ['id'] )) {
			$updateData ['create_user'] = $userId;
			$updateData ['create_datetime'] = 'NOW()';
		}
		$updateData ['update_user'] = $userId;
		$updateData ['update_datetime'] = 'NOW()';
		$this->Toppage->save ( $updateData, false );
		
		$this->Session->setFlash ( __ ( 'info.updateSuccess', true ), 'default', null, 'ToppageUpdateSuccess' );
		
		$this->redirect ( '/admin/toppage/edit' );
	}
	
	/**
	 * キャッチキーワード
	 *
	 * @return multitype:
	 */
	function cached_category_tag() {
		$this->loadModel ( 'CategoryTop' );
		$recs = $this->CategoryTop->getList ();
		if (empty ( $recs )) {
			return array ();
		}
		foreach ( $recs as $key => $value ) {
			$dataList [$key] ['id'] = $value ['CategoryTop'] ['id'];
			$dataList [$key] ['name'] = $value ['CategoryTop'] ['name'];
		}
		return $dataList;
	}
	
	/**
	 * キャッチキーワード
	 *
	 * @return multitype:
	 */
	function cached_keywords() {
		$this->__loadToppageContent ();
		
		if (! empty ( $this->data ['Toppage'] ['keywords'] )) {
			return $keywords = explode ( ' ', $this->data ['Toppage'] ['keywords'] );
		} else {
			return array ();
		}
	}
	
	/**
	 * 友達リンク情報を作成
	 */
	function cached_friendlink() {
		$this->loadModel ( 'PageFriendlink' );
		$recs = $this->PageFriendlink->getList ();
		return $recs;
	}
	
	/**
	 * ヘッダーのリンクを作成
	 */
	function cached_headerlink() {
		$this->loadModel ( 'PageProperty' );
		$recs = $this->PageProperty->getList ();
		return $recs [PAGE_PROPERTY_HEADER];
	}
	
	/**
	 * copyrightを作成
	 */
	function cached_copyright() {
		$this->loadModel ( 'PageProperty' );
		$recs = $this->PageProperty->getList ();
		return $recs [PAGE_PROPERTY_FOOTER];
	}
	
	/**
	 * ランキング商品情報を取得
	 */
	function ranking_products() {
		$this->__loadToppageContent ();
		$this->__loadToppageData ();
		
		$this->__loadRankingProduct ();
		
		$this->render ( '/product/ranking_products' );
	}
	/**
	 *
	 * @todo 加载用户历史浏览记录
	 *      
	 */
	function __loadHistory($login_user = null) {
		$options = array (
				"conditions" => array (
						"UserHistory.user_id" => $login_user ["id"] 
				),
				"limit" => 50,
				"fields" => array (
						"UserHistory.id",
						"UserHistory.product_cd" 
				),
				"order" => array (
						"UserHistory.id" => "DESC" 
				) 
		);
		$userHistorys = $this->UserHistory->find ( "all", $options );
		$productCds = array ();
		$data = array ();
		if (! empty ( $userHistorys )) {
			foreach ( $userHistorys as $k => $v ) {
				$data [$k] = $v ["UserHistory"];
				array_push ( $productCds, trim ( $v ["UserHistory"] ["product_cd"] ) );
			}
		}
		// $productInfos = $this->Product->getBaseInfo ( $productCds );
		
		$products = $this->Product->find ( "all", array (
				"conditions" => array (
						'Product.delete_datetime IS NULL',
						'Product.pub_flg' => 1,
						'Product.product_cd' => $productCds 
				),
				"limit" => 50,
				"order" => array (
						"Product.product_cd" => "DESC" 
				),
				"fields" => array (
						"Product.product_cd",
						"Product.product_name",
						"Product.retail_price",
						"Product.price_for_normal",
						"Product.brand_id" 
				) 
		) );
		$this->__makeProduct ( $products, "userHistorys" );
	}
	/**
	 *
	 * @todo 实体店销售排行
	 *      
	 */
	function __loadStoreRank() {
		$options = array (
				"conditions" => array (
						"StoreRank.pub_flg" => 1,
						"StoreRank.delete_datetime is null" 
				),
				"limit" => 6,
				"fields" => array (
						"StoreRank.id",
						"StoreRank.name",
						"StoreRank.counts",
						"StoreRank.url" 
				),
				"order" => array (
						"StoreRank.counts" => "DESC",
						"StoreRank.id" => "DESC" 
				) 
		);
		$storeRanks = $this->StoreRank->find ( "all", $options );
		$data = array ();
		if (! empty ( $storeRanks )) {
			foreach ( $storeRanks as $k => $v ) {
				$data [$k] = $v ["StoreRank"];
			}
		}
		$this->data ['Toppage'] ["storeRanks"] = $data;
	}
	/**
	 *
	 * @todo 广告
	 *      
	 */
	function __loadAd() {
		// Ad
		$options = array (
				"conditions" => array (
						"Ad.pub_flg" => 1,
						"Ad.delete_datetime is null" 
				),
				"limit" => 10,
				"fields" => array (
						"Ad.id",
						"Ad.pic_url",
						"Ad.memo",
						"Ad.link_url" 
				),
				"order" => array (
						"Ad.position" => "DESC",
						"Ad.id" => "DESC" 
				) 
		);
		$ads = $this->Ad->find ( "all", $options );
		$data = array ();
		if (! empty ( $ads )) {
			foreach ( $ads as $k => $v ) {
				$data [$k] = $v ["Ad"];
			}
		}
		$this->data ['Toppage'] ["category_ads"] = $data;
		// echo json_encode ( $data );
		// exit ();
	}
	/**
	 *
	 * @todo 推荐品牌
	 *      
	 */
	function __loadBrand() {
		// Brand
		$options = array (
				"conditions" => array (
						"Brand.is_recommend" => 1,
						"Brand.delete_datetime is null" 
				),
				"limit" => 40,
				"fields" => array (
						"Brand.id",
						"Brand.brand_name" 
				),
				"order" => array (
						"Brand.id" => "DESC" 
				) 
		);
		$brands = $this->Brand->find ( "all", $options );
		$data = array ();
		// 处理结果集
		if (! empty ( $brands )) {
			foreach ( $brands as $k => $v ) {
				$data [$k] = $v ["Brand"];
				if ($v ["BrandPhoto"]) {
					$data [$k] ["photo_url"] = empty($v ["BrandPhoto"] [0] ["url"])?"/image/front/none_90.jpg":$v ["BrandPhoto"] [0] ["url"];
					$data [$k] ["photo_memo"] = empty($v ["BrandPhoto"] [0] ["memo"])?$v ["Brand"]["brand_name"]:$v ["BrandPhoto"] [0] ["memo"];
				}else{
					$data [$k] ["photo_url"] = "/image/front/none_90.jpg";
					$data [$k] ["photo_memo"] =$v ["Brand"]["brand_name"];
				}
			}
		}
		$this->data ['Toppage'] ["brands"] = $data;
	}
	/**
	 *
	 * @todo 查询新闻公告(推荐文章)
	 *      
	 */
	function __loadArticle() {
		// 查询一条图文
		$options = array (
				"conditions" => array (
						"Article.is_recommend" => 1,
						"Article.pic_url is not null" 
				),
				"fields" => array (
						"Article.id",
						"Article.title",
						"Article.category_id",
						"Article.pic_url",
						"ArticleCategory.name" 
				) 
		);
		$pic_article = $this->Article->find ( "first", $options );
		$article_1 = $pic_article ["Article"];
		$article_1 ["categoryname"] = $pic_article ["ArticleCategory"] ["name"];
// 		echo json_encode($article_1);
// 		exit();
		// 三条文字
		$options = array (
				"conditions" => array (
						"Article.is_recommend" => 1,
						"Article.id <>" => $pic_article ["Article"] ["id"] 
				),
				"fields" => array (
						"Article.id",
						"Article.title",
						"Article.category_id",
						"ArticleCategory.name" 
				),
				"limit" => 3 
		);
		$words_article = $this->Article->find ( "all", $options );
		$out_article = array ();
		foreach ( $words_article as $k => $v ) {
			$out_article [$k] = $v ["Article"];
			$out_article [$k] ["categoryname"] = $v ["ArticleCategory"] ["name"];
		}
		// echo json_ENCODE($OUT_ARTICLE);
		// EXIT();
		$this->data ['Toppage'] ["pic_article"] = $article_1;
		$this->data ['Toppage'] ["words_article"] = $out_article;
	}
	/**
	 *
	 * @todo 查询最新产品
	 */
	function __loadNewestProduct() {
		$products = $this->Product->find ( "all", array (
				"conditions" => array (
						'Product.delete_datetime IS NULL',
						'Product.pub_flg' => 1 
				),
				"limit" => "5",
				"order" => array (
						"Product.product_cd" => "DESC" 
				),
				"fields" => array (
						"Product.product_cd",
						"Product.product_name",
						"Product.retail_price",
						"Product.price_for_normal",
						"Product.brand_id" 
				) 
		) );
		$this->__makeProduct ( $products, "newest_product" );
	}
	/**
	 *
	 * @todo 限时抢购
	 *      
	 */
	function __loadLimitbuy() {
		// 查询最近正在进行中的sale_rule
		$products = array ();
		$ruleIds = array ();
		$rules = array ();
		$conditions = array (
				'conditions' => array (
						'sale_end_datetime >= NOW()',
						'sale_start_datetime <= NOW()',
						'delete_datetime IS NULL' 
				),
				'order' => array (
						'update_datetime' => 'DESC' 
				),
				'recursive' => '0' 
		);
		$saleRuleModel = ClassRegistry::init ( 'SaleRule' );
		$recs = $saleRuleModel->find ( 'all', $conditions );
		if (! empty ( $recs )) {
			$saleProductModel = ClassRegistry::init ( 'SaleProduct' );
			foreach ( $recs as $k => $v ) {
				array_push ( $ruleIds, $v ["SaleRule"] ["id"] );
				$rules [$v ["SaleRule"] ["id"]] = $v ["SaleRule"];
			}
			// 查询产品编号
			$saleProduct = $saleProductModel->getListByRule ( $ruleIds );
			$pro_ids = array ();
			foreach ( $saleProduct as $k => $v ) {
				array_push ( $pro_ids, $v ["SaleProduct"] ["product_cd"] );
			}
			// 查询产品详细
			$products = $this->Product->find ( "all", array (
					"conditions" => array (
							'Product.delete_datetime IS NULL',
							'Product.pub_flg' => 1,
							'Product.product_cd' => $pro_ids 
					),
					"limit" => "5",
					"order" => array (
							"Product.product_cd" => "DESC" 
					),
					"fields" => array (
							"Product.product_cd",
							"Product.product_name",
							"Product.retail_price",
							"Product.price_for_normal",
							"Product.brand_id" 
					) 
			) );
			$this->__makeProduct ( $products, "limit_buy_product" );
		}
	}
	/**
	 *
	 * @todo 随机查询5条结果
	 *      
	 */
	function __loadRandomProduct() {
		$products = $this->Product->find ( "all", array (
				"conditions" => array (
						'Product.delete_datetime IS NULL',
						'Product.pub_flg' => 1 
				),
				"limit" => "5",
				"order" => array (
						"random()" 
				),
				"fields" => array (
						"Product.product_cd",
						"Product.product_name",
						"Product.retail_price",
						"Product.price_for_normal",
						"Product.brand_id" 
				) 
		) );
		$this->__makeProduct ( $products, "random_product" );
	}
	/**
	 *
	 * @todo 处理结果集
	 *      
	 */
	function __makeProduct($data = array(), $outName = "") {
		$result = array ();
		// 处理结果集
		foreach ( $data as $k => $v ) {
			$pro = $v ["Product"];
			// 查询品牌
			if ($v ["Product"] ["brand_id"]) {
				$brank = $this->Brand->find ( "first", array (
						"conditions" => array (
								"Brand.id" => $v ["Product"] ["brand_id"] 
						) 
				) );
				$pro ["brank_name"] = $brank ["Brand"] ["brand_name"];
				$pro ["brank_id"] = $brank ["Brand"] ["id"];
			}
			//处理价格
			$pro["sale_price"]=$v["Product"]["price_for_normal"];
			// 处理图片
			if (! empty ( $v ["ProductPhoto"] )) {
				$pro ["product_pic_url"] = $v ["ProductPhoto"] [0] ["url"];
			}
			$result [] = $pro;
			unset ( $brank );
		}
		unset ( $data );
		$this->data ['Toppage'] [$outName] = $result;
	}
	/**
	 * ページ設定内容を取得
	 */
	function __loadToppageContent() {
		$path = "toppage_loadToppageContent_data";
		$this->data = readCache ( $path );
		if (empty ( $this->data )) {
			$rec = $this->Toppage->getInfo ();
			$content = $rec ['Toppage'] ['content'];
			$this->data = $rec;
			if (! empty ( $content )) {
				$this->data ['Toppage'] = array_merge ( $this->data ['Toppage'], objectToArray ( json_decode ( $content ) ) );
			}
			writeCache ( $this->data, $path );
		}
		
		// $this->data ['Toppage'] ['id'] = $rec ['Toppage'] ['id'];
	}
	
	/**
	 * ページ表示内容を設定
	 */
	function __loadToppageData() {
		//冗余代码
		if (! isset ( $this->viewVars ['categoryAllOptionList'] )) {
			$categoryAllList = $this->Category->getAllOptionList ();
			// 获取所有分类
			$this->set ( 'categoryAllOptionList', $categoryAllList );
		} else {
			$categoryAllList = $this->viewVars ['categoryAllOptionList'];
		}
		$category2List = array ();
		$this->set ( 'category1List', $categoryAllList ['level_1'] );
		if (! empty ( $this->data ['Toppage'] ['category1_id'] )) {
			$category2List = $categoryAllList ['level_2'] [$this->data ['Toppage'] ['category1_id']];
		}
		$this->set ( 'category2List', $category2List );
		// $this->data['Toppage']['category_product']这个已经构造好了首页数据，只是还没有分类信息
		// echo json_encode($this->data['Toppage']['category_product']);
		// exit();
		$path = "toppage_loadToppageData_category_product";
		$category_product = readCache ( $path );
		if (empty ( $category_product )) {
			if (! empty ( $this->data ['Toppage'] ['category_product'] )) {
				foreach ( $this->data ['Toppage'] ['category_product'] as $key => $value ) {
					if (! empty ( $value ['category1_id'] )) {
						$this->data ['Toppage'] ['category_product'] [$key] ['Category2List'] = $categoryAllList ['level_2'] [$value ['category1_id']];
					}
					if (! empty ( $value ['category2_id'] )) {
						$this->data ['Toppage'] ['category_product'] [$key] ['Category3List'] = $categoryAllList ['level_3'] [$value ['category2_id']];
					}
					// @todo 查询分类下的排行榜
					$this->data ['Toppage'] ['category_product'] [$key] ['rank_product'] = array ();
				}
			}
			// echo json_encode($this->data['Toppage']['category_product']);
			// exit();
			
			// 商品情報を取得
			$this->__loadProductInfos ();
			writeCache ( $this->data ['Toppage'] ['category_product'], $path );
		} else {
			$this->data ['Toppage'] ['category_product'] = $category_product;
		}
	}
	
	/**
	 * 該当編集画面に関す商品情報を取得
	 */
	function __loadProductInfos() {
		$productCds = array ();
		
		// カテゴリ商品番号
		$this->PageSetting->loadProductCdsByType ( 'category_product', $productCds );
		// ホット売り商品番号
		// $this->PageSetting->loadProductCdsByType ( 'hot_sale_product',
		// $productCds );
		// // OTC商品番号
		// $this->PageSetting->loadProductCdsByType ( 'otc_product', $productCds
		// );
		// // ホット問い合わせ商品番号
		// $this->PageSetting->loadProductCdsByType ( 'hot_enquiry_product',
		// $productCds );
		
		// 商品情報を取得
		$productInfos = $this->Product->getBaseInfo ( $productCds );
		
		// 会員ランク
		// $memberRank = '';
		// if ($this->Session->check ( 'Auth.Member' )) {
		// $memberRank = strtolower ( $this->Session->read (
		// 'Auth.Member.customer_rank' ) );
		// } else {
		// $memberRank = strtolower ( CUSTOMER_RANK_NORMAL );
		// }
		
		// カテゴリ関連商品
		$this->PageSetting->loadProductInfosByType ( 'category_product', $productInfos );
		// ホット売り商品
		// $this->PageSetting->loadProductInfosByType ( 'hot_sale_product',
		// $productInfos );
		// // OTC商品
		// $this->PageSetting->loadProductInfosByType ( 'otc_product',
		// $productInfos );
		// // ホット問い合わせ商品
		// $this->PageSetting->loadProductInfosByType ( 'hot_enquiry_product',
		// $productInfos );
	}
	
	/**
	 * 編集内容を検証
	 *
	 * @return boolean
	 */
	function __validateContent() {
		$valid = true;
		$errMsg = $this->Toppage->invalidFields ( array (), $this->data );
		if (! empty ( $errMsg )) {
			$validErrors = $errMsg;
			$valid &= false;
		}
		// フォーカス画像をチェック
		if (! empty ( $this->data ['Toppage'] ['focus_pic'] )) {
			foreach ( $this->data ['Toppage'] ['focus_pic'] as $key => $value ) {
				$errMsg = $this->Toppage->invalidFields ( array (), $value );
				if (! empty ( $errMsg )) {
					$validErrors ['focus_pic'] [$key] = $errMsg;
					$valid &= false;
				}
			}
		} else {
			$this->Session->setFlash ( renderMsg ( __ ( 'error.required', true ), '焦点图' ), 'default', null, 'focusPicRequired' );
			$valid &= false;
		}
		// フォーカス下部の広告をチェック
		// $underFocusAdIsEmpty = true;
		foreach ( $this->data ['Toppage'] ['under_focus_ad'] as $key => $value ) {
			// if (empty($value['path']) && empty($value['url']) &&
			// empty($value['comment'])) {
			// continue;
			// }
			// $underFocusAdIsEmpty = false;
			$errMsg = $this->Toppage->invalidFields ( array (), $value );
			if (! empty ( $errMsg )) {
				$validErrors ['under_focus_ad'] [$key] = $errMsg;
				$valid &= false;
			}
		}
		// if ($underFocusAdIsEmpty) {
		// $this->Session->setFlash(renderMsg(__('error.required',
		// true),'焦点图文下方广告位'), 'default', null, 'underFocusAdRequired');
		// $valid &= false;
		// }
		
		// カテゴリ商品をチェック
		$category3Ids = array ();
		if (! empty ( $this->data ['Toppage'] ['category_product'] )) {
			foreach ( $this->data ['Toppage'] ['category_product'] as $k => $v ) {
				
				$validErrors ['category_product'] [$k] = $this->Toppage->invalidFields ( array (), $v );
				if (! empty ( $validErrors ['category_product'] [$k] )) {
					$valid = false;
				}
				// カテゴリ重複性チェック
				if (! in_array ( $v ['category3_id'], $category3Ids )) {
					$category3Ids [] = $v ['category3_id'];
				} else {
					$validErrors ['category_product'] [$k] ['category3_id'] = __ ( 'error.isDuplicate', true );
					$valid = false;
				}
				
				// カテゴリ関連商品をチェック
				$valid &= $this->PageSetting->checkProductCdByType ( 'category_product', $k, true, $validErrors ['category_product'] [$k] ['product'] );
				// 右側広告項目をチェック
				foreach ( $v ['right_ad'] as $key => $value ) {
					$errMsg = $this->Toppage->invalidFields ( array (), $value );
					if (! empty ( $errMsg )) {
						$validErrors ['category_product'] [$k] ['right_ad'] [$key] = $errMsg;
						$valid &= false;
					}
				}
				// 左側広告項目をチェック
				$errMsg = $this->Toppage->invalidFields ( array (), $v ['leftmain_ad'] );
				if (! empty ( $errMsg )) {
					$validErrors ['category_product'] [$k] ['leftmain_ad'] = $errMsg;
					$valid &= false;
				}
			}
		} else {
			$this->Session->setFlash ( renderMsg ( __ ( 'error.required', true ), '分类商品栏' ), 'default', null, 'categoryProductRequired' );
			$valid &= false;
		}
		
		// 活动広告をチェック
		if (! empty ( $this->data ['Toppage'] ['active_ad'] )) {
			foreach ( $this->data ['Toppage'] ['active_ad'] as $key => $value ) {
				$errMsg = $this->Toppage->invalidFields ( array (), $value );
				if (! empty ( $errMsg )) {
					$validErrors ['active_ad'] [$key] = $errMsg;
					$valid &= false;
				}
			}
		} else {
			$this->Session->setFlash ( renderMsg ( __ ( 'error.required', true ), '活动广告栏' ), 'default', null, 'activeAdRequired' );
			$valid &= false;
		}
		
		// ホット売り商品をチェック
		if (! empty ( $this->data ['Toppage'] ['hot_sale_product'] )) {
			$validErrors ['hot_sale_product'] = array ();
			$valid &= $this->PageSetting->checkProductCdByType ( 'hot_sale_product', null, false, $validErrors ['hot_sale_product'] );
		}
		// OTC商品をチェック
		if (! empty ( $this->data ['Toppage'] ['otc_product'] )) {
			$validErrors ['otc_product'] = array ();
			$valid &= $this->PageSetting->checkProductCdByType ( 'otc_product', null, false, $validErrors ['otc_product'] );
		}
		// ホット問い合わせ商品をチェック
		if (! empty ( $this->data ['Toppage'] ['hot_enquiry_product'] )) {
			$validErrors ['hot_enquiry_product'] = array ();
			$valid &= $this->PageSetting->checkProductCdByType ( 'hot_enquiry_product', null, false, $validErrors ['hot_enquiry_product'] );
		}
		
		$this->Toppage->validationErrors = $validErrors;
		if (! $valid) {
			return false;
		}
		return true;
	}
	
	/**
	 * ランキング商品リストを作成
	 */
	function __loadRankingProduct() {
		$this->PageSetting->loadRankingProductByType ( 'hot_sale_product' );
		$this->PageSetting->loadRankingProductByType ( 'otc_product', true );
		$this->PageSetting->loadRankingProductByType ( 'hot_enquiry_product' );
	}
}
?>
