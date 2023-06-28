<?php
require_once("../assets/includes/header.php");
if (!isset($_SESSION['docent'])) {
	header('location:../login'); die();
} if (!$_SESSION['docent']) {
	header('location:../login'); die();
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Docenten pagina</title>
    <script src="../assets/js/libs/OL_lib/OpenLayers.js" defer></script>
    <script src="../assets/js/docent.js" defer></script>
    <link rel="stylesheet" href="../assets/css/koter_analyzer.css">
</head>
<section class="about d-flex flex-column justify-content-center align-items-center sticked-header-offset" style="height: 100%;">
    <section id="about" class="section-50 d-flex flex-column align-items-center">
        <div class="docent-information">
            <p>Naam: <span id="name"></span></p>
            <p>Nummer: <span id="number"></span></p>
            <p>x: <span id="x"></span></p>
            <p>y: <span id="y"></span></p>
            <p>Datum: <span id="date"></span></p>
            <div id="map"></div>
        </div>
    </section>
</section>
<?php require_once("../assets/includes/footer.php"); ?>