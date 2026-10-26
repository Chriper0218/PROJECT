<?php
// INICIAR SESIÓN //
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// CONECTAR A LA BASE DE DATOS //
include("../../INCLUDES/CONEXION/database.php");

// CREAR EL CARRITO SI NO EXISTE //
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// AGREGAR PRODUCTOS //
if (isset($_POST['agregar'])) {
    $ID_PRODUCTO = (int) $_POST['id_producto'];
    if ($ID_PRODUCTO > 0) {
        $SQL = "SELECT * FROM menu WHERE ID_PRODUCTO_MENU = ?";
        $STMT = mysqli_prepare($CONEXION, $SQL);
        mysqli_stmt_bind_param($STMT, "i", $ID_PRODUCTO);
        mysqli_stmt_execute($STMT);
        $RESULTADO = mysqli_stmt_get_result($STMT);
        if ($ROW = mysqli_fetch_assoc($RESULTADO)) {
            $PRECIO_ORIGINAL = $ROW['PRECIO'];
            // CONVERTIR EL PRECIO A NÚMERO //
            if (is_numeric($PRECIO_ORIGINAL)) {
                $PRECIO = (float) $PRECIO_ORIGINAL;
            } else {
                $PRECIO = (float) preg_replace(
                    '/\D/',
                    '',
                    $PRECIO_ORIGINAL
                );
            }

            // SI YA EXISTE, AUMENTAR LA CANTIDAD //
            if (isset($_SESSION['carrito'][$ID_PRODUCTO])) {
                $_SESSION['carrito'][$ID_PRODUCTO]['cantidad']++;
            } else {
                // AGREGAR NUEVO PRODUCTO //
                $_SESSION['carrito'][$ID_PRODUCTO] = [
                    'id' => $ID_PRODUCTO,
                    'nombre' => $ROW['AREPA'],
                    'imagen' => $ROW['URL_PRODUCTO'],
                    'precio' => $PRECIO,
                    'cantidad' => 1
                ];
            }
        }

        mysqli_stmt_close($STMT);}
    header("Location: pedidos.php");
    exit();
}


// AUMENTAR CANTIDAD //
if (isset($_POST['aumentar'])) {
    $ID_PRODUCTO = (int) $_POST['id_producto'];
    if (isset($_SESSION['carrito'][$ID_PRODUCTO])) {
        $_SESSION['carrito'][$ID_PRODUCTO]['cantidad']++;
    }
    header("Location: pedidos.php");
    exit();
}


// DISMINUIR CANTIDAD //
if (isset($_POST['disminuir'])) {
    $ID_PRODUCTO = (int) $_POST['id_producto'];
    if (isset($_SESSION['carrito'][$ID_PRODUCTO])) {
        $_SESSION['carrito'][$ID_PRODUCTO]['cantidad']--;
        if ($_SESSION['carrito'][$ID_PRODUCTO]['cantidad'] <= 0) {
            unset($_SESSION['carrito'][$ID_PRODUCTO]);
        }
    }
    header("Location: pedidos.php");
    exit();
}

// ELIMINAR PRODUCTO //
if (isset($_POST['eliminar'])) {
    $ID_PRODUCTO = (int) $_POST['id_producto'];
    unset($_SESSION['carrito'][$ID_PRODUCTO]);
    header("Location: pedidos.php");
    exit();
}


// CALCULAR SUBTOTAL //
$SUBTOTAL = 0;
foreach ($_SESSION['carrito'] as $PRODUCTO) {
    $SUBTOTAL += $PRODUCTO['precio'] * $PRODUCTO['cantidad'];
}

// COSTO DEL DOMICILIO //
$DOMICILIO = empty($_SESSION['carrito']) ? 0 : 5000;

// TOTAL //
$TOTAL = $SUBTOTAL + $DOMICILIO;

// INCLUIR ENCABEZADO //
include("../../INCLUDES/HEADER/header.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ArepaMania</title>
<link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<!-- PEDIDOS -->
<div class="container-dad">
    <h1>TU PEDIDO</h1>
    <br>
    <div class="container-pedidos">
        <div class="container-productos">
            <?php if (!empty($_SESSION['carrito'])): ?>
                <?php foreach ($_SESSION['carrito'] as $PRODUCTO): ?>
                    <div class="container-img-p">
                        <img src="<?php echo htmlspecialchars($PRODUCTO['imagen']); ?>" alt="<?php echo htmlspecialchars($PRODUCTO['nombre']); ?>">
                        <p><b><?php echo htmlspecialchars($PRODUCTO['nombre']); ?></b>
                        <br><br>
                        <?php echo '$' . number_format($PRODUCTO['precio'], 0, ',', '.'); ?>
                        </p>
                    </div>

                    <table>
                        <tr>
                            <th>
                                <form method="POST">
                                    <input type="hidden" name="id_producto" value="<?php echo $PRODUCTO['id']; ?>">
                                    <button type="submit" name="disminuir">-</button>
                                </form>
                            </th>

                            <th>
                                <button type="button" id="button-none"><?php echo $PRODUCTO['cantidad']; ?></button>
                            </th>

                            <th>
                                <form method="POST">
                                    <input type="hidden" name="id_producto" value="<?php echo $PRODUCTO['id']; ?>">
                                    <button type="submit" name="aumentar">+</button>
                                </form>
                            </th>

                        </tr>
                    </table>

                    <p>
                        <?php
                        echo '$' . number_format(
                            $PRODUCTO['precio'] * $PRODUCTO['cantidad'],
                            0,
                            ',',
                            '.'
                        );
                        ?>
                    </p>

                    <form method="POST">
                        <input type="hidden" name="id_producto" value="<?php echo $PRODUCTO['id']; ?>">
                        <button type="submit" name="eliminar" aria-label="Eliminar producto">
                            <i data-lucide="trash"></i>
                        </button>
                    </form>
                    <hr>

                <?php endforeach; ?>
            <?php else: ?>
                <p>No tienes productos agregados a tu pedido.</p>
            <?php endif; ?>
        </div>

        <!-- RESUMEN DEL PEDIDO -->
        <div class="factura">
            <h2>RESUMEN DEL PEDIDO</h2>
            <br><br>
            <div class="div-p">
                <p>Subtotal:</p>
                <p>
                    <?php echo '$' . number_format($SUBTOTAL, 0, ',', '.'); ?>
                </p>
            </div>

            <br>

            <div class="div-p">
                <p>Domicilio:</p>
                <p>
                    <?php echo '$' . number_format($DOMICILIO, 0, ',', '.'); ?>
                </p>
            </div>
            <br>
            <hr>
            <br>
            <h2>TOTAL:</h2>
            <br>
            <p>
                <b>
                    <?php echo '$' . number_format($TOTAL, 0, ',', '.'); ?>
                </b>
            </p>

            <br><br>

            <div id="container-buttons">
                <form action="confirmar_pedido.php" method="POST">
                    <button type="submit" class="button-yellow" <?php echo empty($_SESSION['carrito']) ? 'disabled' : ''; ?>>Confirmar pedido</button>
                </form>

                <form action="../MENU/menu.php" method="GET">
                    <button type="submit" class="button-seguir-comprando">Seguir comprando</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- PEDIDOS -->


<!-- FOOTER -->
<?php include("../../INCLUDES/FOOTER/footer.php");?>
<!-- FOOTER -->


<!-- LUCIDE -->
<script src="https://unpkg.com/lucide@latest"></script>
<script>
    lucide.createIcons();
</script>
<!-- LUCIDE -->

</body>
</html>
