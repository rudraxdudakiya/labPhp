<?php
include 'db_conn.php';
$res = $conn->query("select * from categories");

if($res->num_rows<0) exit;
while($row = $res->fetch_assoc()) {
    echo "
        <button class='editBtn' data-id='{$row['cid']}'>{$row['cname']}</button><br><br>
    ";
}

