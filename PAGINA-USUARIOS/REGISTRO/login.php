<?php 
include("../../INCLUDES../CONEXION/database.php");
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
<!-- FORMULARIO DE REGISTRO -->
    <div class="container">
        <div class="container-form">
                <h1>CREAR CUENTA</h1>
            <form action="" method="POST">
                <input type="text" minlength="10" maxlenght="255" placeholder="Ingresa tu nombre completo" required name="NOMBRE"> <br>
                <input type="email" maxlength="255" placeholder="Ingresa tu correo electronico" required name="MAIL" > <br>
                <input type="text" maxlength="16" placeholder="Ingresa tu número telefónico" required name="NUMERO"> <br>
                <input type="password" maxlength="255" placeholder="Ingresa una contraseña" required name="CONTRASEÑA"> <br>
                <button type="submit" class="submit" name="ENVIAR"><b>ENVIAR</b></button>
            </form>
                <a href="singup.php">¿ Ya tienes cuenta ?</a> <br><br>
                <a href="../INICIO/index.php">Volver</a>
        </div>
    </div>
<!-- FORMULARIO DE REGISTRO -->
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
            echo "<script>alert('Usuario registrado correctamente')</script>";
        }
        else {
            echo "<script>alert('Usuario registrado incorrectamente')</script>";
        }}

    // GUARDAR DATOS EN LA BASE DE DATOS //
?>

