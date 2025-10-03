<?php
include 'db_conn.php';

$id=$_POST['id'];
$sql="DELETE FROM products WHERE productId=$id";
echo $conn->query($sql)
? json_encode(['status'=>"success", "msg"=>"Deleted the product"])
: json_encode(['status'=>'failed', "msg"=>"Error while deleting"]);