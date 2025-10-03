<?php
include 'db_conn.php';
$res = $conn->query("select * from categories");

if($res->num_rows<0) exit;
echo "
    <table class='table table-border text-center bg-light rounded-sm'>
        <tr>
            <th>category id</th>
            <th>name</th>
            <th>action</th>
        </tr> ";
while($row = $res->fetch_assoc()) {
    echo "
        <tr>
            <td>{$row['cid']}</td>
            <td>{$row['cname']}</td>
            <td>
                <button class='button btn-info btn-sm editBtn' data-id='{$row['cid']}' data-name='{$row['cname']}'>Edit</button>
                <button class='button btn-danger btn-sm deleteBtn' data-id='{$row['cid']}'>Delete</button>
            </td>
        </tr>
    ";
}
echo "</table>";

