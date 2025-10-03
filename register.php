 <div id="register">
     <div class="container mt-5 bg-light p-5 rounded-lg">
         <h2>Register</h2>
         <form id="registerForm">
            <input type="hidden" id="userid" name="userid">
            <input class="form-control mb-2" placeholder="User Name" type="text" name="username" id="username">
            <input class="form-control mb-2" placeholder="Email" type="text" name="email" id="email">
            <input class="form-control mb-2" placeholder="Password" type="text" name="password" id="password">
            <img src="captcha.php" />
            <input class="form-control mb-2" placeholder="Captcha Code" type="text" name="captcha" id="captcha">
            <br>
            <button class="btn btn-primary" type="submit" name="submit" id="submit">Sign Up</button>
        </form><br><br>
        <div id="msg"></div>
        <div class="row align-items-start">
            <div class="col-2">
                <button id="gologin" class="btn btn-link">Login</button>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#registerForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url:'insert.php',
                    type:'post',
                    dataType: "json",
                    data: {
                        id: $('#userid').val(),
                        name: $('#username').val(),
                        email: $('#email').val(),
                        password: $('#password').val(),
                        captcha: $('#captcha').val()
                    },
                    success: function(res) {
                        if(res.status === "success") {    
                            $('#msg').html('<div class="alert alert-info" >'
                            + res.msg +
                            '</div>');
                        } else {
                            $('#msg').html('<div class="alert alert-danger">'
                            + res.msg +
                            '</div>');
                        }
                        $('#registerForm')[0].reset();
                    }
                })
            });

            $('#gologin').click(function() {
                $.ajax({
                    url: 'loginView.php',
                    method: 'get',
                    success: function(data){
                        $('#register').html(data);
                    }
                })
            });
        });
    </script>
</div>