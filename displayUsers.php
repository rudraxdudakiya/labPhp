<?php
include 'db_conn.php';

$sql="select * from userstb";
$result = $conn->query($sql);

if(!$result && $result->num_rows<=0) {
    echo '<p class="alert alert-info" >No Record Found</p>';
    exit;
}

echo "<table class='bg-light table table-border rounded-sm text-center'>
    <tr>
        <th>user id</th>
        <th>name</th>
        <th>email</th>
        <th>password</th>
        <th>is blocked</th>
        <th>action</th>
    </tr>
";

while($user = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$user['uid']}</td>
        <td>{$user['name']}</td>
        <td>{$user['email']}</td>
        <td>{$user['password']}</td>
        "; 
        if($user['isblocked']==1) 
             echo "<td class='alert alert-danger'>Blocked</td>";  
        else 
            echo "<td class='alert alert-info'>Active</td>";
        echo "
        <td>
            <button class='btn btn-warning editBtn' data-id='{$user['uid']}' data-isblocked='{$user['isblocked']}'>block/unblock</button>
            <button class='btn btn-danger deleteBtn' data-id='{$user['uid']}'>delete</button>
    </tr>";
}

echo "</table>";
