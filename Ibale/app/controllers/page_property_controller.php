<?php
class PagePropertyController extends AppController {
    var $name       = 'PageProperty';
    var $uses       = array('PageProperty');
    var $components = array('Query');
    var $helpers    = array('AppSession');

    /**
     * 一覧画面
     */
    function admin_index() {
        $this->layout = "admin";
        $recs = $this->PageProperty->getList();
        $this->set('propertyList', $recs);
        $this->render('admin_index');
    }

    /**
     * 情報を追加
     */
    function admin_add() {
        $this->layout = "admin";

        $errMsg = $this->PageProperty->invalidFields(array(), $this->data);
        $invalid = false;

        //名前をチェック
        if (empty($errMsg['name'])) {
            $invalid |= $this->__isExistsPagePropertyName();
        }
        //順番をチェック
        if (empty($errMsg['order_number'])) {
            //$invalid = $this->__isExsitsSortNumber();
        }
        if (!empty($errMsg) || $invalid) {
            $this->admin_index();
            return;
        }
        
        $userId = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $updateData = $this->data['PageProperty'];
        $updateData['create_user']     = $userId;
        $updateData['create_datetime'] = 'NOW()';
        $updateData['update_user']     = $userId;
        $updateData['update_datetime'] = 'NOW()';
        $this->PageProperty->save($updateData);
        
        $this->redirect('/admin/page_property/');
    }

    /**
     * 情報を削除
     */
    function admin_delete() {
        if (empty($this->data['PageProperty']['id'])) {
            $this->redirect('/admin/page_property/');
            return;
        }

        $updateUserId  = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $updateData['id']              = $this->data['PageProperty']['id'];
        $updateData['del_flg']         = ACTIVE_FLG_TRUE;
        $updateData['update_user']     = $updateUserId;
        $updateData['update_datetime'] = 'NOW()';
        $updateData['delete_user']     = $updateUserId;
        $updateData['delete_datetime'] = 'NOW()';
        $this->PageProperty->save($updateData, false);

        $this->redirect('/admin/page_property/');
    }

    /**
     * 順番が存在かどうかことをチェック
     * @return boolean
     */
    function __isExsitsSortNumber() {
        $conditions = array(
                        'conditions' => array(
                                        'order_number' => $this->data['PageProperty']['order_number'],
                                        'type'         => $this->data['PageProperty']['type'],
                                        'del_flg'      => ACTIVE_FLG_FALSE,
                        ),
                        'recursive'  => 0,
        );
        $recs = $this->PageProperty->find('all', $conditions);
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
    function __isExistsPagePropertyName() {
        $checkData['pKeyName']          = 'id';
        $checkData['pKeyValue']         = null;
        $checkData['fieldName']         = 'name';
        $checkData['fieldValue']        = $this->data['PageProperty']['name'];
        $checkData['associateKeyName']  = 'type';
        $checkData['associateKeyValue'] = $this->data['PageProperty']['type'];
        $ret = $this->PageProperty->isExists($checkData);
        if ($ret) {
            $this->Session->setFlash(str_replace('{0}', '名称', __('error.isExists', true)), 'default', null, 'nameIsExists');
            return true;
        }
        return false;
    }
}
?>