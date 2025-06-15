<?php
    include_once('conexion.php');
    session_start();
    if(isset($_POST['producto'])){
        foreach($_POST['producto'] as $idProducto){
            $query = "INSERT INTO carrito(fkIdUsuario, fkIdProducto, precioUnidad) VALUE (".$_SESSION['idUsuario'].", ".$idProducto.", (SELECT precio FROM producto WHERE idProducto = ".$idProducto."));";	
            $resultado = mysqli_query($conexion, $query);
        }
        echo "<script>alert('Productos agregados correctamente a carrito'); window.location = './carrito.php'</script>";
    }else{
        echo "<script>alert('No hay productos seleccionados'); window.location = '../index.php'</script>";
    }    
?>