<?php
include("../../INCLUDES/CONEXION/database.php");
include("../HEADER_ADMIN/header_admin.php");

// OBTENER EL ID DE LA TAREA
if (isset($_GET['id'])) {
    $ID_TAREA = (int) $_GET['id'];

    $SQL_READ = "SELECT * FROM tareas WHERE ID_TAREA = ?";
    $STMT = mysqli_prepare($CONEXION, $SQL_READ);

    mysqli_stmt_bind_param($STMT, "i", $ID_TAREA);
    mysqli_stmt_execute($STMT);

    $RESULTADO = mysqli_stmt_get_result($STMT);
    $ROW = mysqli_fetch_assoc($RESULTADO);

    mysqli_stmt_close($STMT);

    if (!$ROW) {
        die("La tarea no existe.");
    }
} else {
    die("No se recibió el ID de la tarea.");
}

// ACTUALIZAR LOS DATOS
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $TITULO = $_POST['titulo'];
    $ESTADO = $_POST['estado'];
    $PRIORIDAD = $_POST['prioridad'];
    $TAREA = $_POST['tarea'];
    $FECHA_LIMITE = $_POST['fecha_limite'];
    $ID_TAREA = (int) $_POST['id_tarea'];

    $SQL_UPDATE = "UPDATE tareas
                   SET TITULO = ?, ESTADO = ?, PRIORIDAD = ?, TAREA = ?, FECHA_LIMITE = ?
                   WHERE ID_TAREA = ?";

    $STMT = mysqli_prepare($CONEXION, $SQL_UPDATE);

    mysqli_stmt_bind_param( $STMT, "sssssi", $TITULO, $ESTADO, $PRIORIDAD, $TAREA, $FECHA_LIMITE, $ID_TAREA);

    if (mysqli_stmt_execute($STMT)) {
        mysqli_stmt_close($STMT);
        echo "<script>
            alert('Tarea actualizada correctamente.');
            window.location.href = 'tareas.php';
        </script>";
        exit;
    } else {
        echo "Error al actualizar la tarea: " . mysqli_stmt_error($STMT);
        mysqli_stmt_close($STMT);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar tarea - ArepaMania</title>
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

<div class="container">
    <div class="container-form">
        <form action="" method="POST">
            <input type="hidden" name="id_tarea" value="<?php echo $ROW['ID_TAREA']; ?>">

            <label for="titulo">Título de la tarea:</label>
            <input
                type="text"
                id="titulo"
                name="titulo"
                maxlength="50"
                value="<?php echo htmlspecialchars($ROW['TITULO']); ?>"
                required
            >

            <br><br>

            <label for="estado">Estado de la tarea:</label>
            <select name="estado" id="estado" required>
                <option value="pendiente" <?php if ($ROW['ESTADO'] == 'pendiente') echo 'selected'; ?>>Pendiente</option>
                <option value="progreso" <?php if ($ROW['ESTADO'] == 'progreso') echo 'selected'; ?>>Progreso</option>
                <option value="Completada" <?php if ($ROW['ESTADO'] == 'Completada') echo 'selected'; ?>>Completada</option>
            </select>

            <br><br>

            <label for="prioridad">Prioridad de la tarea:</label>
            <select name="prioridad" id="prioridad" required>
                <option value="baja" <?php if ($ROW['PRIORIDAD'] == 'baja') echo 'selected'; ?>>Baja</option>
                <option value="media" <?php if ($ROW['PRIORIDAD'] == 'media') echo 'selected'; ?>>Media</option>
                <option value="alta" <?php if ($ROW['PRIORIDAD'] == 'alta') echo 'selected'; ?>>Alta</option>
            </select>

            <br><br>

            <label for="fecha_limite">Fecha límite:</label>
            <input type="date" id="fecha_limite" name="fecha_limite" class="input_fecha" value="<?php echo htmlspecialchars($ROW['FECHA_LIMITE'] ?? ''); ?>" required>

            <br><br>

            <label for="tarea">Descripción de la tarea:</label>
            <input type="text" id="tarea" name="tarea" value="<?php echo htmlspecialchars($ROW['TAREA']); ?>" required>
            <br><br>

            <button type="submit" class="guardar">Guardar cambios</button>
            <a href="tareas.php" class="cancelar">Cancelar</a>

        </form>
    </div>
</div>

</body>
</html>