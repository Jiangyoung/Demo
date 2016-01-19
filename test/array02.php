<?php

$t1 = microtime(true);
$arr = range(1,40000);
$t2 = microtime(true);
//echo 'create arr : '.($t2-$t1).PHP_EOL;


$t1 = microtime(true);
$m1 = memory_get_usage();
$arr1 = array();

//foreach :
foreach($arr as $v){
	$arr1[] = $v*3+2;
}


$t2 = microtime(true);
echo 'foreach : '.($t2-$t1).PHP_EOL;
$m2 = memory_get_usage();
echo 'memory used : '.(($m2-$m1)/1024).PHP_EOL;


$t1 = microtime(true);
$m1 = memory_get_usage();
$arr2 = array();


//for : 
for($i=0;$i<count($arr);$i++){
	$arr2[] = $v*3+2;
}


$t2 = microtime(true);
echo 'for : '.($t2-$t1).PHP_EOL;
$m2 = memory_get_usage();
echo 'memory used : '.(($m2-$m1)/1024).PHP_EOL;


$t1 = microtime(true);
$m1 = memory_get_usage();
$arr3 = array();

//for after count:
$count = count($arr);
for($i=0;$i<$count;$i++){
	$arr3[] = $v*3+2;
}


$t2 = microtime(true);
echo 'for after count: '.($t2-$t1).PHP_EOL;
$m2 = memory_get_usage();
echo 'memory used : '.(($m2-$m1)/1024).PHP_EOL;


$t1 = microtime(true);
$m1 = memory_get_usage();

//map closure function : 
$arr4 = array_map(function($val){return $val*3+2;},$arr);



$t2 = microtime(true);
echo 'map closure function : '.($t2-$t1).PHP_EOL;
$m2 = memory_get_usage();
echo 'memory used : '.(($m2-$m1)/1024).PHP_EOL;
$f = function($x){
	return $x*3+2;
};



$t1 = microtime(true);
$m1 = memory_get_usage();

//map function f: 
$arr5 = array_map($f,$arr);



$t2 = microtime(true);
echo 'map function f: '.($t2-$t1).PHP_EOL;
$m2 = memory_get_usage();
echo 'memory used : '.(($m2-$m1)/1024).PHP_EOL;

