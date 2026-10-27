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
    $PRODUCTO = trim($_POST['producto']);
    $DETALLE = trim($_POST['detalle']);
    $CATEGORIA = $_POST['categoria'];
    $CANTIDAD = (int) $_POST['cantidad'];
    $UNIDAD = trim($_POST['unidad']);
    $STOCK = (int) $_POST['stock'];
    $PRECIO = $_POST['precio'];
    $FECHA_INGRESO = $_POST['fecha_ingreso'];
    $FECHA_VENCIMIENTO = !empty($_POST['fecha_vencimiento'])
        ? $_POST['fecha_vencimiento']
        : null;
    $ESTADO = $_POST['estado'];

    $SQL_UPDATE = "UPDATE products SET NOMBRE = ?, DETALLES = ?, CATEGORIA = ?, CANTIDAD = ?, UNIDAD_MEDIDA = ?, 
    STOCK_MINIMO = ?, COSTO_COMPRA = ?, FECHA_INGRESO = ?, FECHA_VENCIMIENTO = ?, ESTADO = ? WHERE ID_PRODUCTO = ?";

    $STMT = mysqli_prepare($CONEXION, $SQL_UPDATE);
    if ($STMT) {
        mysqli_stmt_bind_param( $STMT, "sssisdssssi", $PRODUCTO, $DETALLE, $CATEGORIA, $CANTIDAD, $UNIDAD, $STOCK, $PRECIO, $FECHA_INGRESO, $FECHA_VENCIMIENTO, $ESTADO, $ID_PRODUCTO);

        if (mysqli_stmt_execute($STMT)) {
            mysqli_stmt_close($STMT);

            header("Location: inventario.php?actualizado=1");
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
$SQL_READ = "SELECT * FROM products WHERE ID_PRODUCTO = ?";
$STMT = mysqli_prepare($CONEXION, $SQL_READ);

if (!$STMT) {
    die("Error al consultar el producto: " . mysqli_error($CONEXION));}

mysqli_stmt_bind_param($STMT, "i", $ID_PRODUCTO);
mysqli_stmt_execute($STMT);
$RESULTADO = mysqli_stmt_get_result($STMT);
$ROW = mysqli_fetch_assoc($RESULTADO);
mysqli_stmt_close($STMT);
if (!$ROW) {
    die("El producto no existe.");}
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
        box-sizing: border-box;}

    body {
        font-family: 'Montserrat', sans-serif;
        background: #f5f5f5;
        margin: 0;}

    .container-form {
        width: 400px;
        max-width: calc(100% - 30px);
        margin: 50px auto;
        padding: 25px;
        background: white;
        border-radius: 10px;}

    .container-form h2 {
        text-align: center;}

    .container-form label {
        display: block;
        margin-top: 15px;}

    .container-form input,
    .container-form select {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-family: inherit;}

    .container-botones {
        display: flex;
        gap: 10px;
        margin-top: 25px;}

    .container-botones button {
        flex: 1;
        padding: 12px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-family: inherit;}

    .guardar {
        background: #ddaa01;}

    .cancelar {
        background: #ddd;}

    </style>
</head>
<body>

<div class="container-form">
    <div class="container-form">
        <h2>Editar producto</h2>
        <?php if (isset($ERROR)) { ?>
            <p><?php echo htmlspecialchars($ERROR); ?></p>
        <?php } ?>
        <form action="editar_inventario.php" method="POST">
            <input type="hidden" name="id_producto" value="<?php echo (int) $ROW['ID_PRODUCTO']; ?>">
            <input type="text" required name="producto" placeholder="Producto" value="<?php echo htmlspecialchars($ROW['NOMBRE'] ?? ''); ?>">
            <br>

            <input type="text" name="detalle" placeholder="Detalles" value="<?php echo htmlspecialchars($ROW['DETALLES'] ?? ''); ?>">
            <br>

            <div>
                <br>
                <label for="categoria">Selecciona la categoria:</label>
                <select name="categoria" id="categoria" required>
                    <option value="">Selecciona una categoria</option>
                    <?php
                    $CATEGORIAS = [ "carnes y proteinas", "lacteos y derivados", "harinas y cereales", "frutas y verduras", "aceites y grasas", 
                    "salsas y condimentos", "bebidas", "masas y productos preparados", "empaques y desechables", "productos de aseo", "utensilios"];

                    foreach ($CATEGORIAS as $CATEGORIA) {
                        $SELECCIONADA = (
                            $ROW['CATEGORIA'] === $CATEGORIA) ? 'selected' : '';echo '<option value="' . htmlspecialchars($CATEGORIA) . '" ' . $SELECCIONADA . '>' . htmlspecialchars($CATEGORIA) . '</option>';}?>
                </select>
                <br>
            </div>
            <input type="number" name="cantidad" required min="0" step="1" placeholder="Cantidad del producto" value="<?php echo htmlspecialchars($ROW['CANTIDAD'] ?? ''); ?>">
            <br>
            <input type="text" name="unidad" required placeholder="Unidad de medida" value="<?php echo htmlspecialchars($ROW['UNIDAD_MEDIDA'] ?? ''); ?>">
            <br>
            <input type="number" name="stock" required min="0" step="1" placeholder="Stock minimo" value="<?php echo htmlspecialchars($ROW['STOCK_MINIMO'] ?? ''); ?>">
            <br>
            <input type="text" name="precio" required min="0" step="0.01" placeholder="Precio de compra" value="<?php echo htmlspecialchars($ROW['COSTO_COMPRA'] ?? ''); ?>">
            <br>
            <div class="container-fecha">
                <label for="fecha_ingreso">Fecha de ingreso del producto:</label>
                <input type="date" required name="fecha_ingreso" id="fecha_ingreso" class="input_fecha" value="<?php echo htmlspecialchars($ROW['FECHA_INGRESO'] ?? ''); ?>">
            </div>
            <div class="container-fecha">
                <label for="fecha_vencimiento">Fecha de vencimiento del producto:</label>
                <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="input_fecha" value="<?php echo htmlspecialchars($ROW['FECHA_VENCIMIENTO'] ?? ''); ?>">
            </div>

            <br>
            <div style="display:flex;">
                <label for="estado">Estado del producto:</label>
                <select name="estado" id="estado" required>
                    <?php
                    $ESTADOS = ["activo", "inactivo", "agotado"];
                    foreach ($ESTADOS as $ESTADO_OPCION) {
                        $SELECCIONADA = (
                            $ROW['ESTADO'] === $ESTADO_OPCION
                        ) ? 'selected' : '';
                        echo '<option value="' . htmlspecialchars($ESTADO_OPCION) . '" ' . $SELECCIONADA . '>' . htmlspecialchars($ESTADO_OPCION) . '</option>';}
                    ?>
                </select>
            </div>
            <br>

            <div class="container-botones">
                <button type="submit" class="guardar" name="guardar">Guardar cambios</button>
                <a href="inventario.php"><button type="button" class="cancelar">Cancelar</button></a>
            </div>
        </form>
        
    </div>
</div>

</body>
</html>