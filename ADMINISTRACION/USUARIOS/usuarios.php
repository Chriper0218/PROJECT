<?php 
include("../../INCLUDES/CONEXION/database.php");
include("../HEADER_ADMIN/header_admin.php");
?>

<?php
// ELIMINAR PRODUCTOS //
if (isset($_POST['eliminar'])) {

    $ID_PRODUCTO = (int) $_POST['id_producto'];

    $SQL_DELETE = "DELETE FROM users WHERE ID_USER = ?";
    $STMT = mysqli_prepare($CONEXION, $SQL_DELETE);

    mysqli_stmt_bind_param($STMT, "i", $ID_PRODUCTO);

    if (mysqli_stmt_execute($STMT)) {
        mysqli_stmt_close($STMT);

        echo "<script>
            alert('Producto eliminado exitosamente.');
            window.location.href = window.location.pathname;
        </script>";
        exit;

    } else {
        echo "Error al eliminar el producto: " . mysqli_stmt_error($STMT);
        mysqli_stmt_close($STMT);
    }
}
// ELIMINAR PRODUCTOS //
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
        <h2>Usuarios</h2>
        <button type="button" id="abrir-modal" class="button"><b>Agregar</b></button>
    </div>
    <br>

<!-- TABLA -->
    <div class="container-table">
        <table border="1">
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>Email</th>
                <th>Numero telefonico</th>
                <th>Fecha de registro</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>

         <?php 
        //  MOSTRAR LOS DATOS DE LA BASE DE DATOS   //
            $SQL_READ = "SELECT * FROM users";
            $RESULTADO = mysqli_query($CONEXION, $SQL_READ);

            if (!$RESULTADO) {
                die("Error: " .mysqli_error($CONEXION));
            } else {
                while ($ROW = mysqli_fetch_assoc($RESULTADO)) {
        ?>

            <tr>
                <td><?php echo $ROW['ID_USER'];?></td>
                <td><?php echo $ROW['NAME_USER'];?></td>
                <td><?php echo $ROW['EMAIL_USER'];?></td>
                <td><?php echo $ROW['NUMBER_USER'];?></td>
                <td><?php echo $ROW['DATE_USER'];?></td>
                <td><?php echo $ROW['ROL'];?></td>
                <td>
                    <div class="container-acciones">
                        <button class="button-editar"><img src="../HEADER_IMAGENES/pencil.png" alt="editar"></button>
                        <form method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                            <input type="hidden" name="id_producto" value="<?php echo $ROW['ID_USER']; ?>">
                            <button type="submit" class="button-eliminar" name="eliminar"><img src="../HEADER_IMAGENES/trash.png" alt="Eliminar"></button>
                        </form>
                    </div>
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
    <!-- FORMULARIO DE REGISTRO -->
    <div class="container-form">
        <form action="" method="POST">
            <h2>Crear cuenta</h2>
                <input type="text" minlength="10" maxlenght="255" placeholder="Ingresa tu nombre completo" required name="NOMBRE"> <br>
                <input type="email" maxlength="255" placeholder="Ingresa tu correo electronico" required name="MAIL" > <br>
                <input type="number" maxlength="16" placeholder="Ingresa tu número telefónico" required name="NUMERO"> <br>
                <input type="password" maxlength="255" placeholder="Ingresa una contraseña" required name="CONTRASEÑA"> <br> <br>
            <button type="submit" class="btn-cancelar" name="ENVIAR"><b>Enviar</b></button>
            <button type="button" id="cancelar" class="btn-cancelar"><b>Cancelar</b></button>
            
        </form>
    </div>
    <!-- FORMULARIO DE REGISTRO -->

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
    // GUARDAR DATOS EN LA BASE DE DATOS // 
    
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $NAME = $_POST['NOMBRE'];
        $MAIL = $_POST['MAIL'];
        $NUMBER = $_POST['NUMERO'];
        $PASSWORD = $_POST['CONTRASEÑA'];

        $HASHED_PASSWORD = password_hash($PASSWORD, PASSWORD_DEFAULT);

        $SQL = "INSERT INTO users 
            (NAME_USER, EMAIL_USER, NUMBER_USER, PASSWORD_USER)
            VALUES ('$NAME', '$MAIL', '$NUMBER', '$HASHED_PASSWORD')";

        if(mysqli_query($CONEXION, $SQL)) {
            echo"<script>alert('Producto registrado con exito.');
            window.location.href = window.location.pathname;</script>";
        }
        else {
            echo "<script>alert('Usuario registrado incorrectamente')</script>";
        }}

    // GUARDAR DATOS EN LA BASE DE DATOS //
?>