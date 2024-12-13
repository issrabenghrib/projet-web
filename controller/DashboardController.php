// DashboardController.php - Contrôleur pour le Dashboard
//*<?php
/*include('C:\Users\Hp\OneDrive - ESPRIT\Images\Documents\xampprojet\htdocs\mvc\index.php');
include_once 'C:\Users\Hp\OneDrive - ESPRIT\Images\Documents\xampprojet\htdocs\mvc\model\dashboard.php';

class DashboardController {
    private $dashboardModel;

    public function __construct($db) {
        $this->dashboardModel = new Dashboard($db); // Créez une instance du modèle Dashboard
    }

    // Méthode pour récupérer les statistiques pour l'affichage du dashboard
    public function getDashboardData() {
        $totalRequetes = $this->dashboardModel->getTotalRequetes();
        $recentRequetes = $this->dashboardModel->getRecentRequetes();
        return ['totalRequetes' => $totalRequetes, 'recentRequetes' => $recentRequetes];
    }
}
?>