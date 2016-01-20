<?php
class A
{
	function af($val){
		return $val * 2 + 3;
	}
}
class C
{
	function f($val){
		return $val * 2 + 3;
	}
	function cf($arr){		
		return array_map(array(__CLASS__,'f'),$arr);
		//return array_map(array($this,'f'),$arr);
	}
}
$arr = array(
	100,
	200,
	300,
	400,
	500
);
$a = new A();
$arr1 = array_map(array($a,'af'),$arr);
print_r($arr1);
$c = new C();
$arr2 = $c->cf($arr);
print_r($arr2);