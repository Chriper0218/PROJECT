<?php
include("../../INCLUDES/CONEXION/database.php");

// OBTENER EL ID DEL PRODUCTO
if (isset($_GET['id'])) {
    $ID_PRODUCTO = (int) $_GET['id'];
} elseif (isset($_POST['id_producto'])) {
    $ID_PRODUCTO = (int) $_POST['id_producto'];
} else {
    die("No se recibió el ID del producto.");
}

// ACTUALIZAR LOS DATOS DEL PRODUCTO
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guardar'])) {

    $URL = trim($_POST['url']);
    $NOMBRE = trim($_POST['producto']);
    $PRECIO = $_POST['precio'];

    $SQL_UPDATE = "UPDATE menu SET URL_PRODUCTO = ?, AREPA = ?, PRECIO = ? WHERE ID_PRODUCTO_MENU = ?";
    $STMT = mysqli_prepare($CONEXION, $SQL_UPDATE);
    if ($STMT) {
        mysqli_stmt_bind_param( $STMT, "ssdi", $URL, $NOMBRE, $PRECIO, $ID_PRODUCTO
        );
        if (mysqli_stmt_execute($STMT)) {
            mysqli_stmt_close($STMT);
            header("Location: editar_productos.php?actualizado=1");
            exit;
        } else {

            $ERROR = "Error al actualizar el producto: " . mysqli_stmt_error($STMT);
            mysqli_stmt_close($STMT);
        }
    } else {
        $ERROR = "Error al preparar la actualización: " . mysqli_error($CONEXION);
    }
}

// CONSULTAR LOS DATOS DEL PRODUCTO
$SQL_READ = "SELECT * FROM menu WHERE ID_PRODUCTO_MENU = ?";
$STMT = mysqli_prepare($CONEXION, $SQL_READ);

if (!$STMT) {
    die("Error al consultar el producto: " . mysqli_error($CONEXION));
}

mysqli_stmt_bind_param($STMT, "i", $ID_PRODUCTO);
mysqli_stmt_execute($STMT);
$RESULTADO = mysqli_stmt_get_result($STMT);
$ROW = mysqli_fetch_assoc($RESULTADO);
mysqli_stmt_close($STMT);
if (!$ROW) {
    die("El producto no existe.");
}
include("../HEADER_ADMIN/header_admin.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Editar producto - ArepaMania</title>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
    * {
        box-sizing: border-box;
    }

    body {
        font-family: 'Montserrat', sans-serif;
        background: #f5f5f5;
        margin: 0;
    }

    .container-form {
        width: 400px;
        max-width: calc(100% - 30px);
        margin: 50px auto;
        padding: 25px;
        background: white;
        border-radius: 10px;
    }

    .container-form h2 {
        text-align: center;
    }

    .container-form label {
        display: block;
        margin-top: 15px;
    }

    .container-form input {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-family: inherit;
    }

    .container-botones {
        display: flex;
        gap: 10px;
        margin-top: 25px;
    }

    .container-botones button {
        flex: 1;
        padding: 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-family: inherit;
    }

    .guardar {
        background: #ddaa01;
    }

    .cancelar {
        background: #ddd;
    }
    </style>
</head>
<body>
<div class="container-form">
    <div class="container-form">
        <h2>Editar producto</h2>
        <?php if (isset($ERROR)) { ?>
            <p><?php echo htmlspecialchars($ERROR); ?></p>
        <?php } ?>
        <form action="editar_menu.php" method="POST">
            <input type="hidden" name="id_producto" value="<?php echo (int) $ROW['ID_PRODUCTO_MENU']; ?>">
            <label for="url">URL del producto:</label>
            <input type="text" id="url" name="url" required placeholder="Ingresa la url" value="<?php echo htmlspecialchars($ROW['URL_PRODUCTO'] ?? ''); ?>">
            <br>
            <label for="producto">Nombre del producto:</label>
            <input type="text" id="producto" name="producto" required placeholder="Ingresa el nombre del producto" value="<?php echo htmlspecialchars($ROW['AREPA'] ?? ''); ?>">
            <br>
            <label for="precio">Precio del producto:</label>
            <input type="text" id="precio" name="precio" required min="0" step="0.01" placeholder="Ingresa el precio del producto" value="<?php echo htmlspecialchars((string) ($ROW['PRECIO'] ?? '')); ?>">
            <div class="container-botones">
                <button type="submit" class="guardar" name="guardar">Guardar cambios</button>

                <a href="menu.php"><button type="button" class="cancelar">Cancelar</button></a>
            </div>
        </form>
    </div>
    
</div>

</body>
</html>