<?php
class GiftTopController extends AppController {
    var $name       = 'GiftTop';
    var $uses       = array('GiftTop','GiftType','Category','Brand','Product', 'Member');
    var $components = array('Query', 'PageSetting', 'Email', 'Cookie');
    var $helpers    = array('AppSession', 'Paginator','AppNumber');

    function beforeFilter() {
        $this->AppAuth->allowedActions = array(
                                                'index',
                                                'product_list',
                                                'ajax_send_mail',
                                                //'cached_keywords',
        );
        parent::beforeFilter();
    }

    /**
     * トップページ
     */
    function index() {
        $this->layout = 'front';

        $recs = $this->GiftType->getList();
        $this->set('giftTypeList', $recs);

        $this->__loadGiftTopContent();
        $this->__loadProductInfos();

        //プレゼントの対象と場合を取得
        $this->__getCategoryProductOptions($recs);

        $this->render('index');
    }

    /**
     * 商品一覧
     */
    function product_list() {
        $this->layout = 'front';

        $recs = $this->GiftType->getList();
        $this->set('giftTypeList', $recs);

        $sendTo   = !empty($this->params['named']['gift_send_to'])?$this->params['named']['gift_send_to']:'';
        $sendDate = !empty($this->params['named']['gift_send_date'])?$this->params['named']['gift_send_date']:'';

        $this->__loadGiftTopContent();
        //プレゼントの対象と場合を取得
        $this->__getCategoryProductOptions($recs);

        //商品情報を取得
        $productCds = array();
        foreach($this->data['GiftTop']['category_product'] as $key => $value) {
            if (((!empty($sendTo) && $value['gift_send_to'] == $sendTo)
                    && (!empty($sendDate) && $value['gift_send_date'] == $sendDate))
                    || (empty($sendDate) && !empty($sendTo) && $value['gift_send_to'] == $sendTo)
                    || (empty($sendTo) && !empty($sendDate) && $value['gift_send_date'] == $sendDate)
                    || (empty($sendTo) && empty($sendDate))) {
                foreach($value['product'] as $v) {
                    if (!in_array($v['product_cd'], $productCds)) {
                        $productCds[] = $v['product_cd'];
                    }
                }
            }
        }
        if (empty($this->params['named']['sort_key'])) {
            $this->params['named']['sort_key'] = '2';
        }

        $params = $this->params['named'];
        $params['product_cd'] = $productCds;
        $params['keywords']   = !empty($this->params['named']['keywords'])?$this->params['named']['keywords']:'';
        $this->Product->loadSearchProductCd($params, $this->Session->read('Auth.Member.customer_rank'), $ret);
        $recs = $this->Product->getBaseInfo($ret['product_cd']);

        $dataList = array();
        foreach($ret['product_cd'] as $key => $value) {
            $productInfo = array();
            $this->PageSetting->loadProductInfoByObj($productInfo, $recs[$value]);
            $dataList[$key] = $productInfo;
        }

        $this->set('dataList', $dataList);

        //メールからアクセスする場合
        $ret = $this->__checkSendMailHashCode($memberInfo);
        if ($ret) {
            $giftInfo = $memberInfo;
            $giftInfo['product_cd']           = $productCds;
            $giftInfo['min_price']            = $this->params['named']['min_price'];
            $giftInfo['max_price']            = $this->params['named']['max_price'];
            $giftInfo['receive_person_email'] = $this->params['named']['self'];
            $this->Cookie->write('GiftInfo', json_encode($giftInfo));
        }

        $this->render('list');
    }

    /**
     * メールを送信
     */
    function ajax_send_mail() {
        if (!$this->Session->check($this->AppAuth->sessionKey)) {
            $this->Session->write('Auth.redirect', HTTPS_HOME_PAGE_URL.'/gift_top/');
            $this->Session->write('Front.GiftTop.SendMail.data', $this->params['url']);
            $this->render('/elements/member/login');
            return;
        }
        if (!isset($this->params['url']['email'])) {
            $this->params['url'] = $this->Session->read('Front.GiftTop.SendMail.data');
            $this->Session->delete('Front.GiftTop.SendMail.data');
        }

        $this->__loadGiftTopContent();
        $recs = $this->GiftType->getList();
        //プレゼントの対象と場合を取得
        $this->__getCategoryProductOptions($recs);

        //入力データを検証
        $validData = array();
        $validData['email']     = $this->params['url']['email'];
        $validData['min_price'] = $this->params['url']['min_price'];
        $validData['max_price'] = $this->params['url']['max_price'];
        $errMsg = $this->GiftTop->invalidFields(array(), $validData);
        if (!empty($errMsg)) {
            $this->data['GiftTop'] = $this->params['url'];
            $this->render('/elements/gift_top/send_mail');
            return;
        }

        $data = $this->params['url'];
        $memberInfo = $this->Session->read($this->AppAuth->sessionKey);
        $this->Email->layout   = 'email';
        $this->Email->sendAs   = 'html';
        $this->Email->from     = SITE_ADMIN_EMAIL;
        $this->Email->to       = $data['email'];
        $this->Email->subject  = sprintf(__('mail.subjectForChooseGiftToReceiver', true), __('info.siteNameCN', true), $memberInfo['name']);
        $this->Email->template = 'choose_gift_to_receiver';

        $self = base64url_encode($data['email']);
        $hash = md5($memberInfo['email'].$memberInfo['nickname'].$data['email']);
        $giftSendType = explode('X', $data['gift_send_type']);
        $giftSendType[1] = !empty($giftSendType[1])?$giftSendType[1]:'';
        $url = HTTP_HOME_PAGE_URL."/gift_top/product_list/gift_send_to:{$giftSendType[0]}/gift_send_date:{$giftSendType[1]}/min_price:{$data['min_price']}/max_price:{$data['max_price']}/self:{$self}/ta_id:{$memberInfo['id']}/hash:{$hash}";
        $this->set('url', $url);
        $this->set('mailTo', $data['email']);
        $this->set('memberInfo', $memberInfo);

        $this->Email->send();

        $this->Session->setFlash(sprintf(__('info.sendMailToTASuccess', true), $data['email']), 'default', null, 'sendMailToTASuccess');

        $this->render('/elements/gift_top/send_mail');
    }

    /**
     * ページ設定内容編集画面を初期化
     */
    function admin_edit() {
        $this->layout = 'admin';

        if (empty($this->data['GiftTop']['mode'])) {
            $this->__loadGiftTopContent();
        }

        $gifTypeList = $this->GiftType->getOptionList();
        $this->set('giftSendToList', !empty($gifTypeList[GIFT_TYPE_SEND_TO])?$gifTypeList[GIFT_TYPE_SEND_TO]:array());
        $this->set('giftSendDateList', !empty($gifTypeList[GIFT_TYPE_SEND_DATE])?$gifTypeList[GIFT_TYPE_SEND_DATE]:array());

        if (!empty($this->data['GiftTop']['category_product'])) {
            foreach($this->data['GiftTop']['category_product'] as $key => $value) {
                if (!empty($value['category1_id'])) {
                    $this->data['GiftTop']['category_product'][$key]['Category2List'] = $this->Category->getOptionList($value['category1_id']);;
                }
                if (!empty($value['category2_id'])) {
                    $this->data['GiftTop']['category_product'][$key]['Category3List'] = $this->Category->getOptionList($value['category2_id']);;
                }
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
        $categoryProducts = $this->data['GiftTop']['category_product'];
        unset($this->data['GiftTop']['category_product']);
        foreach($categoryProducts as $key => $value) {
            $this->data['GiftTop']['category_product'][$value['order_number']-1] = $value;
        }

        $userId = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $updateData['id']              = $this->data['GiftTop']['id'];
        $updateData['name']            = __('label.giftTop', true);
        $updateData['type']            = PAGE_SETTING_TYPE_GIFT_TOP;
        $updateData['order_number']    = 1;
        $updateData['content']         = json_encode($this->data['GiftTop']);
        if (empty($this->data['GiftTop']['id'])) {
            $updateData['create_user']     = $userId;
            $updateData['create_datetime'] = 'NOW()';
        }
        $updateData['update_user']     = $userId;
        $updateData['update_datetime'] = 'NOW()';
        $this->GiftTop->save($updateData,false);

        $this->Session->setFlash(__('info.updateSuccess', true), 'default', null, 'giftTopUpdateSuccess');

        $this->redirect('/admin/gift_top/edit');
    }

    /**
     * ページ設定内容を取得
     */
    function __loadGiftTopContent() {
        $rec = $this->GiftTop->getInfo();
        $content = $rec['GiftTop']['content'];

        $this->data = $rec;
        if (!empty($content)) {
            $this->data['GiftTop'] = array_merge($this->data['GiftTop'], objectToArray(json_decode($content)));
        }
        $this->data['GiftTop']['id'] = $rec['GiftTop']['id'];
    }

    /**
     * 該当編集画面に関す商品情報を取得
     */
    function __loadProductInfos() {
        $productCds = array();
        if (!empty($this->data['GiftTop']['category_product'])) {
            foreach($this->data['GiftTop']['category_product'] as $key => $value) {
                foreach($value['product'] as $k => $v) {
                    $productCds[] = $v['product_cd'];
                }
            }
        }

        $productInfos = $this->Product->getBaseInfo($productCds);
        if (!empty($this->data['GiftTop']['category_product'])) {
            foreach($this->data['GiftTop']['category_product'] as $key => $value) {
                foreach($value['product'] as $k => $v) {
                    if (empty($v['product_cd']) || empty($productInfos[$v['product_cd']])) {
                        continue;
                    }
                    $this->PageSetting->loadProductInfoByObj($this->data['GiftTop']['category_product'][$key]['product'][$k], $productInfos[$v['product_cd']]);
                }
            }
        }
    }

    /**
     * 編集内容を検証
     * @return boolean
     */
    function __validateContent() {
        $valid = true;
        $validErrors = array();
        $errMsg = $this->GiftTop->invalidFields(array(), $this->data);
        if (!empty($errMsg)) {
            $validErrors = $errMsg;
            $valid &= false;
        }

        //フォーカス画像をチェック
        if (!empty($this->data['GiftTop']['focus_pic'])) {
            foreach($this->data['GiftTop']['focus_pic'] as $key => $value) {
                $errMsg = $this->GiftTop->invalidFields(array(), $value);
                if (!empty($errMsg)) {
                    $validErrors['focus_pic'][$key] = $errMsg;
                    $valid &= false;
                }
            }
        } else {
            $this->Session->setFlash(renderMsg(__('error.required', true),'焦点图'), 'default', null, 'focusPicRequired');
            $valid &= false;
        }

        //カテゴリ商品をチェック
        $sendList = array();
        if (!empty($this->data['GiftTop']['category_product'])) {
            foreach($this->data['GiftTop']['category_product'] as $k => $v) {
                $validErrors['category_product'][$k] = $this->GiftTop->invalidFields(array(), $v);
                if (!empty($validErrors['category_product'][$k])) {
                    $valid = false;
                }
                //送り場合と送り対象のチェック
                if (!in_array($v['gift_send_to'].'-'.$v['gift_send_date'], $sendList)) {
                    $sendList[] = $v['gift_send_to'].'-'.$v['gift_send_date'];
                } else {
                    $validErrors['category_product'][$k]['gift_send'] = __('error.isDuplicate', true);
                    $valid = false;
                }
                //カテゴリ関連商品をチェック
                $valid &= $this->PageSetting->checkProductCdByType('category_product', $k, true, $validErrors['category_product'][$k]['product']);

                //左側広告項目をチェック
                $errMsg = $this->GiftTop->invalidFields(array(), $v['leftmain_ad']);
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
        if (!empty($this->data['GiftTop']['left_ad'])) {
            foreach($this->data['GiftTop']['left_ad'] as $key => $value) {
                $errMsg = $this->GiftTop->invalidFields(array(), $value);
                if (!empty($errMsg)) {
                    $validErrors['left_ad'][$key] = $errMsg;
                    $valid &= false;
                }
            }
        } else {
            $this->Session->setFlash(renderMsg(__('error.required', true),'左侧广告栏'), 'default', null, 'leftAdRequired');
            $valid &= false;
        }

        $this->GiftTop->validationErrors = $validErrors;
        if (!$valid) {
            return false;
        }
        return true;
    }

    function __checkSendMailHashCode(&$memberInfo = array()) {
        if (empty($this->params['named']['ta_id']) || empty($this->params['named']['self'])) {
            return false;
        }

        $taId = $this->params['named']['ta_id'];
        $self = base64url_decode($this->params['named']['self']);
        $rec = $this->Member->getCustomerInfo($taId);
        if (empty($rec)) {
            return false;
        }

        $hash = md5($rec['email'].$rec['nickname'].$self);
        if (!empty($this->params['named']['hash']) && $this->params['named']['hash'] === $hash) {
            unset($rec['sendto_addresses']);
            $memberInfo = $rec;
            return true;
        }

        return false;
    }

    function __getCategoryProductOptions(&$giftTypeList) {
        $categoryProductOptions = array();
        if (empty($this->data['GiftTop']['category_product'])) {
            $this->set('categoryProductOptions', $categoryProductOptions);
            return;
        }
        foreach($this->data['GiftTop']['category_product'] as $key => $value) {
            $categoryProductOptions[$value['gift_send_to'].'X'.$value['gift_send_date']] = '';
            if (!empty($giftTypeList[GIFT_TYPE_SEND_TO])) {
                foreach($giftTypeList[GIFT_TYPE_SEND_TO] as $k => $v){
                    if ($v['GiftType']['id'] == $value['gift_send_to']){
                        $categoryProductOptions[$value['gift_send_to'].'X'.$value['gift_send_date']] .= $v['GiftType']['name'];
                    }
                }
            }
            if (!empty($giftTypeList[GIFT_TYPE_SEND_DATE])) {
                foreach($giftTypeList[GIFT_TYPE_SEND_DATE] as $k => $v) {
                    if ($v['GiftType']['id'] == $value['gift_send_date']) {
                        $categoryProductOptions[$value['gift_send_to'].'X'.$value['gift_send_date']] .= ' × '.$v['GiftType']['name'];
                    }
                }
            }
        }
        $this->set('categoryProductOptions', $categoryProductOptions);
    }
}
?>