<?php

/**
 * Formulario para agregar un alojamiento
 * @category Views
 * @package  App_Views_AddAccommodation
 */
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Alojamiento</title>
    <link href="<?php echo BASE_URL; ?>/CSS/footer.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="content">
        <?php include BASE_PATH . '/App/Views/layouts/navbar.php'; ?>
        <div class="container d-flex justify-content-center py-5">
            <div class="col-12 col-md-6">
                <h1 class="text-center">
                    <?php
                    if (isset($user) && ($user['role'] === 'admin')) {
                        echo 'Todos los Alojamientos';
                    }
                    ?>
                </h1>
                <h2 class="text-center mb-4 text-dark">Agregar Alojamiento</h2>
                <!-- Formulario para agregar alojamiento -->
                <form action="addAccommodation" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre del alojamiento:</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Precio:</label>
                        <input type="number" id="price" name="price" class="form-control" placeholder="Precio" required step="0.01">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción:</label>
                        <textarea id="description" name="description" class="form-control" placeholder="Descripción" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="capacity" class="form-label">Capacidad:</label>
                        <input type="number" id="capacity" name="capacity" class="form-control" placeholder="Capacidad" required>
                    </div>
                    <div class="mb-3">
                        <label for="active" class="form-label">
                            Estado: <span class="text-muted">(por defecto siempre será Activo)</span>
                        </label>
                        <select id="active" name="active" class="form-control" required>
                            <option value="1">Activo</option>
                        </select>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Agregar Alojamiento</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <footer class="bg-dark text-white text-center py-4">
        <p class="mb-0">© <?php echo date('Y'); ?> Papas Alojamientos. Todos los derechos reservados.</p>
    </footer>
</body>

</html>