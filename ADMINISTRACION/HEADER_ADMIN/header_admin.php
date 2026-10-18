<?php
include("../INCLUDES../CONEXION/database.php");
session_start();
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
header {
    position: relative;
    z-index: 1000;}

.main-nav {
    min-height: 100px;
    width: 100%;
    padding: 0 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    background-color: rgb(13, 13, 13);}

#logoheader {
    display: block;
    width: 120px;
    height: auto;}

.nav-links {
    display: flex;
    align-items: center;
    gap: 8px;
    list-style: none;}

.nav-links a {
    display: block;
    color: white;
    text-decoration: none;
    padding: 10px;
    font-size: 20px;
    transition: color 0.3s ease;}

.nav-links a:hover {
    color:rgb(221, 170, 1);}

.nav-links a[aria-current="page"] {
    color:rgb(221, 170, 1);
    font-weight:bold;}

.menu-btn {
    display: none;
    background: transparent;
    color: rgb(255,255,255);
    border: none;
    font-size: 32px;
    cursor: pointer;
    line-height: 1;
    padding: 8px;}

.right-header {
    display: flex;
    align-items: center;
    gap: 25px;}

.header-icons {
    display: flex;
    align-items: center;
    gap: 18px;}

.right-header img {
    display: block;
    width: 30px;
    height: 30px;
    object-fit: contain;}

#button-header {
    background-color: rgb(221, 170, 1);
    color: black;
    border: none;
    width: 150px;
    min-height: 45px;
    padding: 8px;
    font-size: 14px;
    border-radius: 5px;
    cursor: pointer;
    transition: transform 0.2s ease,
                background-color 0.2s ease;}

#button-header:hover {
    background-color: black;
    color: white;
    outline: 1px solid white;
    transform: scale(1.03);}

#p-admin {
    font-size:20px;
    color:rgb(255,255,255);
}

/* RESPONSIVE */
@media (max-width: 1000px) {
    .main-nav {
        min-height: 80px;
        padding: 0 15px;
        gap: 10px;}

    #logoheader {
        width: 100px;}

    .menu-btn {
        display: block;
        order: 2;}

    .right-header {
        gap: 12px;
        order: 3;}

    .header-icons {
        gap: 12px;}

    .right-header img {
        width: 25px;
        height: 25px;}

    #button-header {
        display: none;}

    .nav-links {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: stretch;
        gap: 0;
        background-color: rgb(13, 13, 13);
        max-height: 0;
        overflow: hidden;
        visibility: hidden;
        opacity: 0;
        transition: max-height 0.35s ease,
                    opacity 0.25s ease,
                    visibility 0.35s ease;}

    .nav-links.active {
        max-height: 400px;
        visibility: visible;
        opacity: 1;
        padding: 10px 0;}

    .nav-links li {
        width: 100%;
        text-align: center;}

    .nav-links a {
        padding: 15px;
        font-size: 18px;}
    }

@media (max-width: 380px) {
    .main-nav {
        padding: 0 10px;}

    #logoheader {
        width: 80px;}

    .right-header {
        gap: 8px;}

    .header-icons {
        gap: 8px;}

    .right-header img {
        width: 22px;
        height: 22px;}

    .menu-btn {
        font-size: 27px;
        padding: 5px;}
    }

/* MODAL */
.modal {
    position: fixed;
    inset: 0;
    z-index: 2000;
    background-color: rgba(0, 0, 0, 0.53);
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 15px;
    opacity: 0;
    pointer-events: none;
    visibility: hidden;
    transition: opacity 0.3s ease,
                visibility 0.3s ease;}

.container-ventana {
    background-color: white;
    color: black;
    border: 1px solid white;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
    width: 90%;
    max-width: 500px;
    max-height: 90vh;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 15px;
    align-items: center;}

.modal--show {
    opacity: 1;
    pointer-events: auto;
    visibility: visible;}

.container-ventana-informacion {
    background-color: rgba(56, 56, 56, 0.16);
    padding: 15px;
    border-radius: 10px;
    border: 1px solid gray;
    width: 100%;}

.modal__close {
    display: inline-block;
    color: black;
    background-color: rgba(196, 10, 10, 0.62);
    min-width: 150px;
    padding: 8px;
    border-radius: 5px;
    border: 1px solid rgb(153, 35, 19);
    text-align: center;
    font-size: 16px;
    cursor: pointer;
    text-decoration: none;}

</style>
</head>
<body>

<!-- HEADER -->
    <header>
        <nav class="main-nav" aria-label="Navegación principal">
            <a href="../INICIO/index.php"><img src="HEADER_IMAGENES/logo.png"alt="Logo de ArepaMania"id="logoheader"></a>

            <ul class="nav-links" id="navlinks">

                <li><a href="#" <?php if ($pagina_actual == 'index.php') echo 'aria-current="page"'; ?>>
                Productos</a></li>

                <li><a href="#"<?php if ($pagina_actual == 'menu.php') echo 'aria-current="page"'; ?>>
                Inventario</a></li>

                <li><a href="#"<?php if ($pagina_actual == 'pedidos.php') echo 'aria-current="page"'; ?>>
                Usuarios</a></li>

                <li><a href="#"<?php if ($pagina_actual == 'nosotros.php') echo 'aria-current="page"'; ?>>
                Pedidos</a></li>

                <li><a href="#"<?php if ($pagina_actual == 'contacto.php') echo 'aria-current="page"'; ?>>
                Tareas</a></li>
            </ul>

            <div class="right-header">
                <div class="header-icons">
                    <p id="p-admin">Admistrador</p>
                    <button class="menu-btn" id="menu-btn" type="button" aria-label="Abrir menú" aria-expanded="false" aria-controls="navlinks"> ☰</button>
                    <a href="#" id="btn-usuario" aria-label="Mi usuario"><img src="HEADER_IMAGENES/user.png" alt="Usuario"></a>
                </div>
            </div>

        </nav>
    </header>
    <!-- HEADER -->


<!-- VENTANA MODAL -->
    <section class="modal" id="modal-usuario">
        <div class="container-ventana">
            <h2>Hola, Juan</h2>
            <p>Aquí puedes ver y gestionar tu información.</p>

            <div class="container-ventana-informacion">
                <div style="display:flex; gap:5px; align-items:center;">
                    <i data-lucide="user"></i>
                    <h3>Información personal</h3>
                </div>

                <br>

                <p>Nombre completo: Juan Perez</p>
                <br>
                <p>Correo electrónico: juanperez262215@gmail.com</p>
                <br>
                <p>Teléfono: 3006708304</p>
            </div>

            <div>
                <button type="button" class="modal__close"
                        id="cerrar-modal">
                    Cerrar
                </button>

                <button type="button" class="modal__close"
                        id="cerrar-sesion">
                    Cerrar sesión
                </button>
            </div>
        </div>
    </section>
<!-- VENTANA MODAL -->

<!-- MENU -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const botonMenu = document.getElementById("menu-btn");
            const enlacesMenu = document.getElementById("navlinks");

            botonMenu.addEventListener("click", function () {
                const abierto = enlacesMenu.classList.toggle("active");

                botonMenu.textContent = abierto ? "✕" : "☰";
                botonMenu.setAttribute("aria-expanded", String(abierto));
                botonMenu.setAttribute(
                    "aria-label",
                    abierto ? "Cerrar menú" : "Abrir menú"
                );
            });

            enlacesMenu.querySelectorAll("a").forEach(function (enlace) {
                enlace.addEventListener("click", function () {
                    enlacesMenu.classList.remove("active");
                    botonMenu.textContent = "☰";
                    botonMenu.setAttribute("aria-expanded", "false");
                    botonMenu.setAttribute("aria-label", "Abrir menú");
                });
            });

            /* Modal de usuario */
            const modal = document.getElementById("modal-usuario");
            const botonUsuario = document.getElementById("btn-usuario");
            const cerrarModal = document.getElementById("cerrar-modal");

            botonUsuario.addEventListener("click", function (evento) {
                evento.preventDefault();
                modal.classList.add("modal--show");
            });

            cerrarModal.addEventListener("click", function () {
                modal.classList.remove("modal--show");
            });

            modal.addEventListener("click", function (evento) {
                if (evento.target === modal) {
                    modal.classList.remove("modal--show");
                }
            });

            /* Cerrar menú con Escape */
            document.addEventListener("keydown", function (evento) {
                if (evento.key === "Escape") {
                    enlacesMenu.classList.remove("active");
                    botonMenu.textContent = "☰";
                    botonMenu.setAttribute("aria-expanded", "false");
                    modal.classList.remove("modal--show");
                }
            });
        });
    </script>
<!-- MENU -->

<script src="https://unpkg.com/lucide@latest"></script>
    <script>
    lucide.createIcons();
</script>

</body>
</html>