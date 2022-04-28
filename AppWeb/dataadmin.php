<?php
// Iniciar la sesión y la conexión a bd
require_once 'includes/conection.php';

// Recoger datos del formulario
if(isset($_POST)) {
//     Borrar error antiguopassword
//    if (isset($_SESSION['error_login'])) {
//        session_unset($_SESSION['error_login']);
//    }


    $nameuser = $_SESSION['usuario']['username'];
    $value = $_POST['value'];
    $idDevice = $_POST['id_device'];

    echo var_dump($nameuser);
    echo var_dump($value);
    echo var_dump($idDevice);

    ;
    $query_userId = "SELECT id_us FROM users WHERE  username =  '$nameuser'";

    $login = mysqli_query($db, $query_userId);
    $user_id_array = mysqli_fetch_assoc($login);
    $user_id = $user_id_array['id_us'];

    $date = date('Y-m-d H:i:s');
    echo $date;

    $sql = "INSERT INTO events VALUES(null,'$value','$idDevice','$user_id',CURRENT_TIMESTAMP, 1);";
    var_dump($sql);
    $guardar = mysqli_query($db, $sql);
    echo var_dump($guardar);

    if($guardar){
        $_SESSION['save_event'] = "El registro se ha completado con éxito";
        echo var_dump($_SESSION['save_event']);
    }else{
        $_SESSION['errores']['save_event_error'] = "Fallo al guardar el evento!!";
        echo var_dump( $_SESSION['errores']['save_event_error']);
    }

}


//    // Recoger datos del formulario
//    $username = trim($_POST['username']);
//    $password = $_POST['password'];
//
//    // Consulta para comprobar las credenciales del usuario
//    $sql = "SELECT * FROM users WHERE username = '$username'";
//    $login = mysqli_query($db, $sql);
//
//
//    if ($login && mysqli_num_rows($login) == 1) {
//        $usuario = mysqli_fetch_assoc($login);
////        var_dump($usuario);
//        // Comprobar la contraseña
//        $verify = password_verify($password, $usuario['password']);
//        echo var_dump($usuario);
//
//        if($verify){
//            $_SESSION['usuario'] = $usuario;
//            if($usuario['level'] == 1){
//                header('Location: user.php');
//
//            }else{
//                header('Location: dashboard.php');
//            }
//
//
//        }else{
//            // Si algo falla enviar una sesión con el fallo
//            $_SESSION['error_login'] = "Verique su nombre de usuario o password";
//
////            header('Location: login.php');
//            echo "MAL aca";
//            header('Location: login.php');
//        }
//    }
//    else{
//        // mensaje de error
//
//        $_SESSION['error_login'] = "Usuario no existe";
//        header('Location: login.php');
////        header('Location: login.php');
//        echo "MAL aqui";
//    }
//
//
//}
//
//// Redirigir al index.php
//



