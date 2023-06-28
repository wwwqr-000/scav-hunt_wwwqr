<?php
require_once("assets/includes/conn.php");
$pull = $conn->query("SELECT * FROM uniekecode");
$code;
while ($row = $pull->fetch_assoc()) {
    $code = $row["code"];
}
if ($code == "0") {
    $code = "Momenteel geen speurtocht.";
}
echo "<p>$code</p>";
?>