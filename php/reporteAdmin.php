<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $IdUsuario = $_POST['IdUsuario'];
    $Seleccion = $_POST['Grupo'];

    if (empty($Seleccion)) {
        $respAX_JSON["mensaje"] = "error";
        echo json_encode($respAX_JSON);
    } else {
        if ($Seleccion == 1) {
            $respAX_JSON["mensaje"] = "ventas";
        } else if ($Seleccion == 2) {
            $respAX_JSON["mensaje"] = "inventario";
        }
    }
    echo json_encode($respAX_JSON);
} else {
    $respAX_JSON["mensaje"] = "error";
    echo json_encode($respAX_JSON);
}
