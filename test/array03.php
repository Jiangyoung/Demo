<?php
$m1 = memory_get_usage();
$t1 = microtime(true);
$arr = array();
for($i=0;$i<=30000;$i++){
	$arr[] = array('id'=>$i+1,'name'=>'sdkjflsjf','type'=>3);
}
$t2 = microtime(true);
//echo 'create arr : '.($t2-$t1).PHP_EOL;
$m2 = memory_get_usage();
//echo 'memory used : '.(($m2-$m1)/1024).PHP_EOL;

$t1 = microtime(true);
$m1 = memory_get_usage();
$arr1 = array_column($arr,'id');

$t2 = microtime(true);
echo 'array_column : '.($t2-$t1).PHP_EOL;
$m2 = memory_get_usage();
echo 'memory used : '.(($m2-$m1)/1024).PHP_EOL;


$t1 = microtime(true);
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


$t1 = microtime(true);
$m1 = memory_get_usage();
$arr3 = array_column($arr,'id','type');
$t2 = microtime(true);
echo 'array_column : '.($t2-$t1).PHP_EOL;
$m2 = memory_get_usage();
echo 'memory used : '.(($m2-$m1)/1024).PHP_EOL;


$t1 = microtime(true);
$t1 = microtime(true);
$m1 = memory_get_usage();
$arr4 = array();
foreach($arr as $v){
	$arr4[$v['id']] = $v['type'];
}
$t2 = microtime(true);
echo 'foreach : '.($t2-$t1).PHP_EOL;
$m2 = memory_get_usage();
echo 'memory used : '.(($m2-$m1)/1024).PHP_EOL;