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
        <button class="button"><b>Agregar</b></button>
    </div>
    <br>

    <div class="container-table">
        <table border="1">
            <tr>
                <th>ID</th>
                <th>URL</th>
                <th>Arepa</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>

            <tr>
                <td>HOLA</td>
                <td>https://chatgpt.com/c/6ad9507c-0e2c-83e9-be92-b3cf999d99d9</td>
                <td>HOLA</td>
                <td>HOLA</td>
                <td>
                    <button class="button-editar"><img src="../HEADER_IMAGENES/pencil.png" alt="editar"></button>
                    <button class="button-eliminar"><img src="../HEADER_IMAGENES/trash.png" alt="eliminar"></button>
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="container-form">
    <form action="" method="POST">
        <h3>Ingresa los datos del producto a ofrecer</h3>
        <input type="text" requied placeholder="Ingresa la url">
        <input type="text" required placeholder="Ingresa el nombre del producto">
        <input type="text" required placeholder="Ingresa el precio del producto">
        <br> <br>
        <button type="submit" name="enviar" class="button">Enviar</button>
    </form>
</div>

</body>
</html>

<?php 
    
?>