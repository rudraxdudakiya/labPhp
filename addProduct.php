<?php
include 'db_conn.php';

$pname= $_POST['pname'];
$category= $_POST['category'];
$subcategory= $_POST['subcategory'];
$discount= $_POST['discount'];
$price= $_POST['price'];

// $imagepath = [];

//     if(!empty($_FILES['productPhoto']['name'][0])) {
//         $files = $_FILES['productPhoto'];
//             for($i=0; $i<count($files['name']); $i++) {
//                 $filename = $files['name'][$i];
//                 $tmpname = $files['tmp_name'][$i];
//                 $destination = "uploads/".$filename;
//                 move_uploaded_file($tmpname, $destination);
//                 $imagepath[]=$destination;
//             }
//     }

// $images=implode('|', $imagepath);

$images="";
if(!empty($_FILES['productPhoto']['name'])) {
    $filename = $_FILES['productPhoto']['name'];
    $tmpname  = $_FILES['productPhoto']['tmp_name'];
    $destination = "uploads/" . $filename;

    move_uploaded_file($tmpname, $destination);
    $images = $destination;  
}

$sql="
insert into products(categoryId, subcid, pname, price, imagepath, discount)
values($category, $subcategory, '$pname', $price, '$images', $discount)
";

echo ($conn->query($sql)) 
? json_encode(['status'=>'success','msg'=>'Inserted the Item'])
: json_encode(['status'=>'failed','msg'=>'Something went wrong'.$conn->error]);
