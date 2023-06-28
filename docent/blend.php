<?php
require_once('../assets/includes/conn.php');
// $pull = 
echo $conn->query('SELECT COUNT(naam) FROM leerling WHERE opleiding_ID = 1')->fetch_array()[0];
// echo $pull[0];

?>