<?php
$arr = array(
	array('id'=>1,'value'=>4),
	array('id'=>2,'value'=>8),
	array('id'=>3,'value'=>2),
	array('id'=>4,'value'=>6)
);

usort($arr,function($a,$b){
	return $a['value'] > $b['value'];
});

print_r($arr);