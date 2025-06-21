<?php
    session_start();
    include_once('conexion.php');
    if(!isset($_SESSION['nombreUsuario']) || !isset($_POST['eliminar'])){
        header('location:../index.php');
    }
    try{
        if($_SESSION['admin'] == FALSE){
            $borrarCompra = "DELETE FROM compra WHERE idCompra = ".$_POST['eliminar']." && fkIdUsuario = ".$_SESSION['idUsuario'].";";
            $borrarCarrito = "DELETE FROM carrito WHERE fkIdCompra = ".$_POST['eliminar']." && fkIdUsuario = ".$_SESSION['idUsuario'].";";
        }elseif($_SESSION['admin'] == TRUE){
            $ids = explode("-",$_POST['eliminar']);
            $borrarCompra = "DELETE FROM compra WHERE idCompra = ".$ids[0]." && fkIdUsuario = ".$ids[1].";";
            $borrarCarrito = "DELETE FROM carrito WHERE fkIdCompra = ".$ids[0]." && fkIdUsuario = ".$ids[1].";";
        }
        $query = mysqli_query($conexion,$borrarCompra);
        $query = mysqli_query($conexion,$borrarCarrito);
        if($_SESSION['admin'] == FALSE){
            echo "<script>alert('Pedido eliminado correctamente'); window.location = './pedidosPendientes.php'</script>";
        }elseif($_SESSION['admin'] == TRUE){
            echo "<script>alert('Pedido eliminado correctamente'); window.location = './pedidoPendienteAdmin.php'</script>";
        }
    }catch(error $e){
        echo $e;
        echo "<script>alert('Hubo un error en el proceso de eliminación del pedido'); window.location = '../index.php'</script>";
    }
    
?>