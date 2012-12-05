<?php
class BannerController extends AppController {
    var $name       = 'Banner';
    var $uses       = array('Banner','GiftType','Category','Brand','Product');
    var $components = array('Query', 'PageSetting');
    var $helpers    = array('AppSession', 'Paginator','AppNumber');
    var $types      = array(PAGE_SETTING_TYPE_BRAND_TOP_BANNER => 'Brand', PAGE_SETTING_TYPE_PRODUCT_LIST_BANNER => 'Product');

    function beforeFilter() {
        parent::beforeFilter();
    }

    /**
     * ページ設定内容編集画面を初期化
     */
    function admin_edit() {
        $this->layout = 'admin';
        if (empty($this->data['Banner']['mode'])) {
            $this->__loadBannerContent();
        }

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
        $type = $this->data['Banner']['type'];
        $userId = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $updateData['id']              = !empty($this->data['Banner'.$type]['id'])?$this->data['Banner'.$type]['id']:'';
        $updateData['name']            = __('label.Banner', true);
        $updateData['type']            = array_search($type, $this->types);
        $updateData['order_number']    = 1;
        $updateData['content']         = json_encode($this->data['Banner'.$type]);
        if (empty($this->data['Banner'.$type]['id'])) {
            $updateData['create_user']     = $userId;
            $updateData['create_datetime'] = 'NOW()';
        }
        $updateData['update_user']     = $userId;
        $updateData['update_datetime'] = 'NOW()';
        $this->Banner->save($updateData,false);

        $this->Session->setFlash(__('info.updateSuccess', true), 'default', null, 'bannerUpdateSuccess');
        $this->redirect('/admin/banner/edit');
    }

    /**
     * ページ設定内容を取得
     */
    function __loadBannerContent() {
        $recs = $this->Banner->getList();
        
        if (empty($recs)) {
            return array();
        }
        foreach($recs as $key => $rec) {
            $type = $this->types[$rec['Banner']['type']];
            $content = $rec['Banner']['content'];
    
            $this->data['Banner'.$type] = $rec['Banner'];
            if (!empty($content)) {
                $this->data['Banner'.$type] = array_merge($this->data['Banner'.$type], objectToArray(json_decode($content)));
            }
            $this->data['Banner'.$type]['id'] = $rec['Banner']['id'];
        }
    }

    /**
     * 編集内容を検証
     * @return boolean
     */
    function __validateContent() {
        $valid = true;
        $validErrors = array();
        $type = $this->data['Banner']['type'];
        if (!empty($this->data['Banner'.$type]['focus_pic'])) {
            //フォーカス画像をチェック
            foreach($this->data['Banner'.$type]['focus_pic'] as $key => $value) {
                $errMsg = $this->Banner->invalidFields(array(), $value);
                if (!empty($errMsg)) {
                    $validErrors['Banner'.$type]['focus_pic'][$key] = $errMsg;
                    $valid &= false;
                }
            }
        } else {
            $this->Session->setFlash(renderMsg(__('error.required', true),'焦点图'), 'default', null, 'Banner'.$type.'focusPicRequired');
            $valid &= false;
        }

        $this->Banner->validationErrors = $validErrors;
        if (!$valid) {
            return false;
        }
        return true;
    }
}
?>