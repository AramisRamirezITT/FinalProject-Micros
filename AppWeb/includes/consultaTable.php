<?php
require_once 'conection.php';

$nameuser = $_SESSION['usuario']['id_us'];

//echo $nameuser;

//$queryMultiple = "SELECT * FROM users WHERE  id_us IN (SELECT id_user FROM events)";
$queryMultiple = "SELECT  u.username, e.id_event, e.value, e.location, e.status, e.reading_time FROM events e INNER JOIN users u ON e.id_user = u.id_us;";

$save = mysqli_query($db, $queryMultiple);
//$save = mysqli_fetch_assoc($save);
//echo var_dump($save);
//
?>

