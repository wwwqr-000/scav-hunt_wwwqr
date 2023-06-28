<?php
/* Voorbeeld van hoe het begin van dit document er uit kan komen te zien.
if (isset($_COOKIE["groepje_nr"]) && isset($_COOKIE["groepje_naam"])) {
    $groepje_ID = htmlspecialchars($_COOKIE["groepje_nr"]);
    $groepje_naam = htmlspecialchars($_COOKIE["groepje_naam"]);
    //Hier dan kijken bij welke vraag het groepje is en wat het nummer is. De vragen en antwoorden connecten met DB.
}
else {
    header("location: //naar main pagina");
}
*/
echo <<< main
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koter haak voorbeeld</title>
    <script src="../assets/js/koter_analyzer.js" defer></script>
</head>
<body>
    
</body>
</html>
main;
?>