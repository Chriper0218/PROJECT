<?php 
include("../HEADER/header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArepaMania</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- NUESTRA INFORMACION -->
<div class="container-dad">
    <div class="container-top">

    <!--TARGETAS-->   
        <div class="informacion">
            <h2>Nuestra informacion</h2> <br>
            <div class="target-informacion">
                <i data-lucide="map-pin"></i>
                <div>
                    <p><b>Direccion</b></p>
                    <p>cra 6b#73c-38</p>
                </div>
            </div> <br>

            <div class="target-informacion">
                <i data-lucide="phone"></i>
                <div>
                    <p><b>Telefono</b></p>
                    <p>+57 300 670 8304</p>
                </div>
            </div> <br>

            <div class="target-informacion">
                <i data-lucide="mail"></i>
                <div>
                    <p><b>Correo electronico</b></p>
                    <p>arepamania02@gmail.com</p>
                </div>
            </div> <br>

            <div class="target-informacion">
                <i data-lucide="clock"></i>
                <div>
                    <p><b>Horario</b></p>
                    <p>fines de semana 6:00 pm - 11:00 pm</p>
                </div>
            </div> <br>
    <!--TARGETAS-->

            <div class="target-informacion-siguenos">
                <h3>siguenos</h3> <br>
                <a href=""><img src="images/facebook.png" alt="facebook"></a>
                <a href=""><img src="images/instagram.png" alt="instagram"></a>
                <a href=""><img src="images/whatsapp.png" alt="whatsapp"></a>
                <p>@ArepaMania</p>
            </div>
        </div>
<!-- NUESTRA INFORMACION -->


    <!-- MENSAJE -->
        <div class="mensaje">
            <h2>Envianos un mensaje</h2> <br>
            <form action="">
                <input type="text" minlength="10" maxlenght="255" placeholder="Ingresa tu nombre" required name="NOMBRE"> <br> <br>
                <input type="email" maxlength="255" placeholder="Ingresa tu correo electronico" required name="EMAIL" > <br> <br>
                <input type="text" maxlength="16" placeholder="Numero telefonico" required name="NUMERO"> <br> <br>
                <input type="text" placeholder="Escribenos un mensaje" id="input-mensaje"> <br> <br>
                <button type="submit" id="button-mensaje"><b>Enviar</b></button>   
            </form>
        </div>

    </div>
<!-- MENSAJE -->

<!-- MAP -->
    <div class="container-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d979.2859057426092!2d-74.80452623038266!3d10.952521716002144!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8ef5d2b589f05255%3A0x7e7771286c8f3946!2sCra.%2010b%20%2350-19%2C%20Metropolitana%2C%20Barranquilla%2C%20Atl%C3%A1ntico!5e0!3m2!1sen!2sco!4v1791217522460!5m2!1sen!2sco" width="90%" height="300" style="border:1px solid black;" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
    </div>
<!-- MAP -->
</div>

<?php 
include("../FOOTER/footer.php")
?>

<!-- FOOTER -->
<script src="https://unpkg.com/lucide@latest"></script>
    <script>
    lucide.createIcons();
</script>
<!-- FOOTER -->

</body>
</html>