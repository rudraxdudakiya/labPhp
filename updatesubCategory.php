<?php
include 'db_conn.php';

$id = $_POST['id'];
$cid = $_POST['cid'];
$name = $_POST['name'];

$sql = "UPDATE subcategory SET name='$name', cid=$cid WHERE subcid = $id";

echo $conn->query($sql)
? json_encode(["status"=>"success", "msg"=>"Updated sub category Category"]) 
: json_encode(["status"=>"failed", "msg"=>"Error in updating subcategory" . $conn->error]);