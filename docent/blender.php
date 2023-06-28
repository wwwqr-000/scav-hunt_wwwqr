<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if (!isset($_SESSION['docent'])) {
	header('location:../login'); die();
} if (!$_SESSION['docent']) {
	header('location:../login'); die();
}
require_once('../assets/includes/conn.php');
if(isset($_POST['ag']) || isset($_POST['amig'])) {
	$oID = $_SESSION['opleiding_ID']; $gID = 1; // opleiding_ID wordt meerdere keren gebruikt, dus een kortere variabelenaam is fijn
	$conn->query('DELETE FROM groep WHERE groepsnaam != "standaard"'); // leeg de tabel met groepen
	if(isset($_POST['ag'])) { // number of groups has been specified
		$ag = $_POST['ag'];
		for($i = 1; $i <= $ag; ++$i) $conn->query("INSERT INTO groep (ID, docent_ID) VALUES ('$i',  '$oID')"); // create groups

		$pull = $conn->query("SELECT * FROM leerling WHERE opleiding_ID = $oID AND leerjaar = 1"); // pull all relevant students
		while($leerling = $pull->fetch_assoc()) { // loop through students
			$conn->query("UPDATE leerling SET  groep_ID = '$gID' WHERE leerling.ID = $leerling[ID]"); // assign group ID to individual student
			if($gID == $ag) $gID = 1; else ++$gID; // groups are assigned 1…x–1…x–1…x
		}
	} else { // size of group has been specified
		$amig = $_POST['amig'];
		$pull = $conn->query("SELECT * FROM leerling WHERE opleiding_ID = $oID AND leerjaar = 1");
		$aLL = $pull->num_rows; // $aLL is the amount of relevant students
		$ag = floor($aLL / $amig); // amount of groups
		for($i = 1; $i <= $ag; ++$i) $conn->query("INSERT INTO groep (ID) VALUES ($i)"); // create groups
		
		while($leerling = $pull->fetch_assoc()) { // loop through students
			$conn->query("UPDATE leerling SET groep_ID = '$gID' WHERE leerling.ID = $leerling[ID]"); // assign group ID to indiv. students
			if($gID == $ag) $gID = 1; else ++$gID; // groups are assigned 1…x–1…x–1…x
			echo "<script>console.log('gID = $gID; ag = $ag')</script>";
		}
	}
	// header('location:/~fp241754/scav-hunt/docent'); die();
}
require_once('../assets/includes/header.php');
?>
<head>
<title>Groepjes maken</title>
<script src="../assets/js/blender.js" defer></script>
</head>
<body id="pagina_blender">
<section class="about d-flex flex-column justify-content-center align-items-center sticked-header-offset" style="height: 100%;">
	<section id="about" class="section-50 d-flex flex-column align-items-center">
		<h2 class="panel-title">Blender</h2>
		<form method="post" action="">
			<h4 id="1">Aantal groepjes</h4>
			<div class="input-group" id="ag">
				<button type="button" class="minus-button" onclick="decrementValue(this)">-1</button>
				<input type="number" name="ag" min="0" value="0">
				<button type="button" class="plus-button" onclick="incrementValue(this)">+1</button>
			</div>
			<h4 id="2">Aantal mensen in groepje</h4>
			<div class="input-group" id="amig">
				<button type="button" class="minus-button" onclick="decrementValue(this)">-1</button>
				<input type="number" name="amig" min="0" id="amig" value="0">
				<button type="button" class="plus-button" onclick="incrementValue(this)">+1</button>
			</div>
			<button type="submit"><p>Genereer groepjes</p></button>
		</form>
	</section>
</section> <!-- End About Section -->

<script>//For value input form
	function incrementValue(button) {
		var input = button.parentNode.querySelector('input[type="number"]');
		var value = parseInt(input.value);
		input.value = value + 1;
	}

	function decrementValue(button) {
		var input = button.parentNode.querySelector('input[type="number"]');
		var value = parseInt(input.value);
		if (value > 0) {
			input.value = value - 1;
		}
	}
</script>
</body>
<?php
$leerlingen = mysqli_query($conn, 'SELECT * FROM leerling');
include "../assets/includes/footer.php";
?>