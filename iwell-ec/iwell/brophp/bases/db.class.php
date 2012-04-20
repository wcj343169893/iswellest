<?php
/** ******************************************************************************
 * brophp.com 数据库操作的基类，提供了SQL语句组合的所有方法。                    *
 * *******************************************************************************
 * 许可声明：专为《细说PHP》读者及LAMP兄弟连学员提供的“学习型”超轻量级php框架。*
 * *******************************************************************************
 * 版权所有 (C) 2011-2013 北京易第优教育咨询有限公司，并保留所有权利。           *
 * 网站地址: http://www.lampbrother.net (LAMP兄弟连)                             *
 * *******************************************************************************
 * $Author: 高洛峰 (skygao@lampbrother.net) $                                    *
 * $Date: 2011-07-18 10:00:00 $                                                  * 
 * 新增一个joins方法(关联表,被关联字段,关联字段,显示结果字段)例子：$s->joins("cat","w_cat","id","id,c_name")->select()其他调用不变
 * ******************************************************************************/
abstract class DB {
	protected $msg = array (); // 提示消息数组
	protected $tabName = ""; // 表名，自动获取
	protected $fieldList = array (); // 表字段结构，自动获取
	                                 // SQL的初使化
	protected $sql = array (
			"field" => "",
			"where" => "",
			"order" => "",
			"limit" => "",
			"group" => "",
			"having" => "",
			"joins" => "" 
	);
	
	/**
	 * 用来获取表名
	 */
	public function __get($pro) {
		if ($pro == "tabName")
			return $this->tabName;
	}
	
	/**
	 * 用于重置成员属性
	 */
	protected function setNull() {
		$this->sql = array (
				"field" => "",
				"where" => "",
				"order" => "",
				"limit" => "",
				"group" => "",
				"having" => "",
				"joins" => "" 
		);
	}
	
	/**
	 * 连贯操作调用field() where() order() limit() group() having()方法，组合SQL语句
	 * 新增一个joins方法(关联表,被关联字段,关联字段,显示结果字段)例子：$s->joins("cat","w_cat","id","id,c_name")->select()
	 * 显示结果字段用，隔开
	 */
	function __call($methodName, $args) {
		$methodName = strtolower ( $methodName );
		if (array_key_exists ( $methodName, $this->sql )) {
			if (empty ( $args [0] ) || (is_string ( $args [0] ) && trim ( $args [0] ) == '')) {
				$this->sql [$methodName] = "";
			} else {
				$this->sql [$methodName] = $args;
			}
		} else {
			Debug::addmsg ( "<font color='red'>调用类" . get_class ( $this ) . "中的方法{$methodName}()不存在!</font>" );
		}
		return $this;
	}
	
	/**
	 * 按指定的条件获取结果集中的记录数
	 */
	
	function total() {
		$where = "";
		$data = array ();
		
		$args = func_get_args ();
		if (count ( $args ) > 0) {
			$where = $this->comWhere ( $args );
			$data = $where ["data"];
			$where = $where ["where"];
		} else if ($this->sql ["where"] != "") {
			$where = $this->comWhere ( $this->sql ["where"] );
			$data = $where ["data"];
			$where = $where ["where"];
		
		}
		
		$sql = "SELECT COUNT(*) as count FROM {$this->tabName}{$where}";
		return $this->query ( $sql, __METHOD__, $data );
	}
	/**
	 * 获取查询多条结果，返回二维数组
	 */
	function select() {
		
		$fields = $this->sql ["field"] != "" ? $this->sql ["field"] [0] : implode ( ",", $this->fieldList );
		
		$where = "";
		$data = array ();
		
		$args = func_get_args ();
		if (count ( $args ) > 0) {
			$where = $this->comWhere ( $args );
			$data = $where ["data"];
			$where = $where ["where"];
		} else if ($this->sql ["where"] != "") {
			$where = $this->comWhere ( $this->sql ["where"] );
			$data = $where ["data"];
			$where = $where ["where"];
		
		}
		
		$order = $this->sql ["order"] != "" ? " ORDER BY {$this->sql["order"][0]}" : " ORDER BY {$this->fieldList["pri"]} ASC";
		$limit = $this->sql ["limit"] != "" ? $this->comLimit ( $this->sql ["limit"] ) : "";
		$group = $this->sql ["group"] != "" ? " GROUP BY {$this->sql["group"][0]}" : "";
		$having = $this->sql ["having"] != "" ? " HAVING {$this->sql["having"][0]}" : "";
		$joins = $this->sql ["joins"];
		
		$sql = "SELECT {$fields} FROM {$this->tabName}{$where}{$group}{$having}{$order}{$limit}";
		$result = $this->query ( $sql, __METHOD__, $data );
		// 新增joins方法处理过程
		if ($joins != "" && !empty($result)) {
			$j = D ( $joins [0] );
			// 查询表的所有字段joins方法(关联表,被关联字段,关联字段,显示结果字段)
			$jfilds = array ();
			foreach ( $result as $key => $value ) {
				$jfilds [] = $value [$joins [1]];
			}
			$jfilds = array_unique ( $jfilds );
			$where = empty ( $jfilds ) ? "" : ($joins [2] . " in (" . implode ( ",", $jfilds ) . ")");
			$jresult = $j->field ( $joins [3] )->where ( $where )->select ();
			// 转换数组
			$joinsResult = array ();
			// 把显示结果字段转换为数组
			$joinsFilds = explode ( ",", $joins [3] );
			// 把二维数组转换为一维数组
// 			print_r($jresult);
			foreach ( $jresult as $key => $value ) {
				$joinsResult [$value [$joinsFilds [0]]] = $value [$joinsFilds [1]];
			}
			// 加入到result中
			$outResult = array ();
			foreach ( $result as $key => $value ) {
				if ($value [$joins [1]] > 0) {
					$value [$joinsFilds [1]] = $joinsResult [$value [$joins [1]]];
					$outResult [] = $value;
				}
			}
			return $outResult;
		} else {
			return $result;
		}
	}
	/**
	 * 获取一条记录，返回一维数组
	 */
	function find($pri = "") {
		$fields = $this->sql ["field"] != "" ? $this->sql ["field"] [0] : implode ( ",", $this->fieldList );
		
		if ($pri == "") {
			$where = $this->comWhere ( $this->sql ["where"] );
			$data = $where ["data"];
			$where = $this->sql ["where"] != "" ? $where ["where"] : "";
		
		} else {
			$where = " where {$this->fieldList["pri"]}=?";
			$data [] = $pri;
		}
		$joins = $this->sql ["joins"];
		$sql = "SELECT {$fields} FROM {$this->tabName}{$where} LIMIT 1";
		
		$result = $this->query ( $sql, __METHOD__, $data );
		
		// 新增joins方法处理过程
		if ($joins != "") {
			$j = D ( $joins [0] );
			// 查询表的所有字段joins方法(关联表,被关联字段,关联字段,显示结果字段)
			// $jfilds = array ();
			// foreach ( $result as $key => $value ) {
			// $jfilds [] = $value [$joins [1]];
			// }
			// $jfilds = array_unique ( $jfilds );
			
			$where = $joins [2] . " = '" .$result[$joins [1]] . "'";
			$jresult = $j->field ( $joins [3] )->where ( $where )->select ();
			// // 转换数组
			// $joinsResult = array ();
			// //把显示结果字段转换为数组
			$joinsFilds = explode ( ",", $joins [3] );
			// //把二维数组转换为一维数组
			// // print_r($jresult);
			// foreach ( $jresult as $key => $value ) {
			// $joinsResult [$value [$joinsFilds [0]]] = $value [$joinsFilds
			// [1]];
			// }
			// // 加入到result中
			if(!empty($jresult)){
				$result [$joinsFilds [1]] = $jresult[0][$joinsFilds [1]];
			}
			return $result;
		} else {
			return $result;
		}
	}
	// filter = 1 去除 " ' 和 HTML 实体， 0则不变
	private function check($array, $filter) {
		$arr = array ();
		
		foreach ( $array as $key => $value ) {
			$key = strtolower ( $key );
			if (in_array ( $key, $this->fieldList )) {
				if (is_array ( $filter ) && ! empty ( $filter )) {
					if (in_array ( $key, $filter )) {
						$arr [$key] = $value;
					} else {
						$arr [$key] = stripslashes ( htmlspecialchars ( $value ) );
					}
				} else if (! $filter) {
					$arr [$key] = $value;
				} else {
					$arr [$key] = stripslashes ( htmlspecialchars ( $value ) );
				}
			}
		}
		return $arr;
	}
	/**
	 * 向数据库中插入一条记录
	 */
	function insert($array = null, $filter = 1) {
		if (is_null ( $array ))
			$array = $_POST;
		
		if (Validate::check ( $this->tabName, $array, "add", $this )) {
			$array = $this->check ( $array, $filter );
			
			$sql = "INSERT INTO {$this->tabName}(" . implode ( ',', array_keys ( $array ) ) . ") VALUES (" . implode ( ',', array_fill ( 0, count ( $array ), '?' ) ) . ")";
			
			return $this->query ( $sql, __METHOD__, array_values ( $array ) );
		} else {
			$this->msg = Validate::getMsg ();
			return false;
		}
	
	}
	
	/**
	 * 更新数据表中指定条件的记录
	 */
	function update($array = null, $filter = 1) {
		if (is_null ( $array ))
			$array = $_POST;
		
		if (Validate::check ( $this->tabName, $array, "mod", $this )) {
			$data = array ();
			if (is_array ( $array )) {
				if (array_key_exists ( $this->fieldList ["pri"], $array )) {
					$pri_value = $array [$this->fieldList ["pri"]];
					unset ( $array [$this->fieldList ["pri"]] );
				}
				
				$array = $this->check ( $array, $filter );
				$s = '';
				foreach ( $array as $k => $v ) {
					
					$s .= "{$k}=?,";
					$data [] = $v; // value
				}
				$s = rtrim ( $s, "," );
				$setfield = $s;
			} else {
				$setfield = $array;
				$pri_value = '';
			
			}
			
			$order = $this->sql ["order"] != "" ? " ORDER BY {$this->sql["order"][0]}" : "";
			$limit = $this->sql ["limit"] != "" ? $this->comLimit ( $this->sql ["limit"] ) : "";
			
			if ($this->sql ["where"] != "") {
				$where = $this->comWhere ( $this->sql ["where"] );
				$sql = "UPDATE  {$this->tabName} SET {$setfield}" . $where ["where"];
				
				if (! empty ( $where ["data"] )) {
					foreach ( $where ["data"] as $v ) {
						$data [] = $v; // value
					}
				}
				$sql .= $order . $limit;
			} else {
				
				$sql = "UPDATE {$this->tabName} SET {$setfield}  WHERE {$this->fieldList["pri"]}=?";
				$data [] = $pri_value; // value
			}
			
			return $this->query ( $sql, __METHOD__, $data );
		} else {
			$this->msg = Validate::getMsg ();
			return false;
		}
	
	}
	/**
	 * 删除满足条件的记录
	 */
	function delete() {
		$where = "";
		$data = array ();
		
		$args = func_get_args ();
		if (count ( $args ) > 0) {
			$where = $this->comWhere ( $args );
			$data = $where ["data"];
			$where = $where ["where"];
		} else if ($this->sql ["where"] != "") {
			$where = $this->comWhere ( $this->sql ["where"] );
			$data = $where ["data"];
			$where = $where ["where"];
		
		}
		
		$order = $this->sql ["order"] != "" ? " ORDER BY {$this->sql["order"][0]}" : "";
		$limit = $this->sql ["limit"] != "" ? $this->comLimit ( $this->sql ["limit"] ) : "";
		
		if ($where == "" && $limit == "") {
			$where = " where {$this->fieldList["pri"]}=''";
		}
		
		$sql = "DELETE FROM {$this->tabName}{$where}{$order}{$limit}";
		
		return $this->query ( $sql, __METHOD__, $data );
	}
	
	private function comLimit($args) {
		if (count ( $args ) == 2) {
			return " LIMIT {$args[0]},{$args[1]}";
		} else if (count ( $args ) == 1) {
			return " LIMIT {$args[0]}";
		} else {
			return '';
		}
	}
	
	/**
	 * 用来组合SQL语句中的where条件
	 */
	private function comWhere($args) {
		$where = " WHERE ";
		$data = array ();
		
		if (empty ( $args ))
			return array (
					"where" => "",
					"data" => $data 
			);
		
		foreach ( $args as $option ) {
			if (empty ( $option )) {
				$where = ''; // 条件为空，返回空字符串；如'',0,false 返回： '' //5
				continue;
			} else if (is_string ( $option )) {
				if (is_numeric ( $option [0] )) {
					$option = explode ( ',', $option ); // 3
					$where .= "{$this->fieldList["pri"]} IN(" . implode ( ',', array_fill ( 0, count ( $option ), '?' ) ) . ")";
					$data = $option;
					continue;
				} else {
					$where .= $option; // 2
					continue;
				}
			} else if (is_numeric ( $option )) {
				$where .= "{$this->fieldList["pri"]}=?"; // 1
				$data [0] = $option;
				continue;
			} else if (is_array ( $option )) {
				if (isset ( $option [0] )) {
					// 如果是1维数组，array(1,2,3,4); //4
					$where .= "{$this->fieldList["pri"]} IN(" . implode ( ',', array_fill ( 0, count ( $option ), '?' ) ) . ")";
					$data = $option;
					continue;
				}
				
				foreach ( $option as $k => $v ) {
					if (is_array ( $v )) {
						// 5、如果是2维数组，array('id'=>array(1,2,3,4))
						$where .= "{$k} IN(" . implode ( ',', array_fill ( 0, count ( $v ), '?' ) ) . ")";
						foreach ( $v as $val ) {
							$data [] = $val;
						}
					} else if (strpos ( $k, ' ' )) {
						// 6、array('add_time >'=>'2010-10-1')，条件key中带 > < 符号
						$where .= "{$k}?";
						$data [] = $v;
					} else if (isset ( $v [0] ) && $v [0] == '%' && substr ( $v, - 1 ) == '%') {
						// 7、array('name'=>'%中%')，LIKE操作
						$where .= "{$k} LIKE ?";
						$data [] = $v;
					} else {
						// 8、array('res_type'=>1)
						$where .= "{$k}=?";
						$data [] = $v;
					}
					$where .= " AND ";
				}
				
				$where = rtrim ( $where, "AND " );
				$where .= " OR ";
				continue;
			}
		}
		$where = rtrim ( $where, "OR " );
		return array (
				"where" => $where,
				"data" => $data 
		);
	}
	
	protected function escape_string_array($array) {
		if (empty ( $array ))
			return array ();
		$value = array ();
		foreach ( $array as $val ) {
			$value [] = str_replace ( array (
					'"',
					"'" 
			), '', $val );
		}
		return $value;
	}
	
	/**
	 * 输出完整的SQL 语句，用于调试
	 */
	protected function sql($sql, $params_arr) {
		
		if (false === strpos ( $sql, '?' ) || count ( $params_arr ) == 0)
			return $sql;
			
			// 进行 ? 的替换，变量替换
		if (false === strpos ( $sql, '%' )) {
			// 不存在%，替换问号为s%，进行字符串格式化
			$sql = str_replace ( '?', "'%s'", $sql );
			array_unshift ( $params_arr, $sql );
			return call_user_func_array ( 'sprintf', $params_arr ); // 调用函数和所用参数
		}
	}
	
	/**
	 * 级联查询
	 * 调用方式unit_select(sql语句)
	 */
	function unit_select() {
		$args = func_get_args ();
		if (count ( $args ) == 0)
			return false;
		return $this->query ( $args [0], "select" );
	}
	/**
	 * 关联查询，参数为数组，可以有多个，每个数组为一个关联的表
	 */
	function r_select() {
		$args = func_get_args ();
		if (count ( $args ) == 0 || ! is_array ( $args [0] ))
			return false;
		
		$one = $this->select ();
		$pri = $this->fieldList ["pri"];
		$pris = array ();
		
		foreach ( $one as $row ) {
			
			$pris [] = $row [$pri];
		}
		
		foreach ( $args as $tab ) {
			
			list ( $tabName, $field, $fk ) = $tab;
			
			if (! empty ( $field )) {
				if (! in_array ( $fk, explode ( ",", $field ) )) {
					$field = $field . "," . $fk;
				} else {
					$field = $field;
				}
			} else {
				$field = '';
			}
			// 以子数组的方式1:n
			if (! empty ( $tab [3] )) {
				$sub = $tab [3];
				
				$obj = D ( $tabName );
				$new = array ();
				foreach ( $one as $row ) {
					if (! empty ( $sub [1] )) {
						if (! empty ( $sub [2] )) {
							$row [$sub [0]] = $obj->field ( $field )->order ( $sub [1] )->limit ( $sub [2] )->where ( array (
									$fk => $row [$pri] 
							) )->select ();
						} else {
							$row [$sub [0]] = $obj->field ( $field )->order ( $sub [1] )->where ( array (
									$fk => $row [$pri] 
							) )->select ();
						}
					} else {
						if (! empty ( $sub [2] )) {
							
							$row [$sub [0]] = $obj->field ( $field )->limit ( $sub [2] )->where ( array (
									$fk => $row [$pri] 
							) )->select ();
						} else {
							$row [$sub [0]] = $obj->field ( $field )->where ( array (
									$fk => $row [$pri] 
							) )->select ();
						}
					}
					$new [] = $row;
				}
				
				$one = $new;
			
			} else {
				$new = array ();
				// 以平级数组的方式1:1
				$where = array (
						$fk => $pris 
				);
				
				if (! empty ( $where [$fk] )) {
					$data = D ( $tabName )->field ( $field )->where ( $where )->select ();
					foreach ( $data as $row ) {
						foreach ( $one as $read ) {
							if ($read [$pri] == $row [$fk]) {
								$new [] = $read + $row;
							}
						}
					}
				}
			}
		
		}
		return $new;
	}
	/**
	 * 关联删除
	 */
	function r_delete() {
		
		$args = func_get_args ();
		
		if (count ( $args ) == 0 || ! is_array ( $args [0] ))
			return false;
		
		$one = $this->select ();
		$pri = $this->fieldList ["pri"];
		$pris = array ();
		
		foreach ( $one as $row ) {
			
			$pris [] = $row [$pri];
		}
		
		$affected_rows = 0;
		foreach ( $args as $tab ) {
			$arr = array (
					$tab [1] => $pris 
			);
			
			if (! empty ( $arr [$tab [1]] ))
				$affected_rows += D ( $tab [0] )->where ( $arr )->delete ();
		}
		
		$affected_rows += $this->where ( $pris )->delete ();
		
		return $affected_rows;
	}
	/**
	 * 设置提示信息
	 *
	 * @param mixed $mess        	
	 */
	function setMsg($mess) {
		if (is_array ( $mess )) {
			foreach ( $mess as $one ) {
				$this->msg [] = $one;
			}
		} else {
			$this->msg [] = $mess;
		}
	
	}
	/**
	 * 获取提示信息
	 *
	 * @return string
	 */
	function getMsg() {
		$str = '';
		
		foreach ( $this->msg as $msg ) {
			$str .= $msg . '<br>';
		}
		return $str;
	}
	
	abstract function query($sql, $method, $data = array());
	abstract function setTable($tabName);
	abstract function beginTransaction();
	abstract function commit();
	abstract function rollBack();
	abstract function dbSize();
	abstract function dbVersion();
}
