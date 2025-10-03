<?php
include 'db_conn.php';

$uname = $_POST['name'];
$email = $_POST['email'];
$pass = $_POST['password'];
$captcha = $_POST['captcha'];

$errors=[];

if(empty($uname)) $errors['uname']="*username is required";
if(empty($email)) $errors['email']="*email is required";
if(empty($pass)) $errors['pass']="*password is required";
if(empty($captcha)) $errors['captcha']="*captcha is required";

if(!preg_match("/^[a-zA-Z- ']*$/", $uname))  $errors['uname']="*username must have alphabates and whitespace only";

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email']="*email format invalid";

if(!empty($errors)) {
    echo json_encode(["status"=>"error", "msg"=>implode("<br>",$errors)]);
    exit;
}

session_start();
if($_SESSION["captcha"]==$captcha) {
    $sql="INSERT INTO userstb(name, email, password) VALUES('$uname', '$email', '$pass')";
    echo $conn->query($sql) 
    ? json_encode(["status"=>"success", "msg" => "Inserted Successfully"]) 
    : json_encode(["status"=>"fail", "msg"=> "Error while Inserting" . $conn->error]);
} else {
    echo json_encode(["status"=>"fail", "msg"=> "captcha invalid"]);
}