<?php
require "console_menus.php";
function NewLine($amount) {
    for ($i = 0; $i < $amount; $i++){
        echo "\r\n";
    }
}

function Main_Menu() {
    system('cls');
    NewLine(100);
    echo "┌────────────────────────┐\n";
    echo "│       Leen Systeem     │\n";
    echo "│                        │\n";
    echo "├──┬───   Opties   ──────┤\n";
    echo "│  └┬─(1). Admin Menu    │\n";
    echo "│   ├─(2). Student Menu  │\n";
    echo "│   └─(3). Exit          │\n";
    echo "└┬───────────────────────┘\n";
    $choice = readline(" └────> ");
    switch ($choice) {
        case "1":
            Admin_Menu();
            break;
        case "2":
            Student_Menu();
            break;
        case "3":
            exit;
        }
        
}

Main_Menu();