<?php
session_start();
if (!isset($_SESSION['docent'])) {
	header('location:../login');
	die();
} elseif (!$_SESSION['docent']) {
	header('location:../login');
	die();
}
require_once("../assets/includes/header.php");
require_once("../assets/includes/conn.php");
?>

<!-- GROEPJES TABEL ALLES TONEN -->
<?php
require_once("../assets/includes/conn.php");

$ophalen = $conn->query("SELECT * FROM vraag");
?>

<section class="about d-flex flex-column justify-content-center align-items-center sticked-header-offset" style="height: 100%;">
	<section id="about" class="section-50 d-flex flex-column align-items-center">
		<div class="container">
			<div class="row">
				<div class="col-6">
					<?php
					/* docenten_edit.PHP
		Allows user to edit specific entry in database
		*/
					function renderForm($id, $vraag, $antwoord, $vragenlijst_ID)
					{
					?>
						<form action="" method="post">
							<input type="hidden" name="id" value="<?php echo $id; ?>" />

							<div>
								<table border='1' cellpadding='10' width='100%'>
									<tr>
										<td><strong>Wat is de vraag: </strong></td>
										<td><input type='text' name='vraag' value='<?php echo $vraag; ?>' /></td>
									</tr>
									<tr>
										<td><strong>Antwoord op de vraag: </strong></td>
										<td><input type='text' name='antwoord' value='<?php echo $antwoord; ?>' /></td>
									</tr>
									<tr>
										<td><strong>Bij welke opleiding hoort de vraag: </strong></td>
										<td><input type='text' name='vragenlijst_ID' value='<?php echo $vragenlijst_ID; ?>' /></td>
									</tr>
									<tr>
										<?php
										require_once("../assets/includes/conn.php");
										// Get all the categories from category table
										$sql_klasid = "SELECT * FROM `vraag`";
										$vraagID = mysqli_query($conn, $sql_klasid);
										?>
										<select name="vraagID">
											<?php
											// use a while loop to fetch data
											// from the $all_categories variable
											// and individually display as an option
											while ($vraag_id = mysqli_fetch_array(
												$vraagID
											)) :
											?>
												<option value="<?php echo $vraag_id["id"];
																// The value we usually set is the primary key
																?>">
												</option>
											<?php
											endwhile;
											// While loop must be terminated
											?>
										</select>
									</tr>
									</td>
								</table>
								<p>Everything is Required</p>

								<input type="submit" name="submit" value="Wijzigen">

							</div>

						</form>

				</div>
			</div>
		</div>


	<?php
					}

					// connect to the database
					require_once("../assets/includes/conn.php");

					echo '
		<div class="container">
			<div class="row">
				<div class="col-md-8"></div>
				<h3 class="panel-title">Vragen Wijzigen</h3>
			</div>
		</div>';

					// check if the form has been submitted. If it has, process the form and save it to the database
					if (isset($_POST['submit'])) {
						if (is_numeric($_POST['id'])) {
							// confirm that the 'id' value is a valid integer before getting the form data
							$id = $_POST['id'];
							// get form data, making sure it is valid
							$vraag = mysqli_real_escape_string($conn, htmlspecialchars($_POST['vraag']));
							$antwoord = mysqli_real_escape_string($conn, htmlspecialchars($_POST['antwoord']));
							$vragenlijst_ID = mysqli_real_escape_string($conn, htmlspecialchars($_POST['vragenlijst_ID']));
					
							// checken of volgende velden zijn gevuld
							if ($vraag == '' || $antwoord == '') {
								// generate error message
								$error = 'ERROR: Please fill in all required fields!';
								//error, display form
								renderForm($id, $vraag, $antwoord, $vragenlijst_ID);
							} else {
								// save the data to the database
								$sql_query = "UPDATE vraag SET vraag='$vraag', antwoord='$antwoord',vragenlijst_ID='$vragenlijst_ID' WHERE id='$id'";
								$retval = mysqli_query($conn, $sql_query);
								if (!$retval) {
									die('Could not enter data: ');
								}
								// once saved, redirect back to the view page
								header("Location: index.php");
							}
						} else {
							// if the 'id' isn't valid, display an error
							echo 'Error!';
						}
					} else {
						// if the form hasn't been submitted, get the data from the db and display the form
						// get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
						if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {
							// query db
							$id = $_GET['id'];
							$result = mysqli_query($conn, "SELECT vraag.antwoord,vraag.vragenlijst_ID,vraag.vraag,vragenlijst.ID,vragenlijst.docent_ID,docent.ID,docent.opleiding_ID,opleiding.ID,opleiding.opleiding_naam,vraag.ID FROM vraag INNER JOIN vragenlijst ON vraag.vragenlijst_ID = vragenlijst.ID INNER JOIN docent ON vragenlijst.docent_ID = docent.ID INNER JOIN opleiding ON docent.opleiding_ID = opleiding.ID WHERE vraag.ID=$id") or die('doet niet');
							$row = mysqli_fetch_array($result);
							// check that the 'id' matches up with a row in the databse
							if ($row) {
								// get data from db
								$vraag = $row['vraag'];
								$antwoord = $row['antwoord'];
								$vragenlijst_ID = $row['opleiding_naam'];
								// show form
								renderForm($id, $vraag, $antwoord, $vragenlijst_ID);
							} else {
								// if no match, display result
								echo "No results!";
							}
						} else {
							// if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
							echo 'Error!';
						}
					}
	?>
	</section>
</section> <!-- End About Section -->
<?php include "../assets/includes/footer.php" ?>