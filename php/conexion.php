<?php
    $servidor = "localhost";
    $usuario = "root";
    $password = "";
    $basedatos = "e-commerce";
    $conexion = mysqli_connect($servidor,$usuario,$password,$basedatos);
    if(!$conexion)
    {
        die("Conexión fallida: " . mysqli_connect_error());
    }
?>