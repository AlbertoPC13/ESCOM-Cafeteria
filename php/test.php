<?php

include_once './conexion.php';
$stmt = $pdo->prepare("INSERT INTO Usuario (Nombre, Apellido, Correo, Contrasena, Telefono, Saldo)
  VALUES (:Nombre, :Apellido, :Correo, :Contrasena, :Telefono, :Saldo)");
$stmt->bindParam(':Nombre', $Nombre);
$stmt->bindParam(':Apellido', $Apellido);
$stmt->bindParam(':Correo', $Correo);
$stmt->bindParam(':Contrasena', $Contrasena);
$stmt->bindParam(':Telefono', $Telefono);
$stmt->bindParam(':Saldo', $Saldo);

$Nombre = $_POST["Nombre"];
$Apellido = $_POST["Apellido"];
$Correo = $_POST["Correo"];
$Contrasena = $_POST["Contrasena"];
$Telefono = $_POST["Telefono"];
$Saldo = 0;

$stmt->execute();

$sql_leer = "SELECT IdUsuario FROM Usuario where Correo='$Correo'";

$gsent = $pdo->prepare($sql_leer);
$gsent->execute();

$resultado1 = $gsent->fetchAll();

foreach ($resultado1 as $Id) :
  $IdUsuario = $Id["IdUsuario"];
endforeach;

session_start();

$_SESSION['IdUsuario'] = $IdUsuario;

$respAX_JSON = array();
$respAX_JSON["nombre"] = $Nombre;
echo json_encode($respAX_JSON);
