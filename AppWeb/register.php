<?php

if(isset($_POST)){

    // Conexión a la base de datos
    require_once 'includes/conection.php';
    $db =$db;
    // Iniciar sesión
    if(!isset($_SESSION)) {
        session_start();
    }
//
//    // Recorger los valores del formulario de registro
    $user_backend = isset( $_POST['username']) ? mysqli_real_escape_string($db, $_POST['username']): false;
    $password_backend = isset( $_POST['password']) ? mysqli_real_escape_string($db, $_POST['username']): false;

    // Array de errores
    $errores = array();
    $search_user = "SELECT * FROM  users WHERE username = '$user_backend'";
    $query = mysqli_query($db, $search_user);

    // Validar name
    if(!is_numeric($user_backend) && !preg_match("/[0-9]/", $user_backend)){
        if ($query && mysqli_num_rows($query) == 1){
            $errores['username'] = "El nombre no es válido o ya esta registrado";
            header('location: 404.php');
        }else{
            $nombre_validado = true;
        }
    }else{
        $errores['username'] = "El nombre no es válido";
    }
    // Validar password
    // Validar la contraseña
    if(!empty($password_backend)){
        $password_validado = true;
    }else{
        $password_validado = false;
        $errores['password'] = "La contraseña está vacía";
    }

    $save_user = false;

    if(count($errores) == 0){
        $save_user = true;

//         Cifrar la contraseña
        $password_segura = password_hash($password_backend, PASSWORD_BCRYPT, ['cost'=>4]);

        // INSERTAR USUARIO EN LA TABLA USUARIOS DE LA BBDD
        $sql = "INSERT INTO users VALUES(null,'$user_backend','$password_segura', 1, 1 );";

        $guardar = mysqli_query($db, $sql);
//        var_dump(mysqli_error($db));

        if($guardar){
            $_SESSION['completado'] = "El registro se ha completado con éxito";
            header("location: login.php");
        }else{
            $_SESSION['errores']['general'] = "Fallo al guardar el usuario!!";
        }
    }else{

        $_SESSION['errores'] = $errores;

        header('location: 404.php');

}


}



?>