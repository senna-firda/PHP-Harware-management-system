<?php

header('Content-Type: text/plain; charset=utf-8');

$amount = [
    "Table1" => 30,
    "Table2" => 70
];

$total_width = array_sum($amount);
$width = 50;

echo "┌";
foreach ($amount as $table_name => $table_width){
    $table_width = $table_width / $total_width * $width;
    echo str_repeat("─", floor($table_width));
}
echo "┐\n";