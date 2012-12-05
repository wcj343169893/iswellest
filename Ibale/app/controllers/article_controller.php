<?php
class ArticleController extends AppController {
    var $name       = 'Article';
    var $uses       = array('Article', 'ArticleCategory');
    var $components = array('Query');
    var $helpers    = array('AppSession', 'Paginator', 'Cache');
    var $cacheAction = array(
                        'detail' => array('duration'=> STATIC_PAGE_CACHED_DURATION),
    );

    function beforeFilter() {
        $this->AppAuth->allowedActions = array(
                                                'cached_footer_help',
                                                'detail',
                                                'detail_noformat',
                                                'cached_article_category',
        );
        parent::beforeFilter();
        
    }

    /**
     * フッターのヘルプ
     * @return Ambigous <multitype:, unknown>
     */
    function cached_footer_help() {
        $this->Article->loadArticleSearchDefaultConditions($conditions);
        $conditions['conditions']['ParentArticleCategory.id'] = 1;
        $recs = $this->Article->find('all', $conditions);

        $ret = array();
        foreach($recs as $key => $value) {
            $ret[$value['Article']['category_id']][] = $value;
        }

        return $ret;
    }

    /**
     * 記事詳細
     */
    function detail() {
        $this->layout = 'front';

        $this->__getDetail($rec);
        if (empty($rec)) {
            $this->redirect(HTTP_HOME_PAGE_URL);
            return;
        }
        $this->set('detail', $rec);

        $this->render('detail');
    }

    function detail_noformat() {
        $this->layout = "empty";
        $this->__getDetail($rec);
        return $rec;
    }

    /**
     * 記事詳細画面で表示の種類
     * @return unknown
     */
    function cached_article_category() {
        $parentCategoryId = $this->params['named']['category1_id'];
        $recs = $this->Article->getListByParentCategoryId($parentCategoryId);

        return $recs;
        
    }

    /**
     * 情報一覧
     */
    function admin_index() {
        $this->layout = "admin";
        $this->Article->loadArticleSearchDefaultConditions($conditions);
        $conditions['limit'] = ADMIN_PAGE_LIMIT_COMM;

        $this->paginate = $conditions;
        $this->set('articleList', $this->paginate());
        $this->render('admin_index');
    }

    /**
     * 情報追加画面を初期化
     */
    
    function admin_edit() {
        $this->layout = "admin";

        if (!empty($this->data['Article']['id']) && empty($this->data['Article']['mode'])) {
            $this->data = $this->Article->getInfo($this->data['Article']['id']);
        }
        $this->data['Article']['content'] = stripcslashes($this->data['Article']['content']);
        $category1List = $this->ArticleCategory->getCategory1OptionList();
        $category2List = array();
        $this->set('category1List', $category1List);
        if (!empty($this->data['Article']['category1_id'])) {
            $category2List = $this->ArticleCategory->getCategory2OptionList($this->data['Article']['category1_id']);
        }
        $this->set('category2List', $category2List);

        $this->loadBackListReferer();
        $this->render('admin_edit');
    }

    /**
     * 情報を更新
     */
    function admin_edit_comp() {
        $this->layout = "admin";

        $errMsg = $this->Article->invalidFields(array(), $this->data);
        $invalid = false;
        //名前をチェック
        if (empty($errMsg['name'])) {
            //$invalid |= $this->__isExistsArticleName();
        }
        if (!empty($errMsg) || $invalid) {
            $this->admin_edit();
            return;
        }

        $userId = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $updateData = $this->data['Article'];
        $updateData['category_id']     = $this->data['Article']['category2_id'];
        $updateData['content']         = $this->data['Article']['content'];

        if (empty($this->data['Article']['id'])) {
            $maxOrderNumber = $this->Article->getMaxOrderNumber();
            $updateData['order_number']    = $maxOrderNumber + 1;
        }

        $updateData['create_user']     = $userId;
        $updateData['create_datetime'] = 'NOW()';
        $updateData['update_user']     = $userId;
        $updateData['update_datetime'] = 'NOW()';
        $this->Article->save($updateData);

        $this->redirect($this->getBackListReferer());
    }

    /**
     * 情報IDより情報を削除
     */
    function admin_delete() {
        if (empty($this->data['Article']['id'])) {
            $this->redirect('/admin/article/');
            return;
        }

        $updateUserId  = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $updateData['id']              = $this->data['Article']['id'];
        $updateData['del_flg']         = ACTIVE_FLG_TRUE;
        $updateData['update_user']     = $updateUserId;
        $updateData['update_datetime'] = 'NOW()';
        $updateData['delete_user']     = $updateUserId;
        $updateData['delete_datetime'] = 'NOW()';
        $this->Article->save($updateData, false);

        $this->redirect($this->referer());
    }

    /**
     * 順番が存在かどうかことをチェック
     * @return boolean
     */
    function __isExsitsSortNumber() {
        $conditions = array(
                        'conditions' => array(
                                        'order_number' => $this->data['Article']['order_number'],
                                        'del_flg'        => ACTIVE_FLG_FALSE,
                        ),
                        'recursive'  => 0,
        );
        $recs = $this->Article->find('all', $conditions);
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
    function __isExistsArticleName() {
        $checkData['pKeyName'] = 'id';
        $checkData['pKeyValue'] = null;
        $checkData['fieldName'] = 'name';
        $checkData['fieldValue'] = $this->data['Article']['name'];
        $ret = $this->Article->isExists($checkData);
        if ($ret) {
            $this->Session->setFlash(str_replace('{0}', '名称', __('error.isExists', true)), 'default', null, 'nameIsExists');
            return true;
        }
        return false;
    }

    function __getDetail(&$rec = array()) {
        if (empty($this->params['named']['title']) && empty($this->params['named']['id'])) {
            $this->redirect(HTTP_HOME_PAGE_URL);
            return;
        }

        $id    = !empty($this->params['named']['id'])?$this->params['named']['id']:null;
        $title = null;
        if (!empty($this->params['named']['title']) && base64url_decode($this->params['named']['title'])) {
            $title = base64url_decode($this->params['named']['title']);
        } elseif (!empty($this->params['named']['title'])) {
            $title = $this->params['named']['title'];
        }

        $rec = $this->Article->getInfo($id, $title);
    }
}
?>