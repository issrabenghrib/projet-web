<?php
include '../../controller/PlanController.php';
$planC = new PlanController();
$planC->deletePlan($_GET["id"]);
header('Location:pList.php');
