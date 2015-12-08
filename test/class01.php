<?php
class classA {
	public function _a($id, $name, $fields = array()) {
		return array('a' => 1, 'b' => 2);
	}
	public function __call($name, $arguments) {
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
		}
		return $res;
	}
	public function loadCache() {
		return false;
	}
}

$obj = new classA();
$res = $obj->a(1, array('id', 'name'));
var_dump(print_r($res, true));