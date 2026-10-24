<?php 
include("../../INCLUDES/CONEXION/database.php");
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
        //  MOSTRAR LOS DATOS DE LA BASE DE DATOS   //
            $SQL_READ = "SELECT * FROM menu";
            $RESULTADO = mysqli_query($CONEXION, $SQL_READ);

            if (!$RESULTADO) {
                die("Error: " .mysqli_error($CONEXION));
            } else {
                while ($ROW = mysqli_fetch_assoc($RESULTADO)) {
        ?>

            <tr>
                <td><?php echo $ROW['ID_PRODUCTO_MENU'];?></td>
                <td><?php echo $ROW['URL_PRODUCTO'];?></td>
                <td><?php echo $ROW['AREPA'];?></td>
                <td><?php echo $ROW['PRECIO'];?></td>
                <td>
                    <button class="button-editar"><img src="../HEADER_IMAGENES/pencil.png" alt="editar"></button>
                    <button class="button-eliminar"><img src="../HEADER_IMAGENES/trash.png" alt="eliminar"></button>
                </td>
            </tr>

        <?php 
                }
            }
        //  MOSTRAR LOS DATOS DE LA BASE DE DATOS   //
        ?>
        </table>
    </div>
</div>
<!-- TABLA -->



<!-- VENTANA MODAL -->
<div class="modal" id="modal">
    <!-- FORM -->
        <div class="container-form">
        <form action="" method="POST">
            <h2>Ingresa los datos del producto a ofrecer</h2>
            <input type="text" requied placeholder="Ingresa la url" name="url" required>
            <input type="text" required placeholder="Ingresa el nombre del producto" name="producto" required>
            <input type="text" required placeholder="Ingresa el precio del producto" name="precio" required>
            <br> <br>
            <button type="submit" class=" btn-cancelar" name="enviar">Enviar</button>
            <button type="button" id="cancelar" class="btn-cancelar">salir</button>
        </form>
        </div>
    <!-- FORM -->

    <script>
        const modal = document.getElementById("modal");
    const abrirModal = document.getElementById("abrir-modal");
    const cerrarModal = document.getElementById("cerrar-modal");
    const cancelar = document.getElementById("cancelar");
    const formulario = document.getElementById("formulario");

    // ABRIR MODAL
    abrirModal.addEventListener("click", function () {
        modal.classList.add("modal--show");
    });

    // CERRAR MODAL CON LA X
    cerrarModal.addEventListener("click", function () {
        modal.classList.remove("modal--show");
    });

    // CERRAR CON CANCELAR
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

    // EJEMPLO DE ENVÍO DEL FORMULARIO
    formulario.addEventListener("submit", function (evento) {
        evento.preventDefault();

        alert("Formulario enviado correctamente.");

        formulario.reset();
        modal.classList.remove("modal--show");
    });
</script>
</div>
<!-- VENTANA MODAL -->

</body>
</html>

<?php 
// INGRESAR PRODUCTO A OFRECER A LA BASE DE DATOS //
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $URL = $_POST['url'];
        $NOMBRE = $_POST['producto'];
        $PRECIO = $_POST['precio'];

        $SQL = "INSERT INTO menu 
        (URL_PRODUCTO, AREPA, PRECIO )
        VALUES('$URL','$NOMBRE','$PRECIO')";

        if(mysqli_query($CONEXION, $SQL)) {
            echo"<script>alert('Producto registrado con exito.');
            window.location.href = window.location.pathname;</script>";
        }
        else {
            echo"<script>alert('Error al registrar el producto.')</script>";
        }
    }
// INGRESAR PRODUCTO A OFRECER A LA BASE DE DATOS //
?>