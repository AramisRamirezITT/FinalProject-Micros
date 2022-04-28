<?php
require_once 'includes/conection.php';
if(isset($_POST)){

    $Obj = new stdClass;

    if (isset($_POST['led'])){
        $led =$_POST['led'];
        var_dump($_POST['led']);
        $Obj->led = 255;
        file_put_contents("json/led.json", json_encode($Obj));

    }else{
        $Obj->led0 = 0;
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


}else{
    echo "NO se envio nada";

}