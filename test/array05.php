<?php

$arr = array();
for($i=80000;$i>=1;$i--){
	$arr[] = array('id'=>$i,'_id'=>$i%7,'name'=>'sdkjflsjf');
}

$t1 = microtime(true);
$m1 = memory_get_usage();

//desc foreach : 
$arr3 = array();
foreach($arr as $v){
	(empty($arr3[$v['_id']])) ? ($arr3[$v['_id']] = $v) : null;
}
//print_r($arr1);

$t2 = microtime(true);
echo 'desc foreach : '.($t2-$t1).PHP_EOL;
$m2 = memory_get_usage();
echo 'memory used : '.(($m2-$m1)/1024).PHP_EOL;



$arr = array();
for($i=1;$i<=30000;$i++){
	$arr[] = array('id'=>$i,'_id'=>$i%7,'name'=>'sdkjflsjf');
}

$t1 = microtime(true);
$m1 = memory_get_usage();

//foreach : 
$arr2 = array();
foreach($arr as $v){
	$arr2[$v['_id']] = $v;
}
//print_r($arr1);

$t2 = microtime(true);
echo 'asc foreach : '.($t2-$t1).PHP_EOL;
$m2 = memory_get_usage();
echo 'memory used : '.(($m2-$m1)/1024).PHP_EOL;








$t1 = microtime(true);
$m1 = memory_get_usage();

//array_column : 
$arr1 = array_column($arr,null,'_id');
//print_r($arr1);

$t2 = microtime(true);
echo 'array_column : '.($t2-$t1).PHP_EOL;
$m2 = memory_get_usage();
echo 'memory used : '.(($m2-$m1)/1024).PHP_EOL;
