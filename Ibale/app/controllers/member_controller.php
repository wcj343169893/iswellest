<?php
class MemberController extends AppController {
    var $name       = 'Member';
    var $uses       = array('Member', 'Order', 'MemberPhoto', 'Address', 'ProductBookmark');
    var $components = array('CommFuncs', 'Email', 'PageSetting');
    var $helpers    = array('AppSession', 'Number');

    function beforeFilter() {
        $this->AppAuth->allowedActions = array(
                                            'regist',
                                            'regist_confirm',
                                            'regist_complete',
                                            'forget_password',
                                            'send_password_reset_mail',
                                            'forget_password_comp',
                                            'password_reset',
                                            'update_password',
                                            'password_reset_comp',
                                            'show_security_pic',
                                            'login',
                                            'logout',

        );
        parent::beforeFilter();
    }

    /**
     * ログイン画面
     */
    function login() {
        if ($this->Session->check('Auth.Member')) {
            $this->redirect('/member/mypage');
            return;
        }

        $this->layout = 'front';
        $this->render('login');
    }

    /**
     * ログアウト
     */
    function logout() {
        $this->Session->delete('Auth.Member');
        $this->redirect(HTTP_HOME_PAGE_URL);
    }

    /**
     * パスワードを忘れる入力画面
     */
    function forget_password() {
        $this->layout = 'front';

        $this->render('forget_password');
    }

    /**
     * パスワードを忘れるの送信
     */
    function send_password_reset_mail() {
        $this->layout = 'front';

        if (empty($this->data['Member'])) {
            $this->redirect(HTTPS_HOME_PAGE_URL.'/member/forget_password');
            return;
        }

        $valid = true;
        $errMsg = $this->Member->invalidFields(array(), $this->data['Member']);
        if (!empty($errMsg)) {
            $valid &= false;
        }
        if ($valid) {
            $ret = $this->Member->verifyMailAndPhone($this->data['Member']['email'], $this->data['Member']['phone']);
            if (!$ret) {
                $this->Session->setFlash(__('error.memberEmailAndPhoneIsNotExists', true), 'default', null, 'memberEmailAndPhoneIsNotExists');
                $valid &= false;
            }
        }
        if (!$valid) {
            $this->forget_password();
            return;
        }

        //会員情報を取得
        $memberInfo = $this->Member->getCustomerInfo($ret);

        //パスワードを再発行するメールを送信
        $this->__sendMailForPassworReset($memberInfo);

        $this->redirect(HTTPS_HOME_PAGE_URL.'/member/forget_password_comp');
    }

    /**
     * パスワードを忘れるの完了画面
     */
    function forget_password_comp() {
        $this->layout = 'front';
        $this->render('forget_password_comp');
    }
    /**
     * パスワード再発行入力画面
     */
    function password_reset() {
        $this->layout = 'front';

        if (!$this->Session->check($this->AppAuth->sessionKey)) {
            if (!empty($this->data['Member'])) {
                $this->render('password_reset');
                return;
            }
            if ((empty($this->params['named']['hashCode']) 
                    || empty($this->params['named']['case']))) {
                $this->redirect(HTTP_HOME_PAGE_URL.'/');
                return;
            }
    
            //会員情報を取得
            $memberId = $this->params['named']['case'];
            $expired  = $this->params['named']['expired'];
            $hashCode = $this->params['named']['hashCode'];
            $memberInfo = $this->Member->getCustomerInfo(intval($memberId));
            if (empty($hashCode) 
                    || $hashCode != md5($memberInfo['email'].$memberInfo['phone'])
                    || empty($expired) 
                    || base64url_decode($expired) < time()) {
                $this->CakeError('error', array('message' => __('error.systemError', true)));
                return;
            }
        } else {
            $memberInfo = $this->Session->read($this->AppAuth->sessionKey);
        }
        $this->data['Member']['id'] = $memberInfo['id'];

        $this->render('password_reset');
    }
    /**
     * パスワード再発行完了画面
     */
    function update_password() {
        $this->layout = 'front';
        if (empty($this->data)) {
            $this->CakeError('error', array('message' => __('error.systemError', true)));
            return;
        }

        $valid = true;
        $errMsg = $this->Member->invalidFields(array(), $this->data['Member']);
        if (!empty($errMsg)) {
            $valid &= false;
        }

        if (!$valid) {
            $this->password_reset();
            return;
        }

        //会員情報を取得
        $memberId = $this->data['Member']['id'];
        $memberInfo = $this->Member->getCustomerInfo(intval($memberId));
        $updateData = $memberInfo;
        $updateData['password'] = $this->data['Member']['password'];
        $this->Member->save($updateData);

        $this->redirect(HTTPS_HOME_PAGE_URL.'/member/password_reset_comp');
    }

    /**
     * パスワード再発行が更新完了
     */
    function password_reset_comp() {
        $this->layout = 'front';
        $this->render('password_reset_comp');
    }

    /**
     * 会員情報を登録
     */
    function regist() {
        $this->layout = 'front';
        if ($this->Session->check($this->AppAuth->sessionKey)) {
            $this->redirect(HTTPS_HOME_PAGE_URL.'/member/edit');
            return;
        }

        if (isset($this->params['named']['mode']) 
                && $this->params['named']['mode'] == 'back' 
                && $this->Session->check('Member.regist.data')) {
            $this->data['Member'] = $this->Session->read('Member.regist.data');
        }

        $this->render('regist');
    }

    /**
     * 会員登録確認画面
     */
    function regist_confirm() {
        $this->layout = 'front';
        if ($this->Session->check($this->AppAuth->sessionKey)) {
            $this->redirect(HTTPS_HOME_PAGE_URL.'/member/edit');
            return;
        }

        $valid = true;
        if (empty($this->data)) {
            $this->redirect('/member/regist');
            return;
        }
        $errMsg = $this->Member->invalidFields(array(), $this->data['Member']);
        if (!empty($errMsg)) {
            $valid &= false;
        }
        $ret = $this->Member->verifyMailAndPhone($this->data['Member']['email'], $this->data['Member']['phone']);
        if ($ret) {
            $this->Session->setFlash(__('error.memberEmailOrPhoneIsWrong', true), 'default', null, 'emailOrPhoneIsWrong');
            $valid &= false;
        }
        if (strtolower($this->Session->read('Member.regist.security_code')) != strtolower($this->data['Member']['security_code'])) {
            $this->Session->setFlash(renderMsg(__('error.incorrect', true),'验证码'), 'default', null, 'securityCodeIsWrong');
            $valid &= false;
        }
        if (!$valid) {
            $this->regist();
            return;
        }
        $this->Session->write('Member.regist.data', $this->data['Member']);
        $this->render('regist_confirm');
    }

    /**
     * 会員登録完了
     */
    function regist_complete() {
        if ($this->Session->check($this->AppAuth->sessionKey)) {
            $this->redirect(HTTPS_HOME_PAGE_URL.'/member/edit');
            return;
        }
        if (!$this->Session->check('Member.regist.data')) {
            $this->redirect('/member/regist');
            return;
        }
        $updateData = $this->Session->read('Member.regist.data');
        $updateData['id']   = $this->Member->generateCustomerId();
        $updateData['mode'] = OMS_SAVE_TYPE_INSERT;
        if (empty($updateData['id'])) {
            $msg = __('error.member_id_generate_failure', true);
            $this->Log($msg, LOG_ERROR);
            $this->CakeError('error', array('message'=>$msg));
            return;
        }

        //会員情報を保存
        $ret = $this->__saveMember($updateData);
        if (!$ret) {
            $this->regist();
            return;
        }

        $loginData['Member.email']    = $updateData['email'];
        $loginData['Member.password'] = $updateData['password'];

        $this->AppAuth->login($loginData);

        //会員へメールを送信
        $this->__sendMailForMemberRegister();

        if ($this->Session->check('Auth.redirect')) {
            $this->redirect($this->Session->read('Auth.redirect'));
            exit();
        }
        $this->redirect('/member/mypage');
    }

    /**
     * 会員編集画面
     */
    function edit() {
        $this->layout = 'front';

        $memberInfo = $this->Session->read($this->AppAuth->sessionKey);
        if (!empty($this->data['Member'])) {
            $this->data['Member'] = array_merge($memberInfo, $this->data['Member']);
        } else {
            $this->data['Member'] = $memberInfo;
        }
        if (empty($this->data['MemberPhoto'])) {
            $memberPhoto = $this->MemberPhoto->getInfo($memberInfo['id']);
            $this->data['MemberPhoto'] = $memberPhoto['MemberPhoto'];
        }
        if (!isset($this->data['Address'])) {
            $this->data['Address'] = $this->data['Member'];
        }

        //エリアリスト
        $this->CommFuncs->initAreaList('Address');

        $this->render('edit');
    }

    /**
     * 会員写真をアップ
     */
    function update_photo() {
        $errMsg = $this->MemberPhoto->invalidFields(array(), $this->data['MemberPhoto']);
        if (!empty($errMsg)) {
            $this->edit();
            return;
        }

        $updateData = array();
        $updateData['member_id']  = $this->Session->read($this->AppAuth->sessionKey.'.id');
        $updateData['photo_path'] = $this->data['MemberPhoto']['photo_path'];
        if (empty($this->data['MemberPhoto']['id'])) {
            $updateData['create_user']      = $updateData['member_id'];
            $updateData['create_datetime']  = 'NOW()';
        }
        $updateData['update_user']      = $updateData['member_id'];
        $updateData['update_datetime']  = 'NOW()';
        $this->MemberPhoto->save($updateData);

        $this->Session->setFlash(__('info.memberPhotoUploadSuccess', true), 'default', null, 'memberPhotoUploadSuccess');
        $this->redirect(HTTPS_HOME_PAGE_URL.'/member/edit');
    }

    /**
     * 会員情報を更新
     */
    function edit_comp() {
        $this->handleInputEmpty(HTTPS_HOME_PAGE_URL.'/member/edit');

        if (empty($this->data['Member']['birthday']['year']) && empty($this->data['Member']['birthday']['month']) && empty($this->data['Member']['birthday']['day'])) {
            $this->data['Member']['birthday_comp'] = '';
        } else {
            $this->data['Member']['birthday_comp'] = $this->data['Member']['birthday']['year'].'-'.$this->data['Member']['birthday']['month'].'-'.$this->data['Member']['birthday']['day'];
        }
        $this->Member->invalidFields(array(), $this->data['Member']);
        $this->Address->invalidFields(array(), $this->data['Address']);
        $this->CommFuncs->validAddress('Address', 'Address');
        if (!empty($this->Member->validationErrors) || !empty($this->Address->validationErrors)) {
            $this->edit();
            return;
        }
        $updateData = array_merge($this->Session->read($this->AppAuth->sessionKey), $this->data['Member'], $this->data['Address']);
        $updateData['birthday'] =!empty($updateData['birthday']['year'])?$updateData['birthday']['year'].'/'.$updateData['birthday']['month'].'/'.$updateData['birthday']['day']:''; 
        $updateData['id'] = intval($this->Session->read($this->AppAuth->sessionKey.'.id'));
        $updateData['address2'] = ($updateData['address2'] == 'other')?$updateData['address2_other']:$updateData['address2'];
        $updateData['address3'] = ($updateData['address3'] == 'other')?$updateData['address3_other']:$updateData['address3'];

        $this->__saveMember($updateData);

        //会員情報を再取得
        $memberInfo = $this->Member->getCustomerInfo(intval($updateData['id']));
        $this->Session->write($this->AppAuth->sessionKey, $memberInfo);
        $this->Session->setFlash(__('info.memberEditSuccess', true), 'default', null, 'memberEditSuccess');

        $this->redirect(HTTPS_HOME_PAGE_URL.'/member/edit');
    }

    /**
     * マイページ画面
     */
    function mypage() {
        $this->layout = 'front';

        $memberInfo = $this->Session->read($this->AppAuth->sessionKey);
        $this->set('memberInfo', $memberInfo);

        $memberPhoto = $this->MemberPhoto->getInfo($memberInfo['id']);
        $this->data['MemberPhoto'] = $memberPhoto['MemberPhoto'];

        //お気に入りリスト
        $recs = $this->ProductBookmark->getListByCustomerId($memberInfo['id'], 6, 0);
        $productCds = array();
        foreach($recs as $value) {
            $productCds[] = $value['Product']['product_cd'];
        }
        $this->CommFuncs->loadProductBlock($productCds, $bookmarkList);
        $this->set('bookmarkList', $bookmarkList);

        //最新の5件注文を取得
        $this->CommFuncs->loadMemberOrderList($memberInfo['id'], $orderListAll);
        $orderList = array_slice($orderListAll, 0, 5);
        $this->set('orderList', $orderList);

        //アドレスリスト
        $addressList = $memberInfo['sendto_addresses'];
        if (is_array($addressList)) {
            $addressList = array_slice($addressList, 0, 5);
        }
        $this->set('addressList', $addressList);
        $this->loadModel('Area');
        $this->Area->getAllOptionList($areaList);
        $this->set('areaList', $areaList);

        $this->render('mypage');
    }

    function get_points() {
        //会員の利用できるポイント情報
        if (!$this->Session->check($this->AppAuth->sessionKey)) {
            die();
        }
        $customerPointModel = ClassRegistry::init('CustomerPoint');
        $pointInfo = $customerPointModel->getInfo($this->Session->read($this->AppAuth->sessionKey.'.id'));
        $this->set('pointInfo', $pointInfo);
        $this->render('/elements/member/get_points');
    }
    /**
     * マイページの左側の表示部分を初期化
     */
    function customer_center_navi() {
        $this->layout = 'ajax';

        //会員情報
        $memberInfo = $this->Session->read($this->AppAuth->sessionKey);
        $this->set('memberInfo', $memberInfo);

        //注文情報を取得
        $this->CommFuncs->loadMemberOrderList($memberInfo['id'], $orderList);
        $orderCount['totalCount']  = 0;
        $orderCount['notCredited'] = 0;
        $orderCount['normal']        = 0;
        $orderCount['paidByOther'] = 0;
        $orderCount['gift']        = 0;
        $orderCount['groupBuy']    = 0;
        $orderCds = array();
        foreach($orderList as $key => $value) {
            if (!in_array($value['order_no'], $orderCds)) {
                $orderCds[] = $value['order_no'];
            } else {
                continue;
            }
            
            $orderCount['totalCount']++;

            if ($value['shipping_status'] == SHIPPING_STATUS_NOTCREDITED) {
                $orderCount['notCredited']++;
            }
            //注文詳細
            $orderInfo = $this->Order->getInfo($memberInfo['id'], $value['order_no']);
            //普通
            if (stripos($orderInfo['orders'][0]['product_info_list'][0]['extradata'], 'sale_method='.SALE_METHOD_NORMAL) !== false) {
                $orderCount['normal']++;
            } 
            //ギフト
            elseif (stripos($orderInfo['orders'][0]['product_info_list'][0]['extradata'], 'sale_method='.SALE_METHOD_GIFT) !== false) {
                $orderCount['gift']++;
            } 
            //考验TA
            elseif (stripos($orderInfo['orders'][0]['product_info_list'][0]['extradata'], 'sale_method='.SALE_METHOD_PAID_BY_OTHER) !== false) {
                $orderCount['paidByOther']++;
            } 
            //共同購入
            elseif (stripos($orderInfo['orders'][0]['product_info_list'][0]['extradata'], 'sale_method='.SALE_METHOD_GROUP_BUY) !== false) {
                $orderCount['groupBuy']++;
            }
        }
        $this->set('orderCount', $orderCount);

        //お気に入る商品情報
        $this->CommFuncs->loadMemberProductBookmarkList($memberInfo['id'], &$bookmarks);
        $this->set('bookmarkCount', count($bookmarks));

        //セッションに保存した注文、お気に入る情報を削除
        $this->Session->delete('Front.Order.List');
        $this->Session->delete('Front.ProductBookmark.list');

        $this->render('/elements/member/customer_center_navi');
    }

    /**
     * 認証画像を作成
     */
    function show_security_pic() {
        $this->layout = 'ajax';

        //生成验证码图片
        Header("Content-type: image/PNG");
        $im = imagecreate(44,18);
        $back = ImageColorAllocate($im, 245,245,245);
        imagefill($im,0,0,$back); //背景

        srand((double)microtime()*1000000);
        //生成4位文字
        $vcodes = '';
        for($i=0;$i<4;$i++){
            $font = ImageColorAllocate($im, rand(100,255),rand(0,100),rand(100,255));
            $number = rand(0,2);
            switch($number)
            {
                case 0:
                    $rand_number = rand(48,57);//数字
                    break;
                case 1:
                    $rand_number = rand(65,90);//大写字母
                    break;
                case 2:
                    $rand_number = rand(97,122);//小写字母
                    break;
            }
            $str = sprintf("%c",$rand_number);
            imagestring($im, 5, 2+$i*10, 1, $str, $font);
            $vcodes .= $str;
        }

        for($i=0;$i<100;$i++) {
            $randcolor = ImageColorallocate($im,rand(0,255),rand(0,255),rand(0,255));
            imagesetpixel($im, rand()%70 , rand()%30 , $randcolor);
        }
        $this->Session->write('Member.regist.security_code', $vcodes);
        ImagePNG($im);
        ImageDestroy($im);
    }

    /**
     * パスワード再発行のメールを送信
     * @param unknown_type $memberInfo
     */
    function __sendMailForPassworReset(&$memberInfo) {
        $this->Email->sendAs   = 'html';
        $this->Email->from     = SITE_ADMIN_EMAIL;
        $this->Email->to       = $memberInfo['email'];
        $this->Email->template = 'password_reset';
        $this->Email->subject  = sprintf(__('mail.subjectForPasswordReset', true), __('info.siteNameCN', true));

        $this->set('hashCode'  , md5($memberInfo['email'].$memberInfo['phone']));
        $this->set('expired'    , base64url_encode(time()+3600*24*3));
        $this->set('memberInfo', $memberInfo); 

        $this->Email->send();
    }

    function __saveMember(&$updateData) {
        $results = $this->Member->save($updateData);
        if (!empty($results['error'])) {
            $msg = __('error.registMemberFailure', true);
            $this->Log($msg, LOG_ERROR);
            $this->Log($updateData, LOG_ERROR);
            if ($results['error']['code'] == '119') {
                $this->data['Member'] = $updateData;
                $this->Session->setFlash(__('error.memberEmailOrNicknameDuplicate', true), 'default', null, 'memberEmailOrNicknameDuplicate');
                return false;
            } else {
                $this->CakeError('error');
                exit();
            }
        }
        return true;
    }

    /**
      会員を登録した場合、会員へ送信
     */
    function __sendMailForMemberRegister() {
        $memberInfo = $this->Session->read($this->AppAuth->sessionKey);

        $this->Email->layout   = 'email';
        $this->Email->sendAs   = 'html';
        $this->Email->from     = SITE_ADMIN_EMAIL;
        $this->Email->to       = $memberInfo['email'];
        $this->Email->subject  = sprintf(__('mail.subjectForMemberRegister', true), __('info.siteNameCN', true));
        $this->Email->template = 'member_register_to_member';

        $this->set('memberInfo', $memberInfo);

        $this->Email->send();
    }
}
?>
