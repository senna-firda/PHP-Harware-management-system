<?php
session_start();
require "Functions-and-testing/Hash_algo.php";

$PROGRAM_WIDTH = 100;
$MIN_WIDTH = 55;

/** 
 * class to get conn inside functions 
 * - assign variable to clone the connect class.
 * - then use the new cloned variable (that is a class) to create the $conn variable.
 */
class connect
{
    public $conn;
    public function __construct()
    {
        $db_host = "localhost";
        $db_user = "root";
        $db_password = "";
        $db_name = "cmd_db";
        $this->conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);
        if (!$this) {
            echo "" . mysqli_connect_errno() . "couldn't connect";
            die();
        } else {
            echo "";
        }
    }
}


class border_width {
    
    public $size;
    public $min_width;
    public function __construct()
    {
        global $PROGRAM_WIDTH;
        global $MIN_WIDTH;
        $this->size = $PROGRAM_WIDTH;
        $this->min_width = $MIN_WIDTH;
    }
}


function Menu_Border($title, $options,$error_message) {
    $size_class = new border_width();
    $width = $size_class->size;
    $min_width = $size_class->min_width; // Minimum width for table

    // Prevents width from being too small
    if ($width < $min_width){
        $width_to_add = $min_width - $width;
        $width += $width_to_add;
    }

    // Top of the border
    echo "┌" . str_repeat("─", $width) . "┐\n";

    // Title
    $title = str_pad($title,$width," ", STR_PAD_BOTH);
    echo "│{$title}│\n";

    // Options text
    echo "├". str_repeat("─",$width) . "┤\n";
    

    // Input options
    $input_options = floor($width / 2.5);
    $actions = $width - $input_options;
    
    $options_list = str_repeat("─", $input_options);
    $actions_list = str_repeat("─", $actions-1);
    
    if (!empty($options)) {
        echo "│". str_pad("Options",$width," ", STR_PAD_BOTH). "│\n";
        echo "├" . $options_list . "┬" . $actions_list . "┤\n";

        foreach ($options as $row => $label){
            $row = str_pad(" ($row)",$input_options-1," ",STR_PAD_BOTH);
            $label = str_pad($label,$actions-3," ",STR_PAD_BOTH );
            echo "│$row │ $label │\n";
            
        }    
        // Bottom of the border
        echo "├" . $options_list . "┴" . $actions_list . "┘\n";
    } else {
        echo "│". str_pad("$error_message",$width," ", STR_PAD_BOTH). "│\n";
        echo "├". str_repeat("─",$width) . "┤\n";
        $error_msg = "Press enter to go back";
        echo "│". str_pad("$error_msg",$width," ", STR_PAD_BOTH). "│\n";
        echo "├" . $options_list . "─" . $actions_list . "┘\n";
    }
}

/**
 * ### Adds newlines
 * - Configurable how many new lines 
 * - Only accepts INTEGERS
 */
function Spacer($amount)
{
    for ($i = 0; $i < $amount; $i++) {
        echo "\n";
    }
}

/**
 * ### Clears the screen
 * - Good for different menu's.
 * 
 * _Always put on top of the thing you want to render basically_
 * _it just moves the cursor all the way down (doesnt actually clear)_
 */
function cls()
{
    Spacer(100);
    print "\033[2J\033[;H";
}

/**
 * Returns a random string
 * - Is used to generate random salts for users
 */
function RandomStringGenerator($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ#!@$%*^(%)';
    $characters_length = strlen($characters);
    $random_string = '';

    for ($i = 0; $i < $length; $i++) {
        $random_string .= $characters[random_int(0, $characters_length - 1)];
    }
    return $random_string;
}


function Admin_Menu()
{
    cls();
    $width_class = new border_width;
    $width = $width_class->size;
    // Admin menu logged in
    if (isset($_SESSION["username"])) {
        // adds padding to the name so the menu looks clean
        $padded_username = str_pad($_SESSION['username'],25," ");
        $logged_in_as = "$padded_username";
        // Menu
        $options = [
            '1' => 'View hardware',
            '2' => 'Lend products',
            '3' => 'Add hardware',
            '4' => 'View lends',
            '5' => 'Remove lends',
            '6' => 'Add accounts',
            '7' => 'Logout',
            'x' => 'Go Back'
        ];

        Menu_Border("ADMIN MENU", $options, " ");
        $choice = readline("└────> ");
        switch ($choice) {
            case "1": // View Hardware
                View_Hardware(0);
                break;
            case "2": //Request hardware
                Lend_Hardware();
                break;
            case "3": // Add hardware
                Add_Hardware();
                break;
            case "4": //View lends
                View_Lends();
                break;
            case "5":   
                Return_Lends(); // Return lends
                break;
            case "6":
                Add_Accounts(); // Add accounts
                break;
            case "7":
                Logout(); //Logout
                break;
            case "x" || "X":
                Main_Menu(); // Goes to main menu
                break;
        }
    } else {
        // Admin menu not logged in
        $options = [
            '1' => 'Login',
            'x' => 'Go Back'
        ];

        Menu_Border("ADMIN MENU", $options, " ");
        $choice = readline("└────> ");
        switch ($choice) {
            case "1":
                echo "Login\n";
                Login();
                Admin_Menu();
                break;
            case "x":
                Main_Menu();
                break;
        }
    }
}

function Login()
{
    $conn_class = new connect();
    $conn = $conn_class->conn;
    $width_class = new border_width;
    $width = $width_class->size;

    cls();
    $options_empty = [];
    $options1 = [
        'Enter username' => '',
    ];

    Menu_Border("LOGIN", $options1, " ");
    $username = readline("└────> ");
    
    if (empty($username)) {
        cls();
        Menu_Border("LOGIN", $options_empty, "No username given.");
        readline("└────> ");
        return Admin_Menu();
    }

    $username = trim($username," ");
    cls();
    $options2 = [
        'Entered username' => $username,
    ];
    
    $padded_username = str_pad($username,16," ");

    Menu_Border("LOGIN", $options2, " ");
    $password = readline("└────> ");

    $sql = "SELECT * FROM `users`";
    $query = mysqli_query($conn, $sql);

    if (empty($password)) {
        cls();
        Menu_Border("LOGIN", $options_empty, "No password given");
        readline("└────> ");

        return Admin_Menu();
    }
    

    // foreach loop to get the table users
    foreach ($query as $row) {
        // if the username is equal to the username given
        if ($row['username'] == $username) {
            $pass_salt = $password.$row['salt'];
            $pass = Hash_Algorithm($pass_salt,255,29560);
            $result = $pass;
            if ($result == $row['password']) {
                $_SESSION['username'] = $username;
                
            } else {
                cls();
                Menu_Border("LOGIN", $options_empty, "Username and password doesn't match");
                readline("");
            }
        }
    }
}

function Logout()
{
    $_SESSION["username"] = null;
    return Admin_Menu();

}

function View_Hardware($menu)
{
    cls();

    $width_class = new border_width;
    $width = $width_class->size;

    $min_width = $width_class->min_width;

    if ($width < $min_width){
        $width_to_add = $min_width - $width;
        $width += $width_to_add;
    }

    $conn_class = new connect();
    $conn = $conn_class->conn;

    $sql = "SELECT * FROM `items`";
    $query = mysqli_query($conn, $sql);

    // Counter
    $i = 0;
    $_10_percent = $width/10;
    // Arrays used for padding
    $item_array = [];
    $category_pad_array = [];
    echo "┌".str_repeat("─",$width)."┐\n";
    echo "│".str_pad("VIEW LOANS",$width," ",STR_PAD_BOTH)."│\n";

    echo "├─".str_repeat("─",$_10_percent)."┬";
    echo str_repeat("─",$_10_percent*3)."─┬";
    echo str_repeat("─",$_10_percent*5.6)."┤\n";
    
    echo "│ ".str_pad("ID",$_10_percent," ",STR_PAD_BOTH)."│";
    echo str_pad("CATEGORY",$_10_percent*3," ",STR_PAD_BOTH)." │";
    echo str_pad("ITEM NAME",$_10_percent*5.6," ",STR_PAD_BOTH)."│\n";

    echo "├─".str_repeat("─",$_10_percent)."┼";
    echo str_repeat("─",$_10_percent*3)."─┼";
    echo str_repeat("─",$_10_percent*5.6)."┤\n";
    
    foreach ($query as $row) {
        // $item_array[] = str_pad($row['item_name'], 30, " ", STR_PAD_RIGHT);
        $sql = "SELECT * FROM `categories` WHERE `category_id` = {$row['category_id']}";
        $query = mysqli_query($conn, $sql);
        $category = mysqli_fetch_assoc($query)['category_name'] ?? '';
        $category_padded = str_pad($category, $_10_percent*3+1, " ", STR_PAD_BOTH);
        $item_array[] = str_pad($row['item_name'],$_10_percent*5.6, " ", STR_PAD_BOTH);
    }
    
    foreach ($item_array as $result) {
        $i += 1;
        $id_table = str_pad($i,$_10_percent," ",STR_PAD_BOTH);
        
        echo "│ {$id_table}│{$category_padded}│{$result}│";
        echo "\n";
    }
    echo "├─".str_repeat("─",$_10_percent)."┴";
    echo str_repeat("─",$_10_percent*3)."─┴";
    echo str_repeat("─",$_10_percent*5.6)."┤\n";
    echo "│".str_pad("Press enter to go back",$width," ",STR_PAD_BOTH)."│\n";
    echo "├".str_repeat("─",$width)."┘\n";

    readline("└────> ");

    if ($menu === 0) {
        Admin_Menu();
    } elseif ($menu === 1) {
        Student_Menu();
    }
}

function Lend_Hardware()
{
    cls();
    
    $conn_class = new connect();
    $conn = $conn_class->conn;

    $sql = "SELECT * FROM `items`";
    $query = mysqli_query($conn, $sql);

    // Counter
    $i = 0;
    // Arrays are used for padding
    $item_array = [];
    $category_pad_array = [];

    $selected_sql = "SELECT * FROM `items`";
    $selected_query = mysqli_query($conn,$selected_sql);

    // List of items
    echo "┌─────────┬───────────┬───────────────────────────┐\n";
    echo "│ ID      │ Category  │ Product name              │\n";
    echo "├─────────┼───────────┼───────────────────────────┤\n";

    foreach ($query as $row) {
        // $item_array[] = str_pad($row['item_name'], 30, " ", STR_PAD_RIGHT);
        $sql = "SELECT * FROM `categories` WHERE `category_id` = {$row['category_id']}";
        $query = mysqli_query($conn, $sql);
        $category = mysqli_fetch_assoc($query)['category_name'] ?? '';

        $category_padded = str_pad($category, 10, " ", STR_PAD_RIGHT);
        $final_result = $category_padded. "│  " . $row['item_name'];
        $item_array[] = str_pad($final_result, 39, " ", STR_PAD_RIGHT);
    }

    foreach ($item_array as $result) {
        $i += 1;
        $counterpadding = str_pad($i, 7, " ", STR_PAD_RIGHT);

        echo "│ $counterpadding │ {$result} │";
        echo "\n";
    }
    echo "├─────────┴───────────┴───────────────────────────┤\n";
    echo "│       Type item number here | 'x' to exit       │\n";
    echo "├─────────────────────────────────────────────────┘\n";
    $lend = readline("└────> ");

    
    cls();

    if ($lend == "x" || $lend == "X"){
        return Admin_Menu();
    }

    if ($lend > $i || $lend == 0 || empty($lend)) {
        echo "";
        echo "┌─────────────────────────────────────────────────┐\n";
        echo "│                    ADD LOAN                     │\n";
        echo "├─────────────────────────────────────────────────┤\n";
        echo "│           Selected Item doesn't exit            │\n";
        echo "├─────────────────────────────────────────────────┤\n";
        echo "│             Press enter to go back              │\n";
        echo "├─────────────────────────────────────────────────┘\n";
        readline("└────> ");
        return Admin_Menu();
    }



    foreach($selected_query as $row){
        if ($lend == $row['item_id']){
            $selected_item = $row['item_name'];
            $selected_item = str_pad($selected_item, 32," ");
        } 
    }
    
    echo "┌─────────────────────────────────────────────────┐\n";
    echo "│                    ADD LOAN                     │\n";
    echo "├──────────────┬──────────────────────────────────┤\n";
    echo "│ Selected     │ $selected_item │\n";
    echo "├──────────────┴──────────────────────────────────┤\n";
    echo "│           Enter student number (Max:6)          │\n";
    echo "├─────────────────────────────────────────────────┘\n";
    $lend = intval($lend);
    $student = readline("└────> ");

    // 6 digit student number
    if (strlen($student) != 6) {
        cls();

        echo "┌─────────────────────────────────────────────────┐\n";
        echo "│                    ADD LOAN                     │\n";
        echo "├─────────────────────────────────────────────────┤\n";
        echo "│        Stundent number should be 6 digits       │\n";
        echo "├─────────────────────────────────────────────────┤\n";
        echo "│             Press enter to go back              │\n";
        echo "├─────────────────────────────────────────────────┘\n";
        readline("└────> ");

        return Admin_Menu();
    }

    // SQL query
    $status_sql = "SELECT `status` FROM `items` WHERE `item_id` = $lend";
    $status_query = mysqli_query($conn, $status_sql);
    $status_row = mysqli_fetch_assoc($status_query);

    // Prevents item for being loaned if it's not available
    if ($status_row && $status_row['status'] === "unavailable") {
        echo "Item selected is unavailable\n";
        readline("Press 'enter' to go back to the admin menu ");
        Admin_Menu();
        return;
    }

    // SQL query
    $sql_lend = "SELECT * FROM `items` WHERE `item_id` = $lend";
    $lend_query = mysqli_query($conn, $sql_lend);

    foreach ($lend_query as $selected) {
        echo "Selected item: " . $selected['item_name'] . "\n\n";
    }

    // Current time and due date
    $current_time = date("Y-m-d H:i:s");
    $due_date_query = strtotime("+1 Months");
    $due_date = date("Y-m-d H:i:s", $due_date_query);

    // Insert new row query (Creates a new loan)
    $insert = "INSERT INTO `loans`(`loan_id`, `student_number`, `item_id`, `issue_date`, `due_date`) 
            VALUES ('[]','$student','$lend','$current_time','$due_date')";
    mysqli_query($conn, query: $insert);

    // Update query
    $update_item = "UPDATE `items` SET `status`='unavailable' WHERE `item_id` = $lend";
    mysqli_query($conn, query: $update_item);

    cls();

    // Show loan information
    echo "┌─────────────────────────────────────────────────┐\n";
    echo "│            Successfully added new loan!         │\n";
    echo "├──────────────┬──────────────────────────────────┤\n";
    echo "│ Student      │ $student                           │\n";
    echo "├──────────────┼──────────────────────────────────┤\n";
    echo "│ Lend item    │ $selected_item │\n";
    echo "├──────────────┼──────────────────────────────────┤\n";   
    echo "│ Time lend    │ $current_time              │\n";
    echo "├─────────────────────────────────────────────────┤\n";
    echo "│             Press enter to go back              │\n";
    echo "├─────────────────────────────────────────────────┘\n";
    readline("└────> ");

    Admin_Menu();
}

function Add_Hardware()
{
    cls();

    $conn_class = new connect();
    $conn = $conn_class->conn;

    $i = 1;
    $counter = 1;
    $category_sql = "SELECT * FROM `categories`";
    $category_query = mysqli_query($conn, $category_sql);
    $item_sql = "SELECT * FROM `items`";
    $item_query = mysqli_query($conn, $item_sql);
    $status = "available";
    $category_name_array = [];


    echo "┌─────────────────────────────────────────────────┐\n";
    echo "│                  ADD HARDWARE                   │\n";
    echo "├──────────────┬──────────────────────────────────┤\n";
    
    

    foreach ($category_query as $row) {
        // adds "category names" to the array
        $category_name_array[] = $row['category_name'];

        foreach ($category_name_array as $result) {
            $e = str_pad($result, 32, " ", STR_PAD_RIGHT);
            
        }

        $padded_ids = str_pad($row['category_id'],8," ",STR_PAD_RIGHT);
        echo "│ ID: $padded_ids │  {$e}│\n";
        $counter++;
    }

    echo "├──────────────┴──────────────────────────────────┤\n";   
    echo "│       Select Category Id | 'x' to go back       │\n";
    echo "├─────────────────────────────────────────────────┘\n";
    $category = readline("└────> ");


    // ID Counter
    foreach ($item_query as $row) {
        $i++;
    }


    if (empty($category) || $category == 0 || $category >= $counter) {
        echo "┌─────────────────────────────────────────────────┐\n";
        echo "│                  ADD HARDWARE                   │\n";
        echo "├─────────────────────────────────────────────────┤\n";
        echo "│          Category chosen does not exist         │\n";
        echo "├─────────────────────────────────────────────────┤\n";
        echo "│             Press enter to go back              │\n";
        echo "├─────────────────────────────────────────────────┘\n";
        readline("└────> ");
        return Admin_Menu();
    }

    $selected_sql = "SELECT * FROM `categories` WHERE `category_id` = $category";
    $selected_query = mysqli_query($conn,$selected_sql);
    if (!$selected_query) {
        die("Query failed: " . mysqli_error($conn) . "\nSQL: " . $selected_sql);
    }
    $result = mysqli_fetch_assoc($selected_query)["category_name"] ?? '';


    cls();

    echo "┌─────────────────────────────────────────────────┐\n";
    echo "│                  ADD HARDWARE                   │\n";
    echo "├──────────────┬──────────────────────────────────┤\n";
    $padded_category = str_pad($result,33," ",STR_PAD_BOTH);
    echo "│   Selected   │$padded_category │\n";
    echo "├──────────────┴──────────────────────────────────┤\n";   
    echo "│   Enter product name (max:24) | 'x' to go back  │\n";
    echo "├─────────────────────────────────────────────────┘\n";
    $item_name = readline("└────> ");
    

    // Empty inputs
    if (empty($item_name)) {
        cls();

        echo "┌─────────────────────────────────────────────────┐\n";
        echo "│                  ADD HARDWARE                   │\n";
        echo "├─────────────────────────────────────────────────┤\n";
        echo "│  Item name must be smaller than 24 characters   │\n";
        echo "├─────────────────────────────────────────────────┤\n";
        echo "│             Press enter to go back              │\n";
        echo "├─────────────────────────────────────────────────┘\n";
        readline("└────> ");
        return Admin_Menu();
    }
    
    // Item name length limit (Max = 23)
    if (strlen($item_name) > 23){
        echo "┌─────────────────────────────────────────────────┐\n";
        echo "│                  ADD HARDWARE                   │\n";
        echo "├─────────────────────────────────────────────────┤\n";
        echo "│  Item name must be smaller than 24 characters   │\n";
        echo "├─────────────────────────────────────────────────┤\n";
        echo "│             Press enter to go back              │\n";
        echo "├─────────────────────────────────────────────────┘\n";
        readline("└────> ");
        return Admin_Menu();
    }

    $insert_query = "INSERT INTO `items`(`item_id`, `status`, `category_id`, `item_name`) 
    VALUES ('$i','$status','$category','$item_name')";
    mysqli_query($conn, $insert_query);

    echo "┌─────────────────────────────────────────────────┐\n";
    echo "│                  ADD HARDWARE                   │\n";
    echo "├─────────────────────────────────────────────────┤\n";
    echo "│          Successfully added new item!           │\n";
    echo "├─────────────────────────────────────────────────┤\n";
    echo "│             Press enter to go back              │\n";
    echo "├─────────────────────────────────────────────────┘\n";
    readline("└────> ");
    Admin_Menu();
}

function View_Lends()
{
    cls();

    $conn_class = new connect();
    $conn = $conn_class->conn;

    $current_time = date("Y-m-d");
    $current_time = str_pad($current_time,22," ",STR_PAD_RIGHT);
    $view_loans = "SELECT * FROM `loans`";
    $loan_query = mysqli_query($conn,$view_loans);
    
    echo "┌─────────────────────────────────────────────────┐\n";
    echo "│                    VIEW LENDS                   │\n";
    echo "├────┬────────────┬───────────┬────────┬──────────┤\n";
    echo "│ ID │ STUDENT ID │  DUEDATE  │  MAIL  │ RETURNED │\n";

    // List of lends
    foreach($loan_query as $row){
        // Padding 
        $row['loan_id'] = str_pad($row['loan_id'],4," ", STR_PAD_BOTH);
        $row['student_number'] = str_pad($row['student_number'],12," ", STR_PAD_BOTH);
        $row['item_id'] = str_pad($row['item_id'],7," ", STR_PAD_BOTH);
        $row['due_date'] = substr($row['due_date'],0,11);

        if ($row['email_send'] == True) {
            $mail = str_pad("Send",8," ",STR_PAD_BOTH);
        } else {
            $mail = str_pad("Queued",8," ",STR_PAD_BOTH);
        }

        

        if ($row['is_returned']== 0){
            $is_due = str_pad("Not back",10," ",STR_PAD_BOTH);
        } else {
            $is_due =str_pad("Returned",10," ",STR_PAD_BOTH);;
        }

        echo "├────┼────────────┼───────────┼────────┼──────────┤\n";
        echo "│{$row['loan_id']}│{$row['student_number']}│{$row['due_date']}│{$mail}│{$is_due}│\n";
    
        
    }

    echo "├────┴────────────┴───────────┴────────┴──────────┤\n";
    echo "│             Press enter to go back              │\n";
    echo "├─────────────────────────────────────────────────┘\n";
    readline("└────> ");
    
    return Admin_Menu();
}

function Add_Accounts()
{
    cls();

    $conn_class = new connect();
    $conn = $conn_class->conn;
    $salt = RandomStringGenerator(16);
    
    $users = "SELECT * FROM `users`";
    $user_query = mysqli_query($conn, $users);

    echo "┌─────────────────────────────────────────────────┐\n";
    echo "│                 ADD NEW ACCOUNT                 │\n";
    echo "├─────────────────────────────────────────────────┤\n";
    echo "│          Enter new username (max = 16)          │\n";
    echo "├─────────────────────────────────────────────────┘\n";   

    $username = readline("└────> ");

    foreach ($user_query as $row) {
        if ($row['username'] == $username){
            echo "┌─────────────────────────────────────────────────┐\n";
            echo "│                 ADD NEW ACCOUNT                 │\n";
            echo "├─────────────────────────────────────────────────┤\n";
            echo "│             Username already taken              │\n";
            echo "├─────────────────────────────────────────────────┤\n";
            echo "│             Press enter to go back              │\n";
            echo "├─────────────────────────────────────────────────┘\n";
            readline("└────> ");
            
            return Admin_Menu();
        }
    }

    if (strlen($username) > 16){
        cls();

        echo "┌─────────────────────────────────────────────────┐\n";
        echo "│                 ADD NEW ACCOUNT                 │\n";
        echo "├─────────────────────────────────────────────────┤\n";
        echo "│       Username longer than (16) characters.     │\n";
        echo "├─────────────────────────────────────────────────┤\n";
        echo "│             Press enter to go back              │\n";
        echo "├─────────────────────────────────────────────────┘\n";
        readline("└────> ");

        return Admin_Menu();
    }

    if (strpos($username, ' ') !== false){
        echo "┌─────────────────────────────────────────────────┐\n";
        echo "│                 ADD NEW ACCOUNT                 │\n";
        echo "├─────────────────────────────────────────────────┤\n";
        echo "│          Cannot add spaces in username          │\n";
        echo "├─────────────────────────────────────────────────┤\n";
        echo "│             Press enter to go back              │\n";
        echo "├─────────────────────────────────────────────────┘\n";
        readline("└────> ");
        return Admin_Menu();
    } 

    if (empty($username)) {
        cls();
        echo "┌─────────────────────────────────────────────────┐\n";
        echo "│                 ADD NEW ACCOUNT                 │\n";
        echo "├─────────────────────────────────────────────────┤\n";
        echo "│                No username given                │\n";
        echo "├─────────────────────────────────────────────────┤\n";
        echo "│             Press enter to go back              │\n";
        echo "├─────────────────────────────────────────────────┘\n";
        readline("└────> ");

        return Admin_Menu();
    } elseif (!empty($username)) {
        cls();

        $username = str_pad($username,33," ",STR_PAD_BOTH);

        echo "┌─────────────────────────────────────────────────┐\n";
        echo "│                 ADD NEW ACCOUNT                 │\n";
        echo "├──────────────┬──────────────────────────────────┤\n";
        echo "│ New username │$username │\n";
        echo "├──────────────┴──────────────────────────────────┤\n";
        echo "│          Enter new password (max = 16)          │\n";
        echo "├─────────────────────────────────────────────────┘\n";  
    }
    $password = readline("└────> ");


    // check if password is given
    if (empty($password)) {
        cls();
        echo "┌─────────────────────────────────────────────────┐\n";
        echo "│                 ADD NEW ACCOUNT                 │\n";
        echo "├─────────────────────────────────────────────────┤\n";
        echo "│                No password given                │\n";
        echo "├─────────────────────────────────────────────────┤\n";
        echo "│             Press enter to go back              │\n";
        echo "├─────────────────────────────────────────────────┘\n";
        readline("└────> ");
        return Admin_Menu();
    }

    cls();

    $password_salted = (string)$password . $salt;
    $password_salted = Hash_Algorithm($password_salted,255,29560);


    $stmt = $conn->prepare("INSERT INTO `users`(`username`, `password`, `salt`) 
            VALUES (?,?,?)");
    $stmt->bind_param("sss", $username, $password_salted, $salt);




    $password = str_pad($password,33," ",STR_PAD_BOTH);
    cls();
    echo "┌─────────────────────────────────────────────────┐\n";
    echo "│                 ADD NEW ACCOUNT                 │\n";
    echo "├──────────────┬──────────────────────────────────┤\n";
    echo "│ New username │$username │\n";
    echo "├──────────────┼──────────────────────────────────┤\n";
    echo "│ New password │$password │\n";
    echo "├─────────────────────────────────────────────────┤\n";
    echo "│             Enter your own password             │\n";
    echo "├─────────────────────────────────────────────────┘\n";
    $Admin_password = readline("└────> ");

    

    foreach ($user_query as $row) {
        if (!isset($_SESSION["username"])) {
            cls();
            echo "┌─────────────────────────────────────────────────┐\n";
            echo "│                 ADD NEW ACCOUNT                 │\n";
            echo "├─────────────────────────────────────────────────┤\n";
            echo "│    Somehow you aren't even meant to be here     │\n";
            echo "├─────────────────────────────────────────────────┤\n";
            echo "│             Press enter to go back              │\n";
            echo "├─────────────────────────────────────────────────┘\n";
            readline("└────> ");

            return Admin_Menu();
        }



        $salted = $Admin_password.$row['salt'];
        $pass_salt = Hash_Algorithm($salted,255,29560);

        if ($pass_salt !== $row['password']) {
            cls();
            echo "┌─────────────────────────────────────────────────┐\n";
            echo "│                 ADD NEW ACCOUNT                 │\n";
            echo "├─────────────────────────────────────────────────┤\n";
            echo "│             Wrong account password              │\n";
            echo "├─────────────────────────────────────────────────┤\n";
            echo "│             Press enter to go back              │\n";
            echo "├─────────────────────────────────────────────────┘\n";
            readline("└────> ");

            return Admin_Menu();
        } 

        if ($stmt->execute()) {
            cls();
            echo "┌─────────────────────────────────────────────────┐\n";
            echo "│                 ADD NEW ACCOUNT                 │\n";
            echo "├─────────────────────────────────────────────────┤\n";
            echo "│         Successfully added new account!         │\n";
            echo "├─────────────────────────────────────────────────┤\n";
            echo "│             Press enter to go back              │\n";
            echo "├─────────────────────────────────────────────────┘\n";
            readline("└────> ");
            
        }

    }
    return Main_Menu();
}

function Return_Lends()
{
    cls();

    $conn_class = new connect();
    $conn = $conn_class->conn;

    $current_time = date("Y-m-d H:i:s");

    $view_loans = "SELECT * FROM `loans`";
    $loan_query = mysqli_query($conn,$view_loans);

    $users = "SELECT * FROM `users`";
    $user_query = mysqli_query($conn, $users);
    
    echo "┌─────────────────────────────────────────────────┐\n";
    echo "│                  Remove Lends                   │\n";
    echo "├────┬────────────────┬───────┬──────────┬────────┤\n";
    echo "│ ID │ STUDENT NUMBER │ITEM ID│   MAIL   │ IS DUE │\n";
    // List of lends
    foreach($loan_query as $row){
        if ($row['is_returned'] == 0){
            // Padding 
            $row['loan_id'] = str_pad($row['loan_id'],4," ", STR_PAD_BOTH);
            $row['student_number'] = str_pad($row['student_number'],16," ", STR_PAD_BOTH);
            $row['item_id'] = str_pad($row['item_id'],7," ", STR_PAD_BOTH);

            if ($row['email_send'] == True) {
                $mail = str_pad("Send",10," ",STR_PAD_BOTH);
            } else {
                $mail = str_pad("Not Send",10," ",STR_PAD_BOTH);
            }

            if ($row['due_date']>= $current_time){
                $is_due = str_pad("Loan Due",6," ",STR_PAD_RIGHT);
            } else {
                $is_due =str_pad("Not Due",8," ",STR_PAD_RIGHT);;
            }

            echo "├────┼────────────────┼───────┼──────────┼────────┤\n";
            echo "│{$row['loan_id']}│{$row['student_number']}│{$row['item_id']}│{$mail}│{$is_due}│\n";
        }
    }
    
    echo "├────┴────────────────┴───────┴──────────┴────────┤\n";
    echo "│            Select ID to return loan             │\n";
    echo "├─────────────────────────────────────────────────┘\n";
    $returned_loan = readline("└────> ");
    $returned_loan = trim($returned_loan);

    cls();

    foreach ($loan_query as $row){
        // Sets the result to the selected row if it exists and is not turned in
        $result = null;
        foreach ($loan_query as $row) {
            if ($row['loan_id'] == $returned_loan && $row['is_returned'] == 0) {
                $result = $row;
                break;
            }
        }
        
        // Error message if it doesn't exist
        if (!$result) {
            cls();

            echo "┌─────────────────────────────────────────────────┐\n";
            echo "│                  Remove Lends                   │\n";
            echo "├─────────────────────────────────────────────────┤\n";
            echo "│         Selected loan ID does not exist         │\n";
            echo "├─────────────────────────────────────────────────┤\n";
            echo "│             Press enter to go back              │\n";
            echo "├─────────────────────────────────────────────────┘\n";
            readline("└────> ");
            return Admin_Menu();
        } else {
            cls();

            // Padding variables to fit inside List
            $loan_id = str_pad($row['loan_id'],32," ",STR_PAD_BOTH);
            $duedate = str_pad($row['due_date'],32," ",STR_PAD_BOTH);
            $current_time = str_pad($current_time,32," ",STR_PAD_BOTH);

            // Time difference (if loan is due or not)
            $date1 = date_create($current_time);
            $date2 = date_create($row['due_date']);

            $diff = date_diff($date1, $date2);

            $time = $diff->format('%a days');

            if ($row['due_date'] <= $current_time){
                echo "Loan is already due $time.\n";
                $timediff = str_pad("Due $time",32," ",STR_PAD_BOTH);
            } else {
                $timediff = str_pad("$time left",32," ",STR_PAD_BOTH);
            }  

            // Selected loan
            echo "┌─────────────────────────────────────────────────┐\n";
            echo "│                  Remove Lends                   │\n";
            echo "├──────────────┬──────────────────────────────────┤\n";
            echo "│ CURRENT TIME │ $current_time │\n";
            echo "│   SELECTED   │ $loan_id │\n";
            echo "│   DUE DATE   │ $duedate │\n";
            echo "│    STATUS    │ $timediff │\n";
            echo "├─────────────────────────────────────────────────┤\n";
            echo "│     Enter your own password to turn in lend.    │\n";
            echo "├─────────────────────────────────────────────────┘\n";
            $Admin_password = readline("└────> ");

            $rowid = $row['item_id'];
            $available = "available";
            $is_returned = 1;
            $loan_id = $returned_loan;

            $stmt = $conn->prepare("UPDATE `loans` SET `is_returned`=? WHERE `loan_id` = ?");
            $stmt->bind_param("ii",$is_returned,$loan_id);  

            $stmtitem = $conn->prepare("UPDATE `items` SET `status` = ? WHERE `item_id` = ?");
            $stmtitem->bind_param("si", $available, $rowid);  
    }

    foreach ($user_query as $row) {
        if ($_SESSION["username"] == $row['username']) {
            $pass_salt = Hash_Algorithm($Admin_password . $row['salt'],255,29560);
            $password = $row['password'];
        }
    }
    
    if (!hash_equals($password, $pass_salt)) {
        cls();

        echo "┌─────────────────────────────────────────────────┐\n";
        echo "│                  Remove Lends                   │\n";
        echo "├─────────────────────────────────────────────────┤\n";
        echo "│   Password does not match, loan not deleted     │\n";
        echo "├─────────────────────────────────────────────────┤\n";
        echo "│             Press enter to go back              │\n";
        echo "├─────────────────────────────────────────────────┘\n";
        readline("└────> ");
        return Admin_Menu();
    }

    if ($stmt->execute() && $stmtitem->execute()){
        cls();
        
        echo "┌─────────────────────────────────────────────────┐\n";
        echo "│                  Remove Lends                   │\n";
        echo "├─────────────────────────────────────────────────┤\n";
        echo "│           Loan successfully turned in           │\n";
        echo "├─────────────────────────────────────────────────┤\n";
        echo "│             Press enter to go back              │\n";
        echo "├─────────────────────────────────────────────────┘\n";
        readline("└────> ");
    } else {
        cls();
        
        echo "┌─────────────────────────────────────────────────┐\n";
        echo "│                  Remove Lends                   │\n";
        echo "├─────────────────────────────────────────────────┤\n";
        echo "│      Error removing loan, contact support       │\n";
        echo "├─────────────────────────────────────────────────┤\n";
        echo "│             Press enter to go back              │\n";
        echo "├─────────────────────────────────────────────────┘\n";
        readline("└────> ");
    }
    

    return Admin_Menu();
}
}

function Student_Menu()
{
    cls();

    $width_class = new border_width;
    $width = $width_class->size;
    $options = [
        1=>"View hardware",
        'x' =>"Go back"
    ];

    Menu_Border( "STUDENT MENU", $options, " ");

    $choice = readline("└────> ");
    switch ($choice) {
        case "1":
            View_Hardware(1); // View hardware
            break;
        case "x"||"X":
            Main_Menu();
            break;
    }
}