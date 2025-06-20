<?php
    session_start();
    include_once('conexion.php');
    if(!isset($_SESSION['producto']) || $_SESSION['admin'] == FALSE)
    {
        header('location:../index.php');
    }
    $query = "DELETE FROM producto WHERE idProducto = ".$_SESSION['producto'].";";
    try{
        $resultado = mysqli_query($conexion, $query);
        unset($_SESSION['producto']);
        echo "<script>alert('Producto eliminado correctamente del catálogo'); window.location = '../index.php'</script>";
    }catch(error){
        echo "<script>alert('Hubo un error en el proceso de eliminación del producto'); window.location = '../index.php'</script>";
    }
?>