<?php
include '../../controller/DateController.php';
$dateC = new DateController();
$dateC->deleteDate($_GET["id"]);
header('Location:dList.php');
