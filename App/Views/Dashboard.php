<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>
    <?php if (isset($user)): ?>
        <h2>Bienvenido, <?php echo htmlspecialchars($user['name']); ?>!</h2>
    <?php endif; ?>
    
    <!-- solo pa testing purposes, delete leiter -->
    
    <a href="/CRUD%20Alojamientos/public/logout">Cerrar sesión</a>
</body>
</html>