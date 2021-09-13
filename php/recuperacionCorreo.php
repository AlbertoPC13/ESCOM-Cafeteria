<?php
include_once './conexion.php';
include_once './sesion.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $Correo = $_POST['Correo'];

    if (empty($Correo)) {
        $respAX_JSON["mensaje"] = "error";
    } else {

        $stmt = $pdo->prepare("SELECT * FROM Usuario where Correo= :Correo");
        $stmt->bindParam(':Correo', $Correo);
        $stmt->execute();

        $consulta = $stmt->fetchAll();

        foreach ($consulta as $Dato) :
            $Usuario = $Dato["Nombre"];
            $Correo = $Dato["Correo"];
            $Contrasena = $Dato["Contrasena"];
        endforeach;

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
            $mail->CharSet = 'UTF-8';                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //CUENTA DE USUARIO DESDE LA QUE SE ENVIA EL CORREO
            $mail->setFrom('cafeteriaescom1@gmail.com', 'Cafeteria ESCOM');
            //DESTINO DEL CORREO
            $mail->addAddress($Correo, $Usuario);     //Add a recipient
            // $mail->addAddress('ellen@example.com');               //Name is optional

            //Attachments
            /* $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
*/
            //MENSAJE
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Cafetería ESCOM - Recuperación de contraseña';
            $mail->Body = 'Hola ' . $Usuario . '. Se ha solicitado la recuperación de credenciales para tu cuenta en Cafetería ESCOM, si no lo hiciste omite este correo. <br> De forma contraria, tu contraseña es: ' . $Contrasena . '<br>-- ESCOM --';

            //ACCION EN CASO DE QUE SE ENVIE CORRECTAMENTE EL CORREO
            $mail->send();
            $respAX_JSON["mensaje"] = "success";
            //ACCION EN CASO DE QUE EL CORREO NO SE ENVIE CORRECTAMENTE
        } catch (Exception $e) {
            $respAX_JSON["mensaje"] = "error";
        }

        //SMPT OUTLOOK smtp-mail.outlook.com 

        $respAX_JSON["mensaje"] = "success";
    }
    echo json_encode($respAX_JSON);
}
