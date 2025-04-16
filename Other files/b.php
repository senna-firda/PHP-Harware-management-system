<?php


// Functions
function newline($amount) {
    for ($i = 0; $i < $amount; $i++) {
        echo "\r\n";
}}


// Menu
function Admin_Menu() {
    echo "┌───────────────────┐\n";
    echo "│    ADMIN MENU     │\n";
    echo "│                   │\n";
    echo "├──1. Get date      │\n";
    echo "├──2. Hello         │\n";
    echo "├──3. Exit          │\n";
    echo "└┬──────────────────┘\n";
    echo " └──> 1";
}



$running = true;

while ($running) {
    Admin_Menu();
    $choice = trim(fgets(STDIN));

    switch ($choice) {
        case '1':
            newline(10);
            echo "$choice \n"; 
            echo "Current Date: " . date('Y-m-d H:i:s') . "\n";
            break;
        case '2':
            echo "\n\nHello there! 👋\n\n";
            break;
        case '3':
            echo "Exiting... Goodbye!\n";
            $running = false;
            break;
        default:
            echo "Invalid option. Please try again.\n";
            break;
    }
}