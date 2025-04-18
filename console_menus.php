<?php

function cls(){
    print("\033[2J\033[;H");
}
function Admin_Menu(){
    cls();
    NewLine(00);
    echo "┌────────────────────────┐\n";
    echo "│       Admin Menu       │\n";
    echo "│                        │\n";
    echo "├──┬───   Opties   ──────┤\n";
    echo "│  └┬─(1). Login         │\n";
    echo "│   └─(2). Go Back       │\n";
    echo "│                        │\n";
    echo "└┬───────────────────────┘\n";
    $choice = readline(" └────> ");

        switch ($choice){
        case "1":
            echo "Login\n";
            $e = readline("give password: ");
            echo "password = $e";
            break;
        case "2":
            Main_Menu();
            break;
    }
}

function Student_Menu() {
    cls();
    NewLine(00);
    echo "┌────────────────────────┐\n";
    echo "│       Student Menu     │\n";
    echo "│                        │\n";
    echo "├──┬───   Opties   ──────┤\n";
    echo "│  └┬─(1). Hardware      │\n";
    echo "│   └─(2). Go Back       │\n";
    echo "│                        │\n";
    echo "└┬───────────────────────┘\n";
    $choice = readline(" └────> ");
        switch ($choice){
        case "1":
            echo "Login";
            break;
        case "2":
            Main_Menu();
            break;
    }
}