<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registro de Movimiento de Inventario</title>
</head>
<body>
    <main>
        <h1>Cargar movimiento</h1>
    <form action="procesarRegistro.php" method="POST" class="form-container">
            <label for="id_producto">Producto:</label>
            <select name="id_producto" id="id_producto" class="select-box">
        <?php
            // Conexión a la base de datos
            include('../../config/config.php');

            $conexion = new mysqli($servername, $username, $password, $dbname);

            if ($conexion->connect_error) {
                die("Error de conexión: " . $conexion->connect_error);
            }

            // Consulta SQL para obtener los productos activos
            $sql = "SELECT id, nombre FROM productos WHERE activo = 1 ORDER BY nombre ASC";
            $resultado = $conexion->query($sql);

            if ($resultado->num_rows > 0) {
                while ($fila = $resultado->fetch_assoc()) {
                    echo "<option value='" . $fila['id'] . "'>" . $fila['nombre'] . "</option>";
                }
            } else {
                echo "<option value='0'>No hay productos disponibles</option>";
            }

            $conexion->close();
            ?>
        </select>

        <section class="formSection">
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" id="fecha" value="<?php echo date('Y-m-d'); ?>" required>


            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad" id="cantidad" required>

            <label for="operacion">Operación:</label>
            <select name="operacion" id="operacion">
                <option value="aumentar">Aumentar</option>
                <option value="disminuir">Disminuir</option>
            </select>

            <label for="descripcion">Descripción:</label>
            <input type="text" name="descripcion" id="descripcion" required>

            <input type="submit" value="Cargar movimiento" class="submit-button">
            <a href="../panelAdmin.php">Regresar al panel</a>
        </section>
    </form>
</main>
</body>
</html>
