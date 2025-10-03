<?php
session_start();
    if(!isset($_SESSION['email'])) {
        header('location: loginView.php');
        exit;
    } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">Hello, <?php echo $_SESSION['email']; ?></a>
            <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
                <span class="navbar-toggler-icon"></span>
            </button> -->
            <div class="collapse navbar-collapse" id="adminNavbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <button class="btn nav-link" data-url="manageCart.php">Manage Cart</button>
                    </li>
                    <li class="nav-item">
                        <button class="btn nav-link" data-url="checkProducts.php">Check Products</button>
                    </li>
                    <li class="nav-item">
                        <button class="btn nav-link" data-url="manageOrder.php">Orders</button>
                    </li>
                </ul>
            </div>
            <button class="btn text-light bg-danger">Logout</button>
        </div>
    </nav>
    <div class="row mt-4">
        <div id="loadCategory" class="ml-2 col-1 p-3  border-end"></div>
        <div id="products" class="rounded-lg col-10 p-3 bg-dark">
            <h4 class="text-center border rounded-sm p-2 text-info">Select the category to see the products</h4><br>
            <div id="main"></div>
        </div>
    </div>
    <div id="msg"></div>

    <script>
        $(document).on("click", ".nav-link", function () {
            let url = $(this).data("url");   
            if (url) {
                $.ajax({
                    url: url,
                    method: "GET",
                    success: function (page) {
                        $("#main").html(page);  
                    },
                    error: function () {
                        $("#main").html("<p class='text-danger'>Failed to load content.</p>");
                    }
                });
            }
        });
        
        $(document).on("click", ".editBtn", function () {
            $.ajax({
                url: 'custShowProducts.php',
                method: 'post',
                data: {id: $(this).data('id')},
                success: function(products) {
                    $('#main').html(products);
                }
            })
        });

        $(document).on('click', '.editBtnAddCart', function() {
            $.ajax({
                url: 'custAddtocart.php',
                method: 'post',
                data: {pid: $(this).data('id'), qnt: $(this).closest('tr').find('.cart_qty').val()},
                dataType: 'json',
                success: function(res){
                    console.log(res.msg);
                    
                        $('#msg').html('<h3 class="text-white p-2 border bg-info text-center">'+res.msg+'</h3>');
                }
            })
        })
            
        $(document).ready(function(){
                loadCategory();
                function loadCategory() {
                    $.ajax({
                        url: "custSelectCategory.php",
                        method: "post",
                        success: function(data) {
                            $('#loadCategory').html(data);
                        }
                    })
                }
        })
    </script>
</body>
</html>