<?php

$magic_length = 233;
$seed=5;

function magic_number($number, $seed)
{
    $key = [
        28, 47, 65, 59, 11, 92, 36, 74, 26,
        86, 51, 77, 25, 39, 83, 53, 61, 69,
        44, 33, 70, 95, 14, 66, 24, 30, 98, 
        18, 91, 87, 41, 12, 78, 35, 49, 22, 
    ];
    $number = substr($number,1);
    $magic = 2342;
    $index = $key[$seed];
    $list_length = strlen($GLOBALS['list']);
    $key2 = ($index * $number + $magic) % $list_length;
    return $key2;
}


$list = (string)'@zX^4p$J9LMw!Q8nKc#Ru0fBt7Dg&vNZ*Yh2Rx$MCodE#Up1LPxnWk%Fz6rqN$a3yLVi*OJhGTU7%mNBWdqZ9$HlpxVtrE0YsbK!X^oZfiKJRz8@vSCpw)yeAmnDQ*cU53oEx#f^RrnLYz5@467@$5@!@%TsgZ4we'
       .'zMxvY1R@PqN&X53Wrb7*UEo!n#CAOxG^eZdK%f!ytQJN9#zr@YHKlp03EjVmuBaWXpDgO&nTRhFzCc8I@^pOLgVsMBw94xqYd*T7zXKPRFc@V6EjZa^MiLkU2o%w5!rR$e3NY6Z#XjKtFnLGAM'
       .'j#Vp0WrXly$MzE5pLguN!YA@d$exqBCtV2o^z7v%PjN*mcKRYTD63ha&EoUWgXkpnrOlBQzZ@Ry#Vd!oJPH*MNT^68xu&LFWaZ$kT3EqmPLp#O9GWRv^zBt7%AyKhMNXrOl!y3Utz#QEYJ'
       .'wPfDZahVRXm#7U8oTq!gjMCelO@pkPZ59xLTNnRU%z2^FwQKYACsmNb!prO6xV@jTdcGRy*&XquBJZkHVLyAoE9%NmFzUt#sCKqYXpT$RAoGNbKZpC5Wm37jOLu@FeXD^wr!RzMYnHP#Tz'
       .'9XbyovMZ^PWuQ!JDRcTp#kHznsA7gUeXF&BwNjY@LpOTMCxz6EqrZVy^F$AHj&uGNWykXzRD@pxBoV7#MfN9CpQUgkELZHwjP!ae%oR^TJxMCNyPbURZ#LsXF!VhzYdrKnWGqET8moLx';


$result = 77620340;





// echo strlen($list);

$magic1='';
// echo $result;
for ($i=0;$i<strlen($result);$i++){
    // $i = 1,2,3,4,5, $val = value of list, $magic = random 
    $val1 = magic_number($result/2,$i);
    $val2 = magic_number($result,$i+12);
    $val3 = magic_number($result,$i+7);
    $val4 = magic_number($result,$i+2);

    // echo "magic 1: ".$magic1."\n";
    // echo "magic 2: ".$magic2."\n";
    // echo "magic 3: ".$magic3."\n";

    $result1=$list[$val1].$list[$val2].$list[$val3].$list[$val4];

    // echo $result3;

    echo $result1;
    
    // echo (string)$list[$val];

    
}
echo "\n\n------------------------------";
echo "\n";