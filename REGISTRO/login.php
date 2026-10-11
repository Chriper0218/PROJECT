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
<!-- FORMULARIO DE REGISTRO -->
    <div class="container">
        <div class="container-form">
                <h1>CREAR CUENTA</h1>
            <form action="" method="POST">
                <input type="text" minlength="10" maxlenght="255" placeholder="Ingresa tu nombre completo" required name="NOMBRE"> <br>
                <input type="email" maxlength="255" placeholder="Ingresa tu correo electronico" required name="EMAIL" > <br>
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
    if(isset($_POST["ENVIAR"])){

        $NOMBRE = trim($_POST["NOMBRE"]);
        $EMAIL = trim($_POST["EMAIL"]);
        $NUMERO = trim($_POST["NUMERO"]);
        $HASH = password_hash($PASSWORD, $HASH);


    $SQL = "INSERT INTO users (NAME_USER, EMAIL_USER, NUMBER_USER, PASSWORD_USER)
    VALUES
    ('$NOMBRE','$EMAIL','$NUMERO','$HASH');";
    
    mysqli_query($CONN, $SQL);

    header("location:../INICIO/index.php");
    exit();}
    
    // GUARDAR DATOS EN LA BASE DE DATOS //
?>

