<?php
include('conexion.php');
session_start();
if (!isset($_SESSION['nombreUsuario'])) {
    header('location:../index.php');
    exit();
}
// Obtiene los ids de los productos del carrito del usuario
$resultadoProductos =  mysqli_query($conexion, "SELECT * FROM carrito WHERE fkIdUsuario = '".$_SESSION['idUsuario']."';");
// Obtiene la información de los productos que tiene en el carrito el 
$idProductos = [];
$resultadoCarrito = $resultadoProductos->fetch_assoc();
$infoCarrito[] = $resultadoCarrito;
$resultadoInfoProductos = mysqli_query($conexion, "SELECT * FROM producto WHERE idProducto=".intval($resultadoCarrito['fkIdProducto']).";");
$infoProductos[] = $resultadoInfoProductos->fetch_assoc();
while ($row = $resultadoProductos->fetch_assoc()) {
    $idProductos[] = $row;
    $resultadoInfoProductos = mysqli_query($conexion, "SELECT * FROM producto WHERE idProducto=".intval($row['fkIdProducto']).";");
    $infoProductos[] = $resultadoInfoProductos->fetch_assoc();
    $infoCarrito[] = $row;
}
$precioTotal = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
</head>
<body>
    <!-- Lista de productos en el carrito -->
    <div>
        <?php
        if(count($infoProductos) > 0){
            echo '<form action="./eliminarProductoCarrito.php" method="post" class="formularioProductos">';
            foreach($infoProductos as $i=>$val)
            {
                $precioTotal += $infoCarrito[$i]['precioTotal'];
                echo "<div class='producto'>";
                    echo '<input type="checkbox" id="producto'.$infoProductos[$i]['idProducto'].'" name="producto[]" value="'.$infoProductos[$i]['idProducto'].'">
                    <label for="producto'.$infoProductos[$i]['idProducto'].'" class="menu">
                    <p class="soloquieto">' . $infoProductos[$i]['nombre'] . '</p>
                    <p>' . $infoProductos[$i]['descripcion'] . '</p>
                    <p>$' . $infoProductos[$i]['precio'] . ' </p>';
                    if($infoProductos[$i]['fkIdCategoria'] == 2){
                        echo '<p> Vuelos: ' . $infoCarrito[$i]['cantidad']. '</p>
                        <p>Precio total p/vuelos: $'. $infoCarrito[$i]['precioTotal'].'</p>
                        </label>';
                    }else{
                        echo '<p>Dias de alquiler: ' . $infoCarrito[$i]['cantidad']. '</p>
                        <p>Precio total p/dias: $'. $infoCarrito[$i]['precioTotal'].'</p>
                        </label>';
                    }
                echo "</div>";
            }
            echo "<p>Subtotal carrito: $".$precioTotal."</p>";
            echo '<input type="submit" name="eliminar" class="eliminar" value="Eliminar">';
            echo "</form>";
        }else{
            echo "No hay productos en el carrito";
        }
    ?>
    </div>
</body>
</html>