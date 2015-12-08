<?php
$fruits = array(
	'apple' => 'apple value',
	'orange' => 'orange value',
	'grape' => 'grape value',
	'plum' => 'plum value',
);

$obj = new ArrayObject($fruits);
var_dump($obj);
$it = $obj->getIterator();
var_dump($it);