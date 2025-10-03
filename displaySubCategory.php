<?php
include 'db_conn.php';
$res = $conn->query("select s.subcid, c.cid, c.cname, s.name from subcategory s, categories c where c.cid=s.cid");

if($res->num_rows<0) exit;
echo "
    <table class='table table-border text-center bg-light rounded-sm'>
        <tr>
            <th>sub category id</th> 
            <th>category id</th>
            <th>name</th>
            <th>action</th>
        </tr> ";
while($row = $res->fetch_assoc()) {
    echo "
        <tr>
            <td>{$row['subcid']}</td>
            <td>{$row['cname']}</td>
            <td>{$row['name']}</td>
            <td>
                <button class='button btn-info btn-sm editBtn' 
                    data-id='{$row['subcid']}' 
                    data-cid='{$row['cid']}' 
                    data-name='{$row['name']}'>Edit</button>
                <button class='button btn-danger btn-sm deleteBtn' 
                    data-id='{$row['subcid']}'>Delete</button>
            </td>
        </tr>
    ";
}
echo "</table>";

