<?php
include_once './sesion.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $Total = $_POST['Total'];
    $IdVenta = $_POST['IdVenta'];
    $Seleccion = $_POST['Grupo'];

    if (empty($Seleccion)) {
        $respAX_JSON["mensaje"] = "error";
    } else {
        include_once './conexion.php';
        $sql_leer = "SELECT * FROM Venta where IdVenta= $IdVenta";

        $gsent = $pdo->prepare($sql_leer);
        $gsent->execute();

        $consulta = $gsent->fetchAll();

        foreach ($consulta as $Dato) :
            $IdUsuario = $Dato["IdUsuario"];
        endforeach;

        $sql_leer = "SELECT * FROM Usuario where IdUsuario= $IdUsuario";

        $gsent = $pdo->prepare($sql_leer);
        $gsent->execute();

        $consulta = $gsent->fetchAll();

        foreach ($consulta as $Dato) :
            $Usuario = $Dato["Nombre"];
            $Correo = $Dato["Correo"];
        endforeach;


        if ($Seleccion == 1) {
            $stmt = $pdo->prepare("UPDATE Venta SET Listo = 1 WHERE IdVenta = $IdVenta");
            $stmt->execute();
            $respAX_JSON["mensaje"] = "success";

            $mail = new PHPMailer(true);

            try {
                //Server settings
                //DATOS DEL CORREO.
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'cafeteriaescom1@gmail.com';                     //SMTP username
                $mail->Password   = '1234567a$';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;
                $mail->CharSet = 'UTF-8';                                   //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //CUENTA DE USUARIO DESDE LA QUE SE ENVIA EL CORREO
                $mail->setFrom('cafeteriaescom1@gmail.com', 'Cafeteria ESCOM');
                //DESTINO DEL CORREO
                $mail->addAddress($Correo, $Usuario);     //Add a recipient
                // $mail->addAddress('ellen@example.com');               //Name is optional

                //MENSAJE
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Cafetería ESCOM - Pedido listo';
                $mail->Body = 'Hola ' . $Usuario . '. Tu pedido te está esperando en Cafetería ESCOM! <br>Pasa por él con tu comprobante de pago, te esperamos!<br><br>-- ESCOM --';

                //ACCION EN CASO DE QUE SE ENVIE CORRECTAMENTE EL CORREO
                $mail->send();
                //ACCION EN CASO DE QUE EL CORREO NO SE ENVIE CORRECTAMENTE
            } catch (Exception $e) {
                $respAX_JSON["mensaje"] = "error";
            }
        } elseif ($Seleccion == 2) {
            $stmt = $pdo->prepare("DELETE FROM Compra WHERE IdVenta = $IdVenta");
            $stmt->execute();

            $sql_leer = "SELECT * FROM Venta where IdVenta= $IdVenta";

            $gsent = $pdo->prepare($sql_leer);
            $gsent->execute();

            $consulta = $gsent->fetchAll();

            foreach ($consulta as $Dato) :
                $IdUsuario = $Dato["IdUsuario"];
            endforeach;

            $stmt = $pdo->prepare("DELETE FROM Venta WHERE IdVenta = $IdVenta");
            $stmt->execute();

            $sql_leer = "SELECT * FROM Usuario where IdUsuario= $IdUsuario";

            $gsent = $pdo->prepare($sql_leer);
            $gsent->execute();

            $consulta = $gsent->fetchAll();

            foreach ($consulta as $Dato) :
                $Saldo = $Dato["Saldo"];
            endforeach;

            $SaldoN = $Saldo + $Total;
            $stmt = $pdo->prepare("UPDATE Usuario SET Saldo = $SaldoN WHERE IdUsuario = $IdUsuario");
            $stmt->execute();
            $mail = new PHPMailer(true);

            try {
                //Server settings
                //DATOS DEL CORREO.
                $mail->SMTPDebug = 0;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'cafeteriaescom1@gmail.com';                     //SMTP username
                $mail->Password   = '1234567a$';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;
                $mail->CharSet = 'UTF-8';                                   //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                //CUENTA DE USUARIO DESDE LA QUE SE ENVIA EL CORREO
                $mail->setFrom('cafeteriaescom1@gmail.com', 'Cafeteria ESCOM');
                //DESTINO DEL CORREO
                $mail->addAddress($Correo, $Usuario);     //Add a recipient
                // $mail->addAddress('ellen@example.com');               //Name is optional

                //MENSAJE
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Cafetería ESCOM - Pedido cancelado';
                $mail->Body = 'Hola ' . $Usuario . '. La Cafetería ESCOM lamenta informarte que tu pedido fue cancelado.<br>Por ello te hemos reembolsado la cantidad de $' . $Total . ' para que puedas realizar una nueva compra en Cafetería ESCOM.<br><br>-- ESCOM --';

                //ACCION EN CASO DE QUE SE ENVIE CORRECTAMENTE EL CORREO
                $mail->send();
                //ACCION EN CASO DE QUE EL CORREO NO SE ENVIE CORRECTAMENTE
            } catch (Exception $e) {
                $respAX_JSON["mensaje"] = "error";
            }
            $respAX_JSON["mensaje"] = "success";
        } else {
            $respAX_JSON["mensaje"] = "error";
        }
    }
    echo json_encode($respAX_JSON);
}
