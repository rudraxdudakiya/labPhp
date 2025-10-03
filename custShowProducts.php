<?php
include 'db_conn.php';

$cid=$_POST['id'];
$res = $conn->query("select p.productId, c.cid, s.subcid, c.cname, s.name, p.pname, p.imagepath, p.discount, p.price 
from products p
join categories c on c.cid=p.categoryId
join subcategory s on  s.subcid=p.subcid
where c.cid=$cid");

if(!$res && $res->num_rows<0) exit;

echo "
<table class='table table-hover text-center table-light table-border'>
    <tr>
        <th>#</th>
        <th>Images</th>
        <th>Name</th>
        <th>Sub Category</th>
        <th>Category</th>
        <th>Price</th>
        <th>discount</th>
        <th>quantity</th>
        <th>action</th>
    </tr>
";
while($product=$res->fetch_assoc()) {
    echo "<tr>
        <td>{$product['productId']}</td><td>";
    
    $images=explode('|',$product['imagepath']);
    foreach($images as $img) 
        echo"<img src='{$img}' width=60 height=80 style='margin-right:8px'/>";

    echo "</td>
        <td>{$product['pname']}</td>
        <td>{$product['name']}</td>
        <td>{$product['cname']}</td>
        <td>{$product['price']}</td>
        <td>{$product['discount']}</td>
        <td><input type='number' min=1 class='cart_qty'/></td>
        <td><button data-id='{$product['productId']}' class='btn btn-primary editBtnAddCart'>Add To Cart</button></td>
    </tr>";
}
echo "</table>";
