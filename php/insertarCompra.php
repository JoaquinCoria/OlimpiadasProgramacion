<?php
    session_start();
    include_once('conexion.php');
    if(!isset($_SESSION['nombreUsuario'])){
       header('location:./login.php'); 
    }
    if($_SESSION['admin'] == TRUE || !isset($_POST['pedido'])){
        header('location:../index.php'); 
    }
    // Inserta una nueva fila en compra
    $query = "INSERT INTO compra(fkIdUsuario, precioTotal, estado) VALUES(".$_SESSION['idUsuario'].", ".$_SESSION['precioCarrito'].", 'Pendiente')";
    $query = mysqli_query($conexion,$query);
    header('location:./realizarPedido.php'); 
?>
