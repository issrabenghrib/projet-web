<?php 
include '../../Controller/OuvrierController.php';
$OuvrierC = new OuvrierController(); 
$list = $OuvrierC->TravailOuvrier();
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

   <!-- Main Stylesheet File -->
   <link href="css/style.css" rel="stylesheet">
</head>

<body id="body">

   <!--========================== Top Bar ============================-->
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
               <h2>Liste des ouvriers employés</h2>
               <p>Voici la liste des ouvriers sur terrain, veuillez contacter un administrateur pour ajouter ou supprimer un ouvrier de la liste.</p>
            </div>

            <!-- Display workers in cards -->
            <div class="row">
               <?php foreach ($list as $o) { ?>
                  <div class="col-md-4 mb-4">
                     <div class="card">
                        <img src="farmer.png" class="card-img-top" alt="Ouvrier Image">
                        <div class="card-body">
                           <h5 class="card-title"><?php echo $o['nom']; ?> <?php echo $o['prenom']; ?> </h5>
                           <h6 class="card-subtitle mb-2 text-muted">Ouvrier Employé</h6>
                           <p class="card-text"><?php echo $o['typetravail']; ?></p>
                           <!-- Add action buttons here -->
                           <a href="#" class="btn btn-primary">Details</a>
                        </div>
                     </div>
                  </div>
               <?php } ?>
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
