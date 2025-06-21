<?php
session_start();
include_once("conexion.php");
if(!isset($_SESSION['nombreUsuario']) || $_SESSION['admin'] == FALSE){
    header('location:../index.php');
}
if (isset($_POST['agregar'])) {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    switch($_POST['categoria']){
        case 'Vuelo':
            $categoria = intval(2);
            break;
        case 'Hospedaje':
            $categoria = intval(3);
            break;
        case 'Vehiculo':
            $categoria = intval(1);
            break;
        default:
            echo "Categoría inválida";
            break;
    }
    $precio = floatval($_POST['precio']);
    $insertar = "INSERT INTO producto (nombre, descripcion, fkIdCategoria, precio) VALUES 
        ('$nombre', '$descripcion', '$categoria', '$precio')";
    $sql = mysqli_query($conexion, $insertar);
    if ($sql) {
        echo "Producto agregado correctamente.";
    } else {
        echo "Error al agregar el producto: " . mysqli_error($conexion);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar producto</title>
</head>
<body>
    <form action="./agregarProductoCatalogo.php" method="post">
        <label for="nombre">Nombre</label><br>
        <input type="text" name="nombre" placeholder ="Ingrese el nombre" required><br>
        <label for="descripcion">Descripción</label><br>
        <textarea class="text" name="descripcion" cols="25" rows="3" placeholder = "Ingrese la descripción" required></textarea><br><br>
        <label for="categoria">Categoría</label> <br>
        <select name="categoria" required>
            <option value="Vuelo">Vuelo</option>
            <option value="Hospedaje">Hospedaje</option>
            <option value="Vehiculo">Vehículo</option>
        </select><br><br>
        <label for="precio">Precio</label> <br>
        <input type="number" name="precio" placeholder="Ingrese el precio" required><br><br>
        <input class="enviar" type="submit" value="Agregar" name="agregar">
        <a href="../index.php" class="enviar">Volver</a>
    </form>
</body>
</html>