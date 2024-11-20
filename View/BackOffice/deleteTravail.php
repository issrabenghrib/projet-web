<?php
include '../../controller/TravailController.php';
$travailC = new TravailController();
$travailC->deleteTravail($_GET["id"]);
header('Location:oList.php');