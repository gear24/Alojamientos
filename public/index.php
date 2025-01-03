<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

#Definir la ruta base del proyecto
define('BASE_PATH', dirname(__DIR__));

#Cargar el autoloader
require_once BASE_PATH . '/autoload.php';

#Inicialización de la sesión
session_start();

# Rutas y controladores
use App\Controllers\AuthController;
use App\Controllers\DashboardController;

# Obtener la URI de la solicitud
$requestUri = $_SERVER['REQUEST_URI'];
$basePath = '/CRUD%20Alojamientos/public';
$requestUri = str_replace($basePath, '', $requestUri);

# Si la URI está vacía, redirigir a /login
if ($requestUri === '') {
    $requestUri = '/login';
}

// Debug
error_log("Request URI: " . $requestUri);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log("POST request received for: " . $requestUri); // Debug log
    switch ($requestUri) {
        case '/register':
            error_log("Register route matched"); // Debug log
            $authController = new AuthController();
            $authController->register();
            break;
        case '/login':
            error_log("Login route matched"); // Debug log
            $authController = new AuthController();
            $authController->login();
            break;
        default:
            error_log("No route matched for: " . $requestUri); // Debug log
            echo "Ruta POST no encontrada";
            break;
    }
} else {
    switch ($requestUri) {
        case '/login':
            $authController = new AuthController();
            $authController->showLoginForm();
            break;
        case '/register':
            $authController = new AuthController();
            $authController->showRegisterForm();
            break;
        case '/dashboard':
            $dashboardController = new DashboardController();
            $dashboardController->showDashboard();
            break;
        case '/logout':
                $authController = new AuthController();
                $authController->logout();
                break;
            
        default:
            echo "Ruta GET no encontrada: " . htmlspecialchars($requestUri);
            break;
    }
}   