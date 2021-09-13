<?php

include_once './conexion.php';
include_once './sesion.php';

if(isset($_SESSION['IdUsuario']))
{
    header('Location: ../index.php');
}

$sql_leer = 'SELECT * FROM categoria';

$gsent = $pdo->prepare($sql_leer);
$gsent->execute();

$resultado1 = $gsent->fetchAll();
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
                <h1 class="section">Registrate</h1>
                <form id="formRegistrar" class="col s12 section">
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">person</i>
                            <input id="first_name" type="text" class="validate" name="Nombre" data-validetta="required,maxLength[25]">
                            <label for="first_name">Nombre</label>
                        </div>
                        <div class="input-field col s6">
                            <input id="last_name" type="text" class="validate" name="Apellido" data-validetta="required,maxLength[25]">
                            <label for="last_name">Apellidos</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">email</i>
                            <input id="email" type="email" class="validate" name="Correo" data-validetta="required,email">
                            <label for="email">Correo electrónico</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">lock</i> 
                            <input id="password" type="password" name="Contrasena" data-validetta="required,minLength[8],maxLength[16]">
                            <label for="password">Contraseña</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s6">
                            <i class="material-icons prefix">phone</i>
                            <input id="input_text" type="tel" data-length="10" name="Telefono" data-validetta="required,number,minLength[10],maxLength[10]">
                            <label for="input_text">Teléfono</label>
                        </div>
                    </div>
                    <button class="btn waves-effect waves-light indigo darken-3" type="submit" name="action">Submit
                        <i class="material-icons right">send</i>
                    </button>
                </form>
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
    <script src="../ajax/ajaxRegistro.js"></script>
</body>

</html>