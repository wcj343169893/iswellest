<?php 
/**
 * ファイル名：app_csv.php
 * 概要：CSVファイルを出力する用のコンポーネント
 * 
 * 作成者：shilei
 * 作成日時：2011/12/30
 */
class AppCsvComponent extends Object{
    
    /*---------------------------------------------------------------------------------------
     * Common setting
     ---------------------------------------------------------------------------------------*/
    //use MIME type
    var $useMime = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'text/csv',
        'application/octet-stream',
        'application/vnd.ms-excel'
    );
    //put field setting
    var $useField = array();
    //csv data value auto encoding
    var $autoEnc = true;
    //encoding setting
    var $encToType = 'UTF-8';
    //encoding setting
    var $csvEncToType = 'UTF-8';
    //fgetcsv setting
    var $csvLength = 1000;
    var $csvDelimiter = ',';
    var $primaryKey = 'id';
    //Set assosiations
    var $assosiation = true;
    
    /*---------------------------------------------------------------------------------------
     * Extend setting
     ---------------------------------------------------------------------------------------*/
    //save method control from csv data 
    var $saveMethodMode = false;
    //[saveMethodMode] is true. fix filedname
    var $methodName = 'method_controller';
    //[saveMethodMode] is true. method type
    var $saveTypeList = array(
                            'n'=>'save',
                            'u'=>'save',
                            'd'=>'del'
                        );
    var $inlineSaveType = true;
    //[saveMethodMode] is true. find method default method value.
    var $defaultSaveType = 'u';
    //use header line
    var $useHeader = false;
    //[useHeader] is true. this add header list. if empty dbtable all field
    var $headerList = array();
    /*---------------------------------------------------------------------------------------
     * Not change values
     ---------------------------------------------------------------------------------------*/
    //Controller
    var $controller = true;
    //Conection manager Object
    var $db = NULL;
    //Model name
    var $modelName = NULL;
    //belongsTo value
    var $belongsTo = array();
    //hasMany value
    var $hasMany = array();
    
    //_setQuartのフラグ
    var $setQuart = true;
    /*---------------------------------------------------------------------------------------
     * Base method
     ---------------------------------------------------------------------------------------*/
    //startup()
    function startup(&$controller){
        $this->controller = $controller;
        $this->modelName = $this->controller->modelClass;
        
        if($this->assosiation){
            if(isset($this->controller->{$this->modelName}->belongsTo)){
                $this->belongsTo = $this->controller->{$this->modelName}->belongsTo;
                if(!empty($this->belongsTo)){$this->controller->{$this->modelName}->recursive = 1;}
            }
            if(isset($this->controller->{$this->modelName}->hasMany)){
                $this->hasMany = $this->controller->{$this->modelName}->hasMany;
                if(!empty($this->belongsTo)){$this->controller->{$this->modelName}->recursive = 2;}
            }
        }else{
            $this->controller->{$this->modelName}->recursive = -1;
        }
    }
    /*---------------------------------------------------------------------------------------
     * Main method
     ---------------------------------------------------------------------------------------*/

    /**
     * CSVファイルを出力する
     * @param $arr CSVデータ
     * @param $autoRender true: CSVダウンロード false: CSVファイルの内容を戻る
     * @param $fileName CSV出力ファイル名前
     * @param $getType ファイルタイプ
     * @param $backup_flg バックアップフラグ
     * @param $backup_file_path バックアップファイルのパス
     * 
     * @return
     */
    function export($arr, $fileName='csv.csv', $autoRender=true, $getType='download', $backup_flg = false, $backup_file_path = '') {
        $csvList = array();
        if($this->useHeader){
            $csvList[] = $this->_getHeader();
        }
        foreach ($arr as $value) {
            $csvList[] = $this->_remakeCsv($value);
        }
        return (!$autoRender)?$csvList:$this->render($csvList,$fileName,$getType, $backup_flg, $backup_file_path);
    }

    /**
     * CSVファイルを出力する
     * @param $arr CSVデータ
     * @param $backup_file_path バックアップファイルのパス
     * 
     * @return
     */
    function exportBackend($arr, $backup_file_path = '') {
        $csvList = array();
        if($this->useHeader){
            $csvList[] = $this->_getHeader();
        }
        foreach ($arr as $value) {
            $csvList[] = $this->_remakeCsv($value);
        }
        $this->_writeCsv($csvList, $backup_file_path);
    }

    /**
     * render
     * @param $data
     * @param $name
     * @param $type
     * @param $backup_flg バックアップフラグ
     * @param $backup_file_path バックアップファイルのパス
     */
    function render($data=array(),$name='csv.csv',$type='download', $backup_flg = false, $backup_file_path = ''){
        if(empty($data)){return NULL;}
        $this->controller->layout = false;
        $this->controller->autoRender = false;
        Configure::write('debug',0);
        if($type=='download'){
            header("Content-type: text/csv");
            header('Content-Disposition: attachment; filename="'. $this->_encTo($name).'";');
        }
        
        if ($backup_flg) {
            $this->_writeCsv($data, $backup_file_path);
        }

        if(is_array($data)){
            echo implode("\n", $data);
            exit;
        }else{
            return false;
        }
    }
    
    /*---------------------------------------------------------------------------------------
     * Common method
     ---------------------------------------------------------------------------------------*/
    //custamSave()
    function _custamSave($saveDatta){
        if(empty($saveDatta)){return NULL;}
        if($saveDatta[$this->modelName][$this->methodName] == 'n'){//New
            if(isset($saveDatta[$this->modelName][$this->primaryKey])){
                unset($saveDatta[$this->modelName][$this->primaryKey]);
            }
            if(!$this->controller->{$this->modelName}->save($saveDatta)){
                return $saveDatta;
            }
        }elseif($saveDatta[$this->modelName][$this->methodName] == 'u'){//UPDATE
            if(!$this->controller->{$this->modelName}->save($saveDatta)){
                return $saveDatta;
            }
        }elseif($saveDatta[$this->modelName][$this->methodName] == 'd'){//DEL
            if(isset($saveDatta[$this->modelName][$this->primaryKey])){
                $targetId = $saveDatta[$this->modelName][$this->primaryKey];
                if(!$this->controller->{$this->modelName}->del($targetId)){
                    return $saveDatta;
                }
            }
        }else{
            return NULL;
        }
    }
    //encTo()
    function _encTo($value=NULL){
        if(empty($value)){return NULL;}
        if(is_array($value)){
            foreach($value as $key=>$aValeu){
                $value[$key] = $this->_encTo($aValeu);
            }
            return $value;
        }else{
            $fromEnc = mb_detect_encoding($value);
            return ($this->encToType != $fromEnc)?mb_convert_encoding($value, $this->encToType, $fromEnc):$value;
        }
    }
    //setPutField()
    function _setPutField(){
        if(empty($this->useField)){
            $schemaList = array_keys($this->controller->{$this->modelName}->_schema);
            if($this->saveMethodMode){
                $schemaList = am(array($this->methodName),$schemaList);
            }
            if(!empty($this->hasMany)){
                foreach($this->hasMany as $key=>$values){
                    if(!in_array($key,$schemaList)){
                        $schemaList[] = $key;
                    }
                }
            }
            return $schemaList;
        }else{
            return $this->useField;
        }
    }
    //getFindField()
    function _getFindField(){
        if(empty($this->useField)){
            $schemaList = array_keys($this->controller->{$this->modelName}->_schema);
            return $schemaList;
        }else{
            return $this->useField;
        }
    }
    //remakeCsv()
    function _remakeCsv($array=array()){
        if(empty($array)){return NULL;}
        $line = NULL;

        foreach($array as $key => $value){
            $array[$key]=$this->_setQuart($value);
        }
        $line = implode($this->csvDelimiter, $array);
        if($this->autoEnc){
            $fromEnc = mb_detect_encoding($line);
            return ($fromEnc != $this->csvEncToType)?mb_convert_encoding($line, $this->csvEncToType, $fromEnc):$line;
        }else{
            return $line;
        }
    }
    //_setQuart()
    function _setQuart($value){
        if (!$this->setQuart) {
            return $value;
        }
        if($value != '' && preg_match("/[\r\n]/", $value)){
//            $value = '"'.str_replace('"','""',$value).'"';
            $value = '"'.preg_replace("/[\r\n]/", "", $value).'"';
            return $value;
        }elseif(preg_match("/\"/", $value)){
            $value = '"'.str_replace('"','""',$value).'"';
        }
        return '"'.$value.'"';
    }
    //_getHeader()
    function _getHeader(){
        $line = (!empty($this->headerList))?implode($this->csvDelimiter, $this->headerList):implode($this->csvDelimiter, $this->_setPutField());

        if($this->autoEnc){
            $fromEnc = mb_detect_encoding($line);
            return ($fromEnc != $this->csvEncToType)?mb_convert_encoding($line, $this->csvEncToType, $fromEnc):$line;
        }else{
            return $line;
        }
    }
    
    /**
     * CSVファイルをバックアップする
     * @author TD shilei
     * @param $data
     * @param $backup_file_path
     */
    function _writeCsv($data, $backup_file_path) {
        $fp = fopen($backup_file_path, 'w');
        foreach ($data as $key => $line_data) {
            $eol = "\n";
            if (count($data) == $key + 1) {
                $eol = "";
            }
            fwrite($fp, $line_data. $eol);
        }
        fclose($fp);
    }
}
?>
