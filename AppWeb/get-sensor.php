<?php

// Iniciar la sesión
if(!isset($_SESSION)){
    session_start();
}


if (isset($_POST)) {
    $Objj = new stdClass;

    $val = $_POST['val'];
    $val1 = $_POST['val1'];
    $val2 = $_POST['val2'];


    $Objj-> val = "$val";
    $Objj-> val1 = "$val1";
    $Objj-> val2 = "$val2";

    file_put_contents("json/adc.json", json_encode($Objj));

    $Usuario_obj = json_decode(file_get_contents("json/user.json"));

    echo  $Usuario_obj->{'usuario'};


//    if($_SESSION['usuario'] == null ||  $_SESSION['usuario']  ==''){
//       echo "No ";
//
//    }else{
//
//        echo "Si ";
//    }



}

