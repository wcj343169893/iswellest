<?php
class GiftTypeController extends AppController {
    var $name       = 'GiftType';
    var $uses       = array('GiftType', 'GiftTop');
    var $components = array('Query');
    var $helpers    = array('AppSession');
    
    /**
     * 一覧画面
     */
    function admin_index() {
        $this->layout = "admin";

        $recs = $this->GiftType->getList();
        $this->set('dataList', $recs);

        $optionList = $this->GiftType->getOptionList();
        $this->set('giftTypeOptionList', $optionList);

        $giftTopInfo = $this->GiftTop->getInfo();
        $giftTopInfo = objectToArray(json_decode($giftTopInfo['GiftTop']['content']));

        $this->set('categoryProductList', $giftTopInfo['category_product']);

        $this->render('admin_index');
    }

    /**
     * 情報を追加
     */
    function admin_add() {
        $this->layout = "admin";

        $errMsg = $this->GiftType->invalidFields(array(), $this->data);
        $valid = true;
        //名前をチェック
        if (empty($errMsg['name'])) {
            $valid &= !$this->__isExistsGiftTypeName();
        }
        if (!empty($errMsg) || !$valid) {
            $this->admin_index();
            return;
        }

        $userId = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $maxOrderNumber = $this->GiftType->getMaxOrderNumber($this->data['GiftType']['type']);
        $updateData = $this->data['GiftType'];
        $updateData['order_number']    = $maxOrderNumber + 1;
        $updateData['create_user']     = $userId;
        $updateData['create_datetime'] = 'NOW()';
        $updateData['update_user']     = $userId;
        $updateData['update_datetime'] = 'NOW()';

        $this->GiftType->save($updateData);
        
        $this->redirect('/admin/gift_type/');
    }

    /**
     * 情報を削除
     */
    function admin_delete() {
        if (empty($this->data['GiftType']['id'])) {
            $this->redirect('/admin/gift_type/');
            return;
        }

        $updateUserId  = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $updateData['id']              = $this->data['GiftType']['id'];
        $updateData['del_flg']         = ACTIVE_FLG_TRUE;
        $updateData['update_user']     = $updateUserId;
        $updateData['update_datetime'] = 'NOW()';
        $updateData['delete_user']     = $updateUserId;
        $updateData['delete_datetime'] = 'NOW()';
        $this->GiftType->save($updateData, false);

        $this->redirect('/admin/gift_type/');
    }

    /**
     * カテゴリ関連商品のギフト種類を変更
     */
    function admin_change_gift_type() {
        $types = array(GIFT_TYPE_SEND_TO=>'gift_send_to',GIFT_TYPE_SEND_DATE=>'gift_send_date');
        if (!isset($types[$this->data['GiftType']['type']])) {
            $this->redirect('/admin/gift_type/');
            return;
        }

        $type      = $types[$this->data['GiftType']['type']];
        $typeIdOrg = $this->data['GiftType']['id'];
        $typeIdNew = $this->data['GiftType']['change_to'];

        $giftTopInfo = $this->GiftTop->getInfo();
        $content = objectToArray(json_decode($giftTopInfo['GiftTop']['content']));
        if (empty($content)) {
            $this->redirect('/admin/gift_type/');
            return;
        }

        foreach($content['category_product'] as $key => $value) {
            if($value[$type] == $typeIdOrg) {
                $content['category_product'][$key][$type] = $typeIdNew;
            }
        }

        $updateUserId  = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $updateData['id']              = $giftTopInfo['GiftTop']['id'];
        $updateData['content']         = json_encode($content);
        $updateData['update_user']     = $updateUserId;
        $updateData['update_datetime'] = 'NOW()';
        $this->GiftTop->save($updateData, false);

        $this->Session->setFlash(__('info.changeGiftTypeSuccess', true), 'default', null, 'changeGiftTypeSuccess');

        $this->redirect('/admin/gift_type/');
    }

    /**
     * 順番が存在かどうかことをチェック
     * @return boolean
     */
    function __isExsitsSortNumber() {
        $conditions = array(
                        'conditions' => array(
                                        'order_number' => $this->data['GiftType']['order_number'],
                                        'type'         => $this->data['GiftType']['type'],
                                        'del_flg'      => ACTIVE_FLG_FALSE,
                        ),
                        'recursive'  => 0,
        );
        $recs = $this->GiftType->find('all', $conditions);
        if (!empty($recs)) {
            $this->Session->setFlash(__('error.orderNumberIsExists', true), 'default', null, 'orderNumberIsExists');
            return true;
        }
        return false;
    }

    /**
     * プロパティ名前が存在かどうかことをチェック
     * @param unknown_type $data
     * @return boolean
     */
    function __isExistsGiftTypeName() {
        $checkData['pKeyName'] = 'id';
        $checkData['pKeyValue'] = null;
        $checkData['fieldName'] = 'name';
        $checkData['fieldValue'] = $this->data['GiftType']['name'];
        $checkData['associateKeyName'] = 'type';
        $checkData['associateKeyValue'] = $this->data['GiftType']['type'];
        $ret = $this->GiftType->isExists($checkData);
        if ($ret) {
            $this->Session->setFlash(str_replace('{0}', '名称', __('error.isExists', true)), 'default', null, 'nameIsExists');
            return true;
        }
        return false;
    }
}
?>