<?php
$array = [1, 4, 2, 9, 7, 11, 10, 25, 6, 5];
$x = 3;
$kq = $x . " ko có trong mảng";
for ($i = 0; $i < count($array) - 1; $i++) {
    for ($j = $i + 1; $j < count($array); $j++) {
        if ($array[$j] < $array[$i]) {
            $temp = $array[$j];
            $array[$j] = $array[$i];
            $array[$i] = $temp;
        }
    }
}
$left = 0;
$right = count($array) - 1;
while ($left < $right) {
    $mid = intval(($left + $right) / 2);
    if ($array[$mid] == $x) {
        $kq = $x . " có xuất hiện trong mảng";
    }
    if ($array[$mid] > $x) {
        $right = $mid - 1;
    } else {
        $left = $mid + 1;
    }
}
echo $kq;
