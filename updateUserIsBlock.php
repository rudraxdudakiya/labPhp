<?php
$id=$_POST['id'];
$isblocked=$_POST['isblocked'];
$chg=0;

if($isblocked==1) $chg=0;
if($isblocked==0) $chg=1;
$sql = "update userstb set isblocked=$chg where uid=$id";

include 'db_conn.php';
echo $conn->query($sql) 
? json_encode(["status"=>"success", "msg"=>"Changed isblocked"])
: json_encode(["status"=>"falied", "msg"=>"error".$conn->error]);