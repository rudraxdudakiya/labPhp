<?php
    include "db_conn.php";
    $cid = $_POST['cid'];
    $sql = "select * from subcategory where cid=$cid";

    $result = $conn->query($sql);

    if($result && $result->num_rows>0) {
        while ($row=$result->fetch_assoc()) {
            echo "
                <option value='{$row['subcid']}'>{$row['name']}</option>
            ";
        }
    }
?>