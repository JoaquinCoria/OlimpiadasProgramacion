<?php
    session_start();
    include_once('conexion.php');
    if(!isset($_SESSION['nombreUsuario']) || !isset($_POST['confirmar'])){
        header('location:../index.php');
    }
    if($_SESSION['admin'] == FALSE){
        header('location:../index.php');
    }
    try{
        $ids = explode("-",$_POST['confirmar']);
        $query = mysqli_query($conexion, "UPDATE compra SET estado = 'Realizado' WHERE idCompra = ".$ids[0]." && fkIdUsuario = ".$ids[1].";");
        $query = mysqli_query($conexion, "INSERT INTO pedidoshistoricos(fechaDelPedido, fkIdUsuario,fkIdCompra)
        VALUES('".date('Y-m-d')."',".$ids[1].",".$ids[0].");");
        echo "<script>alert('Pedido realizado correctamente'); window.location = './pedidoPendienteAdmin.php'</script>";
    }catch(error $e){
        echo "<script>alert('Hubo un error inesperado'); window.location = './pedidoPendienteAdmin.php'</script>";
    }