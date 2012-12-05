<?php
class CategoryTopController extends AppController {
    var $name        = 'CategoryTop';
    var $uses        = array('CategoryTop','Category','Brand','Product');
    var $components  = array('Query', 'PageSetting');
    var $helpers     = array('AppSession', 'Paginator','AppNumber','Cache');

    function beforeFilter() {
        $this->AppAuth->allowedActions = array(
                                                'index',
                                                //'cached_keywords',
        );

        parent::beforeFilter();
    }

    /**
     * カテゴリトップ画面を初期化
     */
    function index() {
        $this->layout = 'front';

        if (empty($this->params['named']['id'])) {
            $this->redirect('/');
            return;
        }
        $this->data['CategoryTop']['id'] = $this->params['named']['id'];
        //ページ設定内容を取得
        $this->__loadCategoryTopContent();

        if(empty($this->data['CategoryTop']['name'])) {
            $this->redirect('/');
            return;
        }

        //ブランドリストを取得
        $brandList = array();
        if (!empty($this->data['CategoryTop']['brand'])) {
            foreach($this->data['CategoryTop']['brand'] as $value) {
                $brandIds[] = $value['id'];
            }
            $brandList = $this->Brand->getList($brandIds, 1);
        }
        $this->set('brandList', $brandList);

        //商品情報を取得
        $this->__loadProductInfos();
        
        $this->__loadRankingProduct();

        $this->render('index');
    }

    /**
     * 情報一覧
     */
    function admin_index() {
        $this->layout = 'admin';
        $dataList = $this->CategoryTop->getList(false);
        $this->set('dataList', $dataList);
        $this->render('admin_index');
    }

    /**
     * 情報を追加
     */
    function admin_add() {
        $this->layout = "admin";

        $errMsg = $this->CategoryTop->invalidFields(array(), $this->data);
        $invalid = false;

        //名前をチェック
        if (empty($errMsg['name'])) {
            $invalid |= $this->__isExistsCategoryTopName();
        }
        if (!empty($errMsg) || $invalid) {
            $this->admin_index();
            return;
        }
        $maxOrderNumber = $this->CategoryTop->getMaxOrderNumber();
        $userId = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $updateData = $this->data['CategoryTop'];
        $updateData['order_number']    = $maxOrderNumber + 1;
        $updateData['type']            = PAGE_SETTING_TYPE_CATEGORY_TOP;
        $updateData['active_flg']      = ACTIVE_FLG_FALSE;
        $updateData['create_user']     = $userId;
        $updateData['create_datetime'] = 'NOW()';
        $updateData['update_user']     = $userId;
        $updateData['update_datetime'] = 'NOW()';
        $this->CategoryTop->save($updateData);

        $this->redirect('/admin/category_top/');
    }

    /**
     * 情報IDより情報を削除
     */
    function admin_delete() {
        if (empty($this->data['CategoryTop']['id'])) {
            $this->redirect('/admin/category_top/');
            return;
        }

        $updateUserId  = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $updateData['id']              = $this->data['CategoryTop']['id'];
        $updateData['del_flg']         = ACTIVE_FLG_TRUE;
        $updateData['update_user']     = $updateUserId;
        $updateData['update_datetime'] = 'NOW()';
        $updateData['delete_user']     = $updateUserId;
        $updateData['delete_datetime'] = 'NOW()';
        $this->CategoryTop->save($updateData, false);

        $this->redirect($this->referer());
    }

    /**
     * ページ設定内容編集画面を初期化
     */
    function admin_edit() {
        $this->layout = 'admin';
        if (empty($this->data['CategoryTop']['id'])) {
            $this->redirect('/admin/category_top/');
            return;
        }
        if (empty($this->data['CategoryTop']['mode'])) {
            $this->__loadCategoryTopContent();
        }

        $category1List = $this->Category->getOptionList();
        $category2List = array();
        $this->set('category1List', $category1List);
        if (!empty($this->data['CategoryTop']['category1_id'])) {
            $category2List = $this->Category->getOptionList($this->data['CategoryTop']['category1_id']);
        }
        $this->set('category2List', $category2List);

        if (!empty($this->data['CategoryTop']['category_product'])) {
            foreach($this->data['CategoryTop']['category_product'] as $key => $value) {
                if (!empty($value['category1_id'])) {
                    $this->data['CategoryTop']['category_product'][$key]['Category2List'] = $this->Category->getOptionList($value['category1_id']);;
                }
                if (!empty($value['category2_id'])) {
                    $this->data['CategoryTop']['category_product'][$key]['Category3List'] = $this->Category->getOptionList($value['category2_id']);;
                }
            }
        }

        //ブランドリストを取得
        $brandList = $this->Brand->getList();
        $this->set('brandList', $brandList);

        //ブランド名前を取得
        if (!empty($this->data['CategoryTop']['brand'])) {
            foreach($this->data['CategoryTop']['brand'] as $key => $value) {
                $this->data['CategoryTop']['brand'][$key]['brand_name'] = $brandList[$value['id']]['Brand']['brand_name'];
            }
        }
        //商品情報を取得
        $this->__loadProductInfos();

        $this->set('pageSettingType', $this->name);

        $this->render('admin_edit');
    }

    /**
     * ページ設定内容をDBに保存
     */
    function admin_edit_comp() {
        $this->layout = "admin";

        $valid = $this->__validateContent();
        if (!$valid) {
            $this->admin_edit();
            return;
        }

        //カテゴリ商品を順番で保存
        $categoryProducts = $this->data['CategoryTop']['category_product'];
        unset($this->data['CategoryTop']['category_product']);
        foreach($categoryProducts as $key => $value) {
            $this->data['CategoryTop']['category_product'][$value['order_number']-1] = $value;
        }

        $userId = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $updateData['id']              = $this->data['CategoryTop']['id'];
        $updateData['name']            = $this->data['CategoryTop']['name'];
        $updateData['type']            = PAGE_SETTING_TYPE_CATEGORY_TOP;
        $updateData['active_flg']      = ACTIVE_FLG_TRUE;
        $updateData['content']         = json_encode($this->data['CategoryTop']);
        $updateData['create_user']     = $userId;
        $updateData['create_datetime'] = 'NOW()';
        $updateData['update_user']     = $userId;
        $updateData['update_datetime'] = 'NOW()';
        $this->CategoryTop->save($updateData, false);

        //$this->Session->setFlash(__('info.updateSuccess', true), 'default', null, 'categoryTopUpdateSuccess');

        $this->redirect('/admin/category_top/');
    }

    /**
     * カテゴリトップ名前が存在かどうかことをチェック
     * @param unknown_type $data
     * @return boolean
     */
    function __isExistsCategoryTopName() {
        $checkData['pKeyName'] = 'id';
        $checkData['pKeyValue'] = $this->data['CategoryTop']['id'];
        $checkData['fieldName'] = 'name';
        $checkData['fieldValue'] = $this->data['CategoryTop']['name'];
        $ret = $this->CategoryTop->isExists($checkData);
        if ($ret) {
            $this->Session->setFlash(str_replace('{0}', '频道名称', __('error.isExists', true)), 'default', null, 'nameIsExists');
            return true;
        }
        return false;
    }

    /**
     * ページ設定内容を取得
     */
    function __loadCategoryTopContent() {
        $conditions = array(
                        'conditions'    => array(
                                            'CategoryTop.id ='      => $this->data['CategoryTop']['id'],
                                            'CategoryTop.del_flg =' => ACTIVE_FLG_FALSE,
                        ),
                        'recursive'     => 0,
        );
        $rec = $this->CategoryTop->find('first', $conditions);
        $content = $rec['CategoryTop']['content'];

        $this->data = $rec;
        if (!empty($content)) {
            $this->data['CategoryTop'] = array_merge($this->data['CategoryTop'], objectToArray(json_decode($content)));
        }
    }



    /**
     * 該当編集画面に関す商品情報を取得
     */
    function __loadProductInfos() {
        $productCds = array();
        //新しい商品
        $this->PageSetting->loadProductCdsByType('new_product', $productCds);
        //ホット商品
        $this->PageSetting->loadProductCdsByType('hot_product', $productCds);
        //カテゴリ関連商品
        $this->PageSetting->loadProductCdsByType('category_product', $productCds);

        if (empty($productCds)) {
            return;
        }

        $productInfos = $this->Product->getBaseInfo($productCds);

        //会員ランク
        $memberRank = '';
        if ($this->Session->check('Auth.Member')) {
            $memberRank = strtolower($this->Session->read('Auth.Member.customer_rank'));
        } else {
            $memberRank = strtolower(CUSTOMER_RANK_NORMAL);
        }

        //新しい商品
        $this->PageSetting->loadProductInfosByType('new_product', $productInfos);
        //ホット商品
        $this->PageSetting->loadProductInfosByType('hot_product', $productInfos);
        //カテゴリ関連商品
        $this->PageSetting->loadProductInfosByType('category_product', $productInfos);
    }

    /**
     * ランキング商品リストを作成
     */
    function __loadRankingProduct() {
        $this->PageSetting->loadRankingProductByType('hot_product');
        $this->PageSetting->loadRankingProductByType('new_product');
    }

    /**
     * 編集内容を検証
     * @return boolean
     */
    function __validateContent() {
        $valid = true;
        $errMsg = $this->CategoryTop->invalidFields(array(), $this->data);
        if (!empty($errMsg)) {
            $validErrors = $errMsg;
            $valid &= false;
        }
        //名前をチェック
        if (empty($validErrors['name'])) {
            $valid &= !$this->__isExistsCategoryTopName();

        }

        //フォーカス画像をチェック
        if (!empty($this->data['CategoryTop']['focus_pic'])) {
            foreach($this->data['CategoryTop']['focus_pic'] as $key => $value) {
                $errMsg = $this->CategoryTop->invalidFields(array(), $value);
                if (!empty($errMsg)) {
                    $validErrors['focus_pic'][$key] = $errMsg;
                    $valid &= false;
                }
            }
        } else {
            $this->Session->setFlash(renderMsg(__('error.required', true),'焦点图'), 'default', null, 'focusPicRequired');
            $valid &= false;
        }

        //新商品をチェック
        if (!empty($this->data['CategoryTop']['new_product'])) {
            $validErrors['new_product'] = array();
            $valid &= $this->PageSetting->checkProductCdByType('new_product', null, false, $validErrors['new_product']);
        }

        //ホット商品をチェック
        if (!empty($this->data['CategoryTop']['hot_product'])) {
            $validErrors['hot_product'] = array();
            $valid &= $this->PageSetting->checkProductCdByType('hot_product', null, false, $validErrors['hot_product']);
        }

        //ブランドをチェック
        if (empty($this->data['CategoryTop']['brand'])) {
            $this->Session->setFlash(renderMsg(__('error.required', true),'品牌滚动栏'), 'default', null, 'brandRequired');
            $valid &= false;
        }

        //カテゴリ商品をチェック
        $category3Ids = array();
        if (!empty($this->data['CategoryTop']['category_product'])) {
            foreach($this->data['CategoryTop']['category_product'] as $k => $v) {
                $validErrors['category_product'][$k] = $this->CategoryTop->invalidFields(array(), $v);
                if (!empty($validErrors['category_product'][$k])) {
                    $valid = false;
                }
                //カテゴリ重複性チェック
                if (!in_array($v['category3_id'], $category3Ids)) {
                    $category3Ids[] = $v['category3_id'];
                } else {
                    $validErrors['category_product'][$k]['category3_id'] = __('error.isDuplicate', true);
                    $valid = false;
                }

                //カテゴリ関連商品をチェック
                $valid &= $this->PageSetting->checkProductCdByType('category_product', $k, true, $validErrors['category_product'][$k]['product']);
                //右側広告項目をチェック
                foreach($v['right_ad'] as $key => $value) {
                    $errMsg = $this->CategoryTop->invalidFields(array(), $value);
                    if (!empty($errMsg)) {
                        $validErrors['category_product'][$k]['right_ad'][$key] = $errMsg;
                        $valid &= false;
                    }
                }
                //左側広告項目をチェック
                $errMsg = $this->CategoryTop->invalidFields(array(), $v['leftmain_ad']);
                if (!empty($errMsg)) {
                    $validErrors['category_product'][$k]['leftmain_ad'] = $errMsg;
                    $valid &= false;
                }
            }
        } else {
            $this->Session->setFlash(renderMsg(__('error.required', true),'分类商品栏'), 'default', null, 'categoryProductRequired');
            $valid &= false;
        }

        //左側広告をチェック
        if (!empty($this->data['CategoryTop']['left_ad'])) {
            foreach($this->data['CategoryTop']['left_ad'] as $key => $value) {
                $errMsg = $this->CategoryTop->invalidFields(array(), $value);
                if (!empty($errMsg)) {
                    $validErrors['left_ad'][$key] = $errMsg;
                    $valid &= false;
                }
            }
        } else {
            $this->Session->setFlash(renderMsg(__('error.required', true),'左侧广告栏'), 'default', null, 'leftAdRequired');
            $valid &= false;
        }

        $this->CategoryTop->validationErrors = $validErrors;
        if (!$valid) {
            return false;
        }
        return true;
    }
}
?>