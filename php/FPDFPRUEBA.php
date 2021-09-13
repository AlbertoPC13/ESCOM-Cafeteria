<?php
include_once 'conexion.php';

include_once 'sesion.php';

require('../FPDP/fpdf.php');

class PDF extends FPDF{
    function Header(){
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(30,10,'Reporte de ventas');
    //    $this->Image("./imgs/LOGO_CAFE4.png",10,8,33);
    }
    function Footer(){
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(30,10,'Reporte de ventas');
    //    $this->Image("./imgs/LOGO_CAFE4.png",10,8,33);
    }
}

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);/*
//$pdf->Cell(40, 10, '¡Hola, Mundo!');
$pdf->Cell(30,10,'Reporte de ventas',1,0,'C');
$sql_leer = "SELECT * FROM Usuario";

$gsent = $pdo->prepare($sql_leer);
$gsent->execute();

$consulta = $gsent->fetchAll();

foreach ($consulta as $Dato) :
    $IdUsuario = $Dato["IdUsuario"];
    $pdf->Cell(60, 10, $IdUsuario, 1, 0, 'C', 0);
endforeach;
$pdf->Cell(60, 10, 'Prueba', 1, 0, 'C', 0);
//(ancho, largo, nombre,borde, sin salto de pagina, centrado, salto de pagina))

*/
$pdf->Output();
?>