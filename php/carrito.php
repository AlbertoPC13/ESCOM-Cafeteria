<?php

include_once './conexion.php';
include_once './sesion.php';

if (!isset($_SESSION['IdUsuario'])) {
    header('Location: ../index.php');
}

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
            <div class="row container">
                <h3>Carrito de compras</h3>
                <div class="col s12 m12 l12">
                    <table class="highlight responsive-table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $IdUsuario = $_SESSION['IdUsuario'];
                            $sql_leer =  "SELECT * FROM Agregar WHERE IdUsuario= $IdUsuario ORDER BY Fecha DESC";
                            $gsent = $pdo->prepare($sql_leer);
                            $gsent->execute();

                            $resultado1 = $gsent->fetchAll();
                            $Total = 0;
                            $Aux;
                            ?>

                            <?php foreach ($resultado1 as $cantidad) : ?>
                                <tr>
                                    <?php
                                    $sql_leer =  'SELECT * FROM Producto WHERE IdProducto=' . $cantidad['IdProducto'];
                                    $gsent = $pdo->prepare($sql_leer);
                                    $gsent->execute();

                                    $resultado2 = $gsent->fetchAll();
                                    ?>

                                    <?php foreach ($resultado2 as $producto) : ?>
                                        <td><?php echo $producto['Nombre'] ?></td>
                                        <td><?php echo $cantidad['Cantidad'] ?></td>
                                        <td> $<?php echo $producto['Precio'] ?></td>
                                    <?php
                                        $Aux = $producto['Precio'] * $cantidad['Cantidad'];
                                        $Total = $Total + $Aux;
                                    endforeach ?>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <section>
            <div class="row container">
                <div class="col container s12 m12 l12 left-align">
                    <h5>Total: $<?php echo $Total ?></h5>
                </div>
                <div class="col container s12 m12 l12 right-align">
                    <form method="post" id="formCompra">
                        <input type="hidden" name="Total" value="<?php echo $Total ?>">
                        <button class="btn waves-effect waves-light" type="submit" name="action">Comprar</button>
                    </form>

                </div>
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

    <script type="text/javascript" src="../jscript/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="../jscript/materialize.js"></script>
    <script type="text/javascript" src="../jscript/init.js"></script>
    <script type="text/javascript" src="../jscript/validetta.js"></script>
    <script type="text/javascript" src="../jscript/validettaLang-es-ES.js"></script>
    <script type="text/javascript" src="../ajax/ajaxCompra.js"></script>
</body>

</html>