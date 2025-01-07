<?php
/**
 * Modelo de la tabla bookings
 * CRUD para la tabla bookings
 */
namespace App\Models;

use Config\Database;
use Exception;

class Booking {
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    public function addBooking(int $userId, int $accommodationId)# Agregar una reserva
    {
        try {
            $query = "INSERT INTO bookings (user_id, accommodation_id) VALUES (:user_id, :accommodation_id)";
            $stmt = $this->conn->prepare($query);
            $stmt->execute([
                ':user_id' => $userId,
                ':accommodation_id' => $accommodationId
            ]);
            return $stmt->rowCount() > 0; // Retorna true si la inserción fue exitosa
        } catch (Exception $e) {
            // Manejo de errores
            throw new Exception("Error al agregar la reserva: " . $e->getMessage());
        }
    }

    public function deleteBooking(int $userId, int $accommodationId) # Eliminar una reserva
     {
        try {
            #Prepara la consulta SQL para eliminar la reserva
            $query = "DELETE FROM bookings WHERE user_id = :user_id AND accommodation_id = :accommodation_id";
            $stmt = $this->conn->prepare($query);
            
            #Ejecuta la consulta con los parámetros proporcionados
            $stmt->execute([
                ':user_id' => $userId,
                ':accommodation_id' => $accommodationId
            ]);
            
            # Retorna true si la eliminación fue exitosa
            return $stmt->rowCount() > 0;
        } catch (Exception $e) {
            // Manejo de errores
            throw new Exception("Error al eliminar la reserva: " . $e->getMessage());
        }
    }
}