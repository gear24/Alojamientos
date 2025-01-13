<?php
/**
 * Controlador de autenticación
 */

namespace App\Controllers;

use App\Models\User;
use Exception;

class AuthController
{
    private $user; # Instancia de User

    public function __construct() {
        $this->user = new User(); # Instancia de User desde el constructor
    }

    public function showRegisterForm() { # Método para mostrar el formulario de registro
        require_once '../app/Views/auth/Register.php';
    }

    public function register() { # Método para registrar un usuario
        try {
            session_start(); 
            
            $name = $_POST['name'] ?? null;
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;
    
            if (!$name || !$email || !$password) {
                throw new Exception("Todos los campos son obligatorios.");
            }
    
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    
            #Usa la instancia de User desde el constructor
            $this->user->create($name, $email, $hashedPassword);
    
            $foundUser = $this->user->findByEmail($email); 
            if (!$foundUser) {
                throw new Exception("Error al encontrar el usuario después de crear.");
            }
                
            $_SESSION['user_id'] = $foundUser['id'];
            $_SESSION['user_name'] = $foundUser['name'];
    
            header("Location: dashboard2");
            exit();
    
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function showLoginForm() { # Método para mostrar el formulario de inicio de sesión
        require_once '../app/Views/auth/Login.php';
    }

    public function login() { # Método para iniciar sesión
        try {
            error_log("Método login iniciado");
            
            $email = $_POST['email'] ?? null;
            $password = $_POST['password'] ?? null;
    
            error_log("Email recibido: " . $email); // Debug
    
            if (!$email || !$password) {
                throw new Exception("Todos los campos son obligatorios.");
            }
    
            #Usa la instancia de User desde el constructor
            $foundUser = $this->user->findByEmail($email);
            
            error_log("Usuario encontrado: " . print_r($foundUser, true));
    
            if (!$foundUser || !password_verify($password, $foundUser['password'])) {
                throw new Exception("Credenciales incorrectas.");
            }
    
            $_SESSION['user_id'] = $foundUser['id'];
            $_SESSION['user_name'] = $foundUser['name'];
            
            error_log("Sesión iniciada para usuario ID: " . $_SESSION['user_id']);
            
            header("Location: dashboard2");
            exit();
    
        } catch (Exception $e) {
            error_log("Error en login: " . $e->getMessage());
            echo "Error: " . $e->getMessage();
        }
    }

    public function logout() {# Método para cerrar sesión
        session_start();
        session_destroy();
        echo "Sesión cerrada.";
        header("Location: /queso/public");
        #header("Location: /login");
        exit();
    }
}