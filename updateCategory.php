<?php
include 'db_conn.php';

$cid = $_POST['id'];
$cname = $_POST['name'];

$sql = "UPDATE categories SET cname='$cname' WHERE cid = $cid";

echo $conn->query($sql)
? json_encode(["status"=>"success", "msg"=>"Updated the Category"]) 
: json_encode(["status"=>"failed", "msg"=>"Error in updating cart" . $conn->error]);