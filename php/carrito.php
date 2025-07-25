<?php
include('conexion.php');
session_start();
if (!isset($_SESSION['nombreUsuario'])) {
    header('location:../index.php');
    exit();
}
if($_SESSION['admin'] == TRUE){
    header('location:../index.php');
    exit();
}

// Obtiene los ids de los productos del carrito actual del usuario
$resultadoProductos =  mysqli_query($conexion, "SELECT * FROM carrito WHERE fkIdUsuario = ".$_SESSION['idUsuario']." && fkIdCompra IS NULL;");
// Obtiene la información de los productos que tiene en el carrito el 
$resultadoCarrito = $resultadoProductos->fetch_assoc();
if($resultadoCarrito!=NULL){
    $idProductos = [];  
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
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/carrito.css">
    <title>Carrito</title>
</head>
<body>
    <!-- Lista de productos en el carrito -->
    <div>
        <?php
        if($resultadoCarrito!=NULL){
            echo '<form action="./eliminarProductoCarrito.php" method="post" class="formularioProductos">';
            foreach($infoProductos as $i=>$val)
            {
                $precioTotal += $infoCarrito[$i]['precioTotal'];
                echo "<div class='producto'>";
                    echo '<input type="checkbox" id="producto'.$infoCarrito[$i]['idCarrito'].'" name="producto[]" value="'.$infoProductos[$i]['idProducto'].'">
                    <label for="producto'.$infoCarrito[$i]['idCarrito'].'" class="menu">
                    <p class="soloquieto">' . $infoProductos[$i]['nombre'] . '</p>
                    <p>' . $infoProductos[$i]['descripcion'] . '</p>
                    <p>$' . $infoProductos[$i]['precio'] . ' </p>
                    <p>Fecha inical: '. $infoCarrito[$i]['fechaInicial'].'</p>';
                    if($infoCarrito[$i]['fechaFinal'] != NULL){
                        echo '<p>Fecha final: '. $infoCarrito[$i]['fechaFinal'].'</p>';
                    }
                    
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
            $_SESSION['precioCarrito'] = $precioTotal;
            $_SESSION['productosCarrito'] = $infoProductos;
            $_SESSION['informacionCarrito'] = $infoCarrito;
            ?>
            <form action="insertarCompra.php" method="post">
                <input type="submit" name="pedido" value="Realizar pedido">
            </form>
            <?php
            
        }else{
            echo "No hay productos en el carrito";
        }
        
    ?>
    <a href="../index.php">Volver</a>
    </div>
</body>
</html>