<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Ajax crud with jquery</title>
</head>
<body class="bg-dark"> 
 <div id="index"> </div>
   <script>
        $(document).ready( function() {
            $.ajax({
                url: 'register.php',
                method: 'post',
                success: function(data) {
                    $('#index').html(data);
                }
            })
        })
   </script>
</body>
</html>