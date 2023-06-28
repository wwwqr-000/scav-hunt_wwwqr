<?php
require_once("../assets/includes/header.php");
if (isset($_SESSION["docent"]))
    unset($_SESSION["docent"]);
if (isset($_SESSION["admin"]))
    unset($_SESSION["admin"]);?>
<script>location.replace("../login") </script>