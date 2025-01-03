<?php
spl_autoload_register(function ($class) {
    // Convertir el namespace a ruta de archivo
    $base_dir = __DIR__ . '/';
    $file = $base_dir . str_replace('\\', '/', $class) . '.php';
    
    // Si el archivo existe, cárgalo
    if (file_exists($file)) {
        require $file;
    }
});