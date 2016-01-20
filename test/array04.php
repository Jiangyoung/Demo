<?php
$arr = array();
for($i=1;$i<=90000;$i++){
	$arr[] = array('id'=>$i,'_id'=>$i%7,'name'=>'sdkjflsjf');
}


$t1 = microtime(true);
$m1 = memory_get_usage();

//in_array foreach : 
$arr1 = array();
foreach($arr as $v){
	(in_array($v['_id'],$arr1)) ? null : $arr1[] = $v['_id'];
}

$t2 = microtime(true);
echo 'in_array foreach : '.($t2-$t1).PHP_EOL;
$m2 = memory_get_usage();
echo 'memory used : '.(($m2-$m1)/1024).PHP_EOL;




$t1 = microtime(true);
$m1 = memory_get_usage();

//empty foreach : 
$arr2 = array();
foreach($arr as $v){
	(empty($arr2['_id'])) ? ($arr2['_id']=$v['_id']) : null;
}

$t2 = microtime(true);
echo 'empty foreach : '.($t2-$t1).PHP_EOL;
$m2 = memory_get_usage();
echo 'memory used : '.(($m2-$m1)/1024).PHP_EOL;


$t1 = microtime(true);
$m1 = memory_get_usage();

//foreach =: 
$arr3 = array();
foreach($arr as $v){
	$arr3['_id']=$v['_id'];
}

$t2 = microtime(true);
echo 'foreach  =: '.($t2-$t1).PHP_EOL;
$m2 = memory_get_usage();
echo 'memory used : '.(($m2-$m1)/1024).PHP_EOL;




$t1 = microtime(true);
$m1 = memory_get_usage();

//array_column : 
$arr3 = array_column($arr,'_id');

$t2 = microtime(true);
echo 'array_column : '.($t2-$t1).PHP_EOL;
$m2 = memory_get_usage();
echo 'memory used : '.(($m2-$m1)/1024).PHP_EOL;




