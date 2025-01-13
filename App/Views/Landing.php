<?php if (!isset($accommodations)) $accommodations = []; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing</title>
    <link href="<?php echo BASE_URL; ?>/CSS/footer.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="content">
        <!-- Header -->
        <section class="bg-primary text-white text-center py-5">
            <div class="container">
                <h1 class="display-4">Bienvenidos a Papas Alojamientos</h1>
                <p class="lead">En Papas encuentras el alojamiento ideal para tus vacaciones o escapadas.</p>
                <p class="lead">Para poder hacer una reservación:</p>
                <a href="login" class="btn btn-light btn-lg mt-3">Inicia Sesión</a>
                <a href="register" class="btn btn-light btn-lg mt-3">Regístrate</a>
            </div>
        </section>

        <!-- Lista de Alojamientos -->
        <section class="py-5">
            <div class="container">
                <h3 class="mb-4 text-center">Alojamientos Disponibles</h3>
                <div class="row">

                    <?php
                    // Array de imágenes locales (usando rutas relativas al servidor)
                    $images = [
                        '/IMG/alojamientos/img1.jpg',
                        '/IMG/alojamientos/img2.jpg',
                        '/IMG/alojamientos/img3.jpg',
                        '/IMG/alojamientos/img4.jpg',
                        '/IMG/alojamientos/img5.jpg',
                        '/IMG/alojamientos/img6.jpg',
                        '/IMG/alojamientos/img7.jpg',
                        '/IMG/alojamientos/img8.jpg',
                        '/IMG/alojamientos/img9.jpg',
                        '/IMG/alojamientos/img10.jpg',
                        '/IMG/alojamientos/img11.jpg',
                        '/IMG/alojamientos/img12.jpg',
                        '/IMG/alojamientos/img13.jpg',
                        '/IMG/alojamientos/img14.jpg',
                        '/IMG/alojamientos/img15.jpg',
                        '/IMG/alojamientos/img16.jpg'
                    ];

                    $hasActiveAccommodations = false; // verificar si hay alojamientos activos

                    foreach ($accommodations as $accommodation):
                        if ($accommodation['active'] == 1 && !empty($images)):
                            $hasActiveAccommodations = true; // Al menos un alojamiento activo
                            // Seleccionar una imagen aleatoria y eliminarla del array
                            $randomKey = array_rand($images);
                            $randomImage = $images[$randomKey];
                            unset($images[$randomKey]); // Eliminar la imagen seleccionada
                    ?>
                            <div class="col-md-4 mb-4">
                                <div class="card h-100 shadow-sm">
                                    <img src="<?php echo htmlspecialchars(BASE_URL . $randomImage); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($accommodation['name']); ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($accommodation['name']); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($accommodation['description']); ?></p>
                                        <p class="card-text">
                                            <strong>Precio:</strong> <?php echo htmlspecialchars($accommodation['price']); ?> USD
                                        </p>
                                        <p class="card-text">
                                            <strong>Capacidad:</strong> <?php echo htmlspecialchars($accommodation['capacity']); ?> personas
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php
                        endif;
                    endforeach;

                    // Si no se encontraron alojamientos activos
                    if (!$hasActiveAccommodations): ?>
                        <p class="text-center text-muted">No hay alojamientos disponibles en este momento.</p>
                    <?php endif; ?>

                </div>
            </div>
        </section>
    </div>
    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <p class="mb-0">© <?php echo date('Y'); ?> Papas Alojamientos. Todos los derechos reservados.</p>
    </footer>
</body>

</html>