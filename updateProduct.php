<?php
include 'db_conn.php';

$id = $_POST['id'];
$pname = $_POST['pname'];
$category = $_POST['category'];
$subcategory = $_POST['subcategory'];
$discount = $_POST['discount'];
$price = $_POST['price'];

$imagepath = [];

    if(!empty($_FILES['productPhoto']['name'][0])) {
        $files = $_FILES['productPhoto'];
            for($i=0; $i<count($files['name']); $i++) {
                $filename = $files['name'][$i];
                $tmpname = $files['tmp_name'][$i];
                $destination = "uploads/".$filename;
                move_uploaded_file($tmpname, $destination);
                $imagepath[]=$destination;
            }
    }

$images=implode('|', $imagepath);

$sql="
update products
set categoryId=$category, 
    subcid=$subcategory, 
    pname='$pname', 
    price=$price, 
    imagepath='$images', 
    discount=$discount
where productId=$id
";

echo ($conn->query($sql)) 
? json_encode(['status'=>'success','msg'=>'Updated the Item of '.$id])
: json_encode(['status'=>'failed','msg'=>'Something went wrong'.$conn->error]);
