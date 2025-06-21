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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos pendientes</title>
</head>
<body>

    <!-- Temporal para entender algo (eliminar) -->
    <style>
        .compra{
            border: solid orange 3px;
            margin-bottom: 10px
        }
        .producto{
            border: solid black 1px;
        }
    </style>
    <div class = "producto">

    </div>
    <?php
    foreach($compras as $i=>$value){
        echo "<div class='compra'>";
            echo "Compra pendiente N°".($i+1)."<br>";
            foreach($infoCarrito[$value['idCompra']] as $i2=>$idProductos)
            {
                $resultadoProductos = mysqli_query($conexion,"SELECT * FROM producto WHERE idProducto = ".$idProductos['fkIdProducto'].";");
                while($row = $resultadoProductos->fetch_assoc()){
                    $infoProducto[] = $row;
                    echo'<div class="producto">
                        <p> Nombre: '.$row['nombre'].'</p>
                        <p> Descripción: '.$row['descripcion'].'</p>
                        <p> Precio p/unidad: $'.$row['precio'].'</p> 
                        <p> Cantidad: '.$idProductos['cantidad'].' </p>   
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