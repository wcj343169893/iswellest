<?php
App::import('Core', 'HttpSocket');
class TestController extends AppController {
    var $name = "Test";
    var $uses = array();
    
    function beforeFilter() {
        $this->AppAuth->allowedActions = array('*');
        //$this->Security->requireAuth = array('load_model');
        parent::beforeFilter();
    
    }

    function load_model() {
    
        $this->loadModel('Test');
        die();
    }
    function auto_input() {
        $this->loadModel('Brand');
        $ret = $this->Brand->getBrand();
        //debug($ret);
        $this->set('brandList', $ret['results']);
        return;
    }
    
    function get_menu_list() {
        $ret = $this->Acl->getAdminSitemap();
        debug($ret);
        $menuList = array();
        debug(count($ret->group));
        for($i=0; $i < count($ret->group); $i++) {
            $parentPath = (string)$ret->group[$i]->attributes()->path;
            $parentPathName = (string)$ret->group[$i]->attributes()->name;
            $menuList[$parentPath]['name'] = $parentPathName;
            for($j=0; $j<count($ret->group[$i]); $j++) {
                $childPath = (string)$ret->group[$i]->menu[$j]->path;
                $childPathName = (string)$ret->group[$i]->menu[$j]->name;
                $menuList[$parentPath][$childPath]['name'] = $childPathName;
            }
        }
        debug($menuList);
        die();
    }
    
    function multi_select() {
        
    }

    function area_list() {
        $this->loadModel('Area');
        $provinceList = $this->Area->getAreaListByParentId();

        $provinceId = 20;
        $cityId=260;
        $regionId=2495;

        $cityList = array();
        if (!empty($provinceId)) {
            $cityList = $this->Area->getAreaListByParentId($provinceId);
        }

        $regionList = array();
        if (!empty($regionId)) {
            $regionList = $this->Area->getAreaListByParentId($cityId);
        }

        $this->set('provinceList', $provinceList);
        $this->set('cityList', $cityList);
        $this->set('regionList', $regionList);
    }
    
    function upload_img() {
    
    }
    
    function label_to_input() {
        $dataList[] = array('id'=>1, 'name'=>'test1');
        $dataList[] = array('id'=>2, 'name'=>'test2');
        $this->set('dataList', $dataList);
    }
    
    function ajax_save_data() {
outputLog('test', LOG_DEBUG);
$this->log($this->params, LOG_DEBUG);
$msg = 'error';//__('error.required', true);
$ret = '{"error":"$msg","result":"false"}';
$this->log($ret, LOG_DEBUG);
echo $ret;
        //__("error.required");

        die();
    
    }
    
    function get_customer() {
        $this->loadModel('Customer');
        $ret = $this->Customer->getCustomerInfo(100001);
        debug($ret);
        die();
    }

    function get_brand() {
        $this->loadModel('Brand');
        $baseTime = '2011/08/01';
        $ret = $this->Brand->getBrand($baseTime);
        debug($ret);
        die();
    }
    function get_product() {
        $this->layout='admin';
        $this->loadModel('Product');
        $baseTime = ('2011/08/01 12:00:00');
        $ret = $this->Product->getProduct($baseTime);
        debug($ret);
        $this->Product->saveAll($ret['results'], array('validate'=>false));
        die();
    }
    
    function get_product_photo() {
        $this->layout='admin';
        $this->loadModel('ProductPhoto');
        $baseTime = ('2011/08/01 12:00:00');
        $ret = $this->ProductPhoto->getProductPhoto($baseTime);
        debug($ret);
        $this->ProductPhoto->saveAll($ret['results'], array('validate'=>false));
        die();
    }
    function get_product_detail() {
        $this->layout='admin';
        $this->loadModel('ProductDesc');
        $baseTime = ('2011/08/01 12:00:00');
        $ret = $this->ProductDesc->getProductDesc($baseTime);
        debug($ret);
        $this->ProductDesc->saveAll($ret['results'], array('validate'=>false));
        die();
    }
    function get_product_price() {
        $this->layout='admin';
        $this->loadModel('Price');
        $baseTime = ('2011/08/01 12:00:00');
        $ret = $this->Price->getPrice($baseTime);
        debug($ret);
        $this->Price->saveAll($ret['results'], array('validate'=>false));
        die();
    }
    
    function get_category() {
        $this->layout='admin';
        $this->loadModel('Category');
        $baseTime = ('2011/08/01 12:00:00');
        $ret = $this->Category->getCategoryFromOMS($baseTime);
        debug($ret);
        //$this->Category->saveAll($ret['results'], array('validate'=>false));
        die();
        
    }

    
    function update_data_from_oms($model) {
        $model = ClassRegistry::init($model);
        $baseTime = ('2010/08/01 12:00:00');
        $ret = $model->getListFromOMS($baseTime);
        debug($ret);
        $model->create();
        foreach($ret['results'] as $key => $value) {
            foreach($value as $k => $v) {
                if (is_array($v)) {
                    $ret['results'][$key][$k] = json_encode($v);
                }
            }
        }
        //$model->saveAll($ret['results'], array('validate'=>false));

    }


    function validate_field() {
        $this->loadModel('Test');
        $this->data[$this->name] = $this->Test->data = array('id'=>'', 'name'=>'');
        $errMsg = $this->Test->invalidFields();
        debug($errMsg);
    }
    
    function sitemap_json() {
        $jsonTxt = file_get_contents(CONFIGS."sitemap.json");
        debug($jsonTxt);
        $jsonTxt = str_replace("\n", "", $jsonTxt);
        debug(json_decode($jsonTxt));
        die();
    }
    function tr_updown() {
        $this->layout="admin";
    }

    function get_stock_info() {
        $this->loadModel('StockInfo');
        $rec = $this->StockInfo->getInfo(array('10001','10002','10003','10004','10005','10006','10007','10008',));
        outputLog($rec);
        die();
    }
    
    function update_stock_info() {
        $this->loadModel('StockInfo');
        //$rec = $this->StockInfo->updateStockInfo(array(array('product_cd'=>'10008','changed_count'=>1,'reason'=>'STORING')));
        //$rec = $this->StockInfo->updateStockInfo(array(array('product_cd'=>'10001','changed_count'=>-1,'reason'=>'STORING')));
        //$rec = $this->StockInfo->updateStockInfo(array(array('product_cd'=>'10000','changed_count'=>100,'reason'=>'STORING')));
        //outputLog($rec);
        $rec = $this->StockInfo->setStock(array(array('product_cd'=>'10008','count'=>1)));
        $rec = $this->StockInfo->getInfo(array('10001','10008', '10009', '10047', '10014'));
        outputLog($rec);
        die();
    }
    function update_data() {
Configure::write('debug', '2');
        //$this->update_data_from_oms('BrandPhoto');
        //$this->update_data_from_oms('ProductDesc');
        //$this->update_data_from_oms('ProductPhoto');
        //$this->update_data_from_oms('Product');
        //$this->update_data_from_oms('Category');
        $this->update_data_from_oms('CategoryProductRel');
        //$this->update_data_from_oms('SaleProduct');
        //$this->update_data_from_oms('SaleRule');
        die();
    }
    function test_json_decode() {
        $arr = array('1'=>array('xxx','yyyy'));
        debug(json_encode($arr));
        die();
    }
    function test_validation_url() {
        $this->data['Toppage']['url'] = 'htp://www.163.com';
        $this->loadModel('Toppage');
        $err = $this->Toppage->invalidFields(array(), $this->data['Toppage']);
        debug($err);
        die();
    }

    function test_str_to_mark() {
        $str = 'shilei123 .&';
        echo '|'.preg_replace("/(\w|\W)/i", '●', $str).'|';
        die();
    }
    function get_all_category() {
        $this->loadModel('Category');
        $rec = $this->Category->getAllOptionList();
        outputLog($rec);
        die();
    }

    function test_get_product_info() {
        $this->loadModel('CategoryProductRel');
        $this->loadModel('Product');
        $productCds = '10002';
        //$ret = $this->CategoryProductRel->getCategoryByProductCd($productCds);
        $ret = $this->Product->getInfo($productCds);
        outputLog($ret);
        die();
    }
    function scroll_pic() {
        $this->layout='ajax';
    }
    function test_reg() {
        $this->layout = 'ajax';
        //die();
    }

    function get_stock_infos() {
        $productCds = array('10001', '10008', '10007');
        $this->loadModel('StockInfo');
        $recs = $this->StockInfo->getInfo($productCds);
        outputLog($recs);
        die();
    }
    function test_preg_replace() {
        $str='<div class="page pageStyle">
            <p>
                <span class="btnBack2">
                <span class="prev"></span>
                </span>
            </p>
            <p>
                <span class="current">1</span><span>
                <a href="/estimation/ajax_list/page:1/product_cd:10008">1</a>
                <a href="/estimation/ajax_list/page:2/product_cd:10008">2</a>
                </span><span><a href="/estimation/ajax_list/page:3/product_cd:10008">3</a></span><span><a href="/estimation/ajax_list/page:4/product_cd:10008">4</a></span>
            </p>
            <p>
                <span class="btnNext2">
                <span><a class="next" href="/estimation/ajax_list/page:2/product_cd:10008"></a></span>
                </span>
            </p>
            <p class="pageSkip">
                <button onclick="javaScript:jumpPage();" class="btnImg btnOk" type="button"></button>
            </p>
            <p class="pageSkip">
                共4页 到第 <input type="text" size="8" name="textfield2" id="jumpPageNo">
            </p>
        </div>';
        /**
        $str = '<p><span>
        <a href="/estimation/ajax_list/page:1/product_cd:10008">1</a>
        </span><span class="current">2</span><span>
        <a href="/estimation/ajax_list/page:3/product_cd:10008">3</a></span><span>
        <a href="/estimation/ajax_list/page:4/product_cd:10008">4</a></span></p>';
        */
        echo preg_replace("/href=\"(\/[\w\/\:]*)\"/", "href=\"javaScript:void(0);\" onclick=\"javaScript:redirectTo('\$1')\"", $str, -1);
        
        $str = 'xxxaxxxbxxxc';
        echo '<br/>';
        echo preg_replace("/xxx/i", "yyy", $str, -1);
        
        die();
    }
    function test_hash() {
        $ctx = hash_init('sha1');
        hash_update($ctx, 'The quick brown fox jumped over the lazy dog.');
        echo hash_final($ctx);
    }
    function test_split_words() {
        $words = 'CategoryTop';
        debug(splitWordsWithUnderLine($words));
        die();
    }

    function test_add_array() {
        $arr1 = array(1, 2);
        $arr2 = array(3, '33');
        print_r($arr1 + $arr2);
    }

    function test_loadRemainTime() {
        loadRemainTime('2012-03-13 12:23:00', $ret);
        echo $ret;
        die();
    }
    function test_base64_encode() {
        echo base64_encode("kamome|邵1002|kamome");
        die();
    }

    function test_coupon() {
        $this->loadModel('Coupon');
        $ret = $this->Coupon->getCouponStatus('');
        outputLog($ret);die();
    }
    function test_getOrder() {
        $this->loadModel('Order');
        $this->Order->getInfo('', 14240);
        die();
    }

    function notify_from_alipay() {
        $this->front = 'ajax';
        $this->data['out_trade_no'] = '100010_14549';
        $this->data['trade_status'] = 'TRADE_FINISHED';
    }

    function test_ucfirst() {
        $words = 'category_top';
        echo ucwords($words);
        die();
    }

    function test_share() {
        
    }

    function test_addslashes() {
        $str = '支付/发票';
        $str = rtrim(strtr(base64_encode($str), '+/', '-_'), '='); 
        //$str = addslashes(base64_encode($str));
        echo $str;
        die();
    }

    function test_save_member() {
        $saveStr = ' {"seq":2111902,"system":"front","sender":"10.1.1.254","params":{"name":"liufeitest","nickname":"liufeitest","sex":"MALE","email":"liufeitest@ibale.com","password":"liufeitest","password_confirm":"liufeitest","phone":13738120537,"security_code":"93fk","id":100689,"mode":"INSERT","email_type":"PC"}}';
        $httpSocket = new HttpSocket();
        $responseData = $httpSocket->post(OMS_API_ROOT_URL. 'savecustomerinfo'.DS, array('args' => $saveStr));
        print_r($responseData);
        exit();
    }

}
?>
