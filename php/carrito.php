<?php
include('conexion.php');
session_start();
//Mostrar productos
$idUsuario = mysqli_query($conexion, "SELECT idUsuario FROM usuario WHERE nombre = '".$_SESSION['nombreUsuario']."';s");
$productos = mysqli_query($conexion, "SELECT fkIdProducto FROM carrito where fkIdUsuario = '".$idUsuario."'");
var_dump($productos);


//Agregar productos




//Eliminar productos


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Lista de productos en el carrito -->
    <div>

    </div>
</body>
</html>