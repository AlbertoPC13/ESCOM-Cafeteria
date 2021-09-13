<?php
include_once './sesion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $Producto = $_POST['Producto'];
    $Cantidad = $_POST['Cantidad'];

    if (empty($Producto) && empty($Cantidad)) {
    $respAX_JSON["mensaje"] = "error";

    } else {
        include_once './conexion.php';
        $stmt = $pdo->prepare("INSERT INTO Agregar (IdUsuario, IdProducto,Cantidad)
        VALUES (:IdUsuario,:IdProducto, :Cantidad)");
        
        $stmt->bindParam(':IdUsuario', $_SESSION['IdUsuario']);
        $stmt->bindParam(':IdProducto', $Producto);
        $stmt->bindParam(':Cantidad', $Cantidad);

        $stmt->execute();
    $respAX_JSON["mensaje"] = "success";

    }
    echo json_encode($respAX_JSON);
}
