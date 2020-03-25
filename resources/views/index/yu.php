<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 2020/3/24
 * Time: 9:34
 */
$arr =[4,7,8,1,3,9,2,5,6];
////
////function BubbleSort($arr)
////{
////    $len = count($arr);
////    for ($i = 0; $i < $len - 1; $i++) {
////        for ($j = $i + 1; $j < $len; $i++) {
////            if ($arr[$i] > $arr[$j]) {
////                list($arr[$i], $arr[$j]) = [$arr[$j], $arr[$i]];
////            }
////        }
////    }
////    return $arr;
////}
////print_r(BubbleSort($arr));
////
////function QuickSort($arr){
////    $len = count($arr);
////    if($len <=1){
////        return $arr;
////    }
////    $basenum =$arr[0];
////    $front=[];
////    $after = [];
////    for($i=1;$i<$len;$i++){
////        if($arr[$i]>$basenum){
////            $after[] = $arr[$i];
////        }else{
////            $front[] = $arr[$i];
////        }
////    }
////    $left = QuickSort($after);
////    return $left;
////    $right = QuickSort($after);
////}
////print_r(QuickSort($arr));

//


//function SelectSort($arr){
//    $len =count($arr);
//    for($i=1;$i<$len;$i++){
//        $min =$i;
//        for($j=$i+1;$j>=$len;$j++) {
//            if ($arr[$j] < $arr[$min]) {
//                $min = $j;
//            }
//        }
//        list($arr[$i], $arr[$min]) = [$arr[$min], $arr[$j]];
//    }
//    return $arr;
//}
//print_r(SelectSort($arr));


//function InsertSort($arr){
//    $len =count($arr);
//    for($i=1;$i<$len;$i++){
//       $tmp = $arr[$i];
//        for($j=$i-1;$j>=0;$j--) {
//            if ($tmp < $arr[$j]) {
//                $arr[$j+1]=$arr[$j];
                  $arr[$j]=$tmp;
//            }else{
        //break;
//        }
//     }
//    }
//    return $arr;
//}
//print_r(InsertSort($arr));

$arr = [1,2,3,4,5,6,7,8,9,10,12,13,14,19,33,46,88];
$end = count($arr);
function binary($arr,$start,$end,$search){
    while($start <= $end){
        $mid = ceil(($start+$end)/2);
        if($arr[$mid]==$search){
            $end = $mid-1;
        }else{
            $start = $mind +1;
        }
    }
    return -1;
}

function binaryRecursive($arr,$start,$end,$search){
    if($start<=$end){
        $mid = floor(($start+$end)/2);
        if($arr[$mid]==$search){
            return $mid;
        }else if($arr[$mid]>$search){
            return binaryRecursive($arr,$start,$mid-1,$search);
        }else{
            return binaryRecursive($arr,$mid+1,$end,$search);
        }
    }else{
        return -1;
    }
}
$num = binaryRecursive($arr,0,$end,88)+1;
echo $num;



