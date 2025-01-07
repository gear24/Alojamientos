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
use App\Controllers\AccommodationsController;
use App\Controllers\BookingController; 

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
        case '/addAccommodation':
            error_log("Add route matched"); // Debug log
            $accommodationscontroller = new AccommodationsController();
            $accommodationscontroller->addAccommodation();
            break;
        case '/addBooking': 
                error_log("Add Booking route matched"); // Debug log
                $bookingController = new BookingController();
                $bookingController->addBooking();
                break;
        case '/unsetBooking': 
                error_log("Add Booking route matched"); // Debug log
                $bookingController = new BookingController();
                $bookingController->unsetBooking();
                break;
        default:
            error_log("No route matched for: " . $requestUri); // Debug log
            echo "Ruta POST no encontrada \n";
            echo $requestUri;
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
        case '/addAccommodation':
                error_log("Add route matched"); // Debug log
                $accommodationscontroller = new AccommodationsController();
                $accommodationscontroller->showAccommodationForm();
                break;

        default:
            echo "Ruta GET no encontrada: " . htmlspecialchars($requestUri);
            break;
    }
}   





