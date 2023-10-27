<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleVerProductos.css">
    <title>Lista de Productos</title>
</head>
<body>
<section class="buscarProducto">
    <h1>Buscar producto</h1>
    <form method="POST" class="form-buscar">
        <input type="text" name="busqueda" placeholder="EJ: monitor samsung">
        <input type="submit" name="buscar" value="Buscar">
    </form>
</section>

<section class="filtroProductos">
    
    <?php
        $filtroEstado = "todos";
        if (isset($_POST['filtrar'])) {
          $filtroEstado = $_POST['filtroEstado'];
        }
    ?>
    <h3>Filtrar productos por estado:</h3>
    <form method="POST">
        <select name="filtroEstado">
            <option value="todos" <?php echo ($filtroEstado=='todos')?'selected="selected"':''; ?>>Todos</option>
            <option value="activos" <?php echo ($filtroEstado=='activos')?'selected="selected"':''; ?>>Activos</option>
            <option value="inactivos" <?php echo ($filtroEstado=='inactivos')?'selected="selected"':''; ?>>Inactivos</option>
        </select>
        <input type="submit" name="filtrar" value="Filtrar">
    </form>
</section>

    <section class="prodcutosActivos">
<div> 
        <?php
        // Conexión a la base de datos
        include('../../config/config.php');
        
        $conexion = new mysqli($servername, $username, $password, $dbname);

        if ($conexion->connect_error) {
            die("Error de conexión: " . $conexion->connect_error);
        }

        $busqueda = "";
        $filtroEstado = "todos";

        if (isset($_POST['buscar'])) {
            $busqueda = $_POST['busqueda'];
        }

        if (isset($_POST['filtrar'])) {
            $filtroEstado = $_POST['filtroEstado'];
        }

        // Consulta a la base de datos 
        $sql = "SELECT * FROM productos WHERE 1=1"; 

        if ($filtroEstado === "activos") {
            $sql .= " AND activo = 1";
        } elseif ($filtroEstado === "inactivos") {
            $sql .= " AND activo = 0";
        }
        
        if (!empty($busqueda)) {
            $sql .= " AND nombre LIKE '%$busqueda%'";
        }

        $resultado = $conexion->query($sql);
        $totProductos = $resultado->num_rows;
        
        echo '<p class="disponible">Total productos: ' . $totProductos . '</p';
        $conexion->close();

        ?>
    </div>
    <div class="productos">
    <?php
    while ($fila = $resultado->fetch_assoc()) {
        echo '<div class="producto">';
        echo '<img src="' . $fila['imagen'] . '" alt="' . $fila['nombre'] . '">';
        echo '<h3>' . $fila['nombre'] . '</h3>';
        echo '<p><span>Precio: </span> $' . $fila['precio'] . '</p>';
        echo '<p> <span>Stock:</span> ' . $fila['stock'] . '</p>';

        echo '<div class="buttons-container">';
        echo '<form method="post" action="../editarProductos/editarProducto.php">';
        echo '<input type="hidden" name="producto" value="' . $fila['id'] . '">';
        echo '<input type="submit" value="Modificar" class="modificarBtn">';
        echo '</form>';
        
        if ($fila['activo'] == 0) {
            echo "<button class='activate-button' onclick='activarProducto(" . $fila['id'] . ")'>Activar</button>";
        }else if($fila ['activo'] == 1){
            echo "<button class='desactivar-boton' onclick='desactivarProducto(" . $fila['id'] . ")'>Desactivar</button>";
        }
        
        echo '</div>';
        echo '</div>';
        
    }
    echo '<a href="../panelAdmin.php">Regresar al panel</a>';
    ?>
</div>
    </section>
    
    <script src="script.js"></script>
</body>
</html>