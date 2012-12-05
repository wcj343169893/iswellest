<?php
/**
 * ファイル名：category.php
 * 概要：商品種類用のモデル
 * 
 * 作成者：shilei
 * 作成日時：2012/01/20
 */
class Category extends AppModel {
    var $name       = "Category";
    var $useTable   = 'category';
    var $belongsTo  = array(  
                            'ParentCategory' => array(  
                                                    'className'  => 'Category',
                                                    'foreignKey' => 'parent_id',
                                                    'conditions' => array(
                                                                        'ParentCategory.delete_datetime IS NULL',
                                                    ),
                            ),
    );

    var $hasMany    = array(
                            'ChildCategory' => array(  
                                                    'className'  => 'Category',  
                                                    'foreignKey' => 'parent_id',  
                                                    'conditions' => array(
                                                                        'ChildCategory.delete_datetime IS NULL',
                                                    ),
                            ),
    );

    /**
     * カテゴリ情報をOMSから取得
     */
    function getListFromOMS($baseTime) {
        $methodPath = 'getcategory';
        $params = array(
                        'base_datetime' => $baseTime,
        );
        return $this->requestOmsData($methodPath, $params);
    }

    /**
     * プルダウンーボタン用のカテゴリのリストを取得
     */
    function getOptionList($parentId = '') {
        $ret = array();
        if (!isset($GLOBALS['GLOBALS']['CategoryList'])) {
            $this->getAllOptionList();
        }

        if (empty($parentId)) {
            return $GLOBALS['GLOBALS']['CategoryList']['level_1'];
        } elseif (isset($GLOBALS['GLOBALS']['CategoryList']['level_2'][$parentId])) {
            return $GLOBALS['GLOBALS']['CategoryList']['level_2'][$parentId];
        } else if (isset($GLOBALS['GLOBALS']['CategoryList']['level_3'][$parentId])) {
            return $GLOBALS['GLOBALS']['CategoryList']['level_3'][$parentId];
        } else {
            return array();
        }
        /**
        $parentId = trim($parentId);
        $conditions = array(
                        'conditions'    => array(
                                            'Category.delete_datetime IS NULL',
                        ),
                        'order'         => array(
                                            'Category.display_order'  => 'ASC',
                        ),
                        'recursive'     => 0,
        );
        if (!empty($parentId)) {
            $conditions['conditions']['Category.parent_id'] = $parentId;
        } else {
            $conditions['conditions'][] = 'Category.parent_id IS NULL';
        }
        $recs = $this->find('all', $conditions);

        if (empty($recs)) {
            return $ret;
        }
        foreach($recs as $key => $value) {
            $value = $value['Category'];
            $ret[$value['id']] = $value['category_title'];
        }
        return $ret;
        */
    }

    /**
     * プルダウンーボタン用のカテゴリのリストを取得
     */
    function getAllOptionList() {
        $ret = array();
        if (isset($GLOBALS['GLOBALS']['CategoryList'])) {
            return $GLOBALS['GLOBALS']['CategoryList'];
        }
        $conditions = array(
                        'conditions'    => array(
                                            'Category.parent_id IS NULL',
                                            'Category.delete_datetime IS NULL',
                        ),
                        'order'         => array(
                                            'Category.display_order'  => 'ASC',
                        ),
                        'recursive'     => 2,
        );

        $recs = $this->find('all', $conditions);
        if (empty($recs)) {
            return $ret;
        }
        foreach($recs as $k1 => $v1) {
            $value = $v1['Category'];
            $ret['level_1'][$value['id']] = $value['category_title'];
            $ret[$value['id']]['parent_id'] = '';
            $ret[$value['id']]['category_title'] = $value['category_title'];
            if (empty($v1['ChildCategory'])) {
                continue;
            }
            foreach($v1['ChildCategory'] as $k2 =>$v2) {
                $ret['level_2'][$value['id']][$v2['id']] = $v2['category_title'];
                $ret[$v2['id']]['parent_id'] = $value['id'];
                $ret[$v2['id']]['category_title'] = $v2['category_title'];
                if (empty($v2['ChildCategory'])) {
                    continue;
                }
                foreach($v2['ChildCategory'] as $k3 => $v3) {
                    if (!is_numeric($k3)) {
                        continue;
                    }
                    $ret['level_3'][$v2['id']][$v3['id']] = $v3['category_title'];
                    $ret[$v3['id']]['parent_id'] = $v2['id'];
                    $ret[$v3['id']]['category_title'] = $v3['category_title'];
                }
            }
        }
        $GLOBALS['GLOBALS']['CategoryList'] = $ret;
        return $ret;
    }
}
?>