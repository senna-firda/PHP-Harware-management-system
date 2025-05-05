<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Email-runner/vendor/autoload.php';
require "Functions-and-testing/Hash_algo.php";


class connect
{
    public $conn;
    public function __construct()
    {

        
    }
}


function RandomStringGenerator($length)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ#!@$%*^(%)';
    $characters_length = strlen($characters);
    $random_string = '';

    for ($i=0; $i<$length; $i++) {
        $random_string .= $characters[random_int(0,$characters_length-1)];
    }
    return $random_string;
}   


function create_salted_password()
{
    $conn_class = new connect();
    $conn = $conn_class->conn;

    //salt
    $salt = RandomStringGenerator(16);
    $salt_hashed = hash('md2',$salt,0);
    echo $salt;


    $username = readline(" give username to generate salt>_ ");
    // echo $username.$password;
    $sql = "SELECT * FROM `users`";
    $query = mysqli_query($conn,$sql);
    foreach ($query as $row)
    {
        if ($row['username'] == $username){
            echo "hashed salt: $salt_hashed \n";
            echo "Password:".$row['password']."\n";
            $salted_pass = $salt_hashed.$row['password'];
            $update = "UPDATE `users` SET `password` = '" .$salted_pass."',`salt`='".$salt."'WHERE`username`='".$username ."'";

            mysqli_query($conn,$update);
        }
    }
}

// email information
function Send_Emails()
{
    $conn_class = new connect();
    $conn = $conn_class->conn;

    $mail_variable = new PHPMailer(true);

    $mail_variable->isSMTP();
    $mail_variable->Host       = 'smtp.gmail.com'; 
    $mail_variable->SMTPAuth   = true;
    $mail_variable->Username   = 'sennagrasmeijer123@gmail.com'; 
    $mail_variable->Password   = 'tgvv brky noyt ycav';    
    $mail_variable->SMTPSecure = 'tls';
    $mail_variable->Port       = 587;
    $mail_variable->setFrom('sennagrasmeijer123@gmail.com', 'SennaGD');
    $mail_variable->addAddress('505503@student.firda.nl', 'Senna');


    // Query
    $sql = "SELECT * FROM loans";
    $query = mysqli_query($conn,$sql);

    $current_time = date("Y-m-d H:i:s",);
    
    foreach($query as $row) {
        $one_past_day = date("Y-m-d H:i:s",strtotime("-1 day", strtotime($row['due_date'])));
        
        $hashed_Student_Number = hash("md2",$row['student_number']."255");
        echo $hashed_Student_Number."\n";

        if ($current_time >= $one_past_day && $row['email_send'] == 1) {
            
            $message = "This is A test\n"."http://localhost/student.return.php/?id={$hashed_Student_Number}/?item_id={$row['item_id']}";
            $mail = clone $mail_variable;

            try {
                $mail->addAddress("{$row['student_number']}@student.firda.nl");
                $mail->Subject = "Due-date Lending Reminder";
                $mail->Body = "You have less than 1 day to bring back your hardware.\n".$message;
                $mail->send();
                echo "Successfully send email to student: {$row['student_number']}\n";
            } 
            catch (Exception $e) {
                echo "Mailer Error ({$row['student_number']}): {$mail->ErrorInfo}\n";
            }
            
            $student_number = $row['student_number'];
            $due_date = $row['due_date'];
            $email_send = "UPDATE `loans` SET `email_send`= 1 WHERE `student_number` = '$student_number' AND `due_date` = '$due_date'";
            mysqli_query($conn, $email_send);
        } else {
            echo "e";
        }
    }
}


/**  
* Random number generator
*/

Send_Emails();

