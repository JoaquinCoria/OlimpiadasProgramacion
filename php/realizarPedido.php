<?php
    if(!isset($_SESSION['nombreUsuario'])){
       header('location:./login.php'); 
    }
    var_dump($_SESSION);    
    // if(!isset($_SESSION['']))
    // {

    // }
?>