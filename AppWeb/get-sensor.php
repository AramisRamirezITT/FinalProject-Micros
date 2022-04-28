<?php

// Iniciar la sesión
if(!isset($_SESSION)){
    session_start();
}


if (isset($_POST)) {
    $Objj = new stdClass;

    $user_arduino = $_POST['user_arduino'];
    $pass_arduino = $_POST['pass_arduino'];


    $Objj-> val1 = "$user_arduino";
    $Objj-> val2 = "$pass_arduino";

    file_put_contents("json/adc.json", json_encode($Objj));

    $Usuarioobj = json_decode(file_get_contents("json/user.json"));

    echo  $Usuarioobj->{'usuario'};


//    if($_SESSION['usuario'] == null ||  $_SESSION['usuario']  ==''){
//       echo "No ";
//
//    }else{
//
//        echo "Si ";
//    }



}

