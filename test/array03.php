<?php
$m1 = memory_get_usage();
echo 'memory used : '.($m1/1024).PHP_EOL;
$t1 = microtime(true);
$arr = array();
for($i=0;$i<=3000;$i++){
	$arr[] = array('id'=>$i+1,'name'=>'sdkjflsjf');
}
$t2 = microtime(true);
echo 'create arr : '.($t2-$t1).PHP_EOL;
$m2 = memory_get_usage();
echo 'memory used : '.(($m2-$m1)/1024).PHP_EOL;
