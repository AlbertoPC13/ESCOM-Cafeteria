<!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Iniciar sesión</h4>
        <div class="row">
            <form id="formLogin" class="col s12">
                <div class="row">
                    <div class="input-field col s12 m12 l6">
                        <i class="material-icons prefix">person</i>
                        <input id="icon_prefix" type="text" name="Correo" class="validate" data-validetta="required">
                        <label for="icon_prefix">Usuario</label>
                    </div>
                    <div class="input-field col s12 m12 l6">
                        <i class="material-icons prefix">lock</i>
                        <input id="icon_telephone" name="Contrasena" type="password" class="validate" data-validetta="required">
                        <label for="icon_telephone">Contraseña</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <a href="./registro.php" class="waves-effect waves-purple btn-flat left">Registrarse</a>
                        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Salir</a>
                        <a href="#modal2" class="modal-close waves-effect waves-purple btn-flat left modal-trigger">¿Olvidaste tu contraseña?</a>
                        <button id="submit" class="waves-effect waves-green btn-flat" name="action">Continuar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Structure 2-->
<div id="modal2" class="modal rec">
    <div class="modal-content">
        <h4 class="center">Recuperar contraseña</h4>
        <div class="row">
            <form id="formRecuperar" class="col s12 centered container">
                <div class="row">
                    <div class="input-field col s12 m12 l12 centered">
                        <i class="material-icons prefix">email</i>
                        <input id="icon_prefix" type="text" name="Correo" class="validate" data-validetta="required">
                        <label for="icon_prefix">Correo</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">
                        <button id="submit" class="waves-effect waves-green btn-flat" name="action">Continuar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Header con sesiones -->
<?php
if (isset($_SESSION['IdUsuario'])) {

    $sql_leer = 'SELECT Nombre FROM Usuario where IdUsuario=' . $_SESSION['IdUsuario'];

    $gsent = $pdo->prepare($sql_leer);
    $gsent->execute();

    $consulta = $gsent->fetchAll();

    foreach ($consulta as $Nombre) :
        $Nombre = $Nombre["Nombre"];
    endforeach;
?>

    <!-- Barra de navegación con inicio de sesión-->
    <nav class=" nav indigo darken-3" role="navigation">

        <div class="nav-wrapper container">
            <a href="../index.php"><img class="brand-logo" draggable="false" src="../imgs/LOGO_CAFE4.png"></a>

            <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down ">
                <li><a href="./saldo.php">Hola <?php echo $Nombre ?></a></li>
                <?php if ($_SESSION['IdUsuario'] == 1) { ?>
                    <li><a href="./admin.php">Vista Administrador</a></li>
                <?php } ?>
                <li><a href="./menu.php">Menú</a></li>
                <li><a href="./carrito.php"><i class="fas fa-shopping-cart"></i>Carrito</a></li>
                <li><a href="./reporteCompras.php">Pedidos</a></li>
                <li><a class="white black-text wabes-effect waves-blue-grey lighten-1 btn" href="./cerrar.php">Cerrar sesión</a></li>
            </ul>

            <ul class="sidenav" id="nav-mobile">
                <li><a href="./saldo.php">Hola <?php echo $Nombre ?></a></li>
                <?php if ($_SESSION['IdUsuario'] == 1) { ?>
                    <li><a href="./admin.php">Vista Administrador</a></li>
                <?php } ?>
                <li><a href="./menu.php"><i class="fas fa-mug-hot"></i>Menú</a></li>
                <li><a href="./carrito.php"><i class="fas fa-shopping-cart"></i>Carrito</a></li>
                <li><a href="./reporteCompras.php"><i class="fas fa-clipboard-list"></i>Pedidos</a></li>
                <li><a class="white black-text wabes-effect waves-blue-grey lighten-1 btn" href="./cerrar.php">Cerrar sesión</a></li>
            </ul>
        </div>
    </nav>
<?php } else { ?>

    <!-- Barra de navegación Sin inicio de sesión-->
    <nav class=" nav indigo darken-3" role="navigation">

        <div class="nav-wrapper container">
            <a href="../index.php"><img class="brand-logo" draggable="false" src="../imgs/LOGO_CAFE4.png"></a>

            <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down ">
                <li id="hola"></li>
                <li><a href="./menu.php">Menú</a></li>
                <li><a class="white black-text wabes-effect waves-blue-grey lighten-1 btn modal-trigger" href="#modal1">Iniciar sesión</a></li>
            </ul>

            <ul class="sidenav" id="nav-mobile">
                <li><a href="./menu.php"><i class="fas fa-mug-hot"></i>Menú</a></li>
                <li><a class="white black-text wabes-effect waves-blue-grey lighten-1 btn modal-trigger" href="#modal1">Iniciar sesión</a></li>
            </ul>
        </div>m
    </nav>
<?php } ?>

<!--JavaScript at end of body for optimized loading-->
<script src="https://kit.fontawesome.com/a779a66931.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="../ajax/ajaxInicio.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="../jscript/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../jscript/materialize.js"></script>
<script type="text/javascript" src="../jscript/init.js"></script>
<script type="text/javascript" src="../jscript/validetta.js"></script>
<script type="text/javascript" src="../jscript/validettaLang-es-ES.js"></script>