<?php
$t1 = microtime(true);
$arr = range(1,10000);
$t2 = microtime(true);
echo 'create arr : '.($t2-$t1).PHP_EOL;
$t1 = microtime(true);
$m1 = memory_get_usage();
$arr1 = array_map(function($val){return $val*3+2;},$arr);
$t2 = microtime(true);
echo 'closer function : '.($t2-$t1).PHP_EOL;
$m2 = memory_get_usage();
echo 'memory used : '.(($m2-$m1)/1024).PHP_EOL;


$t1 = microtime(true);
$t1 = microtime(true);
$arr2 = array_map('f',$arr);
$t2 = microtime(true);
echo 'function f: '.($t2-$t1).PHP_EOL;
$m2 = memory_get_usage();
echo 'memory used : '.(($m2-$m1)/1024).PHP_EOL;


$t1 = microtime(true);
$t1 = microtime(true);
$arr3 = array();
foreach($arr as $v){
	$arr3[] = $v*3+2;
}
$t2 = microtime(true);
echo 'foreach : '.($t2-$t1).PHP_EOL;
$m2 = memory_get_usage();
echo 'memory used : '.(($m2-$m1)/1024).PHP_EOL;


function f($x){
	return $x*3+2;
}