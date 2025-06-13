<?php
include('conexion.php');
session_start();

if (!isset($_SESSION['nombreUsuario'])) {
    header('location:../index.php');
    exit(); // Siempre es buena práctica agregar exit después de un header
}

// Obtener el ID del usuario

// Obtener los productos del carrito del usuario
$resultadoProductos = mysqli_query($conexion, "SELECT fkIdProducto FROM carrito WHERE fkIdUsuario = '$idUsuario';");


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