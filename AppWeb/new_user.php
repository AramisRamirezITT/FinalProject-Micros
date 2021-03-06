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
    <div class="login-content">
        <form action="register.php" method="POST">


            <img src="assets/img/avatar.svg">
            <h2 class="title">New User</h2>
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
            <input type="submit" class="btn" value="Save">
            <input type="button" class="btn" onclick="location.href='login.php';" value="Login" />



<!--            <input type="button" class="btn" onclick="location.href='login.php';" value="Save" />-->
        </form>

    </div>
</div>
<script type="text/javascript" src="js/login.js"></script>
</body>
</html>