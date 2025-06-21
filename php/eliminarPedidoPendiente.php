<?php
    session_start();
    include_once('conexion.php');
    if(!isset($_SESSION['nombreUsuario']) || !isset($_POST['eliminar'])){
        header('location:../index.php');
    }
    try{
        $query = mysqli_query($conexion, "DELETE FROM compra WHERE idCompra = ".$_POST['eliminar']." && fkIdUsuario = ".$_SESSION['idUsuario'].";");
        $query = mysqli_query($conexion, "DELETE FROM carrito WHERE fkIdProducto = ".$_POST['eliminar']." && fkIdUsuario = ".$_SESSION['idUsuario'].";");
        echo "<script>alert('Pedido eliminado correctamente'); window.location = './pedidosPendientes.php'</script>";
    }catch(error){
        echo "<script>alert('Hubo un error en el proceso de eliminación del pedido'); window.location = '../index.php'</script>";
    }
    
?>