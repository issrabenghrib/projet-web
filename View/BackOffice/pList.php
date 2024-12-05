<?php
include '../../controller/PlanController.php';
$PlanC = new PlanController();
$listPlan = $PlanC->ActivitePlan();
include '../../controller/ActiviteController.php';
$ActiviteC = new ActiviteController();
$listActivite = $ActiviteC->listActivite();
?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
    
        <title> Plan List - Dashboard</title>
    
        <!-- Custom fonts for this template-->
        <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">
    
        <!-- Custom styles for this template-->
        <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
    </head>
    <body id="page-top">

        <!-- Page Wrapper -->
        <div id="wrapper">
    
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    
                <!-- Sidebar - Brand -->
                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                    
                    <div class="sidebar-brand-text mx-3"> Farm to future dashboard <sup></sup></div>
                </a>
    
                <!-- Divider -->
                <hr class="sidebar-divider my-0">
    
                <!-- Nav Item - Dashboard -->
                
                <li class="nav-item active">
                    <a class="nav-link" href="addPlan.php">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>Add Plan</span></a>
                </li>
            </ul>
            <!-- End of Sidebar -->
    
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
    
                <!-- Main Content -->
                <div id="content">
    
                    <!-- Topbar -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    
                        <!-- Sidebar Toggle (Topbar) -->
                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>
    
                       
    
                       
    
                    </nav>
                    <!-- End of Topbar -->
    
                    <!-- Begin Page Content -->
                    <div class="container-fluid">
    
                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800"> Plan List</h1>
                                  </div>
    
                        <!-- Content Row -->
                        <div class="row">
    
                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-xl-12 col-md-6 mb-4">
                                <div class="card border-left-primary shadow h-100 py-2">
                                    <div class="card-body">
                                        <div class="row no-gutters align-items-center">
                                        <div class="table-responsive">
                                        <table class="table table-bordered">
                                     
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Methode</th>
                                                        <th>Titre</th>
                                                        <th>Date du plan</th>
                                                        <th>Message</th>
                                                        <th colspan="2">Actions</th>
                                                    </tr>
                                              
                                                <?php
                                            foreach ($listPlan as $p) {
                                            ?> <tr>
                                                <td><?php echo $p['id']; ?></td>
                                                <td><?php echo $p['methode']; ?></td>
                                                    <td><?php echo $p['titre']; ?></td>
                                                    <td><?php echo $p['datep']; ?></td>
                                                    <td><?php echo $p['messagep']; ?></td>
                                                    <td>
                                                        <form method="POST" action="updatePlan.php">
                                                            <input type="submit" name="update" value="Update">
                                                            <input type="hidden" value=<?PHP echo $p['id']; ?> name="id">
                                                            <input type="hidden" value=<?PHP echo $p['id_activite']; ?> name="id_activite">
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <a href="deletePlan.php?id=<?php echo $p['id']; ?>">Delete</a>
                                                    </td>
                                                    </tr>
                                            <?php
                                            }
                                            ?>
                                        </table>

                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                          
                        </div>
    
                      
    
                    </div>
                   
    
                </div>
               
                <footer class="sticky-footer bg-white">
                    <div class="container my-auto">
                        <div class="copyright text-center my-auto">
                            <span>Copyright &copy;  Farm to future dashboard 2024</span>
                        </div>
                    </div>
                </footer>
              
    
            </div>
         
    
        </div>
       
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
        <script src="js/addPlan.js"></script>
    
        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    
        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>
    
        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>
    
        <!-- Page level custom scripts -->
        <script src="js/demo/chart-area-demo.js"></script>
        <script src="js/demo/chart-pie-demo.js"></script>
    
    </body>

</html>