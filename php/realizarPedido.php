<?php
    session_start();
    include_once('conexion.php');
    if(isset($_POST['volver'])){
        unset($_SESSION['informacionCarrito'],$_SESSION['productosCarrito'],$_SESSION['precioCarrito']);
        header('location:./login.php');
    }
    // Valída que todos los datos y credenciales estén en condiciones
    if(!isset($_SESSION['nombreUsuario'])){
       header('location:./login.php'); 
    }
    if($_SESSION['admin'] == TRUE){
        header('location:../index.php'); 
    }
    // Toma todos los datos del carrito del usuario
    $query = "SELECT * FROM carrito WHERE fkIdUsuario = ".$_SESSION['idUsuario']." && fkIdCompra IS NULL;";
    $resultadoCarrito = mysqli_query($conexion, $query);
    // Inserta una nueva fila en compra
    $query = "INSERT INTO compra(fkIdUsuario, precioTotal, estado) VALUES(".$_SESSION['idUsuario'].", ".$_SESSION['precioCarrito'].", 'Pendiente')";
    $query = mysqli_query($conexion,$query);
    // Toma el idCompra de la compra actual
    $query = "SELECT max(idCompra) FROM compra WHERE fkIdUsuario = ".$_SESSION['idUsuario'].";";
    $resultadoIdCompra = mysqli_query($conexion, $query);
    $idCompra = $resultadoIdCompra->fetch_assoc();
    // Actualiza el carrito con las foreing key de la compra actual
    while ($row = $resultadoCarrito->fetch_assoc()) {
        $query = "UPDATE carrito SET fkIdCompra =".$idCompra['max(idCompra)']." WHERE idCarrito = ".$row['idCarrito'].";";
        $query = mysqli_query($conexion, $query);
        $productosCarrito[] = $row;
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Pedido realizado</title>
    </head>
    <body>
        <p>Tu pedido ahora esta pendiente a ser realizado</p>
        <div class="container">
            <h1>Informe del pedido</h1>
            <div class="producto">
                <?php
                    foreach($_SESSION['productosCarrito'] as $i=>$value){
                        echo '<p>Nombre: '.$value['nombre'].'</p>';
                        echo '<p>Descripción: '.$value['descripcion'].'</p>';
                        echo '<p>Precio: $'.$value['precio'].'</p>';
                        echo '<p>Cantidad: '.$_SESSION['informacionCarrito'][$i]['cantidad'].'</p>';
                        echo '<p>Precio total p/producto: $'.$_SESSION['informacionCarrito'][$i]['precioTotal'].'</p>';
                    }
                ?>
            </div>
            <?php
                echo '<p>Fecha: '.date('d/m/Y').'</p>';
                echo '<p>Importe total: $'.$_SESSION['precioCarrito'].'</p>';        
            ?>
            <form action="realizarPedido.php" method="post">
                <button type="submit" name="volver">Terminar</button>
            </form>
        </div>
    </body>
    </html>