<?php

$arr = array();
for($i=1;$i<=30000;$i++){
	$arr[] = array('id'=>$i,'_id'=>$i%13,'name'=>'sdkjflsjf','type'=>3);
}


$t1 = microtime(true);
$m1 = memory_get_usage();

//array_column : 
$arr1 = array_column($arr,'id');

$t2 = microtime(true);
echo 'array_column : '.($t2-$t1).PHP_EOL;
$m2 = memory_get_usage();
echo 'memory used : '.(($m2-$m1)/1024).PHP_EOL;



$t1 = microtime(true);
$m1 = memory_get_usage();
$arr2 = array();
foreach($arr as $v){
	$arr2[$v['id']] = $v;
}
$t2 = microtime(true);
echo 'foreach : '.($t2-$t1).PHP_EOL;
$m2 = memory_get_usage();
echo 'memory used : '.(($m2-$m1)/1024).PHP_EOL;


