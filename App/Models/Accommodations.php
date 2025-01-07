<?php
/**
 * Accommodations
 * 
 * Modelo para manejar los alojamientos.
 */
namespace App\Models;

use Config\Database;
use PDO;
use Exception;

class Accommodations
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    public function createAccommodation(string $name, string $description, float $price, int $capacity, bool $active) #metodo para agregar alojamiento
    {
        try {
            $query = "INSERT INTO accommodations (name, description, price, capacity, active) VALUES (:name, :description, :price, :capacity, :active)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':price', $price);
            $stmt->bindParam(':capacity', $capacity);
            $stmt->bindParam(':active', $active, PDO::PARAM_BOOL);
            $stmt->execute();
            return $this->conn->lastInsertId();
        } catch (Exception $e) {
            // Manejo de errores
            throw new Exception("Error al crear el alojamiento: " . $e->getMessage());
        }
    }

    public function setStatus(int $id, bool $status)#metodo para cambiar el estado del alojamiento
    {
        try {
            $query = "UPDATE accommodations SET active = :status WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':status', $status, PDO::PARAM_BOOL);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->rowCount() > 0; # Devuelve true si se actualizó al menos una fila
        } catch (Exception $e) {
            // Manejo de errores
            throw new Exception("Error al cambiar el estado del alojamiento: " . $e->getMessage());
        }
    }
}