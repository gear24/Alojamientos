<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
</head>

<body>
    <h1>Dashboard</h1>
    <?php if (isset($user)): ?>
        <h2>Bienvenido, <?php echo htmlspecialchars($user['name']) . " " . htmlspecialchars($user['role']); ?>!</h2>
        <?php
        $userId = $user['id'];
        $bookings = $this->hasbooked($userId);
        $accommodations = $this->getAccommodations();
        ?>

        <ul>
            <?php foreach ($accommodations as $accommodation): ?>
                <?php if ($accommodation['active'] == 0):?>
                    <li>
                        <?php echo htmlspecialchars($accommodation['name']); ?>
                        <form action="/CRUD%20Alojamientos/public/unsetBooking" method="POST" style="display:inline;">
                            <input type="hidden" name="accommodation_id"
                                value="<?php echo htmlspecialchars($accommodation['id']); ?>">
                            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($userId); ?>">
                            <button type="submit">Agregar a Reservas</button>
                        </form>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>

    <?php endif; ?>


    <?php
    $accommodations = $this->availableAccommodations();
    $userId = $_SESSION['user_id']; 
    ?>
    <h3>Lista de alojamientos</h3>
    <ul>
        <?php foreach ($accommodations as $accommodation): ?>
            <?php if ($accommodation['active'] == 1):?>
                <li>
                    <?php echo htmlspecialchars($accommodation['name']); ?>
                    <form action="/CRUD%20Alojamientos/public/addBooking" method="POST" style="display:inline;">
                        <input type="hidden" name="accommodation_id"
                            value="<?php echo htmlspecialchars($accommodation['id']); ?>">
                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($userId); ?>">
                        <button type="submit">Agregar a Reservas</button>
                    </form>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>

    <a href="/CRUD%20Alojamientos/public/logout">Cerrar sesión</a>
    <a href="/CRUD%20Alojamientos/public/addAccommodation">Agregar lugar</a>
</body>

</html>