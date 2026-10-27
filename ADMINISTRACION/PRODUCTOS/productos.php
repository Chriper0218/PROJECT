<?php
include("../../INCLUDES/CONEXION/database.php");

// ELIMINAR PRODUCTOS
if (isset($_POST['eliminar'])) {

    $ID_PRODUCTO = (int) $_POST['id_producto'];

    $SQL_DELETE = "DELETE FROM menu WHERE ID_PRODUCTO_MENU = ?";
    $STMT = mysqli_prepare($CONEXION, $SQL_DELETE);

    if ($STMT) {
        mysqli_stmt_bind_param($STMT, "i", $ID_PRODUCTO);

        if (mysqli_stmt_execute($STMT)) {
            mysqli_stmt_close($STMT);
            header("Location: menu.php?eliminado=1");
            exit;
        } else {
            $ERROR = "Error al eliminar el producto: " . mysqli_stmt_error($STMT);
            mysqli_stmt_close($STMT);
        }
    } else {
        $ERROR = "Error al preparar la eliminación: " . mysqli_error($CONEXION);
    }
}

// INGRESAR PRODUCTOS
if (isset($_POST['enviar'])) {

    $URL = trim($_POST['url']);
    $NOMBRE = trim($_POST['producto']);
    $PRECIO = $_POST['precio'];

    $SQL_INSERT = "INSERT INTO menu (URL_PRODUCTO, AREPA, PRECIO)
                   VALUES (?, ?, ?)";

    $STMT = mysqli_prepare($CONEXION, $SQL_INSERT);

    if ($STMT) {
        mysqli_stmt_bind_param($STMT, "ssd", $URL, $NOMBRE, $PRECIO);

        if (mysqli_stmt_execute($STMT)) {
            mysqli_stmt_close($STMT);
            header("Location: menu.php?agregado=1");
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
        <h2>PRODUCTOS A OFRECER</h2>
        <button type="button" id="abrir-modal" class="button"><b>Agregar</b></button>
    </div>
    <br>

    <?php if (isset($_GET['agregado'])) { ?>
        <p>Producto registrado con éxito.</p>
    <?php } ?>

    <?php if (isset($_GET['eliminado'])) { ?>
        <p>Producto eliminado exitosamente.</p>
    <?php } ?>

    <?php if (isset($ERROR)) { ?>
        <p><?php echo htmlspecialchars($ERROR); ?></p>
    <?php } ?>

    <!-- TABLA -->
    <div class="container-table">
        <table border="1">
            <tr>
                <th>ID</th>
                <th>URL</th>
                <th>Arepa</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>

            <?php
            $SQL_READ = "SELECT * FROM menu";
            $RESULTADO = mysqli_query($CONEXION, $SQL_READ);

            if (!$RESULTADO) {
                die("Error al consultar los productos: " . mysqli_error($CONEXION));
            }

            while ($ROW = mysqli_fetch_assoc($RESULTADO)) {
            ?>
                <tr>
                    <td><?php echo (int) $ROW['ID_PRODUCTO_MENU']; ?></td>

                    <td><?php echo htmlspecialchars($ROW['URL_PRODUCTO']); ?></td>

                    <td><?php echo htmlspecialchars($ROW['AREPA']); ?></td>

                    <td><?php echo htmlspecialchars($ROW['PRECIO']); ?></td>

                    <td>
                        <div class="container-acciones">

                            <!-- BOTÓN EDITAR -->
                            <form action="editar_productos.php" method="GET">
                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?php echo (int) $ROW['ID_PRODUCTO_MENU']; ?>"
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
                                    value="<?php echo (int) $ROW['ID_PRODUCTO_MENU']; ?>"
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
<!-- FIN TABLA -->

<!-- VENTANA MODAL -->
<div class="modal" id="modal">
    <div class="container-form">
        <form action="menu.php" method="POST" id="formulario">

            <h2>Ingresa los datos del producto a ofrecer</h2>

            <input type="text" placeholder="Ingresa la url" name="url" required>

            <input type="text" placeholder="Ingresa el nombre del producto" name="producto" required>

            <input type="number" placeholder="Ingresa el precio del producto"
                   name="precio" min="0" step="0.01" required>

            <br><br>

            <button type="submit" class="btn-cancelar" name="enviar">Enviar</button>

            <button type="button" id="cancelar" class="btn-cancelar">Salir</button>

        </form>
    </div>
</div>
<!-- FIN VENTANA MODAL -->

<script>
    const modal = document.getElementById("modal");
    const abrirModal = document.getElementById("abrir-modal");
    const cancelar = document.getElementById("cancelar");

    // ABRIR MODAL
    abrirModal.addEventListener("click", function () {
        modal.classList.add("modal--show");
    });

    // CERRAR CON EL BOTÓN SALIR
    cancelar.addEventListener("click", function () {
        modal.classList.remove("modal--show");
    });

    // CERRAR AL HACER CLIC FUERA
    modal.addEventListener("click", function (evento) {
        if (evento.target === modal) {
            modal.classList.remove("modal--show");
        }
    });

    // CERRAR CON ESC
    document.addEventListener("keydown", function (evento) {
        if (evento.key === "Escape") {
            modal.classList.remove("modal--show");
        }
    });
</script>

</body>
</html>