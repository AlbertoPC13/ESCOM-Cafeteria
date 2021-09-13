<?php

include_once './conexion.php';

try{
$stmt = $pdo->prepare("DELETE FROM producto where idProducto=:idProducto");

$stmt->bindParam(':idProducto', $id);

$id = $_POST["id"];

$stmt->execute();

$respAX_JSON["mensaje"] = "success";
echo json_encode($respAX_JSON);
}catch(Exception $e){
    $respAX_JSON["mensaje"] = "error";
echo json_encode($respAX_JSON);
}
?>