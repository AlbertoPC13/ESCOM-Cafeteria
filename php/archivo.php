<?php
include_once './sesion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $archivo = $_FILES["Comprobante"];
    //$_FILES["archivo"]["name"];
    
    $dirUploads = "../files/";
    $archUpload = $dirUploads.$archivo["name"];

    if(move_uploaded_file($archivo["tmp_name"],$archUpload)){
        include_once './conexion.php';
        $stmt = $pdo->prepare("INSERT INTO Pagos (IdUsuario,Cantidad,Comprobante)
        VALUES (:IdUsuario,:Cantidad, :Comprobante)");

        $stmt->bindParam(':IdUsuario', $_SESSION['IdUsuario']);
        $stmt->bindParam(':Cantidad', $Saldo);
        $stmt->bindParam(':Comprobante', $Comprobante);

        $Saldo = $_POST['Saldo'];
        $Comprobante = $archUpload;

        $stmt->execute();

        $respAX_JSON["mensaje"] = "success";
    }else{
        $respAX_JSON["mensaje"] = "error"; 
        
    }
    echo json_encode($respAX_JSON);
}
