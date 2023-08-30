<?php
$mang = [
    [1, 3, 4],
    [5, 6, 7]
];
// foreach($mang as $key => $value){
//     // echo($value);
//     foreach($value as $k =>$v){
//         echo $v;
//     }
// }
// echo count($mang[1]);
$min = $mang[0][0];
for($i = 0 ; $i < count($mang) ; $i++){
    for($j = 0 ; $j<count($mang[$i]); $j++){
        if($min>$mang[$i][$j]){
         $min = $mang[$i][$j];
        }
    }
}
echo $min;
// tìm x 