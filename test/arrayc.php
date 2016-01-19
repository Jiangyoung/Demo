<?php
//array_map 在内部类中如何使用
class C
{
	public function f($val){
		return $val*3+2;
	}	
	public function test(){
		$arr = range(1,4);
		return array_map(array($this,'f'),$arr);		
	}
}
$obj = new C();
$res = $obj->test();
var_dump($res);
