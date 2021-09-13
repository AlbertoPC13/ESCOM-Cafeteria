<?php
include_once './sesion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $IdUsuario = $_POST['IdUsuario'];
    $Cantidad = $_POST['Cantidad'];
    $IdPago = $_POST['IdPago'];

    if (empty($IdUsuario) && empty($Cantidad)) {
    $respAX_JSON["mensaje"] = "error";

    } else {
        include_once './conexion.php';
        $sql_leer = "SELECT * FROM Usuario where IdUsuario= $IdUsuario";

        $gsent = $pdo->prepare($sql_leer);
        $gsent->execute();

        $consulta = $gsent->fetchAll();

        foreach ($consulta as $Usuario) :
            $Actual = $Usuario["Saldo"];
        endforeach;

        $Cantidad = $Cantidad + $Actual;

        $stmt = $pdo->prepare("UPDATE Usuario SET Saldo = :Saldo WHERE IdUsuario = :IdUsuario");
        
        $stmt->bindParam(':IdUsuario', $IdUsuario);
        $stmt->bindParam(':Saldo', $Cantidad);

        $stmt->execute();

        $stmt = $pdo->prepare("DELETE FROM Pagos WHERE IdPago = $IdPago");
        
        $stmt->execute();
    $respAX_JSON["mensaje"] = "success";

    }
    echo json_encode($respAX_JSON);
}