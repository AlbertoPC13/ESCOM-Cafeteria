<?php
include_once './sesion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $Total = $_POST['Total'];

    if (empty($Total)) {
        $respAX_JSON["mensaje"] = "error";
    } else {
        include_once './conexion.php';

        $IdUsuario = $_SESSION['IdUsuario'];

        $sql_leer = "SELECT * FROM Usuario where IdUsuario= $IdUsuario";

        $gsent = $pdo->prepare($sql_leer);
        $gsent->execute();

        $consulta = $gsent->fetchAll();

        foreach ($consulta as $Dato) :
            $Saldo = $Dato["Saldo"];
        endforeach;


        if ($Saldo >= $Total) {

            $sql_leer = "SELECT * FROM Agregar where IdUsuario= $IdUsuario";

            $gsent = $pdo->prepare($sql_leer);
            $gsent->execute();

            $consulta1 = $gsent->fetchAll();

            $Aux1 = 0;
            $TotalN = 0;

            foreach ($consulta1 as $Dato) :
                $IdProducto = $Dato["IdProducto"];
                $Cantidad = $Dato["Cantidad"];

                $sql_leer = "SELECT * FROM Producto where IdProducto= $IdProducto";

                $gsent = $pdo->prepare($sql_leer);
                $gsent->execute();

                $consulta2 = $gsent->fetchAll();

                foreach ($consulta2 as $Producto) :
                    $Existencias = $Producto["Existencias"];
                    $Precio = $Producto["Precio"];
                endforeach;

                if ($Cantidad > $Existencias) {
                    $stmt = $pdo->prepare("DELETE FROM Agregar WHERE IdProducto = $IdProducto and IdUsuario= $IdUsuario");
                    $stmt->execute();
                } else {
                    $ExistenciasN = $Existencias - $Cantidad;
                    $stmt = $pdo->prepare("UPDATE Producto SET Existencias = $ExistenciasN WHERE IdProducto = $IdProducto");
                    $stmt->execute();
                    $Aux1 = $Cantidad * $Precio;
                    $TotalN = $TotalN + $Aux1;
                }
            endforeach;


            $stmt = $pdo->prepare("INSERT INTO Venta (IdUsuario, Total, Listo) VALUES (:IdUsuario, :Total, :Listo)");
            $stmt->bindParam(':IdUsuario', $IdUsuario);
            $stmt->bindParam(':Total', $TotalN);
            $stmt->bindParam(':Listo', $Listo);

            $Listo = 0;
            $stmt->execute();
            $IdVenta = $pdo->lastInsertId();


            $sql_leer = "SELECT * FROM Agregar where IdUsuario= $IdUsuario";

            $gsent = $pdo->prepare($sql_leer);
            $gsent->execute();

            $consulta = $gsent->fetchAll();

            foreach ($consulta as $Dato) :
                $IdProducto = $Dato["IdProducto"];
                $Cantidad = $Dato["Cantidad"];

                $stmt = $pdo->prepare("INSERT INTO Compra (IdVenta, IdProducto, Cantidad) VALUES (:IdVenta, :IdProducto, :Cantidad)");
                $stmt->bindParam(':IdVenta', $IdVenta);
                $stmt->bindParam(':IdProducto', $IdProducto);
                $stmt->bindParam(':Cantidad', $Cantidad);

                $stmt->execute();
            endforeach;

            $stmt = $pdo->prepare("UPDATE Usuario SET Saldo = :Saldo WHERE IdUsuario = :IdUsuario");

            $stmt->bindParam(':IdUsuario', $IdUsuario);
            $stmt->bindParam(':Saldo', $SaldoN);

            $SaldoN = $Saldo - $TotalN;

            $stmt->execute();

            $stmt = $pdo->prepare("DELETE FROM Agregar WHERE IdUsuario = $IdUsuario");

            $stmt->execute();

            if ($TotalN == 0) {
                $respAX_JSON["mensaje"] = "error";
            } else {
                include_once './comprobanteCompra.php';
                $respAX_JSON["mensaje"] = "success";
            }

        } else {
            
            $stmt = $pdo->prepare("DELETE FROM Agregar WHERE IdUsuario = $IdUsuario");

            $stmt->execute();
            $respAX_JSON["mensaje"] = "error";
        }
    }
    echo json_encode($respAX_JSON);
}
