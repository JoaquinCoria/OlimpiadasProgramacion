<?php
    session_start();
    include_once('conexion.php');
    if(!isset($_SESSION)){
        header('location:../index.php');
    }
    if($_SESSION['admin'] == FALSE){
        header('location:../index.php');
    }
    $resultadoPendientes = mysqli_query($conexion, "SELECT * FROM Compra WHERE estado = 'Pendiente'");
    while($row = $resultadoPendientes->fetch_assoc()){
        $pedidosPendientes[] = $row; 
        $resultadoUsuario = mysqli_query($conexion, "SELECT * FROM usuario WHERE idUsuario = ".$row['fkIdUsuario'].";");
        $usuarios[] = $resultadoUsuario->fetch_assoc();
        $resultadoCarritos = mysqli_query($conexion, "SELECT * FROM carrito WHERE fkIdCompra = ".$row['idCompra']." && fkIdUsuario = ".end($usuarios)['idUsuario'].";");
        while($row2 = $resultadoCarritos->fetch_assoc()){
            $carritos[$row['idCompra']][] = $row2; 
            $resultadoProductos = mysqli_query($conexion, "SELECT * FROM producto WHERE idProducto = ".$row2['fkIdProducto'].";");
            $productos[$row['idCompra']][] = $resultadoProductos->fetch_assoc();
        }  
    }
    if($pedidosPendientes == NULL){
        echo "<script>alert('No se encontraron pedidos pendientes'); window.location = '../index.php'</script>";
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
    <!-- BORRAR -->
    <style>
        .pedido{
            border:solid blue 2px;  
            display:flex;
            flex-direction:row;
        }
        .producto{
            border: solid green 1px;
        }
    </style>
    <h1>Pedidos pendientes</h1>
    <?php
    foreach($pedidosPendientes as $i=>$value){
        echo '<div class="pedido">';
            echo'<p> Usuario: '. $usuarios[$i]['nombre'].'</p>
            <p> E-mail: '.$usuarios[$i]['email'].'</p>';
            foreach($productos[$value['idCompra']] as $i2=>$campos){
                echo '<div class="producto">';
                echo'<p> Producto </p>
                    <p>'.$campos['nombre'].'</p>
                    <p>Fecha 1: '.$carritos[$value['idCompra']][$i2]['fechaInicial'].'</p>';
                    if($carritos[$value['idCompra']][$i]['fechaFinal']!=NULL){
                        echo '<p>Fecha 2: '.$carritos[$value['idCompra']][$i2]['fechaFinal'].'</p>';
                    }
                    
                    echo'<p>Importe total del producto: $'.$carritos[$value['idCompra']][$i2]['precioTotal'].'</p>';
                echo '</div>';
            }
            echo'<p>Importe total del pedido: $'.$value['precioTotal'].'</p>';
            $ids = $value['idCompra'] ."-". $usuarios[$i]['idUsuario'];
            echo '<form action="./confirmarPedidoAdmin.php" method="post">
                <button name ="confirmar" value = "'.$ids.'">Realizar pedido</button>
            </form>';
            echo '<form action="./eliminarPedidoPendiente.php" method="post">
                <button name="eliminar" value= "'.$ids.'">Cancelar pedido</button>
            </form>';
        echo '</div>';
    }
    ?>
</body>
</html>