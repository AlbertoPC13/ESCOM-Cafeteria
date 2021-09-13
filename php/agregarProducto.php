<?php
include_once './conexion.php';

$stmt =$pdo->prepare("INSERT INTO producto (IdCategoria,Nombre, Existencias, Precio,Descripcion) VALUES (:IdCategoria,:Nombre, :Existencias, :Precio,:Descripcion)");

$stmt->bindParam(':IdCategoria', $Categoria);
$stmt->bindParam(':Nombre', $Nombre);
$stmt->bindParam(':Existencias', $Existencias);
$stmt->bindParam(':Precio', $Precio);
$stmt->bindParam(':Descripcion', $Descripcion);

$Categoria = $_POST["Categoria"];
$Nombre = $_POST["Nombre"];
$Existencias = $_POST["Existencias"];
$Precio = $_POST["Precio"];
$Descripcion = $_POST["Descripcion"];


$stmt->execute();

//echo json_encode($respAX_JSON);
?>