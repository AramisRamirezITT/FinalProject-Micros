<?php
require_once 'includes/conection.php';
if(isset($_POST)){

    $Obj = new stdClass;

    if(isset( $_SESSION['usuario'])){
       $usuario =  $_SESSION['usuario']['username'] ;
        $Obj-> usuario = "$usuario";
        file_put_contents("json/led.json", json_encode($Obj));


    }else{

        $Obj->user = "error";
        file_put_contents("json/led.json", json_encode($Obj));
    }

    if (isset($_POST['led'])){
        $led =$_POST['led'];
        var_dump($_POST['led']);
        $Obj->led = 255;
        file_put_contents("json/led.json", json_encode($Obj));

    }else{
        $Obj->led = 0;
        file_put_contents("json/led.json", json_encode($Obj));
    }

    if (isset($_POST['led1'])){
        $led1 = $_POST['led1'];
        var_dump($led1);
        $Obj->led1 = 255;
        file_put_contents("json/led.json", json_encode($Obj));
    }else{
        $Obj->led1 = 0;
        file_put_contents("json/led.json", json_encode($Obj));
    }
    if (isset($_POST['led2'])){
        $led2 = $_POST['led2'];
        var_dump($led2);
        $Obj->led2 = 255;
        file_put_contents("json/led.json", json_encode($Obj));
    }else{
        $Obj->led2 = 0;
        file_put_contents("json/led.json", json_encode($Obj));
    }


//    **************************************************************************
    $obj = json_decode(file_get_contents("json/led.json"));
    $objj = json_decode(file_get_contents("json/adc.json"));

    $nameuser = $_SESSION['usuario']['username'];


    $value1 = $objj->{'val1'};
    $value2 = $objj->{'val1'};
    $value3 = $objj->{'val1'};

    $idDevice1 = $obj->{'led'};
    $idDevice2 = $obj->{'led1'};
    $idDevice3 = $obj->{'led2'};

    echo var_dump($nameuser);



    $query_userId = "SELECT id_us FROM users WHERE  username =  '$nameuser'";

    $login = mysqli_query($db, $query_userId);
    $user_id_array = mysqli_fetch_assoc($login);
    $user_id = $user_id_array['id_us'];

    $date = date('Y-m-d H:i:s');
    echo $date;

    //caso 1 si led 1 on guardar datos
    if($idDevice1 == 255){
        $sql = "INSERT INTO events VALUES(null,'$value1', 'Cocina','$user_id',CURRENT_TIMESTAMP, 1);";
        var_dump($sql);
        $guardar = mysqli_query($db, $sql);
        echo var_dump($guardar);
    }

    //caso 2
    if($idDevice2 == 255){
        $sql = "INSERT INTO events VALUES(null,'$value2','Comedor','$user_id',CURRENT_TIMESTAMP, 1);";
        var_dump($sql);
        $guardar = mysqli_query($db, $sql);
        echo var_dump($guardar);
    }
    //caso 3
    if($idDevice3 == 255){
        $sql = "INSERT INTO events VALUES(null,'$value3','Cuarto','$user_id',CURRENT_TIMESTAMP, 1);";
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

    if($nameuser == "adios"){
        header('Location: dashboard.php');

    }else{

        header('Location: user.php');
    }



}else{
    echo "NO se envio nada";

}