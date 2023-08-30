<?php
// class sx{
//      function __construct(){
//         $array = [12,6,3,8,99,1,5,2,5];
//         $count = count($array)-1;
//         //   for($i=0 ; $i<$count; $i++){
//         //     for($j = $i+1 ; $j<=$count ; $j++){
//         //         if($array[$j]<$array[$i]){
//         //             $temp = $array[$i];
//         //             $array[$i] = $array[$j];
//         //             $array[$j] = $temp;
//         //         }
//         //     }
//         //   }
//         for($i = 0 ; $i<$count ; $i++){
//             for($j = $count; $j > $i ; $j--){
//                 if($array[$j]<$array[$i]){
//                     $temp = $array[$i];
//                     $array[$i] = $array[$j];
//                     $array[$j]=$temp;
//                 }
//             }
//         }
//         $left =  0;
//         $x = 7;
//         $ketQuaTimkiem = "ko có";
//         $right = count($array)-1;
//         while($left < $right){
//             $mid = intval(($left + $right)/2);
//             if($array[$mid]==$x){
//                 $ketQuaTimkiem = "có";
//             }
//             if($array[$mid]>$x){
//                 $right =$mid-1;
//             }else{
//                 $left =$mid+1; 
//             }
//         }
//         // print_r($array)
//         echo $ketQuaTimkiem;
//         }
//      }
//  new sx();

// $array = [1, 1, 1];
//  for($i = 3 ; $i <100 ; $i++){
//      $array[$i] = $array[$i - 1] + $array[$i - 2] + $array[$i - 3];
//  } 
//  $tong = 0;
// //  echo $tong;
//  for($i=0; $i < count($array); $i++){
//     $tong =$tong + $array[$i];
//  }
//  $avg = $tong/count($array);
// //  echo $avg;
// //  $phai = 0;
//  for($i=0; $i < count($array)-1; $i++){
//     if($array[$i]>$avg){
//         $phai = $i;
//         break;
//     }
//  }
//  echo $array[93];
//  $trai ;
//  for($i=count($array)-1; $i >= 0; $i--){
//     if($array[$i]<$avg){
//         $trai = $i;
//         break;
//     }
//  }
//  echo $trai;
$a = [1,3,7,9,2,5];
$b = [2,5,6,7,3];
for($i=0; $i < count($a)-1; $i++){
    for($j=$i+1; $j < count($a); $j++){
        if($a[$i] < $a[$j]){
            $t = $a[$i];
            $a[$i] = $a[$j];
            $a[$j] = $t; 
        }
    }
}
print_r($a);
$c = $a + $b;   
