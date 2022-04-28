<?php require_once 'includes/conection.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Animated Login Form</title>
    <link rel="stylesheet" type="text/css" href="assets/styles/login.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <img class="wave" src="assets/img/wave.png">
    <div class="container">
        <div class="img">
            <img src="assets/img/bg.svg">
        </div>


<!--            --><?php
//        var_dump($_SESSION['error_login']);
////        ?>

        <div class="login-content">
            <form action="sign_in.php" method="POST">
                <img src="assets/img/avatar.svg">

                <?php if(isset( $_SESSION['error_login'] )) :?>
                    <h4 class="error" > Error: <?=  $_SESSION['error_login'] ;?>  </h4>
                <?php else: ?>
                    <h2 class="title">Welcome</h2>
                <?php endif; ?>

                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="div">
                        <h5>Username</h5>
                        <input type="text" class="input" name="username" required>

                    </div>
                </div>
                <div class="input-div pass">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="div">
                        <h5>Password</h5>
                        <input type="password" class="input" name="password" required>
                    </div>
                </div>

                <input type="submit" class="btn" value="Login">
                <input type="button" class="btn" onclick="location.href='new_user.php';" value="Nuevo Usuario" />
            </form>
        </div>
    </div>
    <footer>
        <script type="text/javascript" src="js/login.js"></script>
    </footer>

</body>
</html>