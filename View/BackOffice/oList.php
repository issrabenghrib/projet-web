<?php
include '../../controller/OuvrierController.php';
$OuvrierC = new OuvrierController();
$listOuvrier = $OuvrierC->TravailOuvrier();

include '../../controller/TravailController.php';
$TravailC = new TravailController();
$listTravail = $TravailC->listTravail();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard - Ouvrier and Travail Lists</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../Frontoffice/accueil.php">
            <div class="sidebar-brand-text mx-3">Farm to future dashboard</div>
        </a>
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="addOuvrier.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Add Ouvrier</span>
            </a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="addTravail.php">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Add Travail</span>
            </a>
        </li>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Ouvrier List</h1>
                </div>

                <!-- Ouvrier Table -->
                <div class="row">
                    <div class="col-xl-12 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="table-responsive">
                                        <input type="text" id="search1" placeholder="Rechercher">
                                        <button onclick="sortTable1()">Sort by Age</button>
                                        <table class="table table-bordered">
                                            <tr>
                                                <th>ID</th>
                                                <th>Type de Travail effectué</th>
                                                <th>Nom</th>
                                                <th>Prenom</th>
                                                <th>Age</th>
                                                <th colspan="2">Actions</th>
                                            
                                            </tr>
                                            <tbody id="tbody1">
                                            <?php foreach ($listOuvrier as $o) { ?>
                                                <tr>
                                                    <td><?php echo $o['id'] ?></td>
                                                    <td><?php echo $o['typetravail'] ?></td>
                                                    <td><?php echo $o['nom'] ?></td>
                                                    <td><?php echo $o['prenom'] ?></td>
                                                    <td><?php echo $o['age'] ?></td>
                                                    <td>
                                                        <form method="POST" action="updateOuvrier.php">
                                                            <input type="submit" name="update" value="Update">
                                                            <input type="hidden" value=<?PHP echo $o['id']; ?> name="id">
                                                            <input type="hidden" value=<?PHP echo $o['id_travail']; ?> name="id_travail">
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <a href="deleteOuvrier.php?id=<?php echo $o['id']; ?>">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button id="downloadouvrierExcel">Download Excel</button>
                </div>

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Travail List</h1>
                </div>

                <!-- Travail Table -->
                <div class="row">
                    <div class="col-xl-12 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                        <input type="text" id="search2" placeholder="Rechercher">
                                        <button onclick="sortTable2()">Sort by typetravail</button>
                                            <tr>
                                                <th>ID</th>
                                                <th>TypeTravail</th>
                                                <th>Duree</th>
                                                <th>Unite</th>
                                                <th colspan="2">Actions</th>
                                            </tr>
                                            <tbody id="tbody2">
                                            <?php foreach ($listTravail as $t) { ?>
                                                <tr>
                                                    <td><?php echo $t['id'] ?></td>
                                                    <td><?php echo $t['typetravail'] ?></td>
                                                    <td><?php echo $t['duree'] ?></td>
                                                    <td><?php echo $t['unite'] ?></td>
                                                    <td>
                                                        <form method="POST" action="updateTravail.php">
                                                            <input type="submit" name="update" value="Update">
                                                            <input type="hidden" value=<?PHP echo $t['id']; ?> name="id">
                                                        </form>
                                                    </td>
                                                    <td>
                                                        <a href="deleteTravail.php?id=<?php echo $t['id']; ?>">Delete</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                            
                                            
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button id="downloadtravailExcel">Download Excel</button>

            </div>
            <!-- End of Page Content -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Farm to future dashboard 2024</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>


<!-- Scripts -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
<script src="vendor/chart.js/Chart.min.js"></script>
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>
<script src="js/metier.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.21/jspdf.plugin.autotable.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.21/jspdf.plugin.autotable.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.21/jspdf.plugin.autotable.min.js"></script>
<script>
// Export Ouvrier List to Excel
function exportTableToExcelOuvrier() {
    let table = document.querySelector('#tbody1');
    let rows = Array.from(table.rows);
    let workbook = XLSX.utils.book_new();

    let data = rows.map(row => {
        return Array.from(row.cells).map(cell => cell.innerText.trim());
    });

    let worksheet = XLSX.utils.aoa_to_sheet([['ID', 'Travail Effectué', 'Nom', 'Prenom', 'Age'], ...data]);
    XLSX.utils.book_append_sheet(workbook, worksheet, "Ouvrier List");

    XLSX.writeFile(workbook, "Ouvrier_List.xlsx");
}

// Export Travail List to Excel
function exportTableToExcelTravail() {
    let table = document.querySelector('#tbody2');
    let rows = Array.from(table.rows);
    let workbook = XLSX.utils.book_new();

    let data = rows.map(row => {
        return Array.from(row.cells).map(cell => cell.innerText.trim());
    });

    let worksheet = XLSX.utils.aoa_to_sheet([['ID', 'Type de Travail', 'Duree', 'Unite'], ...data]);
    XLSX.utils.book_append_sheet(workbook, worksheet, "Travail List");

    XLSX.writeFile(workbook, "Travail_List.xlsx");
}

// Event Listeners
document.getElementById('downloadouvrierExcel').addEventListener('click', exportTableToExcelOuvrier);
document.getElementById('downloadtravailExcel').addEventListener('click', exportTableToExcelTravail);
</script>

<!-- Add XLSX Library -->
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.17.0/dist/xlsx.full.min.js"></script>
<script src="js/metier.js"></script>


</body>
</html>
