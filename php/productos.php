<?php

include_once './conexion.php';
include_once './sesionAdmin.php';

if($_SESSION['IdUsuario'] != 1)
{
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
<!--data tables-->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="../css/materialize.css" media="screen,projection" />


</head>
<?php include('navegacionAdmin.php') ?>
<main>
    <!-- Modal Structure -->
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4>Agregar un nuevo producto</h4>
        <div class="row">
            <form id="formAgregar" class="col s12 row">
                <div class="row s12">
                    <div class="input-field col s12 m12 l6">
                        <i class="material-icons prefix">bookmark</i>
                        <input id="Categoria" type="number" name="Categoria" class="validate" data-validetta="required" min="1" max="9">
                        <label for="Categoria">Categoria</label>
                    </div>
                    <div class="input-field col s12 m12 l6">
                        <i class="material-icons prefix">label</i>
                        <input id="Nombre" name="Nombre" type="text" class="validate" data-validetta="required">
                        <label for="Nombre">Nombre</label>
                    </div>
                    <div class="input-field col s12 m12 l6">
                        <i class="material-icons prefix">shopping_cart</i>
                        <input id="Existencia" type="number" name="Existencias" class="validate" data-validetta="required">
                        <label for="Existencia">Existencia</label>
                    </div>
                    <div class="input-field col s12 m12 l6">
                        <i class="material-icons prefix">attach_money</i>
                        <input id="Precio" name="Precio" type="number" class="validate" data-validetta="required">
                        <label for="Precio">Precio</label>
                    </div>
                    
                </div>
                <div class="col s12 row">
                <div class="input-field col s12 m12 l12">
                        <i class="material-icons prefix">comment</i>
                        <input id="Descripcion" name="Descripcion" type="text" class="validate" data-validetta="required">
                        <label for="Descripcion">Descripción</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row">                   
                        <a href="#!" class="modal-close waves-effect waves-red btn-flat">Salir</a>
                        <button id="submit" class="waves-effect waves-green btn-flat" name="action">Continuar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

    <section class="container"> 
    <div class="container section">    
        <h3 class="section">Gestión de Productos</h3>
        <p class="container section">Selecciona un Id de la tabla y da click en algún botón</p>
        <div class="section container">
            <a class="btn waves-effect waves-light modal-trigger" href="#modal1">Agregar
                <i class="material-icons right">send</i>
            </a>
            <button id="eliminar" class="btn waves-effect waves-light">Eliminar
                <i class="material-icons right">send</i>
            </button>
        </div>
    </div>
    <div class="container section">
    <table id="example" class="display highlight nowrap" style="width:100%">
            <thead>
                <th>id</th>
                <th>Categoria</th>
                <th>Nombre</th>
                <th>Existencia</th>
                <th>Precio</th>
                <th>Descripcion</th>
            </thead>
        </table>
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
<script type="text/javascript" src="../ajax/ajaxAgregarProducto.js"></script>
<script type="text/javascript" src="../ajax/ajaxTables.js"></script>
<script type="text/javascript" src="../ajax/ajaxProductos.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript" src="../jscript/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="../jscript/materialize.js"></script>
<script type="text/javascript" src="../jscript/init.js"></script>
<script type="text/javascript" src="../jscript/validetta.js"></script>
<script type="text/javascript" src="../jscript/validettaLang-es-ES.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

</body>

</html>