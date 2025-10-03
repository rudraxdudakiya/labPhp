<div id="login" class="bg-dark">
    <div class="container mt-5 bg-light p-5 rounded-lg">
        <h2>Login</h2>
        <form id="loginForm">
            <input class="form-control mb-2" type="text" name="email" id="email" placeholder="Email">
            <input class="form-control mb-2" type="text" name="password" id="password" placeholder="Password">
            <button type="submit" class="btn btn-primary">Login</button>
        </form><br>
        <div id="msg"></div>
        <button class="btn btn-link" id="gosignup">register</button>
        <!-- <button id="goview" class="btn btn-secondary">View Users</button> -->
    </div>
    <script>             
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'login.php',
                    type: 'post',
                    dataType: 'json',
                    data: {
                        email: $('#email').val(),
                        pass: $('#password').val()
                    },
                    success: function(res) {
                        if(res.status==="success") {
                            $('#msg').html('<div class="alert alert-info">'
                                +res.msg+
                            '</div>');
                            if(res.isadmin)
                                window.location.href="admin_dashboard.php";
                            else
                                window.location.href="customer_dashboard.php";
                        } else {
                            $('#msg').html('<div class="alert alert-danger">' 
                                +res.msg+
                            '</div>');
                        }
                        $('#loginForm')[0].reset();
                    }
                })
            });

            $('#gosignup').click(function() {
                    $.ajax({
                        url: 'index.php',
                        method: 'get',
                        success: function(data) {
                            $('#login').html(data);
                        }
                    })
            });
        });
    </script>
</div>