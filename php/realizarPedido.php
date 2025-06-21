<?php
    session_start();
    include_once('conexion.php');
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
    var_dump($idCompra['max(idCompra)']);
    while ($row = $resultadoCarrito->fetch_assoc()) {
        $query = "UPDATE carrito SET fkIdCompra =".$idCompra['max(idCompra)']." WHERE idCarrito = ".$row['idCarrito'].";";
        var_dump($query);
        $query = mysqli_query($conexion, $query);
        $productosCarrito[] = $row;
    }