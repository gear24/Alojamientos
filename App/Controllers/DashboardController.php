<?php

/**
 * DashboardController
 * 
 * Controlador para manejar el dashboard de la aplicación.
 */

namespace App\Controllers;

use App\Models\Dashboard;
use App\Models\User;
use Exception;

class DashboardController
{
    private $userModel; # Propiedad para almacenar la instancia de User
    private $dashboardModel; # Propiedad para almacenar la instancia de Dashboard

    public function __construct() {
        $this->userModel = new User(); # Inicializa la instancia de User
        $this->dashboardModel = new Dashboard(); # Inicializa la instancia de Dashboard
    }

    public function showDashboard()# Método para mostrar el dashboard
    {
        error_log("Iniciando showDashboard");
        
        if (!isset($_SESSION['user_id'])) {
            error_log("No hay sesión de usuario");
            header('Location: /CRUD%20Alojamientos/public/login');
            exit;
        }
    
        try {
            $user = $this->userModel->findById($_SESSION['user_id']);
            error_log("Datos de usuario: " . print_r($user, true));
    
            if (!$user) {
                throw new Exception("Usuario no encontrado");
            }
    
            #Incluir la vista
            require_once '../App/Views/Dashboard.php';
            
        } catch (Exception $e) {
            error_log("Error en dashboard: " . $e->getMessage());
            echo "Error: " . $e->getMessage();
        }
    }

    // public function hasbooked($id)
    // {
    //     // Usa la instancia de User desde el constructor
    //     $bookings = $this->userModel->hasbooked($id);
    //     return $bookings;
    // }

    public function getAccommodations()# Método para obtener los alojamientos
    {
        // Usa la instancia de Dashboard desde el constructor
        $accommodations = $this->dashboardModel->getAccommodations();
        return $accommodations;
    }

    public function availableAccommodations()# Método para obtener los alojamientos disponibles
    {
        // Usa la instancia de Dashboard desde el constructor
        $accommodations = $this->dashboardModel->availableAccommodations();
        return $accommodations;
    }
}