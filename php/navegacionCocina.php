<!-- Header con sesiones -->
<?php
$sql_leer = 'SELECT Nombre FROM Usuario where IdUsuario=' . $_SESSION['IdUsuario'];

$gsent = $pdo->prepare($sql_leer);
$gsent->execute();

$consulta = $gsent->fetchAll();

foreach ($consulta as $Nombre) :
    $Nombre = $Nombre["Nombre"];
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
                <li><a href="./cocina.php">Vista Cocina</a></li>
            <?php } ?>
            <li><a href="./pedidosCocina.php">Pedidos</a></li>
            <li><a class="white black-text wabes-effect waves-blue-grey lighten-1 btn" href="./cerrar.php">Cerrar sesión</a></li>
        </ul>

        <ul class="sidenav" id="nav-mobile">
            <li><a href="#!">Hola <?php echo $Nombre ?></a></li>
            <?php if ($_SESSION['IdUsuario'] == 1) { ?>
                <li><a href="./admin.php">Vista Administrador</a></li>
                <li><a href="./cocina.php">Vista Cocina</a></li>
            <?php } ?>
            <li><a href="./pedidosCocina.php"><i class="fas fa-utensils"></i>Pedidos</a></li>
            <li><a class="white black-text wabes-effect waves-blue-grey lighten-1 btn" href="./cerrar.php">Cerrar sesión</a></li>
        </ul>
    </div>
</nav>

<!--JavaScript at end of body for optimized loading-->
<script src="https://kit.fontawesome.com/a779a66931.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="../ajax/ajaxInicio.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="../jscript/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../jscript/materialize.js"></script>
<script type="text/javascript" src="../jscript/init.js"></script>
<script type="text/javascript" src="../jscript/validetta.js"></script>
<script type="text/javascript" src="../jscript/validettaLang-es-ES.js"></script>