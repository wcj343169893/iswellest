<?php
/**
 * ファイル名：image_controller.php
 * 概要：画像用のコントローラ
 * 
 * 作成者：shilei
 * 作成日：2012/01/04
 * 変更履歴：
 */
class ImageController extends AppController {
    var $name = 'Image';
    var $uses = array();
    var $allow_types = array('jpeg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif');

    function beforeFilter() {
        $this->AppAuth->allowedActions = array('ajax_upload_img');
        parent::beforeFilter();
    }

    /**
     * 画像をアップロード
     */
    function ajax_upload_img() {
        $this->layout = 'blank';

        if (empty($this->params['form']['filename'])) {
            return;
            //exit();
        }

        $file = $this->params['form']['filename'];
        $imgInfo    = getimagesize($file['tmp_name']);
        $widthOrg   = $imgInfo[0];
        $heightOrg  = $imgInfo[1];
        $fileType   = array_search($imgInfo['mime'], $this->allow_types);

        //画像種類をチェック
        if (!in_array($imgInfo['mime'], $this->allow_types)) {
            $msg = __('error.imageTypeNotMatch', true);
            $this->log($msg, LOG_DEBUG);
            echo "<label class=\"error-message\">{$msg}</label>";
            $this->render('/elements/common/empty');
            return;//exit();
        }
        
        //画像のサイズをチェック
        if ($file['size'] > 400*1024) {
            $msg = __('error.imageSizeLimitOverflow', true);;
            $this->log($msg, LOG_DEBUG);
            echo "<label class=\"error-message\">{$msg}</label>";
            return;//exit();
        }

        //画像をサーバにアップ
        $prefix = !empty($this->params['form']['prefix'])?$this->params['form']['prefix']:'';
        $imgNameNew = $this->__uploadImage($fileType, $file, $this->params['form']['savePath'], $this->params['form']['widthNew'], $this->params['form']['heightNew'], $widthOrg, $heightOrg, $prefix);
        echo "<p id=\"uploadedImg\">/{$imgNameNew}</p>";
        return;//exit();
    }

    /**
     * 画像を作成
     * @param $fileType
     * @param $file
     * @param $savePath
     * @param $widthNew
     * @param $heightNew
     * @param $widthOrg
     * @param $heightOrg
     */
    function __uploadImage($fileType, &$file, $savePath, $widthNew, $heightNew, $widthOrg, $heightOrg, $prefix) {
        $fileNameSuffix = session_id();
        //$fileName       = sprintf("%s_%s", $fileNameSuffix, $file['name']);
        $fileName       = $file['name'];

        $imgOrg         = call_user_func("imagecreatefrom{$fileType}", $file['tmp_name']);
        $imgNew         = imagecreatetruecolor($widthNew, $heightNew);
        imagecopyresampled($imgNew,$imgOrg,0,0,0,0,$widthNew,$heightNew,$widthOrg,$heightOrg);

        $quality = 100;
        if ($fileType == "png") {
            $quality = 9;
        }
        $this->mkdirForUpload(WWW_ROOT.$savePath);

        call_user_func("image{$fileType}", $imgNew, WWW_ROOT.$savePath. $prefix.$fileName, $quality);
        return $savePath. $prefix . $fileName;
    }

    function mkdirForUpload($dir) {
        $dir = (strrpos($dir, DS) == (strlen($dir) - 1))?mb_substr($dir, 0, -1):$dir;
        $parentPath = mb_substr($dir, 0, strrpos($dir, DS));
        if (!file_exists($dir) && file_exists($parentPath)) {
            $ret = mkdir($dir, 0766);
        } else if (!file_exists($dir)){
            $this->mkdirForUpload($parentPath);
            $ret = mkdir($dir, 0766);
        }
        return;
    }
}
?>