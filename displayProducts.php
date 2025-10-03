<?php
include 'db_conn.php';

$sql="
select c.cid, s.subcid, p.productId, p.pname, c.cname, s.name, p.imagepath, p.discount, p.price
from products p, categories c, subcategory s
where p.categoryid=c.cid and p.subcid=s.subcid
";
$res = $conn->query($sql);

if($res->num_rows<0) exit;
echo "
    <table class='table table-border text-center bg-light rounded-sm'>
        <tr>
            <th>product id</th>
            <th>name</th>
            <th>category</th>
            <th>subcategory</th>
            <th>image</th>
            <th>discount</th>
            <th>price</th>
            <th>action</th>
        </tr> ";
while($row = $res->fetch_assoc()) {
    echo "
        <tr>					
            <td>{$row['productId']}</td>
            <td>{$row['pname']}</td>
            <td>{$row['cname']}</td>
            <td>{$row['name']}</td>
            <td>";
    
    $images=explode('|',$row['imagepath']);
            foreach($images as $img)
                echo "<img src='{$img}' width=100 height=100 style='margin-right:8px;' alt='image'/>";
        echo "
            </td>
            <td>{$row['discount']}</td>
            <td>{$row['price']}</td>
            <td>
                <button class='button btn-info btn-sm editBtn' 
                    data-id='{$row['productId']}'
                    data-productname='{$row['pname']}'
                    data-categoryid='{$row['cid']}' 
                    data-subcategoryid='{$row['subcid']}'         
                    data-discount='{$row['discount']}'
                    data-price='{$row['price']}'
                >Edit</button>
                <button class='button btn-danger btn-sm deleteBtnPro' data-id='{$row['productId']}'>Delete</button>
            </td>
        </tr>
    ";
}
echo "</table>";

