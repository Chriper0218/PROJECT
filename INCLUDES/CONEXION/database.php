<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_arepamania";

$CONEXION = mysqli_connect (
    $servername,
    $username,
    $password,
    $dbname
);

if($CONEXION -> connect_error){ 
    echo"<script>alert('Error de conexion');</script>";
    }
?>