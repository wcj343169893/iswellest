<?php
/**
 * ファイル名：ajax_controller.php
 * 概要:Ajax控制器
 * 
 * 作成者：shilei
 * 作成日：2012/01/06
 * 変更履歴：
 */
class AjaxController extends AppController {
    var $name    = 'Ajax';
    var $uses    = array();
    var $layout  = 'ajax';
    var $helpers = array('AppNumber', 'AppSession');

    function beforeFilter() {
        $this->AppAuth->allowedActions = array(
                                            'get_article_category1_option_list',
                                            'get_article_category2_option_list',
                                            'get_category_option_list',
                                            'create_focus_template',
                                            'create_category_product_template',
                                            'create_left_ad_template',
                                            'create_active_ad_template',
                                            'create_under_focus_ad_template',
                                            'clear_login_pop_session',
        );
        parent::beforeFilter();
    }

    /**
     * データを更新
     */
    function admin_save_data() {
        Configure::write('debug', 0);
        $this->layout = 'empty';
        $valid = true;

        unset($this->params['url']['url']);

        if (empty($this->params['url']) && empty($this->params['form'])) {
            die();
        }
        if (!empty($this->params['url'])) {
            $getData = $this->params['url'];
        } else if (!empty($this->params['form'])) {
            $getData = $this->params['form'];
        } else {
            die();
        }

        $modelName = $getData['model'];
        $this->loadModel($modelName);

        $validData = array();
        $validData[$modelName][$getData['pKeyName']] = $getData['pKeyValue'];
        $validData[$modelName][$getData['fieldName']] = $getData['fieldValue'];
        $errMsg = $this->{$modelName}->invalidFields(array(), $validData);
        $isExists = false;
        if (!empty($getData['uniqueFunction']) && empty($errMsg[$getData['fieldName']])) {
            $isExists = $this->{$modelName}->{$getData['uniqueFunction']}($getData);
        }
        if ($isExists) {
            $errMsg[$getData['fieldName']] = __('error.isExists', true);
            $valid = false;
        }

        if ($valid && empty($errMsg)) {
            $updateData = array();
            $updateData[$modelName][$getData['pKeyName']] = $getData['pKeyValue'];
            $updateData[$modelName][$getData['fieldName']] = $getData['fieldValue'];
            $this->{$modelName}->save($updateData, false);
        }
        if (!empty($errMsg)) {
            $valid = false;
            $errMsg = str_replace("{0}", $getData['fieldLabel'], $errMsg[$getData['fieldName']]);
        } else {
            $errMsg = '';
        }
        $this->set('id', $getData['pKeyValue']);
        $this->set('fieldName', $getData['fieldName']);
        $this->set('errMsg', $errMsg);
        $this->set('result', $valid);
    }

    /**
     * 順番を更新
     */
    function admin_save_order_number() {
        if (empty($this->params['url']['model']) || empty($this->params['url']['orderNumbers'])) {
            die();
        }
        $modelName = $this->params['url']['model'];
        $this->loadModel($modelName);

        $updateDatas = array();
        foreach($this->params['url']['orderNumbers'] as $key => $value) {
            if ($value == 'undefined') {
                continue;
            }
            $updateData = array();
            $updateData['id'] = $key;
            $updateData['order_number'] = $value;
            $updateDatas[] = $updateData;
        }
        $this->{$modelName}->saveAll($updateDatas);
        die();
    }

    /**
     * * プルダウンーボタン用の子カテゴリのリストを取得
     */
    function get_article_category1_option_list() {
        $this->layout = 'empty';
        $this->loadModel('ArticleCategory');
        $ret = $this->ArticleCategory->getCategory1OptionList();
        $this->set('optionList', $ret);

        $this->render('option_list');
    }

    /**
     * * プルダウンーボタン用の子カテゴリのリストを取得
     */
    function get_article_category2_option_list() {
        $this->layout = 'empty';
        if (empty($this->params['form']['parentId'])) {
            die();
        }

        $parentId = $this->params['form']['parentId'];
        $this->loadModel('ArticleCategory');
        $ret = $this->ArticleCategory->getCategory2OptionList($parentId);
        $this->set('optionList', $ret);

        $this->render('option_list');
    }

    /**
     * 商品カテゴリのOPTIONリストを取得
     */
    function get_category_option_list() {
        Configure::write('debug','0');
        $this->layout = 'empty';
        if (empty($this->params['form']['parentId'])) {
            die();
        }
        $parentId = $this->params['form']['parentId'];
        $this->loadModel('Category');
        $ret = $this->Category->getOptionList($parentId);
        $this->set('optionList', $ret);

        $this->render('option_list');
    }

    /**
     * フォーカス画像用のテンプレートを作成
     */
    function create_focus_template() {
        Configure::write('debug', 0);

        if (!isset($this->params['url']['key']) 
                || !empty($this->params['url']['key']) && !is_numeric($this->params['url']['key'])
                || !isset($this->params['url']['type'])) {
            die();
        }
        $this->set('key', $this->params['url']['key']);

        $type = $this->params['url']['type'];
        $this->set('pageSettingType', $type);

        if ($type == 'BannerProduct' || $type == 'BannerBrand') {
            $this->render('/elements/banner/focus_pic');
        } elseif($type == 'Toppage') {
            $this->render('/elements/toppage/focus_pic');
        } else {
            $this->render('/elements/page_setting/focus_pic');
        }
    }

    /**
     * トップページにACTIVE広告部のテンプレートを作成
     */
    function create_active_ad_template() {
        Configure::write('debug', 0);

        if (!isset($this->params['url']['key']) 
                || !empty($this->params['url']['key']) && !is_numeric($this->params['url']['key'])
                || !isset($this->params['url']['type'])) {
            die();
        }
        $this->set('key', $this->params['url']['key']);

        $type = $this->params['url']['type'];
        $this->set('pageSettingType', $type);

        $this->render('/elements/toppage/active_ad');
    }

    /**
     * カテゴリ関連商品用のテンプレートを作成
     */
    function create_category_product_template() {
        Configure::write('debug', 0);
        $this->layout = 'ajax';

        if (!isset($this->params['url']['key']) 
                || !empty($this->params['url']['key']) && !is_numeric($this->params['url']['key'])
                || !isset($this->params['url']['type'])) {
            die();
        }
        $this->set('key', $this->params['url']['key']);

        $type = $this->params['url']['type'];
        if ($type == 'Toppage') {
            $this->loadModel('Category');
            $category1List = $this->Category->getOptionList();
            $this->set('category1List', $category1List);
            $elementPath = 'toppage';
        } else if ($type == 'CategoryTop') {
            $this->loadModel('Category');
            $category1List = $this->Category->getOptionList();
            $this->set('category1List', $category1List);
            $elementPath = 'category_top';
        } else if ($type == 'GiftTop') {
            $this->loadModel('GiftType');
            $gifTypeList = $this->GiftType->getOptionList();
            $this->set('giftSendToList', $gifTypeList[GIFT_TYPE_SEND_TO]);
            $this->set('giftSendDateList', $gifTypeList[GIFT_TYPE_SEND_DATE]);
            $elementPath = 'gift_top';
        }
        $this->set('pageSettingType', $type);

        $this->render("/elements/{$elementPath}/category_product");
    }

    /**
     * 左広告画像用のテンプレートを作成
     */
    function create_left_ad_template() {
        Configure::write('debug', 0);

        if (!isset($this->params['url']['key']) 
                || !empty($this->params['url']['key']) && !is_numeric($this->params['url']['key'])
                || !isset($this->params['url']['type'])) {
            die();
        }
        $this->set('key', $this->params['url']['key']);

        $type = $this->params['url']['type'];
        $this->set('pageSettingType', $type);
        if ($type == 'CategoryTop' || $type == 'GiftTop') {
            $this->render('/elements/category_top/left_ad');
        } else {
            $this->render('/elements/page_setting/left_ad');
        }
    }

    /**
     * ログイン必要なデータをセッションから削除
     */
    function clear_login_pop_session() {
        Configure::write('debug', 0);
        if (!isset($this->params['url']['location'])) {
            die();
        }

        if ($this->params['url']['location'] == 'GiftTop') {
            $this->Session->delete('Front.GiftTop.SendMail.data');
        } elseif ($this->params['url']['location'] == 'Enquiry') {
            $this->Session->delete('Front.Product.Enquiry.data');
        }
        die();
    }
}
?>