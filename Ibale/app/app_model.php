<?php
/**
 * ファイル名：app_model.php
 * 概要：ECサイトのモデル
 *
 * 作成者：shilei
 * 作成日：2011/12/30
 * 変更履歴：
 */
App::import('Core', 'HttpSocket');
App::import('Behavior', 'AppValidation');
class AppModel extends Model {

    function __construct($id = false, $table = null, $ds = null){
        //サーバ種類よりデータソースを利用
        if (SERVER_TYPE == SERVER_TYPE_LOCALHOST) {
            $this->useDbConfig = 'default';
        }else if (SERVER_TYPE == SERVER_TYPE_TEST) {
            $this->useDbConfig = 'test';
        }else if (SERVER_TYPE == SERVER_TYPE_KENSHU) {
            $this->useDbConfig = 'kenshu';
        }else if (SERVER_TYPE == SERVER_TYPE_HONBAN) {
            $this->useDbConfig = 'honban';
        }
        parent::__construct($id, $table, null);
    }

    function beforeValidate(&$option){
        //エラーメッセージを初期化
        $this->__loadValidMessage();
    
    }
/**
 * Returns an array of fields that have failed validation. On the current model.
 *
 * @param string $options An optional array of custom options to be made available in the beforeValidate callback
 * @param string $data 検証用のデータ
 * @return array Array of invalid fields
 * @see Model::validates()
 * @access public
 * @link http://book.cakephp.org/view/1182/Validating-Data-from-the-Controller
 */
    function invalidFields($options = array(), $data = array()) {
        if (isset($this->validationErrors)) {
            $this->validationErrors = array();
        }
        if (
			!$this->Behaviors->trigger(
				$this,
				'beforeValidate',
				array($options),
				array('break' => true, 'breakOn' => false)
			) ||
			$this->beforeValidate($options) === false
		) {
			return false;
		}

		if (!isset($this->validate) || empty($this->validate)) {
			return $this->validationErrors;
		}

        //modify by shilei, by 2012-01-11
        if (empty($data)) {
            $data = $this->data;
        }
        //modify by shilei, by 2012-01-11

        $methods = array_map('strtolower', get_class_methods($this));
		$behaviorMethods = array_keys($this->Behaviors->methods());

		if (isset($data[$this->alias])) {
			$data = $data[$this->alias];
		} elseif (!is_array($data)) {
			$data = array();
		}

		//modify by shilei, at 2012-01-11
		$AppValidation = new AppValidation();
		//modify by shilei, at 2012-01-11
		$exists = $this->exists();

		$_validate = $this->validate;
		$whitelist = $this->whitelist;

		if (!empty($options['fieldList'])) {
			$whitelist = $options['fieldList'];
		}

		if (!empty($whitelist)) {
			$validate = array();
			foreach ((array)$whitelist as $f) {
				if (!empty($this->validate[$f])) {
					$validate[$f] = $this->validate[$f];
				}
			}
			$this->validate = $validate;
		}
		foreach ($this->validate as $fieldName => $ruleSet) {
			if (!is_array($ruleSet) || (is_array($ruleSet) && isset($ruleSet['rule']))) {
				$ruleSet = array($ruleSet);
			}
			$default = array(
				'allowEmpty' => null,
				'required' => null,
				'rule' => 'blank',
				'last' => false,
				'on' => null
			);

			foreach ($ruleSet as $index => $validator) {
				if (!is_array($validator)) {
					$validator = array('rule' => $validator);
				}
				$validator = array_merge($default, $validator);

				if (isset($validator['message'])) {
					$message = $validator['message'];
				} else {
					$message = __('This field cannot be left blank', true);
				}

				if (
					empty($validator['on']) || ($validator['on'] == 'create' &&
					!$exists) || ($validator['on'] == 'update' && $exists
				)) {
					$required = (
						(!isset($data[$fieldName]) && $validator['required'] === true) ||
						(
							isset($data[$fieldName]) && (empty($data[$fieldName]) &&
							!is_numeric($data[$fieldName])) && $validator['allowEmpty'] === false
						)
					);

					if ($required) {
						$this->invalidate($fieldName, $message);
						if ($validator['last']) {
							break;
						}
					} elseif (array_key_exists($fieldName, $data)) {
						if (empty($data[$fieldName]) && $data[$fieldName] != '0' && $validator['allowEmpty'] === true) {
							break;
						}
						if (is_array($validator['rule'])) {
							$rule = $validator['rule'][0];
							unset($validator['rule'][0]);
							$ruleParams = array_merge(array($data[$fieldName]), array_values($validator['rule']));
						} else {
							$rule = $validator['rule'];
							$ruleParams = array($data[$fieldName]);
						}

						$valid = true;
						if (in_array(strtolower($rule), $methods)) {
							$ruleParams[] = $validator;
							$ruleParams[0] = array($fieldName => $ruleParams[0]);
							//add by shilei, at 2012-01-11
							if (isset($ruleParams[2])) {
							    $ruleParams[2] = array($ruleParams[2]=>$data[$ruleParams[2]]);
							}
							//add by shilei, at 2012-01-11
							$valid = $this->dispatchMethod($rule, $ruleParams);
						} elseif (in_array($rule, $behaviorMethods) || in_array(strtolower($rule), $behaviorMethods)) {
							$ruleParams[] = $validator;
							$ruleParams[0] = array($fieldName => $ruleParams[0]);
							//add by shilei, at 2012-01-11
							if (isset($ruleParams[2])) {
							    $ruleParams[2] = array($ruleParams[2]=>$data[$ruleParams[2]]);
							}
							//add by shilei, at 2012-01-11
							$valid = $this->Behaviors->dispatchMethod($this, $rule, $ruleParams);
						} elseif (method_exists($AppValidation, $rule)) {
							//add by shilei, at 2012-01-11
							if (isset($ruleParams[2]) && isset($data[$ruleParams[2]])) {
							    $ruleParams[2] = array($ruleParams[2]=>$data[$ruleParams[2]]);
							}
							//add by shilei, at 2012-01-11
							$valid = $AppValidation->dispatchMethod($rule, $ruleParams);
						} elseif (!is_array($validator['rule'])) {
							$valid = preg_match($rule, $data[$fieldName]);
						} elseif (Configure::read('debug') > 0) {
							trigger_error(sprintf(__('Could not find validation handler %s for %s', true), $rule, $fieldName), E_USER_WARNING);
						}

						if (!$valid || (is_string($valid) && strlen($valid) > 0)) {
							if (is_string($valid) && strlen($valid) > 0) {
								$validator['message'] = $valid;
							} elseif (!isset($validator['message'])) {
								if (is_string($index)) {
									$validator['message'] = $index;
								} elseif (is_numeric($index) && count($ruleSet) > 1) {
									$validator['message'] = $index + 1;
								} else {
									$validator['message'] = $message;
								}
							}
							$this->invalidate($fieldName, $validator['message']);

							if ($validator['last']) {
								break;
							}
						}
					}
				}
			}
		}

		$this->validate = $_validate;
		return $this->validationErrors;
	}

	/**
     * OMSインタフェースの呼び出しはHTTPでAPI固有のURLにアクセスすることで行う。アクセス方法はPOST。
     * @param $methodPath
     * @param $params
     */
    function requestOmsData($methodPath, $params) {
        $httpSocket = new HttpSocket();
        $args = $this->__makeOmsRequestArgs($params);
        outputLog('OMSのAPI（'.OMS_API_ROOT_URL. $methodPath.'）へ送信：');
        outputLog($args);
        $responseData = $httpSocket->post(OMS_API_ROOT_URL. $methodPath.DS, array('args' => $args));
        outputLog('OMSからのデータ：');
        outputLog($responseData);
        $this->__convertOmsReponseDataToArray($responseData, $ret);
        return $ret;
    }

    /**
     * Saves model data (based on white-list, if supplied) to the database. By
     * default, validation occurs before save.
     *
     * @param array $data Data to save.
     * @param mixed $validate Either a boolean, or an array.
     *          If a boolean, indicates whether or not to validate before saving.
     *          If an array, allows control of validate, callbacks, and fieldList
     * @param array $fieldList List of fields to allow to be written
     * @return mixed On success Model::$data if its not empty or true, false on failure
     * @access public
     * @link http://book.cakephp.org/view/75/Saving-Your-Data
     */
    function save($data = null, $validate = true, $fieldList = array()) {
        $ret =  parent::save($data, $validate, $fieldList);
        if (!$ret) {
            $this->log('エラーモジュール：：'.$this->table, LOG_ERROR);
            $this->log('エラー内容:', LOG_ERROR);
            $this->log($this->validationErrors, LOG_ERROR);
            $this->log('エラーデータ：', LOG_ERROR);
            $this->log($data, LOG_ERROR);
        }
        return $ret;
    }


    function makeQueryResultObjects($recs) {
        $ret = array();
        foreach ($recs as $key=>$rec) {
            foreach ($rec[0] as $col_name=>$col_value) {
                $ret[$key][$col_name] = $col_value;
            }
        }
        return $ret;
    }



    /**
     * OMSインタフェース用のパラメータを作成
     * @param $args パラメータ配列
     * [return OMSインタフェース用のパラメータ文字列（JSON）
     */
    function __makeOmsRequestArgs($params) {
        $params = addslashesToArray($params);
        $args = array(
                            'seq'       => intval(date('dHis')),
                            'system'    => 'front',
                            'sender'    => getenv('REMOTE_ADDR'),
                            'params'    => $params,
        );
        //return addslashes(json_encode($args));
        return json_encode($args);
    }

    /**
     * OMSからのJSONデータをArrayに変換
     * @param $responseData
     * @param $resultArr
     */
    function __convertOmsReponseDataToArray(&$responseData, &$resultArr = array()) {
        $jsonDataArr = explode("\n", $responseData);
        foreach($jsonDataArr as $key => $value) {
            $arr = (array)json_decode($value);
            if (empty($arr)) {
                continue;
            }
            if ($key > 0) {
                $resultArr['results'][] = objectToArray($arr);
            } else {
                $resultArr = objectToArray($arr);
            }
        }
    }
	/**
	 * エラーメッセージを初期化
	 */
    function __loadValidMessage() {
        if(!is_array($this->validate)){
            return true;
        }
        
        foreach($this->validate as $field => $validators){
            if (empty($validators)) {
                continue;
            }
            foreach($validators as $key => $validator) {
                if (empty($validator['message'])) {
                    $validator['message'] = "error.{$validator['rule'][0]}";
                }
                $message = __($validator['message'], true);
                $patterns = $replacements = array();
                foreach($validator['rule'] as $k => $value) {
                    if ($k == 0) continue;
                    //$message = vsprintf($message, $value);
                    $patterns[$k] = "/\{".$k."\}/";
                    $replacements[$k] = $value;

                }
                $message = preg_replace($patterns, $replacements, $message);
                $validators[$key]['message'] = $message;
            }
            $this->validate[$field] = $validators;
        }
    }

    /**
     * 名前が存在かどうかことをチェック
     * @param unknown_type $data
     * @return boolean
     */
    function isExists($data) {
        $conditions = array(
                        'conditions'    => array(
                                            $data['fieldName'] .' =' => $data['fieldValue'],
                                            'del_flg ='              => ACTIVE_FLG_FALSE,
                        ),
        );
        if (!empty($data['pKeyValue'])) {
            $conditions['conditions'][] = array($data['pKeyName'].' <>'  => $data['pKeyValue']);
        }
        $recs = $this->find('all', $conditions);
        if (!empty($recs)) {
            return true;
        }
        return false;
    }

    /**
     * 最大順番を取得
     * @return 最大順番
     */
    function getMaxOrderNumber() {
        $conditions = array(
                        'fields'	 => array(
                                        'Max(order_number) AS max_order_number',
                        ),
                        'conditions' => array(
                                        'del_flg'        => ACTIVE_FLG_FALSE,
                        ),
                        'recursive'  => 0,
        );
        $rec = $this->find('first', $conditions);
        if (!empty($rec[0]['max_order_number'])) {
            return $rec[0]['max_order_number'];
        }
        return 0;
    }
}
?>
