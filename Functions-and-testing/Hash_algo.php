<?php

$magic1 = '';

function uniord($s)
{
    return unpack('V', iconv('UTF-8', 'UCS-4LE', $s))[1];
}

function Binary_to_rand($number, $seed)
{
    $key = [
        215,  64,  62,  21, 934,
        122, 523, 411,  37, 786,
        248,  19, 675,  88, 302,
        150, 998,  43, 721,  16,
        567, 340, 109,  63, 444,
        839,  72, 611,  93, 287,
        471, 354, 608, 230, 700
    ];

    $magic = 2342;
    $index = $key[$seed];
    $key2 = $index * $number ^ $magic;

    return $key2;
}

function Rand_numb($list, $number, $seed)
{
    $key = [
        30, 69, 14, 41, 12, 65, 39, 92, 28, 47, 33, 53, 36, 26, 26, 59, 86, 59, 49, 65, 
        11, 47, 36, 87, 78, 12, 83, 87, 95, 78, 77, 26, 83, 59, 39, 98, 70, 86, 30, 30, 
        83, 86, 28, 22, 53, 26, 92, 51, 24, 41, 59, 33, 49, 28, 51, 36, 74, 28, 11, 91, 
        95, 12, 65, 26, 28, 59, 91, 22, 49, 36, 83, 87, 95, 74, 95, 91, 26, 83, 98, 65, 
        22, 28, 28, 74, 47, 24, 65, 98, 91, 65, 35, 24, 33, 95, 14, 87, 33, 74, 70, 70, 
        25, 65, 25, 12, 98, 36, 98, 92, 25, 77, 35, 41, 25, 61, 69, 83, 33, 87, 74, 41, 
        77, 24, 61, 28, 44, 59, 28, 98, 47, 78, 92, 78, 91, 78, 69, 22, 78, 65, 70, 30, 
        53, 25, 51, 59, 95, 66, 92, 33, 33, 28, 47, 30, 36, 33, 91, 24, 61, 14, 44, 28, 
        77, 11, 30, 92, 83, 61, 77, 35, 78, 24, 53, 24, 53, 91, 28, 26, 59, 49, 28, 44, 
        22, 18, 36, 26, 12, 36, 91, 25, 39, 47, 26, 49, 70, 22, 28, 59, 98, 47, 70, 18, 
        24, 69, 41, 35, 49, 11, 92, 78, 86, 74, 44, 69, 25, 70, 14, 11, 24, 77, 74, 78, 
        33, 44, 12, 11, 74, 22, 87, 74, 61, 83, 87, 18, 49, 92, 44, 77, 41, 41, 24, 51, 
        12, 36, 95, 83, 14, 25, 98, 25, 44, 65, 25, 70, 86, 70, 41, 39, 25, 69, 30, 65, 
        12, 66, 87, 95, 26, 49, 95, 28, 61, 77, 47, 12, 65, 86, 35, 98, 26, 33, 61, 78, 
        22, 28, 28, 74, 47, 24, 65, 98, 91, 65, 35, 24, 33, 95, 14, 87, 33, 74, 70, 70, 
        25, 65, 25, 12, 98, 36, 98, 92, 25, 77, 35, 41, 25, 61, 69, 83, 33, 87, 74, 41, 
        77, 24, 61, 28, 44, 59, 28, 98, 47, 78, 92, 78, 91, 78, 69, 22, 78, 65, 70, 30, 
        53, 25, 51, 59, 95, 66, 92, 33, 33, 28, 47, 30, 36, 33, 91, 24, 61, 14, 44, 28, 
        77, 11, 30, 92, 83, 61, 77, 35, 78, 24, 53, 24, 53, 91, 28, 26, 59, 49, 28, 44, 
        59, 47, 36, 11, 98, 12, 66, 33, 61, 35, 65, 59, 51, 44, 47, 26, 24, 69, 49, 47, 
        83, 65, 70, 18, 35, 98, 77, 18, 24, 44, 59, 30, 92, 25, 66, 59, 47, 18, 74, 95, 
        47, 14, 53, 51, 61, 47, 51, 24, 61, 39, 61, 61, 12, 12, 35, 86, 74, 41, 98, 66, 
        30, 18, 59, 14, 44, 70, 66, 92, 44, 47, 25, 30, 30, 78, 65, 86, 39, 77, 33, 61, 
        11, 47, 36, 87, 78, 12, 83, 87, 95, 78, 77, 26, 83, 59, 39, 98, 70, 86, 30, 30, 
        83, 86, 28, 22, 53, 26, 92, 51, 24, 41, 59, 33, 49, 28, 51, 36, 74, 28, 11, 91, 
        95, 12, 65, 26, 28, 59, 91, 22, 49, 36, 83, 87, 95, 74, 95, 91, 26, 83, 98, 65, 
        22, 28, 28, 74, 47, 24, 65, 98, 91, 65, 35, 24, 33, 95, 14, 87, 33, 74, 70, 70, 
        25, 65, 25, 12, 98, 36, 98, 92, 25, 77, 35, 41, 25, 61, 69, 83, 33, 87, 74, 41, 
        59, 47, 36, 11, 98, 12, 66, 33, 61, 35, 65, 59, 51, 44, 47, 26, 24, 69, 49, 47, 
        83, 65, 70, 18, 35, 98, 77, 18, 24, 44, 59, 30, 92, 25, 66, 59, 47, 18, 74, 95, 
        47, 14, 53, 51, 61, 47, 51, 24, 61, 39, 61, 61, 12, 12, 35, 86, 74, 41, 98, 66, 
        30, 18, 59, 14, 44, 70, 66, 92, 44, 47, 25, 30, 30, 78, 65, 86, 39, 77, 33, 61,
        59, 47, 36, 11, 98, 12, 66, 33, 61, 35, 65, 59, 51, 44, 47, 26, 24, 69, 49, 47, 
        83, 65, 70, 18, 35, 98, 77, 18, 24, 44, 59, 30, 92, 25, 66, 59, 47, 18, 74, 95, 
        47, 14, 53, 51, 61, 47, 51, 24, 61, 39, 61, 61, 12, 12, 35, 86, 74, 41, 98, 66, 
        30, 18, 59, 14, 44, 70, 66, 92, 44, 47, 25, 30, 30, 78, 65, 86, 39, 77, 33, 61, 
        59, 47, 36, 11, 98, 12, 66, 33, 61, 35, 65, 59, 51, 44, 47, 26, 24, 69, 49, 47, 
        83, 65, 70, 18, 35, 98, 77, 18, 24, 44, 59, 30, 92, 25, 66, 59, 47, 18, 74, 95, 
    ];

    $number = substr($number, 1);
    $magic = 2342;
    $index = $key[$seed];
    $list_length = strlen($list);
    $number = (int) $number;
    $key2 = ($index * $number + $magic) % $list_length;
    return $key2;
}


/**
 * hashes stuff.
 * @var $input the input given
 * @var $time_cost amount of iterations
 * @var $memory amount 0 -> 10.000.000
 * @return 
 */
function Hash_Algorithm($input, $time_cost, $memory):string
{   
    $input_exploded = explode(" ", $input);
    $word_length = [];
    $binary_value = 0;
    $strlength = 3;
    $hash_length = $time_cost; // Lenght of hash
    $output = null; 
    $i = 0;
    $number = $memory;
    $memory = $memory-2;
    $list = (string) "H<+T0}YCe#*]mL1:F^Ed!Lw0-q09lX4DnxJAa0EbgxE(va,XX_f|y-9%9Rgo9Fg#.hrhY7MPz=s?VN,]i_Ed+as4tx&diX".
"VN:B_]|WO3GL_L_K5sTa-]2%A3sgZo?qIv58BPU_aKm.f0r7H?F{S1v6R=pIP,cYIDg(LZrkA;j7|Z!h0vpxhEAKlBpw>?G.ywjAewWa0On8Wf9s".
"b{u[CABY4X+:=CN=NW_hbxQcvw^.FA/_ediROhvXDvmi8X#J9k}7kdoiexM9jIBYJupF:)dy#oCJm2:9oS2x]>vw+^j&|)kaQ+%>QwVt>![kxnwv".
"geBtC7ttl#7v9x4/&z_Y4swIssk!x_7sc|8;.D=iJ?h_dFi)2!aMwYNB{VW8C:oK^8UXPryNc6edIcL/]9DJ(-<5?Dr<8n]ao+J=s/(G=dpNw3n<".
"mAU/5x!]SoNYQG|J[:?6xcRgVKlsr-Qo!3s[u6!%&wHbNCwM4>trCB{*C4M3ZhD:}DW}jBbwwpNdR8>HJ(mkD^VgbQTq+=%dVXUY5[78k%zzPh?^".
"CS?k5>V^Ho7jfm8oX-&yf#W^Wg5V_t3@hS@%c2eQ4+d%*P*OeUEQ2f,]an|8*0mod(K:_C1*uD=Iv3#R6SqUq>Z_k@o6Z#Po=Lv{G*ofLF:^kUsG".
"[lQ!i]sj5gb3bti33.{?IX/3.HT2vW{%pigen@AlAHyN.=.2yI!O?L4WEPN7IVOM?#wdhFRksyaPp0*NP}YnymAQnZka3oY08m!Oj)jxF0uTYp%%".
"cjui/yeE#h6kT!rw^HO>IT()dC=84(=uz]eESg?q>FZwIwdb1YtR*}D}[s0,.34yI%}y1B_.<D,RQ7LobH=f008l)}xbA>yui2RrzM>*f/Exi+?v".
"Boc*(ezwm1hBnbqJK7<797#vU2{1.2oowwGELlE:mnVqgMu8rmXGFz&fwOUVU@=mjO2w5dmnz5ls{DS]jN+lqVw.cF^kKsGKjs#lV!*YnpOpBZ2Y".
"Mb5ac)FkeXR.!2ecby%[./]?Y5?.9GbvIL+=EjeUdP(<3vZW+yFU}/duD_h;i[hf>xT=nV2HmGiK9JP41Zls.uhk&3gdgQG,ABrc}x,u%0;p4U5@".
"YW-@29@HsmbL,bc&DE[:BPin>Rh0-0Z4v-iO,A(0#247N*B^SEC(]vLg#5#;idEMK6X/C8|&?N3cm!vMx;NJLk-]i7,F&vYqpw9]KwsxIkCC7XCP".
"Pz)K9taz>{YMaF*L0(%fnTF>}a,H;1T9+Gu.?_*y:8SDbJVOdeu]ro5ADErBHkn[*ts|}OEHq>l/?w)m<!IqM:nI,IJBz%x4z2.SZJ-tD;B,^He-".
"SFT8h!MIjo0U7aMFJ0-32&8a9HMXujm1JBvDeC^e=p*+/FJG#k771N}_*1LIclW0wOs1Fni_oE4*jE+Mi[@C1Dp_dW74a:|YO{?wEU7&,prD@|F6".
"<oeG<Ml^a^t(PoNF1eE#^hD,WcAkKxJ[FGKc?Zce)u&%qI/.t>U4%()YP@Do_1)@^WOU4RZAVbmLN<vXy9XmT+.UbnfXfjx3<+y&R}p3oA//q7[R".
"]}<Zv25pcp?*#&VfVMM=O/k:1SaNh/J.[8m|CGt1Fyh]104Gta9.9+%1};jUgdhsppn6F,nIJ|DVi(VXoo<tf21E|JbLZ.Op7SKQSyfc=9_6H:zN".
"jq/8rlN.+lfpWD&h]RyFwT4GjVJ]?D#C)B@dV=gKUyjZb.5)_bcQ&OaZ6omL@FY-V%e,,&(1SP4q8i1BfLZ{svnxP]gHNa)#vr^qi|*fehjibsTo".
"Dun?/5[%mxfo8<7]wR9-Y3Rms|LM7WIl@gpej%hQ^WELRO>(t;,uX0na-C=*L:GE0<{ws]UA]vqLU*!TIdXf|oinv.2Rlb[(Nbe?7#T}Z7mxE</D".
"{W_HLfxZ5Eul/-(lEy(89H*+Fcj)i5k5;T(&*KkIYoZr6,o-(m[4.0dTI.h?ne|nf/)CU&N5oSmHWdiZeF9^?pX%E>;K@61VQ/+GeYJKlGc<-<ThPu";

    if ($input < $hash_length) {
        echo "$input\n";
    }

    // Loop that gets the length of each word.
    foreach ($input_exploded as $result) {
        $e = str_split($result);
        $word_length[] = count($e);
    }

    
    foreach ($word_length as $result) {
        // $h gets the length of each word
        $get_word_length = strlen($input_exploded[$i]);
        $added_value = 0;
        $total_value = 0;

        for ($_ = 1; $_ <= $get_word_length; $_++) 
        {
            $binary_value = uniord($input_exploded[$i][$_ - 1]);
            $added_value = $binary_value * Binary_to_rand($number, 25);
            $multiplied = $added_value * $_;
            $length = strlen($multiplied);

            if ($length > $strlength) 
            {
                $value = (string) $multiplied;
                $value = substr($value, 0, 3);
                $value = (int) $value;
                $total_value += (int) $value;
            }
        }

        if (strlen($output) > 2) 
        {
            $output = substr($output, 0, 19);
        } else {
            $output = substr($output, 0, 19);
        }
        $i++;
    }

    for ($ib = 0; $ib < $hash_length; $ib++) 
    {
        // $ib = 1,2,3,4,5, $val = value of list, $magic = random 
        $val1 = Rand_numb($list, $total_value / 2, $ib);
        $val = $list[$val1];
        $output .= $val;
    }
    ;
    return substr($output,0,$time_cost);
}
$e = Hash_Algorithm("TQ3QN-0JY4A-WLPDB",255,29560);
echo $e;

