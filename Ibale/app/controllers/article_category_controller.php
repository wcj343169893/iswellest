<?php
class ArticleCategoryController extends AppController {
    var $name       = 'ArticleCategory';
    var $uses       = array('Article','ArticleCategory');
    var $components = array('Query');
    var $helpers    = array('AppSession', 'Paginator');

    /**
     * 情報一覧
     */
    function admin_index() {
        $this->layout = "admin";
        $recs = $this->ArticleCategory->getList();
        $this->set('articleCategoryList', $recs);

        $category1List = $this->ArticleCategory->getCategory1OptionList();
        $category2List = array();
        $this->set('category1List', $category1List);
        $this->set('category2List', $category2List);

        $this->render('admin_index');
    }

    /**
     * カテゴリ１を追加
     */
    function admin_add_category1() {
        $this->layout = "admin";
        $this->data['ArticleCategory']['name'] = '';
        if (!empty($this->data['ArticleCategory']['category1_name'])) {
            $this->data['ArticleCategory']['name'] = $this->data['ArticleCategory']['category1_name'];
        }
        $errMsg = $this->ArticleCategory->invalidFields(array(), $this->data);
        $invalid = false;
        //名前をチェック
        if (empty($errMsg['name'])) {
            $invalid |= $this->__isExistsArticleCategoryName();
        }
        if (!empty($errMsg) || $invalid) {
            $this->admin_index();
            return;
        }

        $maxOrderNumber = $this->ArticleCategory->getMaxOrderNumber();
        $userId = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $updateData = $this->data['ArticleCategory'];
        $updateData['order_number']    = $maxOrderNumber + 1;
        $updateData['create_user']     = $userId;
        $updateData['create_datetime'] = 'NOW()';
        $updateData['update_user']     = $userId;
        $updateData['update_datetime'] = 'NOW()';
        $this->ArticleCategory->save($updateData);

        $this->redirect('/admin/ArticleCategory/');
    }

    /**
     * カテゴリ２を追加
     */
    function admin_add_category2() {
        Configure::write('debug', 0);
        $this->layout = 'empty';

        unset($this->params['url']['url']);
        if (empty($this->params['url'])) {
            die();
        }

        $valid = true;
        $getData = $this->params['url'];

        $errMsg = $this->ArticleCategory->invalidFields(array(), $getData);
        $checkData = array(
                            'fieldValue'=>$getData['name'],
                            'associateKeyValue'=>$getData['parent_id'],
        );
        $isExists = $this->ArticleCategory->isExists($checkData);

        if ($isExists) {
            $errMsg['name'] = __('error.isExists', true);
            $valid = false;
        }
        $updateData = array();
        if ($valid && empty($errMsg)) {
            $userId     = $this->Session->read($this->AppAuth->sessionKey.'.id');
            $updateData = $getData;
            $updateData['create_user']     = $userId;
            $updateData['create_datetime'] = 'NOW()';
            $updateData['update_user']     = $userId;
            $updateData['update_datetime'] = 'NOW()';
            $this->ArticleCategory->save($updateData, false);
            $updateData['id'] = $this->ArticleCategory->getLastInsertID();
        }
        if (!empty($errMsg)) {
            $valid = false;
            $errMsg = str_replace("{0}", '分类名称', $errMsg['name']);
            $updateData = '';
        } else {
            $errMsg = '';
        }
        $this->set('success'   , $valid);
        $this->set('errMsg'    , $errMsg);
        $this->set('result'    , $updateData);
        $this->render('add_category2');
    }

    /**
     * 情報IDより情報を削除
     */
    function admin_delete() {
        if (empty($this->data['ArticleCategory']['id'])) {
            $this->redirect('/admin/ArticleCategory/');
            return;
        }
        $updateUserId  = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $updateData['del_flg']         = ACTIVE_FLG_TRUE;
        $updateData['update_user']     = $updateUserId;
        $updateData['update_datetime'] = 'NOW()';
        $updateData['delete_user']     = $updateUserId;
        $updateData['delete_datetime'] = 'NOW()';

        $conditions['OR']['ArticleCategory.id'] = $this->data['ArticleCategory']['id'];
        $conditions['OR']['ArticleCategory.parent_id'] = $this->data['ArticleCategory']['id'];

        $this->ArticleCategory->updateAll($updateData, $conditions);

        $this->redirect('/admin/ArticleCategory/index/current_parent_id:'.$this->data['ArticleCategory']['parent_id']);
    }

    /**
     * 記事のカテゴリを変更
     */
    function admin_change_article_category() {
        if (empty($this->data['ArticleCategory']['category2_id'])) {
            $this->redirect('/admin/ArticleCategory/');
            return;
        }

        $conditions['category_id']     = $this->data['ArticleCategory']['id'];
        $updateUserId                  = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $updateData['category_id']     = $this->data['ArticleCategory']['category2_id'];
        $updateData['update_user']     = $updateUserId;
        $updateData['update_datetime'] = 'NOW()';
        $this->Article->updateAll($updateData, $conditions);

        $this->redirect('/admin/ArticleCategory/');
    }

    /**
     * 順番が存在かどうかことをチェック
     * @return boolean
     */
    function __isExsitsSortNumber() {
        $conditions = array(
                        'conditions' => array(
                                        'order_number' => $this->data['ArticleCategory']['order_number'],
                                        'del_flg'        => ACTIVE_FLG_FALSE,
                        ),
                        'recursive'  => 0,
        );
        $recs = $this->ArticleCategory->find('all', $conditions);
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
    function __isExistsArticleCategoryName() {
        $checkData['pKeyName'] = 'id';
        $checkData['pKeyValue'] = null;
        $checkData['fieldName'] = 'name';
        $checkData['fieldValue'] = $this->data['ArticleCategory']['name'];
        $ret = $this->ArticleCategory->isExists($checkData);
        if ($ret) {
            $this->Session->setFlash(str_replace('{0}', '名称', __('error.isExists', true)), 'default', null, 'nameIsExists');
            return true;
        }
        return false;
    }
}
?>
