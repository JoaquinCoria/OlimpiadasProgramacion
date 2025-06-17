<?php
    include_once('conexion.php');
    session_start();
    if(isset($_SESSION['idProducto'])){
        $query = "INSERT INTO carrito(fkIdUsuario, fkIdProducto, precioTotal, precioUnidad, cantidad) 
        VALUE (".$_SESSION['idUsuario'].", ".$_SESSION['idProducto'].", ". $_SESSION['precioTotal']." ,(SELECT precio FROM producto WHERE idProducto = ".$_SESSION['idProducto']."), ". $_SESSION['cantidadCarrito'].");";	
        $resultado = mysqli_query($conexion, $query);
        echo "<script>alert('Productos agregados correctamente a carrito'); window.location = './carrito.php'</script>";
        unset($_SESSION['idProducto'], $_SESSION['cantidadCarrito'], $_SESSION['precioTotal']);
    }else{
        echo "<script>alert('No hay productos seleccionados'); window.location = '../index.php'</script>";
    }    
?>