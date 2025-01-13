<?php
ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

# Definir la ruta base del proyecto
define('BASE_PATH', dirname(__DIR__));
define('BASE_URL', '/queso/public');


# Cargar el autoloader
require_once BASE_PATH . '/autoload.php';

# Inicialización de la sesión
session_start();

# Rutas y controladores
use App\Controllers\AuthController;
use App\Controllers\DashboardController;
use App\Controllers\AccommodationsController;
use App\Controllers\BookingController;
use App\Controllers\HomeController;

# Obtener la URI de la solicitud
# Obtener la URI de la solicitud
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); // Obtiene solo el path
$scriptName = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])); // Normaliza el nombre del script
$basePath = rtrim($scriptName, '/'); // Elimina la barra final si existe
$requestUri = str_replace($basePath, '', $requestUri); // Remueve la ruta base
$requestUri = '/' . trim($requestUri, '/'); // Asegura que siempre comience con '/'

// Debug para verificar las rutas
error_log("Base Path: " . $basePath);
error_log("Request URI: " . $requestUri);



// Si la URI está vacía, redirigir a /login
if ($requestUri === '') {
    $requestUri = '/login';
}

// Debug
error_log("Request URI: " . $requestUri);

switch ($requestUri) {
    case '/login':
        $authController = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->login();
        } else {
            $authController->showLoginForm();
        }
        break;

    case '/register':
        $authController = new AuthController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $authController->register();
        } else {
            $authController->showRegisterForm();
        }
        break;

    /*case '/dashboard2':
        $dashboardController = new DashboardController();
        $dashboardController->showDashboard();
        break;*/
    case '/dashboard2':
        $dashboardController = new DashboardController();

        // Obtiene el parámetro 'view' si está presente
        $view = isset($_GET['view']) ? $_GET['view'] : null;
        $dashboardController->showDashboard($view);
        break;

    case '/logout':
        $authController = new AuthController();
        $authController->logout();
        break;

    case '/addAccommodation':
        $accommodationsController = new AccommodationsController();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $accommodationsController->addAccommodation();
        } else {
            $accommodationsController->showAccommodationForm();
        }
        break;

    case '/addBooking':
        $bookingController = new BookingController();
        $bookingController->addBooking();
        break;

    case '/unsetBooking':
        $bookingController = new BookingController();
        $bookingController->unsetBooking();
        break;
    case '/':
        $homeController = new HomeController();
        $homeController->showHome();
        break;
    default:
        echo "Ruta no encontrada: " . htmlspecialchars($requestUri);
        break;
}
