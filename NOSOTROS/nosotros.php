<?php 
include("../HEADER/header.php")
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArepaMania</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

<!-- SOBRE NOSOTROS-->
    <div class="container-nosotros">
        <div class="container-items-nosotros">
            <h2>Sobre nosotros</h2>
            <h1>
                <b>NUESTRA PASION</b> <br>
                <b>ES LA AREPA</b>
            </h1>
            <p id="p-nosotros">
                En ArepaMania creemos que la comida <br>
                no solo se disfruta, se comparte. somos un <br>
                emprendimiento dedicado a llevar el autentico <br>
                sabor colombiano en cada arepa, perro y mas, <br>
                con ingredientes frescos, de la mejor calidad <br>
                y mucho amor.
            </p>
        </div>
    </div>
<!-- SOBRE NOSOTROS-->


<!-- DEFINICIONES ICONOS -->
<div class="container-dad">
    <div class="container-definicion">
        <div class="container-target">

            <div class="target">
                <i data-lucide="chef-hat"></i>
                <p><b>Sabor autentico</b></p> <br>
                <p>
                    Recetas tradicionales <br> 
                    con el toque unico de <br>
                    ArepaMania
                </p>
            </div>

            <div class="target">
                <i data-lucide="leaf"></i>
                <p><b>Ingredientes</b></p> <br>
                <p>
                    Selecionamos lo mejor <br> 
                    para que cada bocado <br>
                    sea especial
                </p>
            </div>

            <div class="target">
                <i data-lucide="heart"></i>
                <p><b>Pasion</b></p> <br>
                <p>
                    Cada arepa y perro es <br> 
                    preparado con dedicacion <br>
                    y mucho amor
                </p>
            </div>

            <div class="target">  
                <i data-lucide="users"></i>
                <p><b>Tu satisfacion</b></p> <br> 
                <p>
                    Nos importa que disfrutes <br> 
                    cada experiencia con <br>
                    nosotros
                </p>
            </div>
        </div>
    </div>
<!-- DEFINICIONES ICONOS -->


    <div class="container-bottom-definicion">
    <!-- DEFINICION BOTTOM -->
        <div class="container-bottom-definicion-items">
            <div>   
                <h3>Mas que comida <br> es una tradicion</h3> <br>  
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium veritatis pariatur quidem enim. Adipisci ipsum voluptate autem, alias ea reiciendis accusamus, eveniet pariatur  animi est unde repellendus sequi consequuntur doloribus?</p>
            </div>
        </div>
    <!-- DEFINICION BOTTOM -->

    <!-- IMG -->
        <div class="container-img">
            <img src="images/backgroundmin.jpg" alt="imagen-comida" id="imagen-bottom-definicion">
        </div>
    <!-- IMG -->
    </div>
</div>


<!--FOOTER-->
    <?php 
        include("../FOOTER/footer.php");
    ?>
<!--FOOTER-->


<!-- LUCIDE -->
    <script src="https://unpkg.com/lucide@latest"></script>
        <script>
        lucide.createIcons();
    </script>
<!-- LUCIDE -->

</body>
</html>