<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Alojamientos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL; ?>/CSS/footer.css" rel="stylesheet">
</head>

<body>
    <div class="content">
        <div class="container py-5">
            <!-- Header a mostrar según la vista -->
            <header class="mb-4">
                <h1 class="text-center">
                    <?php
                    if ($user['role'] === 'admin') {
                        echo 'Todos los Alojamientos';
                    } elseif ($view === 'reservations') {
                        echo 'Mis Reservaciones';
                    } else {
                        echo 'Alojamientos Disponibles';
                    }
                    ?>
                </h1>
            </header>
            <!-- Array de imágenes -->
            <?php
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
            ]; ?>
            <?php if ($view === 'reservations'): ?>
                <div class="row">
                    <?php if (!empty($reservations)): ?>
                        <?php foreach ($reservations as $reservation):
                            if ($reservation['active'] == 0 && !empty($images)):
                                // Seleccionar una imagen aleatoria y eliminarla del array
                                $randomKey = array_rand($images);
                                $randomImage = $images[$randomKey];
                                unset($images[$randomKey]); // Eliminar la imagen seleccionada
                        ?>
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100 shadow-sm">
                                        <img src="<?php echo htmlspecialchars(BASE_URL . $randomImage); ?>"
                                            class="card-img-top" alt="<?php echo htmlspecialchars($accommodation['name']); ?>">
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo htmlspecialchars($reservation['name']); ?></h5>
                                            <p class="card-text"><?php echo htmlspecialchars($reservation['description']); ?></p>
                                            <p class="card-text">Precio: <?php echo htmlspecialchars($reservation['price']); ?> USD</p>
                                            <p class="card-text">Capacidad: <?php echo htmlspecialchars($reservation['capacity']); ?> personas</p>
                                            <form action="unsetBooking" method="POST" class="d-inline">
                                                <input type="hidden" name="accommodation_id" value="<?php echo htmlspecialchars($reservation['id']); ?>">
                                                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['id']); ?>">
                                                <button type="submit" class="btn ms-0 btn-danger">Retirar reservación</button>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center text-muted">No tienes reservas en este momento, si deseas realizar una reservación, <a class="link-danger link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover" href="dashboard2">haz click aquí para ver los Alojamientos Disponibles</a>.</p>
                    <?php endif; ?>
                </div>
            <?php else: ?>

                <?php
                // Obtener las accommodations
                $accommodations = $this->getAccommodations();

                // Ordenar las accommodations: activos primero
                usort($accommodations, function ($a, $b) {
                    // Los activos (active = 1) se posicionan antes que los inactivos (active = 0)
                    return $b['active'] <=> $a['active'];
                });
                ?>

                <div class="row">
                    <?php if (!empty($accommodations)): ?>
                        <?php
                        $hasActiveAccommodations = false; // Verificar si hay alojamientos activos
                        foreach ($accommodations as $accommodation):
                            // Si el usuario es admin, mostrar todos los alojamientos, si es user, solo los activos
                            if ($user['role'] === 'admin' || $accommodation['active'] == 1):
                                if (!empty($images)):
                                    // Seleccionar una imagen aleatoria
                                    $randomKey = array_rand($images);
                                    $randomImage = $images[$randomKey];
                                    unset($images[$randomKey]);
                        ?>
                                    <div class="col-md-4 mb-4">
                                        <div class="card h-100 shadow-sm">
                                            <img src="<?php echo htmlspecialchars(BASE_URL . $randomImage); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($accommodation['name']); ?>">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo htmlspecialchars($accommodation['name']); ?></h5>
                                                <p class="card-text"><?php echo htmlspecialchars($accommodation['description']); ?></p>
                                                <p class="card-text"><strong>Precio:</strong> <?php echo htmlspecialchars($accommodation['price']); ?> USD</p>
                                                <p class="card-text"><strong>Capacidad:</strong> <?php echo htmlspecialchars($accommodation['capacity']); ?> personas</p>
                                                <?php if ($user['role'] === 'admin'): ?>
                                                    <?php if ($accommodation['active'] == 1): ?>
                                                        <p class="text-success"><strong>Disponible</strong></p>
                                                    <?php else: ?>
                                                        <p class="text-danger"><strong>Reservado</strong></p>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <?php if ($user['role'] !== 'admin'): ?>
                                                    <form action="addBooking" method="POST" class="d-inline ml">
                                                        <input type="hidden" name="accommodation_id" value="<?php echo htmlspecialchars($accommodation['id']); ?>">
                                                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['id']); ?>">
                                                        <button type="submit" class="btn ms-0 btn-success">Reservar</button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                        <?php
                                endif;
                                if ($accommodation['active'] == 1) {
                                    $hasActiveAccommodations = true; // Al menos uno activo
                                }
                            endif;
                        endforeach; ?>
                        <?php if (!$hasActiveAccommodations && $user['role'] !== 'admin'): ?>
                            <p class="text-center text-muted">No hay alojamientos disponibles en este momento.</p>
                        <?php endif; ?>
                    <?php else: ?>
                        <p class="text-center text-muted">No hay alojamientos disponibles en este momento.</p>
                    <?php endif; ?>
                </div>

            <?php endif; ?>
        </div>
    </div>
    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-4">
        <p class="mb-0">© <?php echo date('Y'); ?> Papas Alojamientos. Todos los derechos reservados.</p>
    </footer>
</body>

</html>