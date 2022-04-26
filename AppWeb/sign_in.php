<?php
// Iniciar la sesión y la conexión a bd
require_once 'includes/conection.php';

// Recoger datos del formulario
if(isset($_POST)) {
//     Borrar error antiguopassword
    if (isset($_SESSION['error_login'])) {
        session_unset($_SESSION['error_login']);
    }

    // Recoger datos del formulario
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Consulta para comprobar las credenciales del usuario
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $login = mysqli_query($db, $sql);


    if ($login && mysqli_num_rows($login) == 1) {
        $usuario = mysqli_fetch_assoc($login);
//        var_dump($usuario);
        // Comprobar la contraseña
        $verify = password_verify($password, $usuario['password']);
        echo var_dump($usuario);

        if($verify){
            $_SESSION['usuario'] = $usuario;
            if($usuario['level'] == 1){
                header('Location: user.php');

            }else{
                header('Location: dashboard.php');
            }


        }else{
            // Si algo falla enviar una sesión con el fallo
            $_SESSION['error_login'] = "Verique su nombre de usuario o password";

//            header('Location: login.php');
            echo "MAL aca";
            header('Location: login.php');
        }
    }
    else{
        // mensaje de error

        $_SESSION['error_login'] = "Usuario no existe";
        header('Location: login.php');
//        header('Location: login.php');
        echo "MAL aqui";
    }


}

// Redirigir al index.php




