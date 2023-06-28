<?php
require_once("../assets/includes/conn.php");
function random() {
    return rand(0, 9);
}
//Maak code en jaag in database
$conn->query("UPDATE uniekecode SET code = " . random() . random() . random() . random() . "")
?>