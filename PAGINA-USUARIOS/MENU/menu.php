<?php
include("../../INCLUDES/CONEXION/database.php");
include("../../INCLUDES/HEADER/header.php");

// CONSULTAR LOS PRODUCTOS DE LA BASE DE DATOS //
$SQL_READ = "SELECT * FROM menu";
$RESULTADO = mysqli_query($CONEXION, $SQL_READ);
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

<!-- MENU -->
<div class="container-dad">
    <h1>NUESTRO MENÚ</h1>
    <div class="container-target">

        <?php
        // MOSTRAR LOS PRODUCTOS DE LA BASE DE DATOS //
        if ($RESULTADO && mysqli_num_rows($RESULTADO) > 0) {
            while ($ROW = mysqli_fetch_assoc($RESULTADO)) {
                $ID_PRODUCTO = $ROW['ID_PRODUCTO_MENU'];
                $URL_PRODUCTO = $ROW['URL_PRODUCTO'];
                $AREPA = $ROW['AREPA'];
                $PRECIO = $ROW['PRECIO'];
        ?>
                <div class="target-menu">
                    <img src="<?php echo htmlspecialchars($URL_PRODUCTO); ?>" alt="<?php echo htmlspecialchars($AREPA); ?>">
                    <p class="name"><b><?php echo htmlspecialchars($AREPA); ?></b></p>
                    <p class="price"><b><?php echo htmlspecialchars($PRECIO); ?></b></p>
                    <form action="../PEDIDOS/pedidos.php" method="POST">
                    <input type="hidden" name="id_producto" value="<?php echo (int) $ID_PRODUCTO; ?>">
                    <button type="submit" name="agregar" class="button-target">Agregar</button></form>
                </div>
        <?php

            }

        } elseif ($RESULTADO) {

            echo "<p>No hay productos disponibles en el menú.</p>";
        } else {
            echo "<p>Error al consultar los productos: "
                . htmlspecialchars(mysqli_error($CONEXION))
                . "</p>";
        }
        ?>
    </div>

</div>
<!-- MENU -->

<!-- FOOTER -->
<?php
include("../../INCLUDES/FOOTER/footer.php");
?>
<!-- FOOTER -->

</body>

</html>
