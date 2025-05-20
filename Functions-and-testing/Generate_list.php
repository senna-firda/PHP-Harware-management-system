<?php


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
    59, 47, 36, 11, 98, 12, 66, 33, 61, 35, 65, 59, 51, 44, 47, 26, 24, 69, 49, 47, 
    83, 65, 70, 18, 35, 98, 77, 18, 24, 44, 59, 30, 92, 25, 66, 59, 47, 18, 74, 95, 
    47, 14, 53, 51, 61, 47, 51, 24, 61, 39, 61, 61, 12, 12, 35, 86, 74, 41, 98, 66, 
    30, 18, 59, 14, 44, 70, 66, 92, 44, 47, 25, 30, 30, 78, 65, 86, 39, 77, 33, 61, 
];

// Function to create random list with 2-character values
function generateRandomKey($key) {
    $randomKey = [];
    
    // Repeat the process the same number of times as the original array
    for ($i = 0; $i < count($key); $i++) {
        $randomIndex = array_rand($key); // Get a random index from the $key array
        $randomKey[] = $key[$randomIndex]; // Add the value to the new array
    }

    return $randomKey;
}

// Call the function and print the random key array
$randomList = generateRandomKey($key);


// echo "┌─────────┬───────────┬───────────────────────────┐\n";
// echo "│ ID      │ Category  │ Product name              │\n";
// echo "├─────────┼───────────┼───────────────────────────┤\n";
$tables = [
    "ID" => 20,
    "Items" => 40,
    "stuff" => 30,
    // "stueff" => 30,
    
];
//amount is the multidimensional array
function table_generator($amount)
{
    $total_width = array_sum($amount);
    $width = 55;
    $i = 0;
    $e=0;
    $total = 1;
    $line = 2;
    $total_value = 0;

    foreach ($amount as $table_name => $table_width){
        $total++;
        $e += strlen(str_pad($table_name, $table_width/$total_width*$width, "|",STR_PAD_BOTH))."\n";
        $last_name = $table_name;
    }
    // debugging length
    foreach ($amount as $table_name => $table_width){
        $line += strlen(str_repeat(" ",$table_width/$total_width*$width));
    }
    echo "i = ";
    for($i = 0; $i < $total-2; $i++){
        echo $i+1 . ", ";
        $line++;
    }
    echo "\n";
    $i = 0;
    // smaller
    if (floor($line) < $width){
        $difference = $width - $line;
    }   // bigger
        elseif(floor($line) > $width){
        $difference = $width - $line;
    } 

    foreach ($amount as $table_name => $table_width){
        echo $table_width/86*55 .", ";
        $total_value += $table_width;
    }
    $amount[$last_name] += $difference;
    echo "\n";
    $amount[$last_name]+=$difference;
    // echo "\nTotal width: $total_width\n";
    echo "Difference: $difference\n";
    echo "Total value: ".$total_value/86*55 ."\n";
    echo "Amount of the last value: $amount[$last_name]\n\n";
    echo "Length of repeating lines: $line\n";
    
    
    
    // Actual stuff
    echo "\n\n┌";
    foreach ($amount as $table_name => $table_width){
        $i++;
        $table_width = floor($table_width/$total_width*$width);
        $width_table = strlen(str_pad($table_name, $table_width, "|",STR_PAD_BOTH))."\n";
        echo str_repeat("─",$width_table);

        if ($i <= $total-2){
            echo "┬";
        }
    }
    
    
    echo "┐\n";
    echo "│";

    foreach ($amount as $table_name => $table_width){
        $table_width = floor($table_width/$total_width*$width);   
        echo str_pad($table_name, $table_width, " ",STR_PAD_BOTH). "│";
    }

    $i = 0;
    
    echo "\n├";
    foreach ($amount as $table_name => $table_width){
        $i++;

        $table_width = floor($table_width/$total_width*$width);
        $width_table = strlen(str_pad($table_name, $table_width, "|",STR_PAD_BOTH))."\n";

        echo str_repeat("─",$width_table);

        if ($i <= $total-2){
            echo "┼";
        } 
    }
    echo "┤";
}
// ┌────────────┬────────────────────────┬────────────────┐  
// ├─────────┼──────────────────┼─────────────┼────────────┤


table_generator($tables);