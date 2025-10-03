<?php
include 'db_conn.php';
$id = $_POST['id'];

echo $conn->query("DELETE FROM subcategory WHERE subcid = $id")
? json_encode(["status"=>"success", "msg"=>"Deleted the category"])
: json_encode(["status"=>"", "msg"=>"error while deleting".$conn->error]);