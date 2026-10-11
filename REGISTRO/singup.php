<?php 
include("../CONEXION/database.php");
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
                <input type="email" maxlength="255" placeholder="Ingresa tu correo electronico" required name="EMAIL" > <br>
                <input type="text" maxlength="255" placeholder="Ingresa tu contraseña" required name="CONTRASEÑA"> <br>
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $EMAIL = $_POST["EMAIL"];
    $CONTRASEÑA = $_POST["CONTRASEÑA"];

    $SQL = "SELECT * FROM users WHERE EMAIL_USER = '$EMAIL' AND PASSWORD_USER = '$CONTRASEÑA'";

    $RESULTADO = mysqli_query($CONN, $SQL);

    if (mysqli_num_rows($RESULTADO) > 0) {

        $USUARIO = mysqli_fetch_assoc($RESULTADO);

        $_SESSION['ID_USER'] = $USUARIO['ID_USER'];
        $_SESSION['NAME_USER'] = $USUARIO['NAME_USER'];
        $_SESSION['EMAIL_USER'] = $USUARIO['EMAIL_USER'];

        header("Location: ../INICIO/index.php");
        exit();

    } else {
        echo"<script>alert('Error al iniciar sección')</script>";
    }
}
// VALIDACION DE USUARIOS //
?> 


