<?php

include_once './conexion.php';

$sql_leer = "SELECT p.IdProducto, c.IdCategoria, p.Nombre, p.Existencias, p.Precio, p.Descripcion FROM producto p JOIN categoria c ON c.IdCategoria = p.IdCategoria";


$gsent = $pdo->prepare($sql_leer);
$gsent->execute();

$resultado = $gsent->fetchAll();

foreach ($resultado as $dato) :
    $respAX_JSON["data"][]= $dato;
endforeach;

echo json_encode($respAX_JSON);
?>