<?php 


use setasign\Fpdi\Fpdi;
require_once('fpdf.php');
require_once('FPDI-2.3.4/src/autoload.php');


$pdf = new Fpdi();

// add a page
$pdf->AddPage();

$pdf->setSourceFile('E:\xampp\htdocs\APALLBackOffice\application\views\User\PDF\offline_emandate_PDF.pdf');
$tplIdx = $pdf->importPage(1);
$pdf->useTemplate($tplIdx);

$pdf->SetFont('Helvetica','', 10);
$pdf->SetTextColor(0, 0, 0);

$date = str_split($farray[1]);
$pdf->SetXY(161.5, 21);
$pdf->Write(0,$date[0]); //date [0]

$pdf->SetXY(165.3, 21);
$pdf->Write(0,$date[1]);  //date [1]

$pdf->SetXY(170.5, 21);
$pdf->Write(0,$date[3]); // "-" remove date[2] here select date[3]

$pdf->SetXY(173.8, 21);
$pdf->Write(0,$date[4]); // date [4]

$pdf->SetXY(178.8, 21);
$pdf->Write(0,$date[6]); //date [6]

$pdf->SetXY(182.6, 21);
$pdf->Write(0,$date[7]); //date [7]

$pdf->SetXY(186.5, 21);
$pdf->Write(0,$date[8]); //date [8]

$pdf->SetXY(190, 21);
$pdf->Write(0,$date[9]); // date [9]

$accno = str_split($farray[4]);
$setx = 57.5;
foreach ($accno as $val) 
{
	$pdf->SetXY($setx, 41);
	$pdf->Write(0,$val);  // Bank Account NO.0
	$setx +=4.6;
}
$pdf->SetFont('Helvetica','',7);
$pdf->SetXY(28.7, 45);
//$pdf->Write(0,$farray[5]);//bank name
$pdf->MultiCell(65,3,$farray[5],0,'LR',false);

$pdf->SetFont('Helvetica','', 10);
$ifsc = str_split($farray[6]);// IFSC CODE
$set_x = 99.5;
foreach ($ifsc as $val1) 
{
	$pdf->SetXY($set_x, 48);
	$pdf->Write(0,$val1);  // Bank IFSC
	$set_x +=4.2;
}

$pdf->SetFont('Helvetica','', 10);
$micrcode = str_split($farray[7]);// MICR CODE
$set_x1 = 157;
foreach ($micrcode as $val2) 
{
	$pdf->SetXY($set_x1, 48);
	$pdf->Write(0,$val2);  // MICR Code
	$set_x1 +=4.2;
}

$pdf->SetFont('Helvetica','', 7);
$pdf->SetXY(42, 51);
//$pdf->Write(0,$farray[3]);//Rupees in word
$pdf->MultiCell(75,4,$farray[3],0,'LR',false);

$pdf->SetFont('Helvetica','', 10);
$pdf->SetXY(32, 68);
$pdf->Write(0,$farray[0]);//Reference 1

$pdf->SetFont('Helvetica','', 10);
$pdf->SetXY(165, 55);
$pdf->Write(0,$farray[2]);//Rupees in number

$pdf->SetFont('Helvetica','', 10);
$pdf->SetXY(140, 66);
$pdf->Write(0,$farray[8]);//Phone Number

$pdf->SetFont('Helvetica','', 8);
$pdf->SetXY(140, 75);
$pdf->Write(0,$farray[9]);//Email

$pdf->SetFont('Helvetica','', 8);
$pdf->SetXY(68, 98);
$pdf->Write(0,$farray[10]);//account holdler name

$pdf->SetFont('ZapfDingbats','', 14);
$pdf->SetXY(25, 94.5);
$pdf->Cell(10, 10, chr(52), 5, 0); //check mark until cancelled

$pdf->SetFont('ZapfDingbats','', 14);
$pdf->SetXY(26, 28);
$pdf->Cell(10, 10, chr(52), 5, 0); //Tick Create

$pdf->SetFont('ZapfDingbats','', 14);
$pdf->SetXY(151, 28);
$pdf->Cell(10, 10, chr(52), 5, 0);//Tick the date

$pdf->SetFont('Helvetica','', 10);

$date = str_split($farray[1]);
$pdf->SetXY(25, 87.5);
$pdf->Write(0,$date[0]); //date [0]

$pdf->SetXY(30, 87.5);
$pdf->Write(0,$date[1]);  //date [1]

$pdf->SetXY(35, 87.5);
$pdf->Write(0,$date[3]); // "-" remove date[2] date[5] here select date[3] and [7]

$pdf->SetXY(40, 87.5);
$pdf->Write(0,$date[4]); // date [4]

$pdf->SetXY(45, 87.5);
$pdf->Write(0,$date[6]); //date [6]

$pdf->SetXY(50, 87.5);
$pdf->Write(0,$date[7]); //date [7]

$pdf->SetXY(54, 87.5);
$pdf->Write(0,$date[8]); //date [8]

$pdf->SetXY(59, 87.5);
$pdf->Write(0,$date[9]); // date [9]


$nm = $farray[0];//UCC

$i=date('d/m/Y h:i:s');
// $ii=date('h i');
$dir = "E:/APBackOffice_PDF/e-mandate";
$dir_ses = "E:/APBackOffice_PDF/e-mandate/".$nm.'.pdf';

$pdf->Output("F",$dir_ses);// Pdf Upload in Folder
$pdf->Output("D",'e-mandate.pdf');	// Pdf Download in Folder
?>