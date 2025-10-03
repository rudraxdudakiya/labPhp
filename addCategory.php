<?php
$cname = $_POST['name'];
include 'db_conn.php';

$sql="INSERT INTO categories(cname) values ('$cname')";
echo $conn->query($sql)
? json_encode(["status" => "success", "msg" => "Category Added"])
: json_encode(["status" => "failed", "msg" => "error in adding new category" . $conn->error]);
