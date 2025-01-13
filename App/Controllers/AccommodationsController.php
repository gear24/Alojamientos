<?php

/**
 * Controlador de alojamientos
 * 
 */

namespace App\Controllers;

use App\Models\Accommodations;
use App\Models\User;
use Exception;

class AccommodationsController
{
    private $accommodation; #instanciamo la clase Accommodations
    private $userModel; #instanciamos la clase User

    public function __construct() {
        $this->userModel = new User(); #instanciamos la clase User
        $this->accommodation = new Accommodations(); #inicializamos la instancia de Accommodations
    }

    public function showAccommodationForm()#metodo para mostrar el formulario de alojamiento
    {

        if (!isset($_SESSION['user_id'])) {
            error_log("No hay sesión de usuario");
            header('Location: login');
            exit;
        }

        try {
            $user = $this->userModel->findById($_SESSION['user_id']);
            error_log("Datos de usuario: " . print_r($user, true));

            if (!$user) {
                throw new Exception("Usuario no encontrado");
            }

            // Incluir la vista del formulario de alojamiento y pasar los datos necesarios
            require_once '../App/Views/AddAccommodation.php';
        } catch (Exception $e) {
            error_log("Error en showAccommodationForm: " . $e->getMessage());
            echo "Error: " . $e->getMessage();
        }
    }

    public function addAccommodation()#metodo para agregar alojamiento
    {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            error_log("No hay sesión de usuario");
            header('Location: login');
            exit;
        }
        try {

            $user = $this->userModel->findById($_SESSION['user_id']);
            error_log("Datos de usuario: " . print_r($user, true));

            if (!$user) {
                throw new Exception("Usuario no encontrado");
            }

            $name = $_POST['name'] ?? null;
            $description = $_POST['description'] ?? null;
            $price = $_POST['price'] ?? null;
            $capacity = $_POST['capacity'] ?? null;
            $active = $_POST['active'] ?? null;

            if (!$name || !$description || !$price || !$capacity || !$active) {
                throw new Exception("Todos los campos son obligatorios.");
            }
            
            // Usa la instancia de Accommodations desde el constructor
            $this->accommodation->createAccommodation($name, $description, $price, $capacity, $active);
            
            header("Location: dashboard2");
            require_once '../App/Views/AddAccommodation.php';
            exit();


        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function changeStatus()#metodo para cambiar el estado del alojamiento
    {
        session_start(); 
        try {
            
            $id = $_POST['id'] ?? null;
            $status = $_POST['status'] ?? null;

            if (!$id || !$status) {
                throw new Exception("Todos los campos son obligatorios.");
            }

            // Usa la instancia de Accommodations desde el constructor
            $this->accommodation->setStatus($id, $status);

            header("Location: dashboard2");
            exit();

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}