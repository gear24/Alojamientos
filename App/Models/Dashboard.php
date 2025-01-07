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
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAccommodations() {
        // esta retorna todos los alojamientos
        $query = "SELECT * FROM accommodations";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }


}
