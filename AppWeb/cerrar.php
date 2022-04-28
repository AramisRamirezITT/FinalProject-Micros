<?php
require_once 'includes/conection.php';

$Obj = new stdClass;

if(isset($_SESSION['usuario'])){
    $Obj-> usuario = "Nop";
    file_put_contents("json/user.json", json_encode($Obj));
    session_destroy();
}

header("Location: login.php");
