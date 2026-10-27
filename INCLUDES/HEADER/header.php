<?php
include("../../INCLUDES../CONEXION/database.php");
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
    color:rgb(221, 170, 1);
}

.nav-links a[aria-current="page"] {
    color:rgb(221, 170, 1);
    font-weight:bold;
}

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

.modal--show {
    opacity: 1;
    pointer-events: auto;
    visibility: visible;}

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

/* CONTENEDOR PRINCIPAL */
.container-all {
    width: 100%;
    max-width: 850px;
    max-height: 90vh;
    overflow-y: auto;
    background-color: #ffffff;
    border: 2px solid rgb(221, 170, 1);
    border-radius: 15px;
    box-shadow: 0 10px 35px rgba(0, 0, 0, 0.4);
    animation: aparecer 0.3s ease;
}

/* ENCABEZADO */
.container-top-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    padding: 25px 30px;
    background-color: rgb(13, 13, 13);
    border-bottom: 3px solid rgb(221, 170, 1);
    border-radius: 12px 12px 0 0;
}

/* INFORMACIÓN DEL ENCABEZADO */
.informacion-header {
    display: flex;
    align-items: center;
    gap: 18px;
}

/* FOTO DEL USUARIO */
.informacion-header > img {
    width: 75px;
    height: 75px;
    padding: 8px;
    object-fit: contain;
    background-color: white;
    border: 3px solid rgb(221, 170, 1);
    border-radius: 50%;
}

/* NOMBRE Y ROL */
.nombe h2 {
    color: white;
    font-size: 23px;
    margin-bottom: 7px;
}

.nombe p {
    color: rgb(221, 170, 1);
    font-size: 15px;
    font-weight: 600;
}

/* LOGO DE AREPAMANIA */
.container-top-header > img {
    width: 110px;
    max-height: 80px;
    object-fit: contain;
}

/* PARTE INFERIOR */
.container-bottom {
    padding: 25px;
    background-color: #ffffff;
}

/* CONTENEDOR DE INFORMACIÓN */
.container-informacion_usuario {
    width: 100%;
    padding: 22px;
    border: 1px solid #e2e2e2;
    border-radius: 12px;
    background-color: #ffffff;
}

/* TÍTULO DE DATOS PERSONALES */
.container-informacion_usuario .top {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 25px;
}

/* ICONO DEL TÍTULO */
.container-informacion_usuario .top img {
    width: 28px;
    height: 28px;
    object-fit: contain;
}

/* TEXTO DEL TÍTULO */
.container-informacion_usuario .top h3 {
    font-size: 20px;
    color: rgb(20, 20, 20);
    white-space: nowrap;
}

/* LÍNEA DECORATIVA */
.container-informacion_usuario .top hr {
    flex: 1;
    border: none;
    height: 2px;
    background-color: rgb(221, 170, 1);
    margin-left: 8px;
}

/* DISTRIBUCIÓN DE LOS DATOS */
.container-datos {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 18px;
}

/* TARJETAS DE INFORMACIÓN */
.target-modal {
    display: flex;
    align-items: center;
    gap: 15px;
    min-width: 0;
    padding: 16px;
    background-color: #f8f8f8;
    border: 1px solid #eeeeee;
    border-radius: 10px;
    transition: background-color 0.2s ease,
                border-color 0.2s ease;
}

/* EFECTO AL PASAR EL CURSOR */
.target-modal:hover {
    background-color: #fffaf0;
    border-color: rgb(221, 170, 1);
}

/* ICONOS DE LOS DATOS */
.target-modal > img {
    width: 35px;
    height: 35px;
    flex-shrink: 0;
    object-fit: contain;
    padding: 6px;
    background-color: #ffffff;
    border-radius: 50%;
}

/* CONTENEDOR DEL TEXTO */
.target-modal > div {
    min-width: 0;
}

/* ETIQUETAS */
.target-modal p:first-child {
    color: #555555;
    font-size: 13px;
    margin-bottom: 6px;
}

/* INFORMACIÓN DEL USUARIO */
.target-modal p:last-child {
    color: #171717;
    font-size: 14px;
    overflow-wrap: anywhere;
}

/* ANIMACIÓN */
@keyframes aparecer {
    from {
        opacity: 0;
        transform: translateY(-15px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* RESPONSIVE PARA TABLETS */
@media (max-width: 650px) {
    .container-all {
        max-height: 95vh;
    }

    .container-top-header {
        padding: 20px;
    }

    .informacion-header > img {
        width: 60px;
        height: 60px;
    }

    .nombe h2 {
        font-size: 19px;
    }

    .container-top-header > img {
        width: 85px;
    }

    .container-bottom {
        padding: 15px;
    }

    .container-informacion_usuario {
        padding: 15px;
    }

    .container-datos {
        grid-template-columns: 1fr;
        gap: 12px;
    }
}

/* RESPONSIVE PARA CELULARES */
@media (max-width: 380px) {
    .container-top-header {
        padding: 15px;
        gap: 10px;
    }

    .informacion-header {
        gap: 10px;
    }

    .informacion-header > img {
        width: 48px;
        height: 48px;
    }

    .nombe h2 {
        font-size: 16px;
    }

    .nombe p {
        font-size: 12px;
    }

    .container-top-header > img {
        width: 65px;
    }

    .container-informacion_usuario .top h3 {
        font-size: 16px;
    }

    .target-modal {
        padding: 12px;
        gap: 10px;
    }
}
/* MODAL */

</style>
</head>
<body>

<!-- HEADER -->
    <header>
        <nav class="main-nav" aria-label="Navegación principal">
            <a href="../INICIO/index.php"><img src="../../MEDIA/logo.png"alt="Logo de ArepaMania" id="logoheader"></a>

            <ul class="nav-links" id="navlinks">

                <li><a href="../../PAGINA-USUARIOS/INICIO/index.php" <?php if ($pagina_actual == 'index.php') echo 'aria-current="page"'; ?>>
                Inicio</a></li>

                <li><a href="../../PAGINA-USUARIOS/MENU/menu.php"<?php if ($pagina_actual == 'menu.php') echo 'aria-current="page"'; ?>>
                Menú</a></li>

                <li><a href="../../PAGINA-USUARIOS/PEDIDOS/pedidos.php"<?php if ($pagina_actual == 'pedidos.php') echo 'aria-current="page"'; ?>>
                Pedidos</a></li>

                <li><a href="../../PAGINA-USUARIOS/NOSOTROS/nosotros.php"<?php if ($pagina_actual == 'nosotros.php') echo 'aria-current="page"'; ?>>
                Nosotros</a></li>

                <li><a href="../../PAGINA-USUARIOS/CONTACTO/contacto.php"<?php if ($pagina_actual == 'contacto.php') echo 'aria-current="page"'; ?>>
                Contacto</a></li>
            </ul>

            <div class="right-header">
                <div class="header-icons">
                    <a href="../PEDIDOS/pedidos.php" aria-label="Carrito de compras"><img src="../../MEDIA/shopping-cart.png" alt="Carrito de compras"></a>
                    <a href="#" id="btn-usuario" aria-label="Mi usuario"><img src="../../MEDIA/user.png" alt="Usuario"></a>
                    <button class="menu-btn" id="menu-btn" type="button" aria-label="Abrir menú" aria-expanded="false" aria-controls="navlinks"> ☰</button>
                </div>

                <form action="../REGISTRO/singup.php"><button type="submit" id="button-header"><b>INICIAR SESIÓN</b></button></form>
            </div>
        </nav>
    </header>
    <!-- HEADER -->


<!-- VENTANA MODAL -->
<section class="modal" id="modal-usuario">
    <div class="container-all">

        <div class="container-top-header">
            <div class="informacion-header">
                <img src="../../MEDIA/user.png" alt="imagen-usuario">

                <div class="nombe">
                    <h2>
                        <?php echo htmlspecialchars($USER['NAME_USER'] ?? 'Usuario'); ?>
                    </h2>

                    <p>
                        <?php echo htmlspecialchars($USER['ROL'] ?? ''); ?>
                    </p>
                </div>
            </div>

            <img src="../../MEDIA/NOSOTROS/loguito.png" alt="logo de arepamania">
        </div>

        <div class="container-bottom">
            <div class="container-informacion_usuario">

                <div class="top">
                    <img src="../../MEDIA/user.png" alt="logo de usuario">
                    <h3>Datos personales</h3>
                    <hr>
                </div>

                <div class="container-datos">

                    <div class="target-modal">
                        <img src="../../MEDIA/MODAL/user.png" alt="usuario">

                        <div>
                            <p><b>Usuario:</b></p>
                            <p>
                                <?php echo htmlspecialchars($USER['NAME_USER'] ?? ''); ?>
                            </p>
                        </div>
                    </div>

                    <div class="target-modal">
                        <img src="../../MEDIA/MODAL/mail.png" alt="correo">

                        <div>
                            <p><b>Correo electrónico:</b></p>
                            <p>
                                <?php echo htmlspecialchars($USER['EMAIL_USER'] ?? ''); ?>
                            </p>
                        </div>
                    </div>

                    <div class="target-modal">
                        <img src="../../MEDIA/MODAL/phone.png" alt="teléfono">

                        <div>
                            <p><b>Número telefónico:</b></p>
                            <p>
                                <?php echo htmlspecialchars($USER['NUMBER_USER'] ?? ''); ?>
                            </p>
                        </div>
                    </div>

                    <div class="target-modal">
                        <img src="../../MEDIA/MODAL/crown.png" alt="rol">

                        <div>
                            <p><b>Rol:</b></p>
                            <p>
                                <?php echo htmlspecialchars($USER['ROL'] ?? ''); ?>
                            </p>
                        </div>
                    </div>

                    <div class="target-modal">
                        <img src="../../MEDIA/MODAL/calendar-days.png" alt="fecha de registro">

                        <div>
                            <p><b>Fecha de registro:</b></p>
                            <p>
                                <?php
                                echo !empty($USER['FECHA_REGISTRO'])
                                    ? date('d/m/Y', strtotime($USER['FECHA_REGISTRO']))
                                    : 'No disponible';
                                ?>
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div style="text-align:center; margin-bottom:2%;">
            <button type="button" class="modal__close" id="cerrar-modal">
                Cerrar
            </button>

            <button type="button" class="modal__close" id="cerrar-sesion">
                Cerrar sesión
            </button>
        </div>

    </div>
</section>
<!-- VENTANA MODAL -->


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

            /* Cerrar menú con Escape */
            document.addEventListener("keydown", function (evento) {
                if (evento.key === "Escape") {
                    enlacesMenu.classList.remove("active");
                    botonMenu.textContent = "☰";
                    botonMenu.setAttribute("aria-expanded", "false");
                    modal.classList.remove("modal--show");
                }
            });

            /* Modal de usuario */
            const modal = document.getElementById("modal-usuario");
            const botonUsuario = document.getElementById("btn-usuario");
            const cerrarModal = document.getElementById("cerrar-modal");

            modal.addEventListener("click", function (evento) {
            if (evento.target === modal) {
            cerrarModal();
            }
            });

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
        });
    </script>

<script src="https://unpkg.com/lucide@latest"></script>
    <script>
    lucide.createIcons();
</script>

</body>
</html>


