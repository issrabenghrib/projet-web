<?php
include '../../controller/OuvrierController.php';
$OuvrierC = new OuvrierController();
$OuvrierC->deleteOuvrier($_GET["id"]);
header('Location:oList.php');
