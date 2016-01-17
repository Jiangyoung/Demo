<?php
var_dump(time());
$d = new DateTime();
echo '<pre>';
print_r($d);

var_dump(date('Y W'));

$time = strtotime('11week');
$date = date('Y-m-d H:i:s', $time);
var_dump($time, $date);

$date = strftime('%Y %W', time());

var_dump($date);