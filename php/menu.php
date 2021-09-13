<?php

include_once './conexion.php';
include_once './sesion.php';

$sql_leer = 'SELECT * FROM categoria';

$gsent = $pdo->prepare($sql_leer);
$gsent->execute();

$resultado = $gsent->fetchAll();
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
    <link href="../css/modales.css" rel="stylesheet">

</head>

<body>
    <?php include('navegacion.php') ?>
    <main>
        <section>
            <div class="row container center">
                <img class="center-align" draggable="false" width="40%" src="../imgs/MENU.png">
            </div>
            <div class="menu row container center">
                <?php foreach ($resultado as $dato) : ?>
                    <div class="card col s12 m12 l4 hoverable indigo lighten-5">
                        <div class="card-image waves-effect waves-block waves-light ">
                            <?php echo '<img class="activator" draggable="false" src=' . $dato["Imagen"] . '>' ?>
                        </div>
                        <div class="card-content left-align">
                            <span class="card-title activator grey-text text-darken-4"><?php echo $dato['Nombre'] ?><i class="material-icons right">more_vert</i></span>
                        </div>
                        <div class="card-reveal left-align">
                            <span class="card-title grey-text text-darken-4"><?php echo $dato['Nombre'] ?><i class="material-icons right">close</i></span>
                            <p class="center-align centered"><?php echo $dato['Descripcion'] ?></p>
                            <?php
                            $sql_leer =  'SELECT * FROM producto WHERE IdCategoria ='.$dato['IdCategoria'];
                            $gsent = $pdo->prepare($sql_leer);
                            $gsent->execute();

                            $resultado2 = $gsent->fetchAll();
                            ?>
                            <?php foreach ($resultado2 as $producto) : ?>
                            <!--<form action="agregar.php" method="post">-->
                                <form class="productos">
                                    <input name="Producto" type="hidden" value=<?php echo $producto["IdProducto"]?>>
                                    <ul class="collapsible">
                                        <li>
                                            <div class="collapsible-header">
                                                <i class="material-icons">chevron_right</i>
                                                <?php echo $producto['Nombre'] ?>
                                            </div>
                                            <div class="collapsible-body row">
                                                <p><?php echo $producto['Descripcion'] ?></p>
                                                <h6>Precio: $<?php echo $producto['Precio'] ?></h6>
                                                <?php if(isset($_SESSION['IdUsuario'])){?>
                                                <div class="container">
                                                    <div class="input-field col s6">
                                                        <i class="material-icons prefix">add_shopping_cart</i>
                                                        <input id="Cantidad" type="number" min="1" max="<?php echo $producto['Existencias'] ?>" name="Cantidad" value="1" data-validetta="required" required>
                                                        <input name="Cero" value="0" type="hidden"> 
                                                    </div>
                                                    <div class="input-field col s1">
                                                        <button class="boton btn waves-effect waves-light section">
                                                            <i class="material-icons">send</i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>

                                        </li>
                                    </ul>
                                </form>
                            <?php endforeach ?>
                        </div>
                    </div>
                <?php endforeach ?>

               
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
    <script type="text/javascript" src="../ajax/ajaxInicio.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="../jscript/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../jscript/materialize.js"></script>
    <script type="text/javascript" src="../jscript/init.js"></script>
    <script type="text/javascript" src="../jscript/validetta.js"></script>
    <script type="text/javascript" src="../jscript/validettaLang-es-ES.js"></script>
</body>

</html>