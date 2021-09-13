<?php

include_once './conexion.php';
include_once './sesion.php';
if ($_SESSION['IdUsuario'] != 1) {
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
    <?php include('navegacionAdmin.php') ?>
    <main>
        <section>
            <div class="row container">
                <h3>Reporte de ventas</h3>
                <div class="col s12 m12 l12">
                    <ul class="collapsible popout">
                        <?php
                        $sql_leer =  "SELECT * FROM Venta where Listo = 1 and cast(Fecha as date) = CURDATE() ORDER BY Fecha DESC";
                        $gsent = $pdo->prepare($sql_leer);
                        $gsent->execute();

                        $resultado1 = $gsent->fetchAll();
                        ?>
                        <?php foreach ($resultado1 as $Venta) : ?>

                            <li>
                                <div class="collapsible-header">
                                    <i class="fas fa-shopping-bag"></i>
                                    <?php echo 'IdVenta: ' . $Venta["IdVenta"] . ' -- IdUsuario: ' . $Venta["IdUsuario"] ?>

                                    <span class="badge">Total: $<?php echo $Venta["Total"] ?></span>
                                </div>
                                <div class="collapsible-body">
                                    <h5><?php echo 'Fecha: ' . $Venta["Fecha"] ?></h5>
                                    <table class="highlight responsive-table">
                                        <thead>
                                            <tr>
                                                <th>IdProducto</th>
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
                                                    <td><?php echo $Dato["IdProducto"] ?></td>
                                                    <td><?php echo $Dato["Nombre"] ?></td>
                                                    <td><?php echo $Dato["Cantidad"] ?></td>
                                                    <td><?php echo $Dato["Precio"] ?></td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <div class="row">
                    <div class="left">
                        <form id="formPDF" method="post">
                            <input type="hidden" name="IdUsuario" value="<?php echo $IdUsuario ?>">
                            <p>
                                <label>
                                    <input name="Grupo" type="radio" value="1" checked/>
                                    <span>Ventas</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input name="Grupo" type="radio" value="2" />
                                    <span>Inventario</span>
                                </label>
                            </p>
                            <button class="btn waves-effect" type="submit" name="action"><i class="far fa-file-pdf"></i>Generar reporte</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="page-footer blue-grey darken-4">
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
    <script type="text/javascript" src="../ajax/ajaxPDF.js"></script>
</body>

</html>