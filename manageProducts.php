<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Product</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-dark">
    <?php include 'nav.php'; ?>

    <div class="container mt-5 p-5 bg-light rounded-lg">

        <h2 class="text-info">Manage Products</h2><br>

        <form id="productForm" enctype="multipart/form-data">
            <input type="hidden" name="id" id="id" >
            <input type="text" class="form-control" name="pname" id="pname" placeholder="Product Name"><br>
            <select class='form-select' name="category" id="category">
                <option value='0'> --Select Category-- </option>
                <?php
                    include "db_conn.php";
                    $sql = "select * from categories";

                    $result = $conn->query($sql);

                    if($result && $result->num_rows>0) {
                        while ($row=$result->fetch_assoc()) {
                            echo "
                                <option value='{$row['cid']}'>{$row['cname']}</option>
                            ";
                        }
                    }
                ?>
            </select>
            
            <select class='form-select' name="subcategory" id="subcategory">
                <option value='0'> --Select sub Category-- </option>
            </select><br><br>

            <label for="">Discount %</label>
            <input type="number" id="discount" name="discount" step="0.2" min=0 name="" id=""> 
            <label for="">Price</label>
            <input type="number" id="price" name="price" step="0.2" min=99 name="" id="">
            <br><br>Select the Images of Product
            <input type="file" name="productPhoto" value="select images" >
            <br><br>
            <button type="submit" class="btn btn-primary">Save</button>
        </form><br><div id="msg"></div><br>

        <div id="productsTbl" class="bg-dark"></div>

        <script>
            $(document).ready(function() {
                loadProducts();
                
                function loadProducts() {
                    $.ajax({
                        url: "displayProducts.php",
                        method: "post",
                        success: function(data) {
                            $('#productsTbl').html(data);
                        }
                    })                
                }

                function loadSubcate() {
                    $.ajax({
                        url: "propSubCategory.php",
                        method: "post",
                        data: { cid: $('#category').val() },
                        success: function (data) {
                            $('#subcategory').html(data);
                        }
                    })
                }

                $('#category').on('change', function() {
                    loadSubcate();
                })

                $('#productForm').on('submit', function(e) {
                    e.preventDefault();
                    var formData = new FormData(this);
                    $.ajax({
                        url: $('#id').val() ? 'updateProduct.php' :'addProduct.php',
                        method: 'post',
                        dataType:'json',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(res) {
                            loadProducts();

                            if(res.status==="success") {
                                $('#productForm')[0].reset();
                                $('#msg').html('<p class="alert alert-info">'+res.msg+"</p>")
                            } else {
                                $('#msg').html('<p class="alert alert-danger">'+res.msg+"</p>")                                
                            }
                        }
                    })
                });

                $(document).on('click', '.editBtn', function() {
                    console.log("clecked edit"+ $(this).data('productname') + $(this).data('subcategoryid'));
                    $('#id').val($(this).data('id'));
                    $('#pname').val($(this).data('productname'));
                    $('#category').val($(this).data('categoryid'));
                    loadSubcate();
                    $('#subcategory').val($(this).data('subcategoryid'));
                    $('#discount').val($(this).data('discount'));
                    $('#price').val($(this).data('price'));
                })

                $(document).on('click', '.deleteBtnPro', function() {
                    if(confirm("Sure to delete ??")) {
                        $.ajax({
                            url: 'deleteProduct.php',
                            method: 'post',
                            dataType: 'json',
                            data: {id: $(this).data('id')},
                            success: function() {
                                loadProducts();
                                if(res.status === "success") {
                                    $('#msg').html('<p class="alert alert-info">'+ res.msg + '</p>');
                                } else {
                                    $('#msg').html('<p class="alert alert-danger">'+ res.msg + '</p>');
                                }
                            }
                        })
                    }
                })
            });
        </script>
    </div>
</body>
</html>
