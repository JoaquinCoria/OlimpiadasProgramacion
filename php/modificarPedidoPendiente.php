<?php
    session_start();
    include_once('conexion.php');
    if(!isset($_SESSION['nombreUsuario'])){
        header('location:../index.php');
    }
    if($_SESSION['admin'] == TRUE){
        header('location:../index.php');
    }
    $resultadoPedido = mysqli_query($conexion, "SELECT * FROM compra WHERE idCompra =".$_POST['modificar'].";");
    $resultadoCarrito = mysqli_query($conexion, "SELECT * FROM carrito WHERE fkIdCompra=".$_POST['modificar'].";");
    while($row = $resultadoCarrito->fetch_assoc()){
        $infoCarrito[] = $row;
        $resultadoProductos = mysqli_query($conexion, "SELECT * FROM producto WHERE idProducto=".$row['fkIdProducto'].";");
        while($row2 = $resultadoProductos->fetch_assoc())
        {
            $infoProducto[] = $row2;
        }
    }

    var_dump($infoCarrito);
    echo "<br><br>";var_dump($infoProducto);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar pedido</title>
</head>
<body>
    <div class="pedido">
        <h1>Pedido</h1>
        <?php
        foreach($infoProducto as $i=>$value){

        }
    ?>
    </div>
</body>
</html>