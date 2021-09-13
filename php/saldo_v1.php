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
                <h3>Saldo total</h3>
                <div class="col s12 m12 l12">

                    <?php
                    $IdUsuario = $_SESSION['IdUsuario'];
                    $sql_leer =  "SELECT * FROM Usuario WHERE IdUsuario= $IdUsuario";
                    $gsent = $pdo->prepare($sql_leer);
                    $gsent->execute();

                    $resultado = $gsent->fetchAll();

                    foreach ($resultado as $Saldo) :
                        $Total = $Saldo["Saldo"];
                    endforeach;
                    ?>
                </div>
                <div class="col container s12 m12 l12 left-align">
                    <h5>Total: $<?php echo $Total ?></h5>
                </div>
            </div>
        </section>
        <section>
            <div class="container">
                <h3>Cargar saldo</h3>
                <form action="archivo.php" method="post" enctype="multipart/form-data">

                    <div class="row">
                        <div class="input-field col s2 left-align">
                            <i class="tiny material-icons prefix">attach_money</i>
                            <input id="first_name" type="number" name="Saldo" min="1" value="1" class="validate" required data-validetta="required">
                            <label for="first_name">Saldo</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="file-field col s6 left-align">
                            <div class="btn">
                                Archivo
                                <input type="file" data-validetta="required" accept="application/pdf, .jpg" name="Comprobante">
                            </div>
                            <div class="file-path-wrapper">
                                <input class="file-path validate" type="text" placeholder="Cargue un archivo JPG o PDF" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col s6 left-align">
                            <button class="btn waves-effect waves-light" type="submit" name="action">Enviar
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </div>
            </div>
            </form>
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
    <script src="../ajax/ajaxRegistro.js"></script>
</body>

</html>