<?php
/**
 * OMSデータと同期になる処理を行う
 */
App::import('Vendor', 'app_basics');
class LoadOmsDataShell extends Shell {
    var $uses     = array();
    var $baseTime = null;

    function main() {
        $defaultBaseTime = date('Y/m/d', strtotime(date('Y/m/d')) - 24*60*60).' 00:00:00';
        //2010/08/01 12:00:00
        $this->baseTime = !empty($this->args[0])?$this->args[0]:$defaultBaseTime;

        $this->update_data_from_oms('Product');
        $this->update_data_from_oms('ProductDesc');
        $this->update_data_from_oms('ProductPhoto');
        $this->baseTime = '2010/01/01 00:00:00';
        $this->update_data_from_oms('Category');
        $this->baseTime = !empty($this->args[0])?$this->args[0]:$defaultBaseTime;

        //カテゴリ関連データを削除
        $model = ClassRegistry::init('CategoryProductRel');
        $model->query("DELETE FROM {$model->tablePrefix}category_product_rel;");
        $this->baseTime = '2010/01/01 00:00:00';
        $this->update_data_from_oms('CategoryProductRel');

        $this->baseTime = !empty($this->args[0])?$this->args[0]:$defaultBaseTime;
        $this->update_data_from_oms('Company');
        $this->update_data_from_oms('SaleRule');
        $this->update_data_from_oms('SaleProduct');
        $this->update_data_from_oms('PriceType');
        $this->update_data_from_oms('Manufacturer');
        $this->update_data_from_oms('Brand');
        $this->update_data_from_oms('BrandPhoto');
        $this->update_data_from_oms('Carrier');
        $this->update_data_from_oms('Postage');
    }

    function update_data_from_oms($model) {
        $model = ClassRegistry::init($model);
        $ret = $model->getListFromOMS($this->baseTime);
        if (empty($ret['results'])) {
            return;
        }

        foreach($ret['results'] as $key => $value) {
            foreach($value as $k => $v) {
                if (is_array($v)) {
                    $ret['results'][$key][$k] = json_encode($v);
                }
            }
        }
        $model->saveAll($ret['results'], array('validate'=>false));
    }
}
?>
