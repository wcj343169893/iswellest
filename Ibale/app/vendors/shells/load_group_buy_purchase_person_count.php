<?php
/**
 * 共同購入の購入人数を自動増加の処理を行う
 */
App::import('Vendor', 'app_basics');
class LoadGroupBuyPurchasePersonCountShell extends Shell {
    var $uses = array('GroupBuy');

    function main() {
        $conditions = array(
                        'conditions'    => array(
                                                'GroupBuy.manual_purchase_person_count_flg =' => ACTIVE_FLG_TRUE,
                                                'GroupBuy.start_time <= \'NOW()\'',
                                                'GroupBuy.end_time   >= \'NOW()\'',
                                                'GroupBuy.max_purchase_number > GroupBuy.purchase_product_count',
                                                'GroupBuy.del_flg ='     => ACTIVE_FLG_FALSE,
                        ),
                        'recursive'     => '-1',
        );
        $recs = $this->GroupBuy->find('all', $conditions);
        if (empty($recs)) {
            return;
        }

        $sql = "";
        foreach($recs as $key => $value) {
            $value = $value['GroupBuy'];
            $this->__loadGroupBuyPurchasePersonCount(&$value);
            $sql .= "UPDATE {$this->GroupBuy->tablePrefix}group_buy SET base_purchase_person_count={$value['base_purchase_person_count']} WHERE id={$value['id']};";
        }
        $this->GroupBuy->query($sql);
    }

    function __loadGroupBuyPurchasePersonCount(&$value) {
        if (empty($value['base_purchase_person_count'])) {
            for($i = 0; $i < 2; $i++) {
                $randValue = rand($value['base_purchase_person_count_min'], $value['base_purchase_person_count_max']);
                if ($value['max_purchase_number'] > $randValue + $value['purchase_person_count']) {
                    $value['base_purchase_person_count'] = $randValue;
                    break;
                }
            }
            return;
        }

        for($i = 0; $i < 2; $i++) {
            $hour = rand($value['increase_purchase_person_count_min'], $value['increase_purchase_person_count_max']);
            if ($value['max_purchase_number'] > $value['purchase_person_count'] + $value['base_purchase_person_count'] + $hour) {
                $value['base_purchase_person_count'] += $hour;
                break;
            }
        }
        return;
    }
}
?>