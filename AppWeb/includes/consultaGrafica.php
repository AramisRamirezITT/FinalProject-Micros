<?php
require_once 'conection.php';

$query_grafica = "SELECT value, reading_time FROM events";

$query_grafica_db = mysqli_query($db, $query_grafica);
//var_dump($query_grafica_db);

$valuesx = array(); // values
$valuesy = array(); // date

while ($ver = mysqli_fetch_row($query_grafica_db)){
    $valuesy[] = $ver[0];
    $valuesx[] = $ver[1];
}
    $datosx = json_encode($valuesx);
    $datosy = json_encode($valuesy);
//    var_dump($datosx);
//    var_dump($datosy);

?>

