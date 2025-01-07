<?php
namespace App\Controllers;

use App\Models\Accommodations;
use App\Models\Booking;

class BookingController {
    private $booking;
    private $accommodations;

    public function __construct() {
        // Inicializa el modelo de Booking
        $this->booking = new Booking();
        $this->accommodations = new Accommodations();

    }

public function addBooking() {
    $userId = $_POST['user_id'];
    $accommodationId = $_POST['accommodation_id'];

    if ($this->booking->addBooking($userId, $accommodationId)) {
        // Cambiar el estado del alojamiento a inactivo
        if (!$this->accommodations->setStatus($accommodationId, 0)) {
            echo "Error al cambiar el estado del alojamiento.";
        }

        // Redirigir a una página de éxito o al dashboard
        header("Location: /CRUD%20Alojamientos/public/dashboard");
        exit();
    } else {
        echo "Error al agregar la reserva.";
    }
}

public function unsetBooking() {
    $userId = $_POST['user_id'] ?? null;
    $accommodationId = $_POST['accommodation_id'] ?? null;

    if (!$userId || !$accommodationId) {
        echo "Error: user_id o accommodation_id no proporcionados.";
        return;
    }

    // Elimina la reserva de la base de datos
    if ($this->booking->removeBookingByUserAndAccommodation($userId, $accommodationId)) {
        // Cambia el estado del alojamiento a activo
        if ($this->accommodations->setStatus($accommodationId, 1)) {
            header("Location: /CRUD%20Alojamientos/public/dashboard");
            exit();
        } else {
            echo "Error al cambiar el estado del alojamiento.";
        }
    } else {
        echo "Error al eliminar la reserva.";
    }
}

}