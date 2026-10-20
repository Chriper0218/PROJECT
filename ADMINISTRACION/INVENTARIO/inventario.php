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
            <h2>INVENTARIO</h2> 
            <button class="button-agregar"><b>Agregar</b></button>
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

                <tr>
                    <td>hello</td>
                    <td>hello</td>
                    <td>hello</td>
                    <td>hello</td>
                    <td>hello</td>
                    <td>hello</td>
                    <td>hello</td>
                    <td>hello</td>
                    <td>hello</td>
                    <td>hello</td>
                    <td>hello</td>
                    <td>
                        <button>edit</button>
                        <button>delete</button>
                    </td>
                </tr>

            </table>
        </div>
    </div>

</body>
</html>