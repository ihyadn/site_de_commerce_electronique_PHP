<?php 
 //include("header.php");
session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

require('fpdf/fpdf.php');
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','B',8);
$pdf->Cell(0,10,'Your Shopping Carte',1,1);
$pdf->Cell(95,10,'',0,1);

$pdf->Cell(25,20,'Item ID',1,0);
$pdf->Cell(85,20,'Item Name',1,0);
$pdf->Cell(20,20,'Item Price',1,0);
$pdf->Cell(25,20,'Item Shipping',1,0);
$pdf->Cell(20,20,'Item Quantity',1,0);
$pdf->Cell(23,20,'Total Price',1,1);

if (isset($_SESSION['mycart'])) {

	$total = 0;
	
	foreach ($_SESSION['mycart'] as $key => $value) {
	
$pdf->Cell(25,20,$value['id'],1,0);
$pdf->Cell(85,20,$value['name'],1,0);
$pdf->Cell(20,20,$value['price'],1,0);
$pdf->Cell(25,20,$value['ship'],1,0);
$pdf->Cell(20,20,$value['quantity'],1,0);
$pdf->Cell(23,20,"$ ".($value['quantity'] * ($value['price']+$value['ship'])),1,1);
$total = $total + $value['quantity'] * ($value['price']+$value['ship']);
}


}

$pdf->Cell(40,20,'',0,1);

$pdf->Cell(40,20,'Total Price',1,0);
$pdf->Cell(150,20,"$ ".($total),1,1);
$pdf->Output('D','Carte.pdf');


?>