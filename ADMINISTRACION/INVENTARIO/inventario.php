<?php
include("../../INCLUDES/CONEXION/database.php");

// ELIMINAR PRODUCTOS
if (isset($_POST['eliminar'])) {

    $ID_PRODUCTO = (int) $_POST['id_producto'];

    $SQL_DELETE = "DELETE FROM products WHERE ID_PRODUCTO = ?";
    $STMT = mysqli_prepare($CONEXION, $SQL_DELETE);

    if ($STMT) {
        mysqli_stmt_bind_param($STMT, "i", $ID_PRODUCTO);

        if (mysqli_stmt_execute($STMT)) {
            mysqli_stmt_close($STMT);
            header("Location: inventario.php?eliminado=1");
            exit;
        } else {
            $ERROR = "Error al eliminar el producto: " . mysqli_stmt_error($STMT);
            mysqli_stmt_close($STMT);
        }
    } else {
        $ERROR = "Error al preparar la eliminación: " . mysqli_error($CONEXION);
    }
}

// AGREGAR PRODUCTOS
if (isset($_POST['enviar'])) {

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

    $SQL_INSERT = "INSERT INTO products
        (NOMBRE, DETALLES, CATEGORIA, CANTIDAD, UNIDAD_MEDIDA,
         STOCK_MINIMO, COSTO_COMPRA, FECHA_INGRESO, FECHA_VENCIMIENTO, ESTADO)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $STMT = mysqli_prepare($CONEXION, $SQL_INSERT);

    if ($STMT) {
        mysqli_stmt_bind_param(
            $STMT,
            "sssisdssss",
            $PRODUCTO,
            $DETALLE,
            $CATEGORIA,
            $CANTIDAD,
            $UNIDAD,
            $STOCK,
            $PRECIO,
            $FECHA_INGRESO,
            $FECHA_VENCIMIENTO,
            $ESTADO
        );

        if (mysqli_stmt_execute($STMT)) {
            mysqli_stmt_close($STMT);
            header("Location: inventario.php?agregado=1");
            exit;
        } else {
            $ERROR = "Error al registrar el producto: " . mysqli_stmt_error($STMT);
            mysqli_stmt_close($STMT);
        }
    } else {
        $ERROR = "Error al preparar el registro: " . mysqli_error($CONEXION);
    }
}

include("../HEADER_ADMIN/header_admin.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArepaMania</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <div class="container-top">
        <h2>INVENTARIO</h2>
        <button type="button" id="abrir-modal" class="button"><b>Agregar</b></button>
    </div>
    <br>

    <?php if (isset($_GET['agregado'])) { ?>
        <p>Producto registrado con éxito.</p>
    <?php } ?>

    <?php if (isset($_GET['eliminado'])) { ?>
        <p>Producto eliminado exitosamente.</p>
    <?php } ?>

    <?php if (isset($_GET['actualizado'])) { ?>
        <p>Producto actualizado correctamente.</p>
    <?php } ?>

    <?php if (isset($ERROR)) { ?>
        <p><?php echo htmlspecialchars($ERROR); ?></p>
    <?php } ?>

    <div class="container-table">
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Detalles</th>
                <th>Categoria</th>
                <th>Cantidad</th>
                <th>Unidad</th>
                <th>Stock minimo</th>
                <th>Precio compra</th>
                <th>Fecha ingreso</th>
                <th>Fecha vencimiento</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>

            <?php
            $SQL_READ = "SELECT * FROM products";
            $RESULTADO = mysqli_query($CONEXION, $SQL_READ);

            if (!$RESULTADO) {
                die("Error al consultar los productos: " . mysqli_error($CONEXION));
            }

            while ($ROW = mysqli_fetch_assoc($RESULTADO)) {
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($ROW['ID_PRODUCTO']); ?></td>
                    <td><?php echo htmlspecialchars($ROW['NOMBRE']); ?></td>
                    <td><?php echo htmlspecialchars($ROW['DETALLES'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($ROW['CATEGORIA']); ?></td>
                    <td><?php echo htmlspecialchars($ROW['CANTIDAD']); ?></td>
                    <td><?php echo htmlspecialchars($ROW['UNIDAD_MEDIDA']); ?></td>
                    <td><?php echo htmlspecialchars($ROW['STOCK_MINIMO']); ?></td>
                    <td><?php echo htmlspecialchars($ROW['COSTO_COMPRA']); ?></td>
                    <td><?php echo htmlspecialchars($ROW['FECHA_INGRESO']); ?></td>
                    <td><?php echo htmlspecialchars($ROW['FECHA_VENCIMIENTO'] ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($ROW['ESTADO']); ?></td>
                    <td>
                        <div class="container-acciones">

                            <!-- BOTÓN EDITAR -->
                            <form action="editar_inventario.php" method="GET">
                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?php echo (int) $ROW['ID_PRODUCTO']; ?>"
                                >
                                <button type="submit" class="button-editar">
                                    <img src="../HEADER_IMAGENES/pencil.png" alt="Editar">
                                </button>
                            </form>

                            <!-- BOTÓN ELIMINAR -->
                            <form method="POST"
                                  onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                                <input
                                    type="hidden"
                                    name="id_producto"
                                    value="<?php echo (int) $ROW['ID_PRODUCTO']; ?>"
                                >
                                <button type="submit" class="button-eliminar" name="eliminar">
                                    <img src="../HEADER_IMAGENES/trash.png" alt="Eliminar">
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</div>

<!-- VENTANA MODAL -->
<div class="modal" id="modal">
    <div class="container-form">
        <form action="inventario.php" method="POST" id="formulario">
            <h2>Ingresa los datos de los productos</h2>

            <input type="text" required name="producto" placeholder="Producto">
            <br>

            <input type="text" name="detalle" placeholder="Detalles">
            <br>

            <div>
                <br>
                <label for="categoria">Selecciona la categoria:</label>

                <select name="categoria" id="categoria" required>
                    <option value="">Selecciona una categoria</option>
                    <option value="carnes y proteinas">carnes y proteinas</option>
                    <option value="lacteos y derivados">lacteos y derivados</option>
                    <option value="harinas y cereales">harinas y cereales</option>
                    <option value="frutas y verduras">frutas y verduras</option>
                    <option value="aceites y grasas">aceites y grasas</option>
                    <option value="salsas y condimentos">salsas y condimentos</option>
                    <option value="bebidas">bebidas</option>
                    <option value="masas y productos preparados">masas y productos preparados</option>
                    <option value="empaques y desechables">empaques y desechables</option>
                    <option value="productos de aseo">productos de aseo</option>
                    <option value="utensilios">utensilios</option>
                </select>
                <br>
            </div>

            <input type="number" name="cantidad" required min="0" step="1"
                   placeholder="Cantidad del producto">
            <br>

            <input type="text" name="unidad" required placeholder="Unidad de medida">
            <br>

            <input type="number" name="stock" required min="0" step="1"
                   placeholder="Stock minimo">
            <br>

            <input type="number" name="precio" min="0" step="0.01"
                   placeholder="Precio de compra" required>
            <br>

            <div class="container-fecha">
                <label for="fecha_ingreso">Fecha de ingreso del producto:</label>
                <input type="date" required name="fecha_ingreso" id="fecha_ingreso"
                       class="input_fecha">
            </div>

            <div class="container-fecha">
                <label for="fecha_vencimiento">Fecha de vencimiento del producto:</label>
                <input type="date" name="fecha_vencimiento" id="fecha_vencimiento"
                       class="input_fecha">
            </div>
            <br>

            <div style="display:flex;">
                <label for="estado">Estado del producto:</label>
                <select name="estado" id="estado" required>
                    <option value="activo">activo</option>
                    <option value="inactivo">inactivo</option>
                    <option value="agotado">agotado</option>
                </select>
            </div>
            <br>

            <button type="submit" class="btn-cancelar" name="enviar">Enviar</button>
            <button type="button" id="cancelar" class="btn-cancelar">Salir</button>
        </form>
    </div>
</div>

<script>
const modal = document.getElementById("modal");
const abrirModal = document.getElementById("abrir-modal");
const cancelar = document.getElementById("cancelar");
const formulario = document.getElementById("formulario");

abrirModal.addEventListener("click", function () {
    modal.classList.add("modal--show");
});

cancelar.addEventListener("click", function () {
    modal.classList.remove("modal--show");
});

modal.addEventListener("click", function (evento) {
    if (evento.target === modal) {
        modal.classList.remove("modal--show");
    }
});

document.addEventListener("keydown", function (evento) {
    if (evento.key === "Escape") {
        modal.classList.remove("modal--show");
    }
});
</script>

</body>
</html>