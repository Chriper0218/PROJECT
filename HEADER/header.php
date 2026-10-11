<?php 
include("../CONEXION/database.php");
session_start();
?>

<?php 
$pagina_actual = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ArepaMania</title>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;}
    
body {
    font-family: 'Montserrat', sans-serif;
    font-size: 16px;}

/* HEADER */
.menu-1 {
    height: 100px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-left: 20px;
    padding-right: 20px;
    background-color: rgb(13, 13, 13);}

nav a {
    color: rgb(255, 255, 255);
    text-decoration: none;
    padding: 10px;
    margin-left: 10px;
    margin-right: 10px;
    font-size: 23px;}

nav a:hover {
    color: rgb(221, 170, 1);}

#logoheader {
    width: 120px;
    height: auto;}

.right-header {
    display: flex;
    align-items: center;
    gap: 35px;}

.right-header img {
    width: 30px;
    height: 30px;
    object-fit: contain;}

#button-header {
    background-color: rgb(221, 170, 1);
    border: none;
    width: 150px;
    height: 45px;
    font-size: 15px;
    border-radius: 5px;
    cursor: pointer;
    transition: transform 0.2s ease, background-color 0.2s ease;}

#button-header:hover {
    background-color: rgb(0, 0, 0);
    color: rgb(255, 255, 255);
    border: 1px solid rgb(255, 255, 255);
    transform: scale(1.05);} 
/* HEADER */

/* MODAL */
.modal {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(0, 0, 0, 0.53);
    display: flex;
    justify-content: center;
    align-items: center;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;}

.container-ventana {
    background-color: rgb(255,255,255);
    color: rgb(0,0,0);
    border: 1px solid white;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.5);
    width: 90%;
    max-width: 500px;
    display: flex;
    flex-direction: column;
    gap: 15px;
    align-items:center;}

.modal--show {
    opacity: 1;
    pointer-events: unset;}

.container-ventana-informacion {
    background-color:rgba(56, 56, 56, 0.16);
    padding:15px;
    border-radius:10px;
    border:1px solid gray;}

.modal__close {
    color:rgb(0,0,0);
    background-color:rgba(196, 10, 10, 0.62);
    width: 200px;
    padding:6px;
    border-radius:5px;
    border:1px solid rgb(153, 35, 19);
    text-align:center;
    font-size:16px;}

a[aria-current="page"] {
    color:rgb(221, 170, 1);
    font-weight:bold;}
/* MODAL */
</style>

</head>
<body>

<!--HEADER-->
    <header>
        <div class="menu-1">
            <a href="#"><img src="images/logo.png" alt="Logo de ArepaMania" id="logoheader"></a>
            <nav>
                <a href="../INICIO/index.php" <?php if($pagina_actual == 'index.php') echo'aria-current="page"';?>>    
                Inicio</a>

                <a href="../MENU/menu.php" <?php if($pagina_actual == 'menu.php') echo'aria-current="page"';?>>
                Menú</a>

                <a href="../PEDIDOS/pedidos.php" <?php if($pagina_actual == 'pedidos.php') echo'aria-current="page"';?>>
                Pedidos</a>

                <a href="../NOSOTROS/nosotros.php" <?php if($pagina_actual == 'nosotros.php') echo'aria-current="page"';?>>
                Nosotros</a>

                <a href="../CONTACTO/contacto.php" <?php if($pagina_actual == 'contacto.php') echo'aria-current="page"'; ?>>
                Contacto</a>
            </nav>

            <div class="right-header">
                <a href="../PEDIDOS/pedidos.php"><img src="images/shopping-cart.png" alt="Carrito de compras"></a>
                <a href="#" id="btn-usuario"><img src="images/user.png" alt="usuario"></a>
                <form action="../REGISTRO/singup.php"><button id="button-header"><b>INICIAR SESIÓN</b></button></form>
            </div>
        </div>
    </header>
<!--HEADER-->

<!-- VENTANA MODAL -->
    <section class="modal">
        <div class="container-ventana">
            <h2>Hola, Juan</h2>
            <p>Aqui puedes ver y gestionar tu informacion</p>

            <div class="container-ventana-informacion">
                <div style="display:flex; gap:5px;">
                    <i data-lucide="user"></i>
                    <h3 style="display:flex; align-items: center;"><b>Informacion personal</b><h3>
                </div>
                <br>
                <div>
                    <p>nombre completo: Juan Perez</p> <br>
                    <p>correo electronico: juanperez262215@gmail</p> <br>
                    <p>telefono: 3006708304</p> <br>
                </div>
            </div>

            <div>
                <a class="modal__close">Salir</a>
                <button class="modal__close">Cerrar sesión</button>
            </div>
        </div>
    </section>

    <script src="../JS/modal.js"></script>
<!-- VENTANA MODAL -->

<!-- LUCIDE -->
    <script src="https://unpkg.com/lucide@latest"></script>
        <script>
        lucide.createIcons();
    </script>
<!-- LUCIDE -->

</body>
</html>

