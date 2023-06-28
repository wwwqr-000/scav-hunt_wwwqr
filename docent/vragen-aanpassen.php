<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if (!isset($_SESSION['docent'])) {
	header('location:../login'); die();
} if ($_SESSION['docent'] != 1) {
	header('location:../login'); die();
}
/* if (isset($_SESSION["docent"])) {
	if ($_SESSION["docent"] != 1) {
		header("location:../login");
		die();
	}
} else {
	header("location:../login");
	die(); 
}*/

/*require_once("../assets/includes/header.php");*/
require_once("../assets/includes/conn.php");
?>


<section class="about d-flex flex-column justify-content-center align-items-center sticked-header-offset" style="height: 100%;">
	<section id="about" class="section-50 d-flex flex-column align-items-center">

		<?php
		// vullen variabele programs met inhoud van database
		$vragen = mysqli_query($conn, "SELECT * FROM vraag");
		?>
		<div class="row">
			<div class="col-xs-8"></div>
			<div class="panel panel-info">
				<div class="panel-heading">
					<h3 class="panel-title">Lijst met Vragen</h3>
				</div>
			</div>

		</div>
		<?php 
		
		echo "<div class='scrollable'><table border='1' cellpadding='10'>";
		echo "<thead>     
			<tr>    
				<th>ID</th>
				<th>Vraag</th>
				<th>Antwoord</th>
				<th>Opleiding</th>
                <th>Bewerk</th>
                <th>Verwijder</th>
			</tr>
		</thead>";
		echo '</div>';


		$pull = $conn->query("SELECT vraag.antwoord,vraag.vragenlijst_ID,vraag.vraag,vragenlijst.ID,vragenlijst.docent_ID,docent.ID,docent.ID,docent.opleiding_ID,opleiding.ID,opleiding.opleiding_naam,vraag.ID FROM vraag INNER JOIN vragenlijst ON vraag.vragenlijst_ID = vragenlijst.ID INNER JOIN docent ON vragenlijst.docent_ID = docent.ID INNER JOIN opleiding ON docent.opleiding_ID = opleiding.ID");
		while($row = $pull->fetch_assoc()) {
			echo "<tr>";
			echo "<td>$row[ID]</td>";
			echo "<td>$row[vraag]</td>";
			echo "<td>$row[antwoord]</td>";
			echo "<td>$row[opleiding_naam]</td>";
			echo "<td><a href=\"vragen_edit.php?id=$row[ID]\">Bewerk</a></td>";
            echo "<td><a href=\"vragen_delete.php?id=$row[ID]\">Verwijder</a></td>";
			echo "</tr>";
		}

		echo "</table></div>";
		echo "<a href='vragen_toevoegen.php'><button>Toevoegen</button></a>
	<a href='../login/logout.php'><button class='button-red'>Log Out</button></a>";
		?>

	</section>
</section>
<?php require_once("../assets/includes/footer.php"); ?>