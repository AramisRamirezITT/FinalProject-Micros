<?php
// Iniciar la sesión y la conexión a bd
require_once 'includes/conection.php';

// Recoger datos del formulario


    $objjj = json_decode(file_get_contents("json/led.json"));
    $objj = json_decode(file_get_contents("json/adc.json"));

    $nameuser = $_SESSION['usuario']['username'];


    $value1 = $objj->{'val1'};
    $value2 = $objj->{'val1'};
    $value3 = $objj->{'val1'};

    $idDevice1 = $objjj->{'led'};
    $idDevice2 = $objjj->{'led1'};
    $idDevice3 = $objjj->{'led2'};

    echo var_dump($nameuser);



    $query_userId = "SELECT id_us FROM users WHERE  username =  '$nameuser'";

    $login = mysqli_query($db, $query_userId);
    $user_id_array = mysqli_fetch_assoc($login);
    $user_id = $user_id_array['id_us'];

    $date = date('Y-m-d H:i:s');
    echo $date;

    //caso 1 si led 1 on guardar datos
    if($idDevice1 == 255){
        $sql = "INSERT INTO events VALUES(null,'$value1','Cuarto','$user_id',CURRENT_TIMESTAMP, 1);";
        var_dump($sql);
        $guardar = mysqli_query($db, $sql);
        echo var_dump($guardar);
    }

    //caso 2
    if($idDevice2 == 255){
        $sql = "INSERT INTO events VALUES(null,'$value2','Cosina','$user_id',CURRENT_TIMESTAMP, 1);";
        var_dump($sql);
        $guardar = mysqli_query($db, $sql);
        echo var_dump($guardar);
    }
    //caso 3
    if($idDevice3 == 255){
        $sql = "INSERT INTO events VALUES(null,'$value3','Sala','$user_id',CURRENT_TIMESTAMP, 1);";
        var_dump($sql);
        $guardar = mysqli_query($db, $sql);
        echo var_dump($guardar);
    }



//
//    $sql = "INSERT INTO events VALUES(null,'$value','$idDevice','$user_id',CURRENT_TIMESTAMP, 1);";
//    var_dump($sql);
//    $guardar = mysqli_query($db, $sql);
//    echo var_dump($guardar);

    if($guardar){
        $_SESSION['save_event'] = "El registro se ha completado con éxito";
        echo var_dump($_SESSION['save_event']);
    }else{
        $_SESSION['errores']['save_event_error'] = "Fallo al guardar el evento!!";
        echo var_dump( $_SESSION['errores']['save_event_error']);
    }





