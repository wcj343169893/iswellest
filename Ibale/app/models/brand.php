<?php
/**
 * ファイル名：brand.php
 * 概要：ブランド用のモジュール
 * 
 * 作成者：shilei
 * 作成日時：2012/01/17
 */
class Brand extends AppModel {
    var $name       = 'Brand';
    var $primaryKey = 'id';
    var $useTable   = 'brand';
    var $hasMany    = array(
                        'BrandPhoto' => array(
                                            'className'  => 'BrandPhoto',
                                            'foreignKey' => 'brand_id',
                                            'conditions' => array('BrandPhoto.delete_datetime IS NULL'),
                        ),
    );
    /**
     * @todo 根据分类id，查询品牌
     * @param cid 顶级分类编号
     * @return array
     * */
	function getListByCid($cid){
		$categoryIdsStr = "SELECT id FROM {$this->tablePrefix}category WHERE 1=1 AND parent_id IN (SELECT id FROM {$this->tablePrefix}category WHERE 1=1 AND parent_id={$cid}) UNION SELECT id FROM {$this->tablePrefix}category WHERE 1=1 AND parent_id={$cid} UNION SELECT {$cid} AS id ";
		$categoryIdsStr="(select cpr.product_cd from {$this->tablePrefix}category_product_rel as cpr where cpr.category_id in({$categoryIdsStr}))";
		
		$sql="select brand.id,brand.brand_name,brand.brand_name_pinyin,brand.brand_description from {$this->tablePrefix}brand as brand 
		left join {$this->tablePrefix}product as product on product.brand_id=brand.id";
		$sql.=" where product.product_cd in({$categoryIdsStr})";
		$sql.=" group by brand.id order by brand.id desc limit 18";
		$brands = $this->query($sql);
		$data=array();
		if(!empty($brands)){
			//处理结果集
			foreach($brands as $k=>$v){
				$data[$k]=$v[0];
			}
		}
		return $data;
	}
    /**
     * ブランド情報をOMSから取得
     */
    function getListFromOMS($baseTime) {
        $methodPath = 'getbrand';
        $params = array(
                        'base_datetime' => $baseTime,
        );
        return $this->requestOmsData($methodPath, $params);
    }

    /**
     * ヘッダーリストを取得
     */
    function getList($brandIds = null, $recursive = 0) {
        $ret = array();
        $conditions = array(
                        'conditions'    => array(
                                            'Brand.delete_datetime IS NULL',
                        ),
                        'order'         => array(
                                            'Brand.update_datetime'  => 'DESC',
                        ),
                        'recursive'     => $recursive,
        );

        if (!empty($brandIds)) {
            $conditions['conditions'][] = array('Brand.id ' => $brandIds);
        }

        $recs = $this->find('all', $conditions);
        foreach($recs as $key => $value) {
            $ret[$value['Brand']['id']] = $value;
        }
        return $ret;
    }
}

?>
