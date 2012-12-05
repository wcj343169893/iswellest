<?php
class AddressController extends AppController {
    var $name       = 'Address';
    var $uses       = array('Member', 'Address', 'Area');
    var $components = array('Email');
    var $helpers    = array('AppSession', 'Number', 'Paginator');

    function beforeFilter() {
        $this->AppAuth->allowedActions = array();
        parent::beforeFilter();
    }

    /**
     * 注文一覧画面
     */
    function index() {
        $this->layout = 'front';
        $memberInfo = $this->Session->read($this->AppAuth->sessionKey);
        $addressList = $memberInfo['sendto_addresses'];
        $this->set('addressList', $addressList);
        //エリアリスト
        $this->CommFuncs->initAreaList();
        $this->Area->getAllOptionList($areaList);
        $this->set('areaList', $areaList);

        $this->data['Address']['referer'] = 'index';

        $this->render('list');
    }

    /**
     * アドレス編集画面
     */
    function edit($layout = '', $render = '') {
        $this->layout = !empty($layout)?$layout:'front';
        $id = $this->__checkAddressId();

        $memberInfo = $this->Session->read($this->AppAuth->sessionKey);
        $this->data['Address'] = $memberInfo['sendto_addresses'][$id];
        $this->data['Address']['id']      = $id;
        $this->data['Address']['referer'] = 'edit';

        //エリアリスト
        $this->CommFuncs->initAreaList();
        $this->Area->getAllOptionList($areaList);
        $this->set('areaList', $areaList);

        $this->render(!empty($render)?$render:'edit');
    }

    /**
     * アドレスを更新
     */
    function update_address() {
        if (empty($this->data)) {
            $this->redirect(HTTPS_HOME_PAGE_URL.'/address/list');
            return;
        }
        $valid = true;
        $errMsg = $this->Address->invalidFields(array(), $this->data);
        $this->CommFuncs->validAddress('Address');
        if (!empty($this->Address->validationErrors)) {
            $valid &= false;
        }
        if (!$valid) {
            $this->index();
            return;
        }
        $this->__updateAddress();

        $this->redirect(HTTPS_HOME_PAGE_URL.'/address/list');
    }

    /**
     * Enter description here ...
     */
    function edit_for_shopping_payment() {
        $this->layout = 'ajax';

        //配送先を取得
        $addressList = $this->Session->read($this->AppAuth->sessionKey.'.sendto_addresses');
        $this->set('addressList', $addressList);

        //エリアリスト
        $this->CommFuncs->initAreaList();

        $this->render('/elements/shopping/address_list');
    }

    function edit_address_for_shopping_payment() {
        $this->layout = 'ajax';
        //エリアリスト
        $this->CommFuncs->initAreaList();

        if (!isset($this->params['named']['id'])) {
            $this->set('formAction', HTTPS_HOME_PAGE_URL.'/address/ajax_update_address');
            $this->render('/elements/address/edit');
            return;
        }

        $this->set('mode', 'Edit');
        $this->set('formAction', HTTPS_HOME_PAGE_URL.'/address/ajax_update_address');
        $this->edit('ajax', '/elements/address/edit');

    }

    /**
     * アドレスを更新
     */
    function ajax_update_address() {
        $this->layout = 'ajax';
        if (empty($this->data)) {
            exit();
        }
        $this->data['Shopping']['address'] = $this->data['Address']['address'];

        $valid = true;
        $errMsg = $this->Address->invalidFields(array(), $this->data);
        $this->CommFuncs->validAddress('Address');
        if (!empty($this->Address->validationErrors)) {
            $valid &= false;
        }
        if (!$valid) {
            $this->set('invalid', true);
            $this->action = 'edit_for_shopping_payment';
            $this->edit_for_shopping_payment();
            return;
        }
        $this->__updateAddress();
        unset($this->data['Address']);

        //配送先を取得
        $addressList = $this->Session->read($this->AppAuth->sessionKey.'.sendto_addresses');
        $this->set('addressList', $addressList);
        //エリアリスト
        $this->CommFuncs->initAreaList();

        $this->set('invalid', false);
        $this->data['Address']['referer'] = 'list';

        $this->render('/elements/shopping/address_list');
    }

    function ajax_delete() {
        $this->layout = 'ajax';
        if (!isset($this->params['named']['id'])) {
            exit();
        }
        $memberInfo = $this->Session->read($this->AppAuth->sessionKey);
        $id = $this->params['named']['id'];
        unset($memberInfo['sendto_addresses'][$id]);
        relocateArrKey($memberInfo['sendto_addresses']);
        $this->Address->save($memberInfo);

        //アドレス情報を再取得
        $memberInfo = $this->Member->getCustomerInfo($memberInfo['id']);
        $this->Session->write($this->AppAuth->sessionKey, $memberInfo);

        //配送先を取得
        $addressList = $this->Session->read($this->AppAuth->sessionKey.'.sendto_addresses');
        $this->set('addressList', $addressList);

        //エリアリスト
        $this->CommFuncs->initAreaList();

        $this->render('/elements/shopping/address_list');
    }

    /**
     * アドレスを削除
     */
    function delete() {
        $id = $this->__checkAddressId();
        $memberInfo = $this->Session->read($this->AppAuth->sessionKey);

        unset($memberInfo['sendto_addresses'][$id]);
        $tmpSendtoAddress = $memberInfo['sendto_addresses'];
        $memberInfo['sendto_addresses'] = array();
        foreach($tmpSendtoAddress as $value) {
            $memberInfo['sendto_addresses'][] = $value;
        }
        $this->Address->save($memberInfo);

        //アドレス情報を再取得
        $memberInfo = $this->Member->getCustomerInfo($memberInfo['id']);

        $this->Session->write($this->AppAuth->sessionKey, $memberInfo);

        $this->redirect(HTTPS_HOME_PAGE_URL.'/address/list');
    }

    /**
     * アドレスのキーをチェック
     */
    function __checkAddressId() {
        if (!isset($this->params['named']['id']) || '' === $this->params['named']['id']) {
            $this->redirect(HTTPS_HOME_PAGE_URL.'/address/list');
            exit();
        }

        $id = $this->params['named']['id'];
        $memberInfo = $this->Session->read($this->AppAuth->sessionKey);
        if (!isset($memberInfo['sendto_addresses'][$id])) {
            $this->redirect(HTTPS_HOME_PAGE_URL.'/address/list');
            exit();
        }
        return $id;
    }

    function __updateAddress() {
        $memberInfo = $this->Session->read($this->AppAuth->sessionKey);
        unset($this->data['Address']['update_flg']);
        //タイトル
        $updateData             = $this->data['Address'];
        $updateData['title']    = $updateData['address1'].'-'.$updateData['address2'].'-'.$updateData['address3'].'-'.$updateData['address4'];
        $updateData['address2'] = ($updateData['address2'] == 'other')?$updateData['address2_other']:$updateData['address2'];
        $updateData['address3'] = ($updateData['address3'] == 'other')?$updateData['address3_other']:$updateData['address3'];

        //アドレスのキー
        if ('' != ($this->data['Address']['id'])) {
            $memberInfo['sendto_addresses'][$this->data['Address']['id']] = $updateData;
        } else {
            $updateData['id'] = getMaxValue($memberInfo['sendto_addresses'], 'id') + 1;
            $memberInfo['sendto_addresses'][] = $updateData;
        }
        $this->Address->save($memberInfo);

        //アドレス情報を再取得
        $memberInfo = $this->Member->getCustomerInfo($memberInfo['id']);
        $this->Session->write($this->AppAuth->sessionKey, $memberInfo);
    }
}
?>