<?php

include_once './conexion.php';
include_once './sesionAdmin.php';

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
                <h3>Comprobantes de pago</h3>
                <div class="col s12 m12 l12">
                    <table class="highlight responsive-table">
                        <thead>
                            <tr>
                                <th>IdUsuario</th>
                                <th>Saldo</th>
                                <th>Comprobante</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $sql_leer =  'SELECT * FROM Pagos';
                            $gsent = $pdo->prepare($sql_leer);
                            $gsent->execute();

                            $resultado = $gsent->fetchAll();
                            ?>
                            <?php foreach ($resultado as $Comprobante) : ?>
                                <tr id="<?php echo 'Pago'.$Comprobante['IdPago'].'tr' ?>">
                                    <td><?php echo $Comprobante['IdUsuario'] ?></td>
                                    <td>$ <?php echo $Comprobante['Cantidad'] ?></td>
                                    <?php if (strrpos($Comprobante['Comprobante'], '.pdf') > 0) { ?>
                                        <td><a href="<?php echo $Comprobante['Comprobante'] ?>">Abrir PDF</a></td>
                                    <?php } else { ?>
                                        <td><img class="materialboxed" width="250" src="<?php echo $Comprobante['Comprobante'] ?>"></td>
                                    <?php } ?>

                                    <form id="<?php echo 'Pago'.$Comprobante['IdPago'] ?>" class="Pagos">
                                        <input name="Cantidad" value=<?php echo $Comprobante['Cantidad'] ?> type="hidden">

                                        <input name="IdPago" value=<?php echo $Comprobante['IdPago'] ?> type="hidden">

                                        <input name="IdUsuario" value=<?php echo $Comprobante['IdUsuario'] ?> type="hidden">
                                    </form>
                                        <td><button class="boton aceptar waves-effect waves-green btn" onClick="aceptar(<?php echo 'Pago'.$Comprobante['IdPago'] ?>);"><i class="fas fa-check"></i> Aceptar</button></td>
                                        <td><button class="boton btn cancelar waves-effect waves-red btn" onClick="cancelar(<?php echo 'Pago'.$Comprobante['IdPago'] ?>)"><i class="fas fa-times" ></i> Cancelar</button></td>
                                    
                                </tr>

                            <?php endforeach ?>
                        </tbody>
                    </table>
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

    <script type="text/javascript" src="../jscript/jquery-3.6.0.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="../jscript/materialize.js"></script>
    <script type="text/javascript" src="../jscript/init.js"></script>
    <script type="text/javascript" src="../jscript/validetta.js"></script>
    <script type="text/javascript" src="../jscript/validettaLang-es-ES.js"></script>
    <script src="../ajax/ajaxCargar.js"></script>
</body>

</html>