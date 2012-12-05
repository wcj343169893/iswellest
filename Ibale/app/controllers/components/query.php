<?php
/**
 * ファイル名：query.php
 * 概要：DBに検索用のコンポーネント
 *
 * 作成者：shilei
 * 作成日：2011/12/30
 * 変更履歴：
 */
class QueryComponent extends Object {

    function startup(&$controller){
        $this->controller = $controller;
    }

    /**
     * 検索条件を再作成
     * @param unknown_type $conditions
     */
    function renderSearchConditions(&$conditions) {
        $this->__renderSearchConditions($conditions);
        $this->__unsetEmptyElement($conditions);
    }

    function __renderSearchConditions(&$conditions) {
        foreach($conditions as $key => $value) {
            $reg = "/(###)([\S\s]*)(\.)([\S\s]*)(\.)([\S\s]*)(###)/i";
            if (is_array($value)) {
                $this->__renderSearchConditions($conditions[$key]);
                continue;
            }
            preg_match($reg, $value, $matches);
            if (empty($matches)) {
                $reg = "/(###)([\S\s]*)(\.)([\S\s]*)(###)/i";
                preg_match($reg, $value, $matches);
            }
            if (isset($matches[2]) && isset($matches[4]) && isset($matches[6]) 
                    && !empty($this->controller->params[$matches[2]][$matches[4]][$matches[6]])) {
                $value = preg_replace($reg, $this->controller->params[$matches[2]][$matches[4]][$matches[6]], $value);
                $conditions[$key] = $value;
            }elseif (isset($matches[2]) && isset($matches[4]) && !isset($matches[6]) 
                    && empty($this->controller->params[$matches[2]][$matches[4]])) {
                $value = preg_replace($reg, $this->controller->params[$matches[2]][$matches[4]], $value);
                $conditions[$key] = $value;
            } elseif (!empty($matches))  {
                unset($conditions[$key]);
            }
        }
    }
        function __unsetEmptyElement(&$conditions) {
        foreach($conditions as $key => $value) {
            if (is_array($value) && !empty($value)) {
                $this->__unsetEmptyElement($conditions[$key]);
                continue;
            } else if (is_array($value) && empty($value)) {
                unset($conditions[$key]);
            }
        }
    }
}
?>