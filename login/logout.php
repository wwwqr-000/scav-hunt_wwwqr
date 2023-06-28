<?php
require_once("../assets/includes/header.php");
session_start();
if (isset($_SESSION["docent"]))
    unset($_SESSION["docent"]);
if (isset($_SESSION["admin"]))
    unset($_SESSION["admin"]);
header("location: ../login");
