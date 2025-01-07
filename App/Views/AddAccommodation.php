<form action="/CRUD%20Alojamientos/public/addAccommodation" method="POST">
    <h2>Agregar Alojamiento</h2>
    
    <label for="name">Nombre:</label>
    <input type="text" id="name" name="name" placeholder="Nombre" required>
    
    <label for="description">Descripción:</label>
    <textarea id="description" name="description" placeholder="Descripción" required></textarea>
    
    <label for="price">Precio:</label>
    <input type="number" id="price" name="price" placeholder="Precio" required step="0.01">
    
    <label for="capacity">Capacidad:</label>
    <input type="number" id="capacity" name="capacity" placeholder="Capacidad" required min="1">
    
    <label for="active">Estado:</label>
    <select id="active" name="active" required>
        <option value="1">Activo</option>
        <option value="0">Inactivo</option>
    </select>

    <button type="submit">Agregar Alojamiento</button>
</form>