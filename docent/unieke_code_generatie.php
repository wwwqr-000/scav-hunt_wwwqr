<?php
require_once("../assets/includes/header.php");
require_once("../assets/includes/conn.php");
function random() {
    return rand(1, 9);
}
//Maak code en jaag in database
$conn->query("UPDATE uniekecode SET code = " . random() . random() . random() . random() . " WHERE ID = 1");
$code = 0;
$pull = $conn->query("SELECT * FROM uniekecode WHERE ID = 1");
//Laat code zien
echo '
<section class="about d-flex flex-column justify-content-center align-items-center sticked-header-offset" style="height: 100%;">
	<section id="about" class="section-50 d-flex flex-column align-items-center">
    <h1>Code: ';
    while ($row = $pull->fetch_assoc()) {echo $row["code"];}
    echo '
    </h1>
</section>
</section>
';
require_once("../assets/includes/footer.php");
?>