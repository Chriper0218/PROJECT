<?php 
$CONN = mysqli_connect(
"localhost",
"root",
"",
"db_arepamania",
);

if($CONN -> connect_error){ 
    echo"<script>alert('Error de conexion');</script>";
    }
?>