<?php
require "c_functions.php";
require "connect.php";


$sql = "SELECT * FROM `producten`";
$query = mysqli_query($conn, $sql);

$i = 0;
echo "__________________________";
newline(2);
while ($row = mysqli_fetch_assoc($query)) {
    $i++;
    echo "$i  ". $row["product_naam"] ."\n";
}
echo "__________________________";
newline(2);





Login($conn,"","");
# Loop to keep the menu loaded.
$running = true;

Main_Menu();
while ($running) {
    echo "Give input >_ ";
    $choice = trim(fgets(STDIN));
    switch ($choice) {
        case "1":
            
            break;
            
        case "2":
            
            break;

        case "e" or "E": // Exit program
            $running=false;
            break;
            
        default:
            echo "Invalid option. Please try again.\n";
            break;
    }
}
echo "__________________________";