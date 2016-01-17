<?php
/**
 * __call方法练习程序
 *
 * @author Jiangyoung
 * @copyright 2015
 */

/**
 * 魔术方法__call 测试类
 *
 * __call方法联系
 */
class classA {
	/**
	 * a方法用来触发call方法
	 * @param int $id ID
	 * @param string $name 名称
	 * @param array $fields 字段
	 * @return array
	 */
	public function _a($id, $name, $fields = array()) {
		return array('a' => 1, 'b' => 2);
	}
	public function __call($name, $arguments) {
		//读取缓存
		$res = $this->loadCache();
		if (true === $res) {
			return true;
		}
		$argCount = count($arguments);
		$nname = '_' . $name;
		if (!method_exists($this, $nname)) {
			$arrRet = array('no this function!');
			return $arrRet;
		}
		if (3 === $argCount) {
			list($arg1, $arg2, $arg3) = $arguments;
			$res = $this->$nname($arg1, $arg2, $arg3);
		} else if (2 === $argCount) {
			list($arg1, $arg2) = $arguments;
			$res = $this->$nname($arg1, $arg2);
		} else if (1 === $argCount) {
			list($arg1) = $arguments;
			$res = $this->$nname($arg1);
		} else {
			$res = $this->$nname();
		} // End of switch.
		return $res;
	} // End of __call() method.
	public function loadCache() {
		return false;
	} // End of loadCahe() method.
} // End of ClassA class.
//实例化classA类
$obj = new classA();
//执行a方法（触发__call方法）
$res = $obj->a(1, array('id', 'name'));
//打印结果
var_dump(print_r($res, true));