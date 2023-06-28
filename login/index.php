<?php
$_SESSION['pagina'] = 'login';
require_once("../assets/includes/header.php");

if (isset($_SESSION["error"])) {//Error feedback van login
  if ($_SESSION["error"] != 0) {
    echo "<script>
    window.alert($_SESSION[error]);
    </script>";
    $_SESSION["error"] = "0";
  }
}

if (isset($_SESSION['docent'])):
	echo $_SESSION['docent'];?>
  <script>location.replace("../docent/index.php") </script>.
<?php endif; ?>

<main id="main">

<section class="about d-flex flex-column justify-content-center align-items-center sticked-header-offset" style="height: 100%;">
  <section id="about" class="section-50 d-flex flex-column align-items-center">
    <h3>Docent en admin login</h3>
    <form method="post" action="send.php">
      <input type="text" name="user" placeholder="Username" required>
      <input type="password" name="pw" placeholder="Password" required>
      <button type="submit" name="submit">Login</button>
    </form>
    <p id="error"></p>
  </section>
</section>


<?php
require_once("../assets/includes/footer.php");
?>