<?php
$idIter = new ArrayIterator(array('1', '2', '3'));
$nameIter = new ArrayIterator(array('张三', '李四', '王五'));
$ageIter = new ArrayIterator(array('22', '21', '23'));

$mit = new MultipleIterator(MultipleIterator::MIT_KEYS_ASSOC);
$mit->attachIterator($idIter, 'ID');
$mit->attachIterator($nameIter, 'NAME');
$mit->attachIterator($ageIter, 'AGE');
$res = iterator_to_array($mit);
var_dump($res);
foreach ($mit as $value) {
	var_dump($value);
}
