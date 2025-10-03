<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Product</title>
    <script src="jquery-3.7.1.min.js"></script>
</head>
<body class="bg-dark">
    <div>
        <h2>Manage Products</h2><br>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="text" name="pname" placeholder="name"><br>
        
            <select name="category" id="category" onchange=>
                <?php 
                    include 'db.php';
                    $options = $conn->query('select * from categories');
                    while($row=$options->fetch_assoc()){
                        echo "<option value='{$row['cid']}'>{$row['cname']}</option> ";
                    }
                ?>
            </select><br>
            <select name="subcategory" id="subcategory">

            </select><br>

            <input type="number" name="discount" id="discount" min="0" step="0.5"><br>
            <img src="captcha.php" alt=""><input type="text" name="captcha" id="captcha"><br>
            <input type="number" name="price" id="price" step="0.5" min="1"><br>
            select img:
            <input type="file" name="upload" id="upload"><br>
            <button type="submit">Save</button>
        </form>
    </div>
    <div id="showPro"></div>

    <script>

    </script>
</body>
</html>
