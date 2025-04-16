<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "cmd_db";


$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);
if (!$conn) {
    echo"". mysqli_connect_errno() ."couldn't connect";
    die();
} else {
    echo "Database: $db_name \n";
}

function Login ($connection_var,$username, $password) {
    $conn = $connection_var;

    # Gets the usernames & passwords
    $usernames = "SELECT * FROM `users`";
    $query = mysqli_query($conn,$usernames);
    while ($row = mysqli_fetch_assoc($query)) {
        echo "Username: ";
        echo $row["user_name"];
        echo "\npassword: ";
        echo $row["user_password"];

        if ($row ["user_name"] == $row["user_password"]){
            echo "correct";
        }
    }
}
?>