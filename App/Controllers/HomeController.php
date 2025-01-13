<?php

/*
* Home controller
*/

namespace App\Controllers;

use App\Models\Dashboard;
use Config\Database;
use PDO;

class HomeController{
    private $dashboardModel;

    public function __construct() {
        $this->dashboardModel = new Dashboard();
    }

    public function showHome() {
        $accommodations = $this->getEveryAccommodations(); // Obtiene los datos desde el modelo
        include BASE_PATH . '/App/Views/layouts/navbar.php';
        require_once __DIR__ . '/../Views/Landing.php';
    }    
    public function getEveryAccommodations() {
        $accommodations = $this->dashboardModel->availableAccommodations();;
        return $accommodations;
    }
}