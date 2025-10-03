<?php
include 'db_conn.php';
$email=$_POST["email"];
$pass=$_POST["pass"];

session_start();

$sql = "select * from userstb where email='$email' and password='$pass' limit 1";
$result = $conn->query($sql);
    if($result && $result->num_rows==1) {
        $_SESSION['email']=$email;
        if($email=="admin@admin.com")
            echo json_encode(["status"=>"success", "msg" => "Logged IN Successfully", "isadmin"=>true]);
        else
            echo json_encode(["status"=>"success", "isadmin"=>false]);
    } else {
        echo json_encode(["status"=>"fail", "msg"=> "opps Error" . $conn->error]);
    }