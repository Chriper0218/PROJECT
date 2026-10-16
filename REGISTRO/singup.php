<?php 
include("../INCLUDES../CONEXION/database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArepaMania</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<!-- FORMULARIO DE INICIO DE SESION -->
    <div class="container">
        <div class="container-form">
            <h1>INICIAR SESIÓN</h1>
            <form action="" method="POST">
                <input type="text" minlength="10" maxlength="255" placeholder="Ingresa tu nombre de usuario" required name="USUARIO" > <br>
                <input type="password" maxlength="255" placeholder="Ingresa tu contraseña" required name="CONTRASEÑA"> <br>
                <button type="submit" name="SUBMIT" class="submit"><b>ENVIAR</b></button> <br>
                <a href="login.php">¿ aún no tienes cuenta ?</a> <br><br>
                <a href="../INICIO/index.php">Volver</a>
            </form>
        </div>
    </div>
<!-- FORMULARIO DE INICIO DE SESION -->

</body>
</html>


<?php 
// VALIDACION DE USUARIOS //
// VALIDACION DE USUARIOS //
?> 


