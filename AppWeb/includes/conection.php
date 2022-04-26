<?php

$host = 'localhost' ;
$user = 'root';
$password = '';
$db_name = 'finalproject';

$db = mysqli_connect($host, $user, $password, $db_name);


if (mysqli_connect_error()) {
    echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
    echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

mysqli_query($db, "SET NAMES 'utf8'");

// Iniciar la sesión
if(!isset($_SESSION)){
    session_start();
}
