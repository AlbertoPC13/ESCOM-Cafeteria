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

</head>

<body>
    <?php include('navegacion.php') ?>
    <main>
        <section>
            <div class="row container">
                <h3>Mis compras</h3>
                <div class="col s12 m12 l12">
                    <ul class="collapsible popout">
                        <?php
                        $IdUsuario = $_SESSION['IdUsuario'];
                        $sql_leer =  "SELECT * FROM Venta where IdUsuario = $IdUsuario  ORDER BY Fecha DESC";
                        $gsent = $pdo->prepare($sql_leer);
                        $gsent->execute();

                        $resultado1 = $gsent->fetchAll();
                        $i = 1;
                        ?>
                        <?php foreach ($resultado1 as $Venta) : ?>
                            <li>
                                <div class="collapsible-header">
                                    <i class="fas fa-shopping-bag"></i>
                                    <?php echo 'Compra ' . $i ?>

                                    <span class="badge">Total: $<?php echo $Venta["Total"] ?></span>
                                </div>
                                <div class="collapsible-body">
                                    <h5><?php echo 'Fecha: ' . $Venta["Fecha"] ?></h5>
                                    <table class="highlight responsive-table">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th>Cantidad</th>
                                                <th>Precio Unitario</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $pdo->prepare("SELECT * FROM Compra c JOIN Producto p ON c.IdProducto = p.IdProducto where IdVenta= :IdVenta");
                                            $stmt->bindParam(':IdVenta', $Venta["IdVenta"]);
                                            $stmt->execute();
                                            $consulta = $stmt->fetchAll();
                                            ?>
                                            <?php foreach ($consulta as $Dato) : ?>
                                                <tr>
                                                    <td><?php echo $Dato["Nombre"] ?></td>
                                                    <td><?php echo $Dato["Cantidad"] ?></td>
                                                    <td><?php echo $Dato["Precio"] ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                    <?php if ($Venta["Listo"] == 1) { ?>
                                        <h5>Tu pedido está listo</h5>
                                    <?php } else { ?>
                                        <h5>Tu pedido está en proceso</h5>
                                    <?php } ?>
                                </div>
                            </li>
                        <?php
                            $i++;
                        endforeach ?>

                    </ul>
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
    <script type="text/javascript" src="../ajax/ajaxInicio.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="../jscript/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="../jscript/materialize.js"></script>
    <script type="text/javascript" src="../jscript/init.js"></script>
    <script type="text/javascript" src="../jscript/validetta.js"></script>
    <script type="text/javascript" src="../jscript/validettaLang-es-ES.js"></script>
</body>

</html>