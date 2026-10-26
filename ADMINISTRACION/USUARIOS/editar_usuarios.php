<?php
include("../../INCLUDES/CONEXION/database.php");

// OBTENER ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de usuario inválido.");
}

$ID = (int) $_GET['id'];

// ACTUALIZAR USUARIO
if (isset($_POST['editar'])) {

    $NOMBRE = $_POST['NOMBRE'];
    $MAIL = $_POST['MAIL'];
    $NUMERO = $_POST['NUMERO'];
    $ROL = $_POST['ROL'];

    $SQL_UPDATE = "UPDATE users SET NAME_USER = ?, EMAIL_USER = ?, NUMBER_USER = ?, ROL = ? WHERE ID_USER = ?";
    $STMT = mysqli_prepare($CONEXION, $SQL_UPDATE);

    mysqli_stmt_bind_param( $STMT, "ssssi", $NOMBRE, $MAIL, $NUMERO, $ROL, $ID);

    if (mysqli_stmt_execute($STMT)) {
        mysqli_stmt_close($STMT);
        header("location:usuarios.php");
        exit();
    } else {
        die("Error al actualizar el usuario: " . mysqli_stmt_error($STMT));
    }
}

// CONSULTAR USUARIO
    $SQL_READ = "SELECT * FROM users WHERE ID_USER = ?";
    $STMT = mysqli_prepare($CONEXION, $SQL_READ);
    mysqli_stmt_bind_param($STMT, "i", $ID);
    mysqli_stmt_execute($STMT);
    $RESULTADO = mysqli_stmt_get_result($STMT);
    $ROW = mysqli_fetch_assoc($RESULTADO);
    mysqli_stmt_close($STMT);
    if (!$ROW) {
        die("Usuario no encontrado.");
    }

include("../HEADER_ADMIN/header_admin.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuario - ArepaMania</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;}

        body {
            font-family: 'Montserrat', sans-serif;
            background: #f5f5f5;
            margin: 0;}

        .container-form {
            width: 400px;
            max-width: calc(100% - 30px);
            margin: 50px auto;
            padding: 25px;
            background: white;
            border-radius: 10px;}

        .container-form h2 {
            text-align: center;}

        .container-form label {
            display: block;
            margin-top: 15px;}

        .container-form input,
        .container-form select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-family: inherit;}

        .container-botones {
            display: flex;
            gap: 10px;
            margin-top: 25px;}

        .container-botones button {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-family: inherit;}

        .guardar {
            background: #ddaa01;}

        .cancelar {
            background: #ddd;}
    </style>
</head>
<body>
<div class="container-form">
    <h2>Editar usuario</h2>
    <form method="POST">

        <label>Nombre:</label>
        <input type="text" name="NOMBRE" value="<?php echo htmlspecialchars($ROW['NAME_USER']); ?>" required>

        <label>Correo electrónico:</label>
        <input type="email" name="MAIL" value="<?php echo htmlspecialchars($ROW['EMAIL_USER']); ?>" required>

        <label>Número telefónico:</label>
        <input type="text" name="NUMERO" value="<?php echo htmlspecialchars($ROW['NUMBER_USER']); ?>" required>

        <label>Rol:</label>
        <select name="ROL" required>
            <option value="Usuario" <?php if ($ROW['ROL'] == 'Usuario') echo 'selected'; ?>>Usuario </option>
            <option value="Administrador" <?php if ($ROW['ROL'] == 'Administrador') echo 'selected'; ?>> Administrador</option>
        </select>

        <div class="container-botones">
            <button type="submit" name="editar" class="guardar">Guardar cambios</button>
            <button type="button" class="cancelar" onclick="window.location.href='usuarios.php'">Cancelar</button>
        </div>
    </form>
</div>

</body>
</html>
