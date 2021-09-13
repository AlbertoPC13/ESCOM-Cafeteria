<?php

include_once './php/conexion.php';

include_once './php/sesion.php';

if (isset($_SESSION['IdUsuario']) && $_SESSION['IdUsuario'] == 2) {
    header('Location: ./php/cocina.php');
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Cafetería ESCOM | Inicio</title>
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="./css/validetta.css">

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="./css/materialize.css" media="screen,projection" />


    <link href="./css/modales.css" rel="stylesheet">

</head>

<body>

    <!-- Modal Structure 1-->
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
                            <a href="./php/registro.php" class="waves-effect waves-purple btn-flat left">Registrarse</a>
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
                            <input id="icon_prefix" type="email" name="Correo" class="validate" data-validetta="required">
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
                <a href="./index.php"><img class="brand-logo" draggable="false" src="./imgs/LOGO_CAFE4.png"></a>

                <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down ">
                    <li><a href="./php/saldo.php">Hola <?php echo $Nombre ?></a></li>
                    <?php if ($_SESSION['IdUsuario'] == 1) { ?>
                        <li><a href="./php/admin.php">Vista Administrador</a></li>
                        <li><a href="./php/cocina.php">Vista Cocina</a></li>
                    <?php } ?>
                    <li><a href="./php/menu.php">Menú</a></li>
                    <li><a href="./php/carrito.php"><i class="fas fa-shopping-cart"></i>Carrito</a></li>
                    <li><a href="./php/reporteCompras.php">Pedidos</a></li>
                    <li><a class="white black-text wabes-effect waves-blue-grey lighten-1 btn" href="./php/cerrar.php">Cerrar sesión</a></li>
                </ul>

                <ul class="sidenav" id="nav-mobile">
                    <li><a href="./php/saldo.php">Hola <?php echo $Nombre ?></a></li>
                    <?php if ($_SESSION['IdUsuario'] == 1) { ?>
                        <li><a href="./php/admin.php">Vista Administrador</a></li>
                        <li><a href="./php/cocina.php">Vista Cocina</a></li>
                    <?php } ?>
                    <li><a href="./php/menu.php"><i class="fas fa-mug-hot"></i>Menú</a></li>
                    <li><a href="./php/carrito.php"><i class="fas fa-shopping-cart"></i>Carrito</a></li>
                    <li><a href="./php/reporteCompras.php"><i class="fas fa-clipboard-list"></i>Pedidos</a></li>
                    <li><a class="white black-text wabes-effect waves-blue-grey lighten-1 btn" href="./php/cerrar.php">Cerrar sesión</a></li>
                </ul>
            </div>
        </nav>
    <?php } else { ?>
        <!-- Barra de navegación Sin inicio de sesión-->
        <nav class=" nav indigo darken-3" role="navigation">

            <div class="nav-wrapper container">
                <a href="./index.php"><img class="brand-logo" draggable="false" src="./imgs/LOGO_CAFE4.png"></a>

                <a href="#" data-target="nav-mobile" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                <ul class="right hide-on-med-and-down ">
                    <li><a href="./php/menu.php">Menú</a></li>
                    <li><a class="white black-text wabes-effect waves-blue-grey lighten-1 btn modal-trigger" href="#modal1">Iniciar sesión</a></li>
                </ul>

                <ul class="sidenav" id="nav-mobile">
                    <li><a href="./php/menu.php"><i class="fas fa-mug-hot"></i>Menú</a></li>
                    <li><a class="white black-text wabes-effect waves-blue-grey lighten-1 btn modal-trigger" href="#modal1">Iniciar sesión</a></li>
                </ul>
            </div>
        </nav>
    <?php } ?>

    <!-- Slider -->
    <section class="slider">
        <ul class="slides">
            <li>
                <img src="./imgs/COFFE2.jpg">
                <div class="caption center-align">
                    <h1>El mejor café está con nosotros</h1>
                    <h2 class="light grey-text text-lighten-3">Prueba nuestras variedades de café</h2>
                </div>
            </li>
            <li>
                <img src="./imgs/BREAD1.jpg">
                <div class="caption left-align">
                    <h1>Para que tu día sea pan comido...</h1>
                    <h2 class="light grey-text text-lighten-3">Prueba algo de la sección de repostería</h2>
                </div>
            </li>
            <li>
                <img src="./imgs/HB1.jpg">
                <div class="caption left-align">
                    <h1>¿Hambre?</h1>
                    <h2 class="light grey-text text-lighten-3">¡Nuestra hamburguesa BBQ te espera!</h2>
                </div>
            </li>
            <li>
                <img src="./imgs/COFFE7.jpg">
                <div class="caption center-align">
                    <h1>Disfruta el momento</h1>
                    <h2 class="light grey-text text-lighten-3">Prueba uno de nuestros métodos artesanales para tu
                        próximo café</h2>
                </div>
            </li>
        </ul>
    </section>

    <main>
        <section>
            <div class="row container center">
                <h2 class="header">Un día perfecto para darte el gusto</h2>
                <h5 class="grey-text text-darken-3 lighten-3">En la cafetería de ESCOM te ofrecemos una gran
                    variedad de
                    deliciosos platillos preparados con los mejores productos del mercado</h5>
                <h5 class="grey-text text-darken-3 lighten-3">¡Te invitamos a que vengas y disfrutes con tus amigos
                    de
                    la experiencia ESCOM!</h5>
            </div>

            <div class="parallax-container">
                <div class="parallax"><img src="./imgs/COFFE1.jpg"></div>
            </div>

            <div class="row container center">
                <h2 class="header">Ven a disfrutar con nosotros</h2>
                <h5 class="grey-text text-darken-3 lighten-3">Te esperamos en ESCOM con los brazos abiertos</h5>
                <h5 class="grey-text text-darken-3 lighten-3">ESCOM IPN, Unidad Profesional Adolfo López Mateos, 07320
                    Ciudad de México, CDMX</h5>
            </div>

            <iframe class="mapa" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3760.871129348783!2d-99.1489002851419!3d19.50417948684372!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f94c06d75fd7%3A0x3fe1567da2190ac9!2sESCOM%20-%20Escuela%20Superior%20de%20C%C3%B3mputo%20-%20IPN!5e0!3m2!1ses-419!2smx!4v1623587411784!5m2!1ses-419!2smx" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>

            <div class="parallax-container">
                <div class="parallax"><img src="./imgs/COFFE10.jpg"></div>
            </div>

        </section>

        <section class="black row center sm">
            <div class="col s12 m12 l4 center">
                <iframe class="fb-page" src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FESCOM-Cafeter%25C3%25ADa-103328858658635&tabs=timeline%2Cevents%2Cmessages&width=340&height=500&small_header=false&adapt_container_width=false&hide_cover=false&show_facepile=true&appId" width="340" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
            </div>
            <div class="col s12 m12 l8 center sm white-text">
                <h3 class="sm">¡Unete a la comunidad de ESCOM en
                    nuestra página de Facebook!</h3>
            </div>
        </section>
    </main>

    <footer class="page-footer indigo darken-3">
        <div class="center">
            <h5 class="white-text">Mantente conectado</h5>
            <p class="grey-text text-lighten-4">Síguenos en nuestras redes sociales para descubrir más contenido
                de tu interés</p>
        </div>

        <div class="social-container">
            <a href="https://www.facebook.com/ESCOM-Cafeter%C3%ADa-103328858658635"><i class="fab fa-facebook-square"></i>
            </a>
            <a href="#"><i class="fab fa-instagram"></i>
            </a>
            <a href="#"><i class="fab fa-twitter-square"></i>
            </a>
        </div>

        <div class="footer-copyright">
            <div class="container center footer-text">
                © 2021 ESCOM
            </div>
        </div>
    </footer>

    <!--JavaScript at end of body for optimized loading-->
    <script src="https://kit.fontawesome.com/a779a66931.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./jscript/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="ajax/ajaxInicio.js"></script>
    <script type="text/javascript" src="./jscript/materialize.js"></script>
    <script type="text/javascript" src="./jscript/init.js"></script>
    <script type="text/javascript" src="./jscript/validetta.js"></script>
    <script type="text/javascript" src="./jscript/validettaLang-es-ES.js"></script>
</body>

</html>