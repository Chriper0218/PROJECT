<?php 
include("../../INCLUDES../HEADER/header.php")
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
<!-- PEDIDOS -->
    <div class="container-dad">
        <h1>TU PEDIDO</h1> <br> 
        <div class="container-pedidos">
            <div class="container-productos">
                <div class="container-img-p">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRKq_xNoXL1lld2ScLa7xET3fQG96FqVzHwErOptjg4VpSH6_IRe70W5AE&s=10" alt="producto">
                    <p></b>Arepa sencilla</b> <br> <br> $12.000</p>
                </div>
                    <table>
                        <tr>
                            <th><button>-</button></th>
                            <th><button id="button-none">2</button></th>
                            <th><button>+</button></th>
                        </tr>
                    </table>
                <p>$24.000</p>
                <a href=""><i data-lucide="trash"></i></a>
            </div>

            <div class="factura">
                <h2>RESUMEN DEL PEDIDO</h2> <br> <br>
                <div class="div-p"><p>subtotal:</p> <p>$44.000</p></div> <br>
                <div class="div-p"><p>domicilio:</p> <p>$5.000</p></div> <br>
                <hr> <br>
                <h2>TOTAL:</h2> <br>
                <p><b>$49.000</b></p>
                <br> <br>

                    <div id="container-buttons">
                        <form action=""><button class="button-yellow">Confimar pedido</button></form>
                       <form action="../MENU/menu.php"><button class="button-seguir-comprando" >Seguir comprando</button></form>
                    </div>

            </div>  
        </div>

        <form action="..MENU/menu.php"><button class="button-seguir-comprando">Seguir comprando</button></form>
        
    </div>
<!-- PEDIDOS -->

<!-- FOOTER -->
    <?php 
        include("../../INCLUDES../FOOTER/footer.php")
    ?>
<!-- FOOTER -->


<!-- LUCIDE -->
    <script src="https://unpkg.com/lucide@latest"></script>
        <script>
        lucide.createIcons();
    </script>
<!-- LUCIDE -->
</body>
</html>