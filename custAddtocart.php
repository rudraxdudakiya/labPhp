<?php
$pid = $_POST['pid'];
$qnt = intval($_POST['qnt']);

session_start();
$email = $_SESSION['email'];

include 'db_conn.php';
$sql = "select uid from userstb where email = '$email'";
$res=$conn->query($sql);
$user=$res->fetch_assoc();
$uid=$user['uid'];

$res2=$conn->query("select price from products where productId=$pid");
$price=$res2->fetch_assoc();
$amt=floatval($price['price']);

$stotal=$amt*$qnt;

$addCartSql="
insert into cart(userid,productid,quantity,subtotal)
values($uid,$pid,$qnt,$stotal)
";

echo $conn->query($addCartSql)
? json_encode(["msg"=>"Product is added to cart"])
: json_encode(['msg'=>"opps".$conn->error]);