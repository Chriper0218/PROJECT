<?php 
include("../../INCLUDES../CONEXION/database.php");
session_start();
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
                <input type="email" maxlength="255" placeholder="Ingresa tu nombre correo electronico" required name="MAIL" > <br>
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
    
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $MAIL = $_POST['MAIL'];
    $PASSWORD = $_POST['CONTRASEÑA'];

    $SQL = "SELECT * FROM users WHERE EMAIL_USER = '$MAIL'";
    $RESULTADO = mysqli_query($CONEXION, $SQL);
    $USER = mysqli_fetch_assoc($RESULTADO);

    if($USER && password_verify($PASSWORD, $USER['PASSWORD_USER'])) {

        $_SESSION['USER_ID'] = $USER['ID_USER'];
        $_SESSION['USER_NAME'] = $USER['NAME_USER'];
        $_SESSION['ROL'] = $USER['ROL'];

        if($USER['ROL'] == 'administrador') {
            header("Location: ../../ADMINISTRACION/INVENTARIO/inventario.php");} 

        else {
            header("Location: ../INICIO/index.php");}
        exit;
    }
    
    else {
        echo "<script>alert('Correo electronico o contraseña incorrectas')</script>";
    }
}
// VALIDACION DE USUARIOS //
?> 


