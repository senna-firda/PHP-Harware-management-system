<?php
// Connection DB
$servername = "localhost"; $username = "root";
$password = ""; $db_name = "cmd_db";

$conn = new mysqli($servername,$username,$password,$db_name);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "\33[;36mDB:" . $db_name . "\n";

$fin = fopen("php://stdin", "r");

echo "\033[0;34mGive a number: ";

$line = fgets($fin);

if (trim($line) == "2") {
    // ANSI escape code for dark purple (magenta)
    echo "\033[0;35mNUMBER IS: " . $line . "\033[0m";
} else {
  echo "is not 2";
}





?>

