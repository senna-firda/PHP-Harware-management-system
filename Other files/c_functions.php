<?php

function Newline($amount) {
    for ($i = 0; $i < $amount; $i++) {
        echo "\r\n";
}}


/**
 * "Main_Menu( )" is the menu that everyone sees 
 *  when launching the program.
 */
function Main_Menu(){
    
    echo "\n";
    echo " __ __  ___  _ _  _ _\n"; 
    echo "|  \  \| __]| \ || | |\n";
    echo "|     || _] |   || | |\n";
    echo "|_|_|_||___]|_\_| \__|\n";
    echo "\n";
    echo "- 1. Admin Menu (LOGIN TEST)\n";
    echo "- 2. Student Menu\n";
    echo "- E. Exit\n";
}

function Admin_Menu() {
    echo "\n\n";
    echo " ___    _         _         __ __                 \n";
    echo "| . | _| | _ _ _ [_] _ _   |  \  \ ___  _ _  _ _  \n";
    echo "|   |/ . || ' ' || || ' |  |     |/ ._]| ' || | | \n";
    echo "|_|_|\___||_|_|_||_||_|_|  |_|_|_|\___.|_|_| \__| \n";
    
}

function Student_Menu() {
    echo "\n\n";
    echo " ___    _           _              _      __ __       \n";    
    echo "/ __] _| |_  _ _  _| | ___  _ _  _| |_   |  \  \ ___  _ _  _ _  \n";
    echo "\__ \  | |  | | |/ . |/ ._]| ' |  | |    |     |/ ._]| ' || | | \n";
    echo "[___/  |_|   \__|\___|\___.|_|_|  |_|    |_|_|_|\___.|_|_| \__| \n";
}





                                                               

?>