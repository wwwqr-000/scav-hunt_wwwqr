<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
// require_once("../assets/includes/header.php");
require_once("../assets/includes/conn.php");
if (!isset($_SESSION['docent'])) {
	header('location:../login'); die();
} if ($_SESSION['docent'] != 1) {
	header('location:../login'); die();
}
/* 
 .PHP
 Allows user to create a new entry in the database
*/

$id='';
$vraag='';
$antwoord='';
$vragenlijst_ID='';

 function renderForm($id, $vraag, $antwoord,$vragenlijst_ID)
 {
 ?>
  
 
 <form action='' method='post'>
 <div>
<table border='1' cellpadding='10' width='100%'>
<tr>
<td> <strong>Vraag: </strong></td><td>  <input type='text' name='vraag' value='<?php echo $vraag; ?>'/>*</td>
</tr>
<tr>
<td> <strong>Antwoord op de vraag: </strong></td><td>  <input type='text' name='antwoord' value='<?php echo $antwoord; ?>'/>*</td>
</tr>
<tr>
<td> <strong>Bij welke vragenlijstnummer hoort de vraag: </strong></td><td>  <input type='text' name='vragenlijst_ID' value='<?php echo $vragenlijst_ID; ?>'/>*</td>
</tr>

</table>
<p>* required</p>
 <input type='submit' name='submit' value='submit'>
 </div>
 </form> 

 <?php 
 }


 // connect to the database
 require '../assets/includes/conn.php';
 

echo '<div class="container">
		<div class="row">
			<div class="col-xs-8"></div>
  
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Nieuwe Vraag toevoegen</h3>
					</div>
				</div>
			
		</div>
	</div>

   '
;
 // check if the form has been submitted. If it has, start to process the form and save it to the database
 if (isset($_POST['submit']))
 	{ 
       

 	// get form data, making sure it is valid
//	$id = $_POST['id']; 	     // get form data, making sure it is valid
	$vraag = mysqli_real_escape_string($conn,$_POST['vraag']);
	$antwoord = mysqli_real_escape_string($conn,$_POST['antwoord']);
	$vragenlijst_ID = mysqli_real_escape_string($conn,$_POST['vragenlijst_ID']);
	//$groep_ID = mysqli_real_escape_string($conn,$_POST['groep_ID']);
   
 
 // check to make sure both fields are entered
 if ($vraag == '' || $antwoord == '' || $vragenlijst_ID == '')
 	{
 	// generate error message
 	$error = 'ERROR: Please fill in all required fields!';
 	// if either field is blank, display the form again
 	renderForm($id,$vraag, $antwoord,$vragenlijst_ID);

 	}
 else
 	{ 
		 
 	// save the data to the database

	$sql_query = "INSERT INTO vraag (vraag, antwoord,vragenlijst_ID) VALUES ('$vraag', '$antwoord',$vragenlijst_ID)";


	$retval = mysqli_query($conn, $sql_query );
   
   	if (!$retval ) {
      	die('Could not enter data: ');
   	}
   
   	echo "Entered data successfully\n";
    header("Location: vragen-aanpassen.php");
 
 	}
}
 else
 	// if the form hasn't been submitted, display the form
 	{
 	renderForm('','','','');
 	}
require_once("../assets/includes/footer.php"); ?>
