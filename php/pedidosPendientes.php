<?php
    session_start();
    include_once('conexion.php');
    if(!isset($_SESSION['nombreUsuario'])){
        header('location:./login.php');
    }
    $query = "SELECT idCompra FROM compra WHERE fkIdUsuario =".$_SESSION['idUsuario'].";";
    $resultadoCompra = mysqli_query($conexion,$query);
    var_dump($resultadoCompra->fetch_assoc());echo "<br><br>";
    var_dump($_SESSION['admin']);
?>