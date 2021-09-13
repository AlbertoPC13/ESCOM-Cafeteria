<?php
include_once './sesion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $Saldo = $_POST['Saldo'];
    //$Comprobante = addslashes(file_get_contents($_FILES['Comprobante']['tmp_name']));
    $Comprobante = addslashes($_FILES['Comprobante']['tmp_name']);

    if (empty($Saldo) && empty($Comprobante)) {
        $respAX_JSON["mensaje"] = "error";
    } else {
        include_once './conexion.php';
        $stmt = $pdo->prepare("INSERT INTO Pagos (IdUsuario,Cantidad,Comprobante)
        VALUES (:IdUsuario,:Cantidad, :Comprobante)");

        $stmt->bindParam(':IdUsuario', $_SESSION['IdUsuario']);
        $stmt->bindParam(':Cantidad', $Saldo);
        $stmt->bindParam(':Comprobante', $Comprobante);

        $stmt->execute();
    }
}
