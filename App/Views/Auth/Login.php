<?php
/*
    Vista de login
*/
?>
<?php
/*
    Vista de login con Bootstrap
*/
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link href="<?php echo BASE_URL; ?>/CSS/footer.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="content">
        <?php include BASE_PATH . '/App/Views/layouts/navbar.php'; ?>
        <!-- Header -->
        <section class="bg-primary text-white text-center py-4">
            <div class="container">
                <h1 class="display-4">Bienvenido a Papas Alojamientos</h1>
                <p class="lead">Estas a un solo click de una reservación</p>
            </div>
        </section>
        <!-- Contenedor del formulario -->
        <div class="container d-flex justify-content-center align-items-center" style="min-height: 70vh; margin-top: -5rem;">
            <div class="card shadow-sm p-4" style="width: 100%; max-width: 400px;">
                <h2 class="text-center mb-4">Iniciar Sesión</h2>
                <form action="login" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Correo" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
                </form>
                <div class="text-center mt-3">
                    <small>¿No tienes una cuenta? <a href="register""7>Regístrate aquí</a></small>
                </div>
            </div>
        </div>
    </div>
    <footer class=" bg-dark text-white text-center py-4">
        <p class="mb-0">© <?php echo date('Y'); ?> Papas Alojamientos. Todos los derechos reservados.</p>
    </footer>
</body>

</html>