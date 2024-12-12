<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Check if files exist before requiring them
$weatherServicePath = __DIR__ . '/../model/WeatherService.php';
$meteoControllerPath = __DIR__ . '/../controller/MeteoController.php';

if (file_exists($weatherServicePath)) {
    require_once $weatherServicePath;
} else {
    die("WeatherService.php not found at: " . $weatherServicePath);
}

if (file_exists($meteoControllerPath)) {
    require_once $meteoControllerPath;
} else {
    die("MeteoController.php not found at: " . $meteoControllerPath);
}

$controller = new MeteoController();
$controller->handleRequest();
?>