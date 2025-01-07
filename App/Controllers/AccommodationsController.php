<?php

namespace App\Controllers;

use App\Models\Accommodations;
use App\Models\User; // Si necesitas User en algún momento
use Exception;

class AccommodationsController
{
    private $accommodation; // Propiedad para almacenar la instancia de Accommodations

    public function __construct() {
        $this->accommodation = new Accommodations(); // Inicializa la instancia de Accommodations
    }

    public function showAccommodationForm()
    {
        require_once '../app/Views/addAccommodation.php';
    }

    public function addAccommodation()
    {
        try {
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

            header("Location: /CRUD%20Alojamientos/public/dashboard");
            exit();

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function changeStatus()
    {
        try {
            session_start(); 
            
            $id = $_POST['id'] ?? null;
            $status = $_POST['status'] ?? null;

            if (!$id || !$status) {
                throw new Exception("Todos los campos son obligatorios.");
            }

            // Usa la instancia de Accommodations desde el constructor
            $this->accommodation->setStatus($id, $status);

            header("Location: /CRUD%20Alojamientos/public/dashboard");
            exit();

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}