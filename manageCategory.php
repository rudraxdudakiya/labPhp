<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Category</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <?php include 'nav.php'; ?><br>
    <a href="manageSubCate.php"><button id="subcate">Manage Subcategory</button></a>
    <div class="container mt-1 p-5 bg-dark rounded-lg">
        <h2 class="text-info">Manage Category</h2><br>
        <form id="categoryForm" class="d-flex">
            <input type="hidden" name="id" id="id" >
            <input type="text" name="cname" id="cname" placeholder="Category Name">
            <button type="submit" class="btn btn-primary">Save</button>
        </form><br><br><div id="msg"></div><br>
        <div id="categoryTbl"></div>

        <script>
            $(document).ready(function() {
                loadCategory();
                function loadCategory() {
                    $.ajax({
                        url: "displayCategory.php",
                        method: "post",
                        success: function(data) {
                            $('#categoryTbl').html(data);
                        }
                    })
                }

                $('#categoryForm').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: $('#id').val()? 'updateCategory.php' :'addCategory.php',
                        method: 'post',
                        dataType: 'json',
                        data: {
                            id: $('#id').val(),
                            name: $('#cname').val()
                        },
                        success: function(res) {
                            loadCategory();
                            if(res.status === "success"){
                                $('#cname').val(""); 
                                $('#msg').html('<p class="alert alert-info">'+ res.msg + '</p>');
                            } else {
                                $('#msg').html('<p class="alert alert-danger">' + res.msg + '</p>');
                            }
                        }
                    })
                });

                $(document).on('click', '.editBtn', function () {
                    $('#id').val($(this).data('id'));
                    $('#cname').val($(this).data('name'));
                });

                $(document).on('click', '.deleteBtn', function () {
                    if(confirm('Are You sure ??')) {
                        $.ajax({
                            url: 'deleteCategory.php',
                            method: 'post',
                            dataType: 'json',
                            data: { id: $(this).data('id') },
                            success: function(res) {
                                loadCategory()
                                if(res.status === "success") {
                                    $('#msg').html('<p class="alert alert-info">'+ res.msg + '</p>');
                                } else {
                                    $('#msg').html('<p class="alert alert-danger">'+ res.msg + '</p>');
                                }
                            }
                        });
                    }
                });
            });
        </script>
    </div>
</body>
</html>