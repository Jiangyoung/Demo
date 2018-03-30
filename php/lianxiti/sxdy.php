<?php
/**
 * 转圈打印
 */

echo 'n:';
$n = intval(fgets(STDIN));

$end = $n * $n;

$cursor = 1;
$i = $j = 0;
$result = [];
while($cursor <= $end) {
    $startCursor = $cursor;
    //横
    while(!isset($result[$i][$j]) && !isset($result[$i][$j+1]) && ($j < $n - 1)) $result[$i][$j++] = $cursor++;
    //竖
    while(!isset($result[$i][$j]) && !isset($result[$i+1][$j]) && ($i < $n - 1)) $result[$i++][$j] = $cursor++;
    //反着横
    while(!isset($result[$i][$j]) && !isset($result[$i][$j-1]) && ($j > 0) ) $result[$i][$j--] = $cursor++;
    //倒着竖
    while(!isset($result[$i][$j]) && !isset($result[$i-1][$j]) && ($i > 1) ) $result[$i--][$j] = $cursor++;
    // 结束
    if ($startCursor === $cursor) {
        $result[$i][$j] = $cursor++;
    }
    printResult($result, $n);
}

function printResult($result, $n) {
    echo str_repeat('--↓--', $n), PHP_EOL;
    for ($i=0;$i<$n;$i++) {
        for ($j=0;$j<$n;$j++) {
            echo sprintf("%' ".$n."d", $result[$i][$j] ?? 0);
        }
        echo PHP_EOL;
    }
    echo str_repeat('--↑--', $n), PHP_EOL, PHP_EOL;
}


//horizontal
//vertical

