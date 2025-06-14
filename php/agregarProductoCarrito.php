<?php
    include_once('conexion.php');
    session_start();
    print_r($_POST['producto']);
    echo "<br>";
    print_r(sizeof($_POST['producto']));
     echo "<br>";
    foreach($_POST['producto'] as $idProducto){
        $query = "INSERT INTO carrito(fkIdUsuario, fkIdProducto, precioUnidad) VALUE (".$_SESSION['idUsuario'].", ".$idProducto.", (SELECT precio FROM producto WHERE idProducto = ".$idProducto."));";	
        $resultado = mysqli_query($conexion, $query);
    }
//     $query = "INSERT INTO carrito(fkIdUsuario, fkIdProducto, precioTotal, precioUnidad) VALUE (".$_SESSION['idUsuario'].", 	
// "
//     $_POST['']
?>