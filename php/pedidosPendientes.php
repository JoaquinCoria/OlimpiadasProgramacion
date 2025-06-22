<?php
    session_start();
    include_once('conexion.php');
    if(!isset($_SESSION['nombreUsuario'])){
        header('location:./login.php');
    }
    $query = "SELECT * FROM compra WHERE fkIdUsuario =".$_SESSION['idUsuario']." && estado = 'Pendiente';";
    $resultadoCompra = mysqli_query($conexion,$query);
    while ($row = $resultadoCompra->fetch_assoc()) {
        $compras[] = $row;
        $resultadoInfoCarrito = mysqli_query($conexion, "SELECT * FROM carrito WHERE fkIdCompra=".intval($row['idCompra']).";");
        while($row2 = $resultadoInfoCarrito->fetch_assoc()){
            $infoCarrito[$row['idCompra']][] = $row2;
        }
    }   
    if($compras == NULL){
        echo "<script>alert('No se encontraron pedidos pendientes'); window.location = '../index.php'</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/pedidosPendientes.css">
    <title>Pedidos pendientes</title>
</head>
<body>
    <a href="../index.php">
        Volver
    </a>
    <?php
    foreach($compras as $i=>$value){
        echo "<div class='compra'>";
            echo "<h2>Compra pendiente N°".($i+1)."</h2>";
            foreach($infoCarrito[$value['idCompra']] as $i2=>$idProductos)
            {
                $resultadoProductos = mysqli_query($conexion,"SELECT * FROM producto WHERE idProducto = ".$idProductos['fkIdProducto'].";");
                while($row = $resultadoProductos->fetch_assoc()){
                    $infoProducto[] = $row;
                    echo'<div class="producto">
                        <p><b> Nombre: </b>'.$row['nombre'].'</p>
                        <p><b> Descripción:</b> '.$row['descripcion'].'</p>
                        <p><b>Precio p/unidad:</b>$'.$row['precio'].'</p> 
                        <p><b>Cantidad: </b>'.$idProductos['cantidad'].' </p>   
                        <p> Precio total del producto: $'.$idProductos['precioTotal'].' </p>  
                    </div>
                    ';
                }
            }
            echo '<p> Precio total del pedido: $'.$value['precioTotal'].'</p>';
            echo '<form action="eliminarPedidoPendiente.php" method="post">
                <button type = "submit" name = "eliminar" value = "'.$value['idCompra'].'">Eliminar pedido</button>
            </form>';
            echo '<form action="modificarPedidoPendiente.php" method="post">
                <button type = "submit" name = "modificar" value = "'.$value['idCompra'].'">Modificar pedido</button>
            </form>';
        echo "</div>";
    }
    ?>
</body>
</html>