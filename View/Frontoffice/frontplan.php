<?php
include '../../Controller/DateController.php';
$DateC = new DateController();
$list = $DateC->listDate();
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Reveal Bootstrap Template</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="lib/magnific-popup/magnific-popup.css" rel="stylesheet">
  <link href="lib/ionicons/css/ionicons.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">

  <!-- =======================================================
    Theme Name: Reveal
    Theme URL: https://bootstrapmade.com/reveal-bootstrap-corporate-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body id="body">

  <!--==========================
    Top Bar
  ============================-->
  <section id="topbar" class="d-none d-lg-block">
    <div class="container clearfix">
      <div class="contact-info float-left">
        <i class="fa fa-envelope-o"></i> <a href="mailto:contact@farmtofuture.com">contact@farmtofuture.com</a>
        <i class="fa fa-phone"></i> +216 22 222 222
      </div>
      <div class="social-links float-right">
        <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
        <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
        <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
        <a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
        <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
      </div>
    </div>
  </section>

  
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <h1><a href="#body" class="scrollto">Farm to<span> future</span></a></h1>
       
      </div>

      
    </div>
  </header>
  <main id="main">
    <section id="testimonials" class="wow fadeInUp">
      <div class="container">
        <div class="section-header">
          <h2>suivie des activites</h2>
          <p>Voici la liste des dates des activites</p>
        </div>
        <div class="container d-flex flex-wrap justify-content-between">
        <?php
        foreach ($list as $o) {
        ?>
            <div class="testimonial-item" style="width:200px; height: 250px; overflow: hidden;">
              <p>

              </p>
              <img src="" class="testimonial-img" alt="">
              <h5>Annee:<?php echo $o['annee']?></h5>
              <h5>Mois:<?php echo $o['mois']?></h5>
              <h5>Jour:<?php echo $o['jour']?></h5>
              <h4>Date Employé</h4>
            </div>
            <?php
        }
        ?>
            

            

        </div>

      </div>
    </section>
  </main>

  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Projet web <strong>Farm to future</strong>. All Rights Reserved
      </div>
      <div class="credits">
       
      </div>
    </div>
  </footer>

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/owlcarousel/owl.carousel.min.js"></script>
  <script src="lib/magnific-popup/magnific-popup.min.js"></script>
  <script src="lib/sticky/sticky.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8HeI8o-c1NppZA-92oYlXakhDPYR7XMY"></script>
  <script src="contactform/contactform.js"></script>
  <script src="js/main.js"></script>

</body>
</html>
