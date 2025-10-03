<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>
    <?php include 'nav.php'; ?>
    <div class="container mt-5 p-5 bg-dark rounded lg">
        <h2 class="text-info">Manage Users</h2><br>
        <div id="msg" class="alert"></div>
        <div id="usersTbl"></div>
    </div>
    <script>
        $(document).ready(function () {
            loadUsers()
            function loadUsers() {
                $.ajax({
                    url: 'displayUsers.php',
                    method: 'post',
                    success: function(data){                        
                        $('#usersTbl').html(data);
                    }
                })
            }
            $(document).on('click', '.editBtn', function() {
                $.ajax({
                    url: "updateUserIsBlock.php",
                    method: 'post',
                    data: {
                        id: $(this).data('id'),
                        isblocked: $(this).data('isblocked')
                    },
                    success: function(res) {
                        loadUsers();
                    }   
                })                
            })
        })
    </script>
</body>
</html>