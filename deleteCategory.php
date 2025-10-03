<?php
include 'db_conn.php';
$cid = $_POST['id'];

echo $conn->query("DELETE FROM categories WHERE cid = $cid")
? json_encode(["status"=>"success", "msg"=>"Deleted the category"])
: json_encode(["status"=>"", "msg"=>"error while deleting".$conn->error]);