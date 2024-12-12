<?php
require_once __DIR__ . '/../model/MeteoModel.php';

class MeteoController {
    private $model;

    public function __construct() {
        $this->model = new MeteoModel();
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['action'])) {
                switch ($_POST['action']) {
                    case 'add':
                        $this->model->addMeteo($_POST['date'], $_POST['temperature'], $_POST['humidite'], $_POST['pluie']);
                        break;
                    case 'update':
                        $this->model->updateMeteo($_POST['id'], $_POST['date'], $_POST['temperature'], $_POST['humidite'], $_POST['pluie']);
                        break;
                    case 'delete':
                        $this->model->deleteMeteo($_POST['id']);
                        break;
                }
            }
        }
        $this->showMeteo();
    }

    public function showMeteo() {
        $meteoData = $this->model->getAllMeteo();
        include __DIR__ . '/../view/adminView.php';
    }
}
?>