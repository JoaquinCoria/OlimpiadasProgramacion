<?php
    include_once('conexion.php');
    session_start();
    if(isset($_SESSION['idProducto'])){
        if(count($_SESSION['fechas']) == 2)
        {
            $query = "INSERT INTO carrito(fkIdUsuario, fkIdProducto, precioTotal, precioUnidad, cantidad, fechaInicial, fechaFinal) 
            VALUE (".$_SESSION['idUsuario'].", ".$_SESSION['idProducto'].", ". $_SESSION['precioTotal']." ,(SELECT precio FROM producto WHERE idProducto = ".$_SESSION['idProducto']."), ". $_SESSION['cantidadCarrito'].",'".$_SESSION['fechas'][0]."','".$_SESSION['fechas'][1]."');";	
        }elseif(count($_SESSION['fechas']) == 1)
        {
            $query = "INSERT INTO carrito(fkIdUsuario, fkIdProducto, precioTotal, precioUnidad, cantidad, fechaInicial) 
            VALUE (".$_SESSION['idUsuario'].", ".$_SESSION['idProducto'].", ". $_SESSION['precioTotal']." ,(SELECT precio FROM producto WHERE idProducto = ".$_SESSION['idProducto']."), ". $_SESSION['cantidadCarrito'].",'".$_SESSION['fechas'][0]."');";
        }
        $resultado = mysqli_query($conexion, $query);
        echo "<script>alert('Productos agregados correctamente a carrito'); window.location = './carrito.php'</script>";
        unset($_SESSION['idProducto'], $_SESSION['cantidadCarrito'], $_SESSION['precioTotal'], $_SESSION['fechas']);
    }else{
        echo "<script>alert('No hay productos seleccionados'); window.location = '../index.php'</script>";
    }    
?>