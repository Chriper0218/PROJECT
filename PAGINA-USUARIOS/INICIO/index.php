<?php 
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
<!-- MAIN (INICIO) -->
    <main>
        <div class="container-main">
            <div class="container-main-items">
                <h1 class="h1-white">EL MEJOR</h1>
                <h1 class="h1-yellow">SABOR EN</h1>
                <h1 class="h1-white">CADA BOCADO</h1>
                <p>Arepas y perros calientes preparados <br>
                al momento con ingredientes <br>
                frescos y de calidad</p>

                <div class="container-buttons">
                    <form action="../MENU/menu.php"><button class="button-main"><b>VER MENÚ</b></button></form>
                    <form action="../PEDIDOS/pedidos.php"><button class="button-main"><b>HACER PEDIDO</b></button></form>
                </div>

            </div>
        </div>
    </main>
<!-- MAIN (INICIO) -->

<!--FOOTER-->
<?php 
include("../../INCLUDES../FOOTER/footer.php");
?>
<!--FOOTER-->

</body>
</html>