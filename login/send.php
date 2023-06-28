<?php

require_once('../assets/includes/conn.php');
session_start();
$usr = htmlspecialchars($_POST['user']);
$pw = htmlspecialchars($_POST['pw']);
$docent = $conn->query('SELECT * FROM docent');
$check = 0;
while ($row = $docent->fetch_assoc()) {
	if ($usr == $row['naam'] && $pw == $row['wachtwoord']) {
		$_SESSION['docent'] = 1;
		$_SESSION['naam'] = $row['naam'];
		$_SESSION['opleiding_ID'] = $row['opleiding_ID'];
		if ($row['isAdmin']) $_SESSION['admin'] = 1;
		header('location:../docent');
		die();
	}
}
$_SESSION['error'] = 'Inloggegevens onjuist.';
header('location:../login');
die();
?>
