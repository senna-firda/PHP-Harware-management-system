<?php



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
$conn_class = new connect();
$conn = $conn_class->conn;

$array = [
    1 => "SELECT `item_id` FROM `items`",
    2 => "SELECT `item_name` FROM `items`",
];

function show_info_from_multiple_tables($conn,$array)
{
    count($array);
    var_dump($array[1]);
    $query = mysqli_query($conn,$array[1]);
    foreach($query as $row){
        echo $row['item_id']."\n";
    }
    $query = mysqli_query($conn,$array[2]);
    foreach($query as $row){
        echo $row['item_name']."\n";
    }
    
}

show_info_from_multiple_tables($conn, $array);