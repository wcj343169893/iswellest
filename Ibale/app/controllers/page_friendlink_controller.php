<?php
class PageFriendlinkController extends AppController {
    var $name       = 'PageFriendlink';
    var $uses       = array('PageFriendlink');
    var $components = array('Query');
    var $helpers    = array('AppSession', 'Paginator');
    
    /**
     * 情報一覧
     */
    function admin_index() {
        $this->layout = "admin";
        $conditions = array(
                        'conditions'    => array(
                                            'del_flg ='     => ACTIVE_FLG_FALSE,
                        ),
                        'order'         => array(
                                            'order_number'  => 'ASC',
                        ),
                        'limit'         => ADMIN_PAGE_LIMIT_COMM,
        );
        $this->paginate = $conditions;
        $this->set('friendlinkList', $this->paginate());
        $this->loadBackListReferer();

        $this->render('admin_index');
    }

    /**
     * 情報を追加
     */
    function admin_add() {
        $this->layout = "admin";

        $errMsg = $this->PageFriendlink->invalidFields(array(), $this->data);
        $valid = true;

        //名前をチェック
        if (empty($errMsg['name'])) {
            $valid = !$this->__isExistsPageFriendlinkName();
        }

        if (!empty($errMsg) || !$valid) {
            $this->admin_index();
            return;
        }

        $maxOrderNumber = $this->PageFriendlink->getMaxOrderNumber();
        $userId = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $updateData = $this->data['PageFriendlink'];
        $updateData['order_number']    = ($maxOrderNumber + 1 < 1000)?$maxOrderNumber + 1:$maxOrderNumber;
        $updateData['create_user']     = $userId;
        $updateData['create_datetime'] = 'NOW()';
        $updateData['update_user']     = $userId;
        $updateData['update_datetime'] = 'NOW()';

        $this->PageFriendlink->save($updateData);
        if (!empty($this->PageFriendlink->validationErrors)) {
            $this->admin_index();
            return;
        }

        $this->redirect('/admin/page_friendlink/');
    }

    /**
     * 情報IDより情報を削除
     */
    function admin_delete() {
        if (empty($this->data['PageFriendlink']['id'])) {
            $this->redirect('/admin/page_friendlink/');
            return;
        }

        $updateUserId  = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $updateData['id']              = $this->data['PageFriendlink']['id'];
        $updateData['del_flg']         = ACTIVE_FLG_TRUE;
        $updateData['update_user']     = $updateUserId;
        $updateData['update_datetime'] = 'NOW()';
        $updateData['delete_user']     = $updateUserId;
        $updateData['delete_datetime'] = 'NOW()';
        $this->PageFriendlink->save($updateData, false);

        $this->redirect($this->referer());
    }

    /**
     * 選択した情報を削除
     */
    function admin_delete_selected() {
        if (empty($this->data['PageFriendlink']['selectedId'])) {
            $this->redirect('/admin/page_friendlink/');
            return;
        }

        $conditions = array();
        foreach($this->data['PageFriendlink']['selectedId'] as $key => $value) {
            if ($value == ACTIVE_FLG_TRUE) {
                $conditions['id'][] = $key;
            }
        }

        if (empty($conditions)) {
            $this->redirect('/admin/page_friendlink/');
            return;
        }
        $updateData    = array();
        $updateUserId  = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $updateData['del_flg']         = ACTIVE_FLG_TRUE;
        $updateData['update_user']     = $updateUserId;
        $updateData['update_datetime'] = 'NOW()';
        $updateData['delete_user']     = $updateUserId;
        $updateData['delete_datetime'] = 'NOW()';
        $this->PageFriendlink->updateAll($updateData, $conditions);

        $this->redirect($this->getBackListReferer());
    }

    /**
     * 順番が存在かどうかことをチェック
     * @return boolean
     */
    function __isExsitsSortNumber() {
        $conditions = array(
                        'conditions' => array(
                                        'order_number' => $this->data['PageFriendlink']['order_number'],
                                        'del_flg'        => ACTIVE_FLG_FALSE,
                        ),
                        'recursive'  => 0,
        );
        $recs = $this->PageFriendlink->find('all', $conditions);
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
    function __isExistsPageFriendlinkName() {
        $checkData['pKeyName']   = 'id';
        $checkData['pKeyValue']  = null;
        $checkData['fieldName']  = 'name';
        $checkData['fieldValue'] = $this->data['PageFriendlink']['name'];
        $ret = $this->PageFriendlink->isExists($checkData);
        if ($ret) {
            $this->Session->setFlash(str_replace('{0}', '名称', __('error.isExists', true)), 'default', null, 'nameIsExists');
            return true;
        }
        return false;
    }
}
?>