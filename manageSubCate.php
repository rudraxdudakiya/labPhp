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
    <a href="manageCategory.php"><button id="subcate">Manage category</button></a>
    <div class="container mt-1 p-5 bg-dark rounded-lg">
        <h2 class="text-info">Manage SubCategory</h2><br>
        <form id="subcategoryForm" class="d-flex">
            <input type="hidden" name="id" id="id" >
            <select name="category" id="category">
                <option value='0'> --select Category-- </option>
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
            </select><br>
            <input type="text" name="sname" id="sname" placeholder="Sub-Category Name">
            <button type="submit" class="btn btn-primary">Save</button>
        </form><br><br><div id="msg2"></div><br>
        <div id="subcategoryTbl"></div>

        <script>
            $(document).ready(function() {
                loadSubCategory();
                function loadSubCategory() {
                    $.ajax({
                        url: "displaySubCategory.php",
                        method: "post",
                        success: function(data) {
                            $('#subcategoryTbl').html(data);
                        }
                    })
                }

                $('#subcategoryForm').on('submit', function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: $('#id').val()? 'updatesubCategory.php' :'addsubCategory.php',
                        method: 'post',
                        dataType: 'json',
                        data: {
                            id: $('#id').val(),
                            cid: $('#category').val(),
                            name: $('#sname').val()
                        },
                        success: function(res) {
                            loadSubCategory();
                            if(res.status === "success"){
                                $('#subcategoryForm')[0].reset(); 
                                $('#msg2').html('<p class="alert alert-info">'+ res.msg + '</p>');
                            } else {
                                $('#msg2').html('<p class="alert alert-danger">' + res.msg + '</p>');
                            }
                        }
                    })
                });

                $(document).on('click', '.editBtn', function () {
                    $('#id').val($(this).data('id'));
                    $('#category').val($(this).data('cid'))
                    $('#sname').val($(this).data('name'));
                });

                $(document).on('click', '.deleteBtn', function () {
                    if(confirm('Are You sure ??')) {
                        $.ajax({
                            url: 'deletesubCategory.php',
                            method: 'post',
                            dataType: 'json',
                            data: { id: $(this).data('id') },
                            success: function(res) {
                                loadCategory()
                                if(res.status === "success") {
                                    $('#msg2').html('<p class="alert alert-info">'+ res.msg + '</p>');
                                } else {
                                    $('#msg2').html('<p class="alert alert-danger">'+ res.msg + '</p>');
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