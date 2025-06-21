<?php
    session_start();
    include_once('conexion.php');
    if(!isset($_SESSION)){
        header('location:../index.php');
    }
    if(!isset($_SESSION['producto']) || $_SESSION['admin'] == FALSE)
    {
        header('location:../index.php');
    }
    var_dump($_SESSION['producto']);
    // Actualiza únicamente los campos con valores
    foreach($_POST as $i=>$value){
        if($value != NULL){
            // Según la opción seleccionada para categoría lo cambia por la llave primary key correspondiente
            if($i == "categoria"){
                switch($value){
                    case 'Vuelo':
                        $pkCategoria =  2;
                        break;
                    case 'Hospedaje':
                        $pkCategoria =  3;
                        break;    
                    case 'Vehiculo':
                        $pkCategoria =  1;
                        break;
                    default:
                        echo "<script>alert('Hubo un error al modificar el producto'); window.location = '../index.php'</script>";
                        break;
                }
                $query = "UPDATE producto SET fkIdCategoria ='".$pkCategoria."' WHERE idProducto=".$_SESSION['producto'].";";
            }else{
                var_dump($_SESSION['producto']);
                $query = "UPDATE producto SET ".$i."='".$value."' WHERE idProducto=".$_SESSION['producto'].";";
            }
            try{
                $resultado = mysqli_query($conexion, $query);
            }catch(error){
                echo "<script>alert('Hubo un error al modificar el producto'); window.location = '../index.php'</script>";
            }
        }
    }
    if($resultado){
        unset($_SESSION['producto']);
        echo "<script>alert('Producto modificado correctamente'); window.location = '../index.php'</script>";
    }else{
        echo "<script>alert('Hubo un error al modificar el producto'); window.location = '../index.php'</script>";
    }
?>