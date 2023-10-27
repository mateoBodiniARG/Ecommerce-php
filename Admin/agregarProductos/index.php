<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Agregar producto</title>
    <link rel="stylesheet" href="styleAddProductos.css" />
  </head>
  <body>
    <header>
      <h1>Agregar Producto</h1>
    </header>
    <main>
      <form method="post" action="agregarProd.php">
        <div>
          <label for="nombre">Nombre:</label>
          <input type="text" name="nombre" id="nombre" required />
        </div>

        <div>
          <label for="precio">Precio:</label>
          <input type="number" name="precio" id="precio" required />
        </div>

        <div>
          <label for="imagen">URL de la Imagen:</label>
          <input type="text" name="imagen"  required />
        </div>

        <div>
          <label for="stock">Stock</label>
          <input type="number" name="stock" id="stock" required />
        </div>

        <div>
          <?php
          // Realiza la conexión a la base de datos
          include('../../config/config.php');
          $conexion = new mysqli($servername, $username, $password, $dbname);

          // Verifica la conexión
          if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
          }

          // Consulta SQL para obtener todas las marcas
          $consultaMarcas = "SELECT * FROM marcas";
          $resultadoMarcas = $conexion->query($consultaMarcas);
          echo '<label for="Marca">Marca:</label>';
          echo '<select name="Marca">';
          while ($marca = $resultadoMarcas->fetch_assoc()) {
              $selected = ($marca['id'] == $fila['id']) ? 'selected' : '';
              echo "<option value='{$marca['id']}' $selected>{$marca['nombre']}</option>";
          }
          echo '</select>';
          ?>
        </div>

        <div>
          <input type="submit" value="Agregar Producto" />
        </div>
        
        <div class="returnBtn">
          <a href="../panelAdmin.php" class="regresarAdmin">Regresar</a>
        </div>
      </form>
    </main>
  </body>
</html>
