<?php
    include_once('conexion.php');
    session_start();
    if(!isset($_SESSION['nombreUsuario'])){
        header('location:../index.php');
    }

    if(isset($_POST['producto'])){
        foreach($_POST['producto'] as $idProducto){
            $query = "DELETE FROM carrito WHERE fkIdProducto = ".$idProducto." && fkIdUsuario = ".$_SESSION['idUsuario'].";";	
            $resultado = mysqli_query($conexion, $query);
        }
        echo "<script>alert('Producto/s eliminado/s correctamente de carrito'); window.location = '../index.php'</script>";
    }else{
        echo "<script>alert('No hay productos seleccionados'); window.location = '../index.php'</script>";
    }    
?>