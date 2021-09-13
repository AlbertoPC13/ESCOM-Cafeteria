<?php

session_start();

if(isset($_SESSION['IdUsuario']))
{
    if($_SESSION['IdUsuario'] == 1 || $_SESSION['IdUsuario'] == 2 )
    {
        $IdUsuario = $_SESSION['IdUsuario'];
        $_SESSION['IdUsuario'] = $IdUsuario;
    }
    else{
        header('Location: ../index.php');
    }
}else{
    header('Location: ../index.php');
}