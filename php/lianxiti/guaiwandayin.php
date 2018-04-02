<?php
/**
 * @
 */

echo 'n行:';
$n = intval(fgets(STDIN));
echo 'm列:';
$m = intval(fgets(STDIN));

$end = $n * $m;
$cursor = 1;

$result = [];
$i = $j = 0;
$result[$i][$j] = $cursor++;

while($cursor <= $end) {
    // 横走一步
    if ((0 == $i || $i == $n - 1) && $j + 1 <= $m - 1) {
        $result[$i][++$j] = $cursor++;
    // 竖走一步
    } elseif ((0 == $j || $j = $m - 1) && $i + 1 <= $n - 1) {
        $result[++$i][$j] = $cursor++;
    }

    // 左斜下
    while ($j - 1 >= 0 && $i + 1 <= $n - 1 && !isset($result[$i + 1][$j - 1])) $result[++$i][--$j] = $cursor++;

    // 左斜上
    while ($i - 1 >= 0 && $j + 1 <= $m - 1 && !isset($result[$i - 1][$j + 1])) $result[--$i][++$j] = $cursor++;
}

printResult($result, $n, $m);

function printResult($result, $n, $m) {
    echo str_repeat('--↓--', $m), PHP_EOL;
    for ($i=0;$i<$n;$i++) {
        for ($j=0;$j<$m;$j++) {
            echo sprintf("%' 4d", $result[$i][$j] ?? 0);
        }
        echo PHP_EOL;
    }
    echo str_repeat('--↑--', $m), PHP_EOL, PHP_EOL;
}




