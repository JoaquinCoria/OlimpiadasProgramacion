<?php
    include_once('conexion.php');
    session_start();

    foreach($_POST['producto'] as $idProducto){
        $query = "INSERT INTO carrito(fkIdUsuario, fkIdProducto, precioUnidad) VALUE (".$_SESSION['idUsuario'].", ".$idProducto.", (SELECT precio FROM producto WHERE idProducto = ".$idProducto."));";	
        $resultado = mysqli_query($conexion, $query);
    }
    echo "<script>alert('Productos agregados correctamente a carrito'); window.location = '../index.php'</script>";
?>