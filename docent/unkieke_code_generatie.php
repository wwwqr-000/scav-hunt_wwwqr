<?php
require_once("../assets/includes/conn.php");
function random() {
    return rand(0, 9);
}
//Maak code en jaag in database
$conn->query("UPDATE uniekecode SET code = " . random() . random() . random() . random() . " WHERE ID = 1");
$code = 0;
$pull = $conn->query("SELECT * FROM uniekecode WHERE ID = 1");
//Laat code zien
echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>';
    while ($row = $pull->fetch_assoc()) {echo $row["code"];}
    echo '
    </p>
</body>
</html>
';
?>