<?php
$string = 'aaaab';
$match = array();
$res = preg_replace('/a/', 'x', $string);
var_dump($res);
var_dump($match);
var_dump(preg_quote("{[/\\$%#@%^#fj"));
var_dump(mb_convert_encoding("就哭了我费劲儿", 'UTF-8'));