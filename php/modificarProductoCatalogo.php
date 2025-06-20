<?php
    session_start();
    include_once('conexion.php');
    if($_SESSION['admin'] == FALSE || !isset($_POST['producto'])){
        //header('location:../index.php');
    }
    $informacionProducto = mysqli_query($conexion, "SELECT * FROM producto WHERE idProducto = ".$_POST['producto'].";")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto vendedor</title>
</head>
<body>
    <div class="container">
        <?php echo '
        <div class="tarjetaProducto">
            <h1>'.$informacionProducto["nombre"].'</h1>
            <p>'.$informacionProducto["descripcion"].'</p>
            ';
            echo '<p>Precio: $'.$informacionProducto['precio'].'</p>
        </div>
        ';?>
        <form action="modificarProductoCatalogo.php" method="post">
            <input type="submit" name="btnVendedor" value="Modificar">
            <input type="submit" name="btnVendedor" value="Eliminar">
        </form>
    </div>
</body>
</html>