<?php
$arr = array(
	array('id' => 1, '_id' => 'a', 'age' => 22, 'name' => '张三', 'params' => array('a' => '1', 'b' => '2')),
	array('id' => 1, '_id' => 'b', 'age' => 23, 'name' => '俄三', 'params' => array('a' => '3', 'b' => '4')),
	array('id' => 3, '_id' => 'c', 'age' => 21, 'name' => '就三', 'params' => array('a' => '5', 'b' => '6')),
);
$jsonStr = json_encode($arr);
$serializeStr = serialize($arr);
$matchs = array();
echo $jsonStr . '<hr/>';
echo $serializeStr . '<hr/>';
$matchCount = preg_match("/\"params\":[\{\"]?([a-zA-Z0-9_-]+)[\}\"]?/", $jsonStr);
var_dump($matchs, $matchCount);
var_dump(array_column($arr, NULL, 'id'));
var_dump(array_column($arr, 'id'));

$x = NULL;
var_dump(isset($x));
echo '<hr/>';

function groupBy($arr, $index_key, $column_key = NULL) {
	return array_reduce($arr, function ($result, $item) use ($index_key, $column_key) {
		$result[$item[$index_key]][] = (isset($column_key) && isset($item[$column_key])) ? $item[$column_key] : $item;
		return $result;
	}, array());
}
$res = groupBy($arr, 'id', 'name');
var_dump($res);

function iarray_column($arr, $column_key, $index_key = NULL) {
	return array_reduce($arr, function ($result, $item) use ($column_key, $index_key) {
		if (isset($index_key) && isset($item[$index_key])) {
			$result[$item[$index_key]] = $item[$column_key];
		} else {
			$result[] = $item[$column_key];
		}
		return $result;
	}, array());
}
echo '<hr/>';
$res = iarray_column($arr, 'id');
var_dump($res, array_column($arr, 'id'));