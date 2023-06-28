<?php
session_start();
if (isset($_SESSION["docent"])) { 
	if ($_SESSION["docent"] != 1) {
		header("location:../login");
	}
}
else {
	header("location:../login");
}
/* 
 delete.PHP
 Deletes a specific entry from the 'leerling' table
 Docent can delete a student
*/

 // connect to the database
 require_once("../assets/includes/conn.php");
 

 
 // check if the 'id' variable is set in URL, and check that it is valid
 if (isset($_GET['id']) && is_numeric($_GET['id']))
 {
 // get id value
 $id = $_GET['id'];
 
 // delete the entry
 $conn->query("DELETE FROM vraag WHERE id=$id");
 
 // redirect back to the view page
 header("Location: ../docent");
 }
 else
 // if id isn't set, or isn't valid, redirect back to view page
 {
 header("Location: ../docent");
 }
 
?>