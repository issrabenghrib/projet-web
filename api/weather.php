<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../config/database.php';

$conn = getDBConnection();
$method = $_SERVER['REQUEST_METHOD'];

switch($method) {
    case 'GET':
        getWeatherData();
        break;
    case 'POST':
        addWeatherData();
        break;
    case 'PUT':
        updateWeatherData();
        break;
    case 'DELETE':
        deleteWeatherData();
        break;
    default:
        http_response_code(405);
        echo json_encode(['message' => 'Méthode non autorisée']);
}

function getWeatherData() {
    global $conn;
    try {
        $date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
        
        $stmt = $conn->prepare("SELECT * FROM weather_predictions WHERE date = ?");
        $stmt->execute([$date]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode(['message' => 'Aucune donnée trouvée pour cette date']);
        }
    } catch(PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}

function addWeatherData() {
    global $conn;
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        
        $stmt = $conn->prepare("
            INSERT INTO weather_predictions (date, temperature, humidity, rain_probability)
            VALUES (?, ?, ?, ?)
        ");
        
        $stmt->execute([
            $data['date'],
            $data['temperature'],
            $data['humidity'],
            $data['rain_probability']
        ]);
        
        echo json_encode([
            'message' => 'Données ajoutées avec succès',
            'id' => $conn->lastInsertId()
        ]);
    } catch(PDOException $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}

function updateWeatherData() {
    global $conn;
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        
        if (!$id) {
            throw new Exception('ID manquant');
        }
        
        $stmt = $conn->prepare("
            UPDATE weather_predictions 
            SET temperature = ?, humidity = ?, rain_probability = ?
            WHERE id = ?
        ");
        
        $stmt->execute([
            $data['temperature'],
            $data['humidity'],
            $data['rain_probability'],
            $id
        ]);
        
        echo json_encode(['message' => 'Données mises à jour avec succès']);
    } catch(Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}

function deleteWeatherData() {
    global $conn;
    try {
        $id = isset($_GET['id']) ? $_GET['id'] : null;
        
        if (!$id) {
            throw new Exception('ID manquant');
        }
        
        $stmt = $conn->prepare("DELETE FROM weather_predictions WHERE id = ?");
        $stmt->execute([$id]);
        
        echo json_encode(['message' => 'Données supprimées avec succès']);
    } catch(Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>