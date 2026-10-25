<?php 
include("../../INCLUDES/CONEXION/database.php");
include("../HEADER_ADMIN/header_admin.php");
?> 

<?php
// ELIMINAR PRODUCTOS //
if (isset($_POST['eliminar'])) {

    $ID_PRODUCTO = (int) $_POST['id_producto'];

    $SQL_DELETE = "DELETE FROM products WHERE ID_PRODUCTO = ?";
    $STMT = mysqli_prepare($CONEXION, $SQL_DELETE);

    mysqli_stmt_bind_param($STMT, "i", $ID_PRODUCTO);

    if (mysqli_stmt_execute($STMT)) {
        mysqli_stmt_close($STMT);
         echo "<script>window.location.href = window.location.pathname;
        alert('Producto eliminado exitosamente.'); 
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
        <h2>INVENTARIO</h2>
        <button type="button" id="abrir-modal" class="button"><b>Agregar</b></button>
    </div>
    <br>

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
            // MOSTRAR DATOS DE PRODUCTOS DE LA BASE DE DATOS
            $SQL_READ = "SELECT * FROM products";
            $RESULTADO = mysqli_query($CONEXION, $SQL_READ);

            if (!$RESULTADO) {
                die("Error: " . mysqli_error($CONEXION));
            } else {
                while ($ROW = mysqli_fetch_assoc($RESULTADO)) {
            ?>

                    <tr>
                        <td><?php echo $ROW['ID_PRODUCTO']; ?></td>
                        <td><?php echo $ROW['NOMBRE']; ?></td>
                        <td><?php echo $ROW['DETALLES']; ?></td>
                        <td><?php echo $ROW['CATEGORIA']; ?></td>
                        <td><?php echo $ROW['CANTIDAD']; ?></td>
                        <td><?php echo $ROW['UNIDAD_MEDIDA']; ?></td>
                        <td><?php echo $ROW['STOCK_MINIMO']; ?></td>
                        <td><?php echo $ROW['COSTO_COMPRA']; ?></td>
                        <td><?php echo $ROW['FECHA_INGRESO']; ?></td>
                        <td><?php echo $ROW['FECHA_VENCIMIENTO']; ?></td>
                        <td><?php echo $ROW['ESTADO']; ?></td>
                        <td>
                            <div class="container-acciones">
                                <button type="button" class="button-editar"><img src="../HEADER_IMAGENES/pencil.png" alt="editar"></button>
                                <form method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                                <input type="hidden" name="id_producto" value="<?php echo $ROW['ID_PRODUCTO']; ?>">
                                <button type="submit" class="button-eliminar" name="eliminar">              
                                    <img src="../HEADER_IMAGENES/trash.png" alt="Eliminar">
                                </button>
                            </div>

                            </form>
                        </td>
                    </tr>
            <?php
                }
            }
            // MOSTRAR DATOS DE PRODUCTOS DE LA BASE DE DATOS
            ?>
        </table>
    </div>
</div>


<!-- VENTANA MODAL -->
<div class="modal" id="modal">
    
    <!-- FORM -->
    <div class="container-form">
            <form action="" method="POST">
                <h2>Ingresa los datos de los productos</h2>
                <input type="text" required name="producto" placeholder="Producto"> <br> 
                <input type="text" name="detalle" placeholder="Detalles"> <br>
                
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
                    </select> <br>
                </div>

                <input type="number" name="cantidad" required placeholder="Cantidad del producto" step="1"> <br>
                <input type="text" name="unidad" required placeholder="Unidad de medida"> <br>
                <input type="number" name="stock" required placeholder="stock minimo" step="1"> <br>
                <input type="text" name="precio" placeholder="Precio de compra" required> <br>
                 

                <div class="container-fecha">
                    <label for="fecha_ingreso">Fecha de ingreso del producto:</label>
                    <input type="date" required name="fecha_ingreso" class="input_fecha">
                </div>

                <div class="container-fecha">
                    <label for="fecha_vencimiento">Fecha de vencimiento del producto:</label>
                    <input type="date" name="fecha_vencimiento" class="input_fecha">
                </div>
                <br>
                
                <div style="display:flex;">
                    <label for="estado">Estado del producto:</label> <br>
                    <select name="estado" id="estado" required>
                        <option value="activo">activo</option>
                        <option value="inactivo">inactivo</option>
                        <option value="agotado">agotado</option>
                    </select>
                </div>
                <br>
                <button type="submit" class=" btn-cancelar" name="enviar">Enviar</button>
                <button type="button" id="cancelar" class="btn-cancelar">salir</button>
            </form>
        </div>
<!-- FORM -->
</div>

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
<!-- VENTANA MODAL -->
</body>
</html>


<?php
//  AGREGAR PRODUCTOS EN LA BASE DE DATOS   //
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $PRODUCTO = $_POST['producto'];
        $DETALLE = $_POST['detalle'];
        $CATEGORIA = $_POST['categoria'];
        $CANTIDAD = $_POST['cantidad'];
        $UNIDAD = $_POST['unidad'];
        $STOCK = $_POST['stock'];
        $PRECIO = $_POST['precio'];
        $FECHA_INGRESO = $_POST['fecha_ingreso'];
        $FECHA_VENCIMIENTO = $_POST['fecha_vencimiento'];
        $ESTADO = $_POST['estado'];

        $SQL = "INSERT INTO products (NOMBRE, DETALLES, CATEGORIA, CANTIDAD, UNIDAD_MEDIDA, STOCK_MINIMO, COSTO_COMPRA, FECHA_INGRESO, FECHA_VENCIMIENTO, ESTADO)
        VALUES('$PRODUCTO','$DETALLE','$CATEGORIA','$CANTIDAD','$UNIDAD','$STOCK','$PRECIO','$FECHA_INGRESO','$FECHA_VENCIMIENTO','$ESTADO')";

        if(mysqli_query($CONEXION, $SQL)) {
            echo"<script>alert('Producto registrado con exito.');
            window.location.href = window.location.pathname;</script>";
        }
        else {
            echo"<script>alert('Error al registrar el producto.')</script>";
        }
    }
//  AGREGAR PRODUCTOS EN LA BASE DE DATOS   //
?>

<?php 
//  ELIMINAR REGISTROS O ELEMENTOS DEL INVENTARIO   //
    if(isset($_POST['eliminar'])) {
        $ID_PRODUCTO = (int) $_POST['ID_PRODUCTO'];

        $SQL_DELETE = "DELETE * FROM products WHERE ID_PRODUCTO = '$ID_PRODUCTO'";
        $STMT = mysqli_prepare($CONEXION, $SQL);

        mysqli_stmt_bind_param($STMT, "i", $ID_PRODUCTO);

        if (mysqli_stmt_execute($STMT)) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
        } else {
        echo "Error al eliminar el producto.";
        }

        mysqli_stmt_close($STMT);
        }
//  ELIMINAR REGISTROS O ELEMENTOS DEL INVENTARIO   //
?>

