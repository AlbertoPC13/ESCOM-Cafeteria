<?php

include_once './sesion.php';
require('../FPDP/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('../imgs/LOGO_CAFE3.png', 10, 8, 33); //No funciona :c 
        // Arial bold 15
        $this->SetFont('Arial', 'B', 15);
        // Movernos a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(30, 20, 'Reporte de inventario', 0, 2, 'C');
        // Salto de línea
        $this->Ln(10);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, iconv('UTF-8', 'windows-1252', 'Cafetería ESCOM #' . $this->PageNo()), 0, 0, 'C');
    }

    function TablaBasica($header)
    {
        include_once './conexion.php';


        //Cabecera
        foreach ($header as $col)
            if ($col == "Nombre") {
                $this->Cell(70, 7, $col, 1);
            } else {
                $this->Cell(30, 7, $col, 1);
            }
        $this->Ln();

        $stmt = $pdo->prepare("SELECT * FROM producto");
        $stmt->execute();
        $consulta = $stmt->fetchAll();

        foreach ($consulta as $Dato) :

            $str = $Dato["IdProducto"];
            $str = iconv('UTF-8', 'windows-1252', $str);
            $this->Cell(30, 5, $str, 1);

            $str = $Dato["IdCategoria"];
            $str = iconv('UTF-8', 'windows-1252', $str);
            $this->Cell(30, 5, $str, 1);

            $str = $Dato["Nombre"];
            $str = iconv('UTF-8', 'windows-1252', $str);
            if (strlen($str) > 33)
                $str = substr($str, 0, 33) . '...';
            $this->Cell(70, 5, $str, 1);

            $str = $Dato["Existencias"];
            $str = iconv('UTF-8', 'windows-1252', $str);
            $this->Cell(30, 5, $str, 1);

            $str = $Dato["Precio"];
            $str = iconv('UTF-8', 'windows-1252', $str);
            $this->Cell(30, 5, $str, 1);

            $this->Ln();
        endforeach;
    }
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);

$header = array('IdProducto', 'IdCategoria', 'Nombre', 'Existencias', 'Precio Unitario');
$pdf->TablaBasica($header);

date_default_timezone_set('America/Mexico_City');
$hoy = date("Y-m-d");
$pdf->Output('ReporteInventario_' . $hoy . '.pdf', 'D');
