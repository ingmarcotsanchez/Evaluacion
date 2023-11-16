<?php

require_once "fpdf.php";
require_once "../../config/conexion.php";
require_once "../../models/Usuario.php";
$usuario = new Usuario();
    $usu = $usuario->listar();
require_once "../../models/Carreras.php";
$carrera = new Usuario();
    $car = $carrera->listar();
date_default_timezone_set('America/Bogota');




//inicia el pdf
$pdf = new FPDF('P','mm','Letter',true,'UTF-8',false);

//informacion del pdf
$pdf->SetCreator('Escuela de Artes y Letras');
$pdf->SetAuthor('Escuela de Artes y Letras');
$pdf->SetTitle('Certificado Evaluaciones');

//PDF
$pdf->AddPage();
$pdf->Image('../images/logo.png',20,20,30,30);
$pdf->SetFont('Arial','B',12);
$pdf->SetXY(20,20);
$pdf->Cell(30,30,'',1,0,'C');
$pdf->SetXY(50,20);
$pdf->SetTextColor(34,68,136);
$pdf->Cell(120,10,'PAZ Y SALVO DE SECRETARIA ACADEMICA',1,0,'C');
$pdf->SetFont('Arial','B',8);
$pdf->SetXY(170,20);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(20,10,'No.4',1,1,'C');
$pdf->SetFont('Arial','B',12);
$pdf->SetXY(50,30);
$pdf->Cell(140,10,'Area: Vicerectoria Academica',1,1,'C');
$pdf->SetFont('Arial','B',10);
$pdf->SetXY(50,40);
$pdf->Cell(35,10,'Codigo: GE-AC-01',1,0,'C');
$pdf->Cell(20,10,'Factor: 2',1,0,'C');
$pdf->Cell(32,10,'Caracteristica: 9',1,0,'C');
$pdf->Cell(21,10,'Version: 2',1,0,'C');
$pdf->Cell(32,10,'No. Páginas: 1',1,1,'C');

/*$pdf->Write(0,'Hora: '.date('h:i A'));*/
$pdf->Ln(10);
$pdf->Cell(40,20,'',0.0,'C');
$pdf->SetTextColor(34,68,136);
$pdf->SetFont('Arial','B',16);
$pdf->SetFillColor(217,217,217);
$pdf->Cell(200,10,'Identificacion',1,1,'L',1);
$pdf->SetFont('Arial','',14);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(200,10,'Nombres y Apellidos: '.$_SESSION["usu_nombre"].' '.$_SESSION["usu_apellidos"],1,1,'L');
$pdf->Cell(200,10,'Documento: '.$_SESSION["usu_usuario"],1,1,'L');
$pdf->Cell(200,10,'Programa: '.$_SESSION["car_id"],1,1,'L');
$pdf->Cell(200,10,'Fecha: '.date('d-m-Y'),1,1,'L');
$pdf->Ln(5);
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(255,255,255);
$pdf->Cell(200,10,'1- ESTE PAZ Y SALVO DEBE PRESENTARLO A SUS DOCENTES PARA INGRESAR A PARCIALES FINALES',0,1,'L');
$pdf->MultiCell(200,10,'2- ES INDISPENSABLE PRESENTAR ESTE DOCUMENTO EN TESORERIA PARA VALIDAR LA MATRICULA DEL SIGUIENTE PERIODO',0,1,'L');
$pdf->SetFont('Arial','B',16);
$pdf->SetFillColor(217,217,217);
$pdf->Ln(20);
$pdf->Cell(200,10,'ESTE PAZ Y SALVO NO REQUIERE FIRMA NI SELLO',1,1,'C',1);

$pdf->Ln(40);


$pdf->Output('Certificado_Evalauciones_'.date('d_m_y').'.pdf','I'); //I muestra D descarga
