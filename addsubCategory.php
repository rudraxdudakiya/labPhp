<?php
$cid = $_POST['cid'];
$name = $_POST['name'];
include 'db_conn.php';

$sql="INSERT INTO subcategory(cid, name) values ($cid, '$name')";
echo $conn->query($sql)
? json_encode(["status" => "success", "msg" => "sub Category Added"])
: json_encode(["status" => "failed", "msg" => "error in adding new sub category" . $conn->error]);
