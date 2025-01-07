<?php

namespace App\Models;

use Config\Database;
use PDO;

class User
{
    private $conn;

    public function __construct()
    {
        $this->conn = Database::getConnection();
    }

    public function create($name, $email, $password, $role = 'user')
    {
        $query = "INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':password' => $password,
            ':role' => $role,
        ]);
    }

    public function findByEmail($email)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function isAdmin($userId)
    {
        $query = "SELECT role FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user['role'] === 'admin';
    }

    public function hasbooked($id)
    {
        $query = "
            SELECT b.id AS booking_id, a.name AS accommodation_name 
            FROM bookings b
            JOIN accommodations a ON b.accommodation_id = a.id
            WHERE b.user_id = :id
        ";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
