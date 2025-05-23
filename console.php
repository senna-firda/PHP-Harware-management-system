<?php
require "console_functions.php";

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// 5 + 15 = 20 
function Main_Menu() 
{
    cls();

    $width_class = new border_width;
    $width = $width_class->size;

    $options = [
        1 => 'Admin Menu',
        2 => 'Student Menu',
        'x' => 'Exit',
    ];

    Menu_Border("LENDING SYSTEM", $options, "TEST ERROR");
    $choice = readline("└────> ");
    switch ($choice) {
        case "1":
            Admin_Menu();
            break;
        case "2":
            Student_Menu();
            break;
        case "x" || "X":
            cls();
            exit;
        } 
    }
    
Main_Menu();