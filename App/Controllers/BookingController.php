<?php

/**
 * BookingController
 * 
 * Controlador para manejar las reservas de alojamientos.
 */
namespace App\Controllers;

use App\Models\Accommodations;
use App\Models\Booking;

class BookingController {
    private $booking; # Instancia de Booking
    private $accommodations; # Instancia de Accommodations

    public function __construct() {
        #Inicializa el modelo de Booking
        $this->booking = new Booking();
        $this->accommodations = new Accommodations();

    }

public function addBooking() { # Método para agregar una reserva
    $userId = $_POST['user_id'];
    $accommodationId = $_POST['accommodation_id'];

    if ($this->booking->addBooking($userId, $accommodationId)) {
        # Cambia el estado del alojamiento a reservado
        if (!$this->accommodations->setStatus($accommodationId, 0)) {
            echo "Error al cambiar el estado del alojamiento.";
        }

        # Redirige al dashboard2
        header("Location: dashboard2");
        exit();
    } else {
        echo "Error al agregar la reserva.";
    }
}

public function unsetBooking() {# Método para eliminar una reserva
    $userId = $_POST['user_id'] ?? null;
    $accommodationId = $_POST['accommodation_id'] ?? null;

    if (!$userId || !$accommodationId) {
        echo "Error: user_id o accommodation_id no proporcionados.";
        return;
    }

    ##Eimina la reserva de la base de datos
    if ($this->booking->deleteBooking($userId, $accommodationId)) {
       # Cambia el estado del alojamiento a disponible
        if ($this->accommodations->setStatus($accommodationId, 1)) {
            header("Location: dashboard2?view=reservations");
            exit();
        } else {
            echo "Error al cambiar el estado del alojamiento.";
        }
    } else {
        echo "Error al eliminar la reserva.";
    }
}

}