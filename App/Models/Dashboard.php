<?php

namespace App\Models;

use Config\Database;
use PDO;

class Dashboard
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }


    public function availableAccommodations()
    {
        // Este retorna las disponibles
        $query = "SELECT * FROM accommodations WHERE active = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $results;
        echo ($stmt);
    }
    public function getAccommodations()
    {
        // esta retorna todos los alojamientos
        $query = "SELECT * FROM accommodations";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo ($stmt);
    }
    public function getUserReservations($userId)
    {
        // Retorna las reservas del usuario
        $query = "
            SELECT a.* 
            FROM accommodations a
            JOIN bookings b ON a.id = b.accommodation_id
            WHERE b.user_id = :user_id
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
