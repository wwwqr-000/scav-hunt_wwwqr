<?php
require_once("../assets/includes/header.php");
require_once("../assets/includes/conn.php");
if (!isset($_SESSION['admin'])) {
	header('location:../login'); die();
} else if (!$_SESSION['admin']) {
	header('location:../login'); die();
}

/* 
 .PHP
 Allows user to create a new entry in the database
*/

$id='';
$naam='';
$opleiding='';
$wachtwoord='';
$isAdmin='';

 function renderForm($id, $naam, $opleiding, $wachtwoord,$isAdmin)
 {
 ?>
  
 
 <form action='' method='post'>
 <div>
<table border='1' cellpadding='10' width='100%'>
<tr>
<td> <strong>naam: </strong></td><td>  <input type='text' name='naam' value='<?php echo $naam; ?>'/>*</td>
</tr>
<tr>
<td> <strong>opleiding: </strong></td><td>  <input type='text' name='opleiding' value='<?php echo $opleiding; ?>'/>*</td>
</tr>
<tr>
<td> <strong>wachtwoord: </strong></td><td>  <input type='text' name='wachtwoord' value='<?php echo $wachtwoord; ?>'/>*</td>
</tr>
<tr>
<td> <strong>Admin: </strong></td><td>  <input type='checkbox' name='isAdmin'/></td>
</tr>

<?php

?>

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
						<h3 class="panel-title">Nieuwe Docent / Admin toevoegen</h3>
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
	$naam = mysqli_real_escape_string($conn,$_POST['naam']);
	$opleiding = mysqli_real_escape_string($conn,$_POST['opleiding']);
	$wachtwoord = mysqli_real_escape_string($conn,$_POST['wachtwoord']);
	$isAdmin = (isset($_POST['isAdmin']) ? 1 : 0);
    /* if (isset($_POST['isAdmin']))
        $isAdmin = '1'; // Checkbox is selected
    else
        $isAdmin = '0'; // Alternate code */
   
 
 // check to make sure both fields are entered
 if ($naam == '' || $opleiding == '' || $wachtwoord == '')
 	{
 	// generate error message
 	$error = 'ERROR: Please fill in all required fields!';
 	// if either field is blank, display the form again
 	renderForm($naam, $opleiding, $wachtwoord);

 	}
 else
 	{ 
		 
 	// save the data to the database

	$sql_query = "INSERT INTO docent (naam, opleiding, wachtwoord,isAdmin) VALUES ('$naam', '$opleiding', '$wachtwoord','$isAdmin')";


	$retval = mysqli_query($conn, $sql_query );
   
   	if (! $retval ) {
      	die('Could not enter data: ');
   	}
   
   	echo "Entered data successfully\n";
    header("Location: index.php");
 
 	}
}
 else
 	// if the form hasn't been submitted, display the form
 	{
 	renderForm('','','','','');
 	}
require_once("../assets/includes/footer.php"); ?>
