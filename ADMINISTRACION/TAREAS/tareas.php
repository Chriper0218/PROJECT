<?php 
include("../../INCLUDES/CONEXION/database.php");
include("../HEADER_ADMIN/header_admin.php");
?>

<?php
// ELIMINAR PRODUCTOS //
if (isset($_POST['eliminar'])) {

    $ID_PRODUCTO = (int) $_POST['id_producto'];

    $SQL_DELETE = "DELETE FROM tareas WHERE ID_TAREA = ?";
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
        <h2>TAREAS</h2>
        <button type="button" id="abrir-modal" class="button"><b>Agregar</b></button>
    </div>
    <br>

<!-- TABLA -->
    <div class="container-table">
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Estado</th>
                <th>Prioridad</th>
                <th>Fecha de creacion</th>
                <th>TAREA</th>
                <th>Fecha limite</th>
                <th>Acciones</th>
            </tr>

         <?php 
        //  MOSTRAR LOS DATOS DE LA BASE DE DATOS   //
            $SQL_READ = "SELECT * FROM tareas";
            $RESULTADO = mysqli_query($CONEXION, $SQL_READ);

            if (!$RESULTADO) {
                die("Error: " .mysqli_error($CONEXION));
            } else {
                while ($ROW = mysqli_fetch_assoc($RESULTADO)) {
        ?>

            <tr>
                <td><?php echo $ROW['ID_TAREA'];?></td>
                <td><?php echo $ROW['TITULO'];?></td>
                <td><?php echo $ROW['ESTADO'];?></td>
                <td><?php echo $ROW['PRIORIDAD'];?></td>
                <td><?php echo $ROW['FECHA_CREACION'];?></td>
                <td><?php echo $ROW['TAREA'];?></td>
                <td><?php echo $ROW['FECHA_LIMITE'];?></td>
                <td>
                    <div class="container-acciones">
                        <form action="editar_tareas.php" method="GET">
                            <input type="hidden" name="id" value="<?php echo $ROW['ID_TAREA']; ?>">
                            <button type="submit" class="button-editar"><img src="../HEADER_IMAGENES/pencil.png" alt="Editar"></button>
                        </form>

                        <form method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                            <input type="hidden" name="id_producto" value="<?php echo $ROW['ID_TAREA']; ?>">
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
    <!-- FORMULARIO -->
    <div class="container-form">
        <form action="" method="POST">
            <h2>Ingresa los datos sobre la tarea</h2>
            <input type="text" name="titulo" placeholder="Ingresa el titulo de la tarea" max-length="50" required>
                <div>
                    <br>
                        <label for="estado">Escoge el estado de la tarea:</label>
                            <select name="estado" id="estado" required>
                                <option value="pendiente">Pendiente</option>
                                <option value="progreso">Progreso</option>
                                <option value="Completada">Completada</option>
                            </select>
                </div>
            <br>
                <div>
                <label for="prioridad">Escoge la prioridad de la tarea:</label>
                    <select name="prioridad" id="prioridad" required>
                        <option value="baja">Baja</option>
                        <option value="media">media</option>
                        <option value="alta">alta</option>
                    </select>
                </div>
            <label for="fecha_limite">Ingresa la fecha limite:</label>
            <input type="date" name="fecha_limite" class="input_fecha"> <br>
            <input type="text" name="tarea" placeholder="Ingresa la tarea" required id="input-tarea"> <br> <br>
            <button type="submit" class=" btn-cancelar" name="enviar">Enviar</button>
            <button type="button" id="cancelar" class="btn-cancelar">salir</button>
            
        </form>
    </div>
    <!-- FORMULARIO -->

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
// AGREGAR LOS DATOS A LA BASE DE DATOS //
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $TITULO = $_POST['titulo'];
        $ESTADO = $_POST['estado'];
        $PRIORIDAD = $_POST['prioridad'];
        $TAREA = $_POST['tarea'];
        $FECHA_LIMITE = $_POST['fecha_limite'];

        $SQL = "INSERT INTO tareas
        (TITULO, ESTADO, PRIORIDAD, TAREA, FECHA_LIMITE)
        VALUES ('$TITULO','$ESTADO','$PRIORIDAD','$TAREA', '$FECHA_LIMITE')";

        if(mysqli_query($CONEXION, $SQL)) {
            echo"<script>alert('Producto registrado con exito.');
            window.location.href = window.location.pathname;</script>";
        }
        else {
            echo"<script>alert('Error al registrar el producto.')</script>";
        }
    }
// AGREGAR LOS DATOS A LA BASE DE DATOS //
?>
