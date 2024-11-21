<?php
include '../../controller/ActiviteController.php';
$activiteC = new ActiviteController();
$activiteC->deleteActivite($_GET["id"]);
header('Location:aList.php');