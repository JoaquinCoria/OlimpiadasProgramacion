<?php
    session_start();
    include_once('conexion.php');
    if(!isset($_SESSION['nombreUsuario'])){
        header('location:../index.php');
    }
    if($_SESSION['admin'] == TRUE){
        header('location:../index.php');
    }
    if(isset($_POST['modificar'])){
        unset($_SESSION['modificar']);
        $resultadoPedido = mysqli_query($conexion, "SELECT * FROM compra WHERE idCompra =".$_POST['modificar'].";");
        $resultadoCarrito = mysqli_query($conexion, "SELECT * FROM carrito WHERE fkIdCompra=".$_POST['modificar'].";");
        $_SESSION['modificar'] = $_POST['modificar'];
    }elseif(isset($_SESSION['modificar'])){
        $resultadoPedido = mysqli_query($conexion, "SELECT * FROM compra WHERE idCompra =".$_SESSION['modificar'].";");
        $resultadoCarrito = mysqli_query($conexion, "SELECT * FROM carrito WHERE fkIdCompra=".$_SESSION['modificar'].";");
    }
    while($row = $resultadoCarrito->fetch_assoc()){
        $infoCarrito[] = $row;
        $resultadoProductos = mysqli_query($conexion, "SELECT * FROM producto WHERE idProducto=".$row['fkIdProducto'].";");
        while($row2 = $resultadoProductos->fetch_assoc())
        {
            $infoProducto[] = $row2;
        }
    }
    if(isset($_POST['eliminar'])){
        $ids = explode("-", $_POST['eliminar']);echo "<br><br>";
        $eliminarProducto = mysqli_query($conexion, "DELETE FROM carrito WHERE fkIdProducto = ".$ids[0]." && fkIdCompra = ".$ids[1]." && fkIdUsuario = ".$_SESSION['idUsuario'].";");
    }
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
        <form action="modificarPedidoPendiente.php" method="post">
        <?php
        foreach($infoProducto as $i=>$value){
            echo "<div class='producto'>";
            echo "<p>Nombre: " .$value['nombre']."</p>";
            echo "<p>Descripción: " .$value['descripcion']."</p>";
            echo "<p>Descripción/unidad: $" .$value['precio']."</p>";
            echo "<p>Fecha 1: " .$infoCarrito[$i]['fechaInicial']."</p>";
            if($infoCarrito[$i]['fechaFinal'] != NULL){
                 echo "<p>Fecha 2: " .$infoCarrito[$i]['fechaFinal']."</p>";
            }
            if($value['fkIdCategoria'] == 2){
                echo "<p>Cantidad de vuelos: " .$infoCarrito[$i]['cantidad']."</p>";
            }else{
                echo "<p>Cantidad de días: " .$infoCarrito[$i]['cantidad']."</p>";
            }
            echo "<p>Precio total/producto: ".$infoCarrito[$i]['precioTotal']."</p>";
            $datos =  $infoCarrito[$i]['fkIdProducto'] . "-" . $infoCarrito[$i]['fkIdCompra'];
            echo '<button type="submit" name="eliminar" value="'.$datos .'">Eliminar producto</button>';
        }
        ?>
        </form>
    </div>
</body>
</html>