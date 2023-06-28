<?php
$_SESSION["pagina"] = "home";
include 'assets/includes/header.php';
echo <<<meta
<html id="page_home">
<meta>
meta;
?>
<style>
  h2, h3, h4 {
    text-align: center;
  }
  
  p {
    text-align: left;
  }
</style>


<main id="main">

  <section class="about d-flex flex-column justify-content-center align-items-center sticked-header-offset" style="height: 100%;">
    <section id="about" class="section-50 d-flex flex-column align-items-center">
      <div class="container">

        <div class="col-12">
          <div class="full-width-block">
            <?php
            $filePath = "about.txt";

            function formatText($text)
            {
              $text = preg_replace("/\*(.*?)\*/", "<em>$1</em>", $text);
              $text = preg_replace("/\*\*(.*?)\*\*/", "<strong>$1</strong>", $text);
              $text = preg_replace("/__(.*?)__/", "<u>$1</u>", $text);

              return $text;
            }

            $content = formatText(file_get_contents($filePath));

            $lines = explode("\n", $content);
            foreach ($lines as $line) {
              if (preg_match("/^###/", $line)) {
                echo "<h3>" . substr($line, 3) . "</h4>";
              } elseif (preg_match("/^##/", $line)) {
                echo "<h2>" . substr($line, 2) . "</h3>";
              } elseif (preg_match("/^#/", $line)) {
                echo "<h1>" . substr($line, 1) . "</h2>";
              } else {
                echo "<p>" . $line . "</p>";
              }
            } ?>
          </div>
        </div>
        <!-- <div class="block">
          <div class="content d-flex flex-column justify-content-center align-items-center sticked-header-offset">
            <h2>Join the adventure today!</h2>
            <div class="image-container">
              <img src="assets/img/Map-location.png" alt="Image" class="full-width-image">
            </div>
          </div>
        </div>
      </div> -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <div class="container">
        <br>
        
      </div>
    </section>
  </section> <!-- End About Section -->

  <?php include "assets/includes/footer.php" ?>