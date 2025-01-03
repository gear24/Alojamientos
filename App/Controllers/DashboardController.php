<?php

namespace App\Controllers;

use App\Models\User;
use Exception;


class DashboardController
{
    public function showDashboard()
    {
        error_log("Iniciando showDashboard");
        
        if (!isset($_SESSION['user_id'])) {
            error_log("No hay sesión de usuario");
            header('Location: /CRUD%20Alojamientos/public/login');
            exit;
        }
    
        try {
            $userModel = new User();
            $user = $userModel->findById($_SESSION['user_id']);
            error_log("Datos de usuario: " . print_r($user, true));
    
            if (!$user) {
                throw new Exception("Usuario no encontrado");
            }
    
            // Incluir la vista
            require_once '../App/Views/Dashboard.php';
            
        } catch (Exception $e) {
            error_log("Error en dashboard: " . $e->getMessage());
            echo "Error: " . $e->getMessage();
        }
    }
}
