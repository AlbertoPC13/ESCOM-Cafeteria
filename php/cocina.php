<?php

include_once './conexion.php';
include_once './sesionAdmin.php';


?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Cafetería ESCOM | Inicio</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="../css/validetta.css">

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.css" media="screen,projection" />

</head>

<body>

    <!-- Header con sesiones -->
    <?php
    $sql_leer = 'SELECT * FROM Usuario where IdUsuario=' . $_SESSION['IdUsuario'];

    $gsent = $pdo->prepare($sql_leer);
    $gsent->execute();

    $consulta = $gsent->fetchAll();

    foreach ($consulta as $Dato) :
        $Nombre = $Dato["Nombre"];
        $Apellidos = $Dato["Apellido"];
    endforeach;
    ?>
    <!-- Barra de navegación con inicio de sesión-->
    <nav class=" nav red darken-4" role="navigation">

        <div class="nav-wrapper container">
            <a href="./cocina.php"><img class="brand-logo" draggable="false" src="../imgs/LOGO_CAFE4.png"></a>

            <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down ">
                <li><a href="#!">Hola <?php echo $Nombre ?></a></li>
                <?php if ($_SESSION['IdUsuario'] == 1) { ?>
                    <li><a href="./admin.php">Vista Administrador</a></li>
                    <li><a href="../index.php">Vista Cliente</a></li>
                <?php } ?>
                <li><a href="./pedidosCocina.php">Pedidos</a></li>
                <li><a class="white black-text wabes-effect waves-blue-grey lighten-1 btn" href="./cerrar.php">Cerrar sesión</a></li>
            </ul>

            <ul class="sidenav" id="nav-mobile">
                <li><a href="#!">Hola <?php echo $Nombre ?></a></li>
                <?php if ($_SESSION['IdUsuario'] == 1) { ?>
                    <li><a href="./admin.php">Vista Administrador</a></li>
                    <li><a href="../index.php">Vista Cliente</a></li>
                <?php } ?>
                <li><a href="./pedidosCocina.php"><i class="fas fa-utensils"></i>Pedidos</a></li>
                <li><a class="white black-text wabes-effect waves-blue-grey lighten-1 btn" href="./cerrar.php">Cerrar sesión</a></li>
            </ul>
        </div>
    </nav>

    <main class="container section">
        <div class="center-align container section">
                <h1 class="centered section">
                
                <?php if ($_SESSION['IdUsuario'] == 1) { echo "Hola Administrador: <br>".$Nombre."<br>".$Apellidos;} else echo "Hola cocinero: <br>".$Nombre."<br>".$Apellidos; ?>             
                </h1>
        </div>
    </main>

    <footer class="page-footer red darken-4">
        <div class="footer-copyright">
            <div class="container center footer-text">
                © 2021 ESCOM
            </div>
        </div>
    </footer>
    <!--JavaScript at end of body for optimized loading-->
    <script src="https://kit.fontawesome.com/a779a66931.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../ajax/ajaxInicio.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="../jscript/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../jscript/materialize.js"></script>
    <script type="text/javascript" src="../jscript/init.js"></script>
    <script type="text/javascript" src="../jscript/validetta.js"></script>
    <script type="text/javascript" src="../jscript/validettaLang-es-ES.js"></script>
</body>

</html>