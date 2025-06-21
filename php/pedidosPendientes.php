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
        // $resultadoInfoProductos = mysqli_query($conexion, "SELECT * FROM producto WHERE idProducto=".intval($row['fkIdProducto']).";");
        // $infoProductos[] = $resultadoInfoProductos->fetch_assoc();
        // $infoCarrito[] = $row;
    }
    foreach($compras as $i=>$value){
        var_dump($i);echo "<br>";
        var_dump($value);echo "<br>";
    }
?>