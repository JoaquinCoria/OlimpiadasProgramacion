<?php
include('conexion.php');
session_start();

if (!isset($_SESSION['nombreUsuario'])) {
    header('location:../index.php');
    exit();
}
// Obtiene los ids de los productos del carrito del usuario
$resultadoProductos =  mysqli_query($conexion, "SELECT fkIdProducto FROM carrito WHERE fkIdUsuario = '".$_SESSION['idUsuario']."';");

// Obtiene la información de los productos que tiene en el carrito el usuario
$idProductos = [];
while ($row = $resultadoProductos->fetch_assoc()) {
    $idProductos[] = $row;
    $resultadoInfoProductos = mysqli_query($conexion, "SELECT * FROM producto WHERE idProducto=".intval($row['fkIdProducto']).";");
    $infoProductos[] = $resultadoInfoProductos->fetch_assoc();
}


//Muestra los datos de los 

if (mysqli_num_rows($resultadoProductos) > 0){
    echo '<form action="./eliminarProductoCarrito.php" method="post" class="formularioProductos">';
    foreach($infoProductos as $i=>$val)
    {
        echo "<div class='producto'>";
            echo '<input type="checkbox" id="producto'.$infoProductos[$i]['idProducto'].'" name="producto[]" value="'.$infoProductos[$i]['idProducto'].'">
            <label for="producto'.$infoProductos[$i]['idProducto'].'" class="menu">
            <p class="soloquieto">' . $infoProductos[$i]['nombre'] . '</p>
            <p>' . $infoProductos[$i]['descripcion'] . '</p>
            <p>' . $infoProductos[$i]['precio'] . ' </p>
            </label>';
        echo "</div>";
    }
    echo '<input type="submit" name="eliminar" class="eliminar" value="Eliminar">';
echo "</form>";
}else{
    echo "No hay productos en el carrito";
}
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