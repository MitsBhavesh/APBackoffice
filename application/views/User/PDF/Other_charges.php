<?php
require('fpdf.php');
// foreach ($equity_pnl as  $value) {
   
// }
class PDF extends FPDF
{
// Simple table
function BasicTable($header, $data)
{
    // Header
    foreach($header as $col)
        $this->Cell(40,7,$col,1);
    $this->Ln();
    // Data
    foreach($data as $row)
    {
        foreach($row as $col)
            $this->Cell(40,6,$col,1);
        $this->Ln();
    }
}

}
$pdf = new PDF();

// Column headings
$header = array('PAN', 'Client id', 'Client Name');
// Data loading

$pdf->AddPage();
$pdf -> Line(10, 42, 205, 42);
$pdf -> Line(10, 10, 10, 42);
$pdf -> Line(10, 10, 205, 10);
$pdf -> Line(205, 10, 205, 42);

$pdf->SetFont('Arial','B',11);
$pdf->SetXY(12, 12);
$pdf->Cell(25,4,"ARHAMSHARE PVT.LTD",0);

$pdf->SetFont('Arial','',7);
$pdf->SetXY(12, 16);
$pdf->Cell(25,4,"Regd. Off.: U-8, Jolly Plaza, Athvagate, SURAT-395001.",0);

$pdf->SetXY(12, 20);
$pdf->Cell(25,4,"Tel: 0261-6794000, Fax : 0261-2471060, Email: contact@arhamshare.com,",0);

$pdf->SetXY(12, 24);
$pdf->Cell(25,4,"Website: www.arhamshare.com, SEBI Regi. No:BSE & NSE :INZ000175534",0);

$pdf->SetXY(12, 28);
$pdf->Cell(25,4,"CIN: U67120GJ2010PTC061501, GST Location: Gujarat, Investor",0);

$pdf->SetXY(12, 32);
$pdf->Cell(25,4,"Grievances ID: grievances@arhamshare.com",0);

$pdf->SetXY(12, 36);
$pdf->Cell(25,4,"Compliance Officer : Priyank Mehta, Tel.: 0261-6794000, Email Id: mehta_priyank@ymail.com",0);

$pdf->Image('arham_logo.JPG',150,15,45);

$pdf -> Line(10, 270, 205, 270); // ____
$pdf -> Line(10, 43, 10, 270);// |......
$pdf -> Line(10, 43, 205, 43);
$pdf -> Line(205, 43, 205, 270);
// ................

// $pdf -> Line(20, 20, 205, 20);
// $pdf -> Line(205, 20, 205, 42);
// $pdf->SetFont('Arial','',9);
// $pdf->SetXY(12, 46);
// $pdf->Write(0,"Pan: ". $data[2]);
// $pdf->SetXY(12, 52);
// $pdf->Write(0,"Client ID: ". $data[0]);
// $pdf->SetXY(12, 58);
// $pdf->Write(0,"Client Name: ". $data[1]);
// $pdf->SetFont('Arial','B',9);


function calculateFiscalYearForDate($month)
{
    if($month > 4)
    {
        $y = date('Y');
        $pt = date('Y', strtotime('+1 year'));
        $fy = $y."/04/01".",".$pt."/03/31";
    }
    else
    {
        $y = date('Y', strtotime('+1 year'));
        $pt = date('Y');
        $fy = $y."/04/01".",".$y."/03/31";
    }
    return $fy;
}

$f_year_date=calculateFiscalYearForDate('m');
$f_year_date=explode(",", $f_year_date);
$selected_date=date_create($f_year_date[1]);
$final_convert_date=date_format($selected_date,"d/m/Y");

// start pdf data
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(2,48,32);
$pdf->SetTextColor(255,255,255);
$pdf->ln();
$pdf->cell(195,7,"Personal Information",1,1,'C',true);

$pdf->SetFont('Arial','',9);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(45,7,'Pan : ',1,0);
$pdf->Cell(45,7,'Client ID : ',1,0);
$pdf->Cell(105,7,'Client Name : ',1,0);

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(2,48,32);
$pdf->SetTextColor(255,255,255);
$pdf->ln();
$pdf->cell(195,7,"Other credits and debits for all segments from  ",1,1,'C',true);

// ######################### Start Realized Profit Breakdown
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"Mutual Funds",1,1,'',true);

$pdf->SetFont('Arial','',9);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(105,7,'Particulars',1,0);
$pdf->Cell(45,7,'Debit',1,0);
$pdf->Cell(45,7,'Credit',1,0);

$pdf->AddPage();

$pdf -> Line(10, 270, 205, 270); // ____
$pdf -> Line(10, 10, 10, 270);// |......
$pdf -> Line(10, 10, 205, 10);//----....
$pdf -> Line(205, 10, 205, 270);//.....|

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(2,48,32);
$pdf->SetTextColor(255,255,255);
$pdf->cell(195,7,"F&O",1,1,'C',true);

$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(105,7,'Particulars',1,0);
$pdf->Cell(45,7,'Debit',1,0);
$pdf->Cell(45,7,'Credit',1,0);
$pdf->ln(); 

// Total

$pdf->SetFont('Arial','B',8);
$pdf->Cell(105,7,'',0,0);
$pdf->Cell(45,7,'Total',1,0);
$pdf->Cell(45,7,'0',1,0);

$pdf->ln(); 
$total_SHORTTERM=0;
$pdf->SetFont('Arial','',7);

$pdf->AddPage();

$pdf -> Line(10, 270, 205, 270); // ____
$pdf -> Line(10, 10, 10, 270);// |......
$pdf -> Line(10, 10, 205, 10);//----....
$pdf -> Line(205, 10, 205, 270);//.....|

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(2,48,32);
$pdf->SetTextColor(255,255,255);
$pdf->cell(195,7,"Equity",1,1,'C',true);

$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(105,7,'Particulars',1,0);
$pdf->Cell(45,7,'Debit',1,0);
$pdf->Cell(45,7,'Credit',1,0);
$pdf->ln(); 

// Total

$pdf->SetFont('Arial','B',8);
$pdf->Cell(105,7,'',0,0);
$pdf->Cell(45,7,'Total',1,0);
$pdf->Cell(45,7,'0',1,0);

$pdf->ln(); 
$total_SHORTTERM=0;
$pdf->SetFont('Arial','',7);

$pdf->AddPage();

$pdf -> Line(10, 270, 205, 270); // ____
$pdf -> Line(10, 10, 10, 270);// |......
$pdf -> Line(10, 10, 205, 10);//----....
$pdf -> Line(205, 10, 205, 270);//.....|

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(2,48,32);
$pdf->SetTextColor(255,255,255);
$pdf->cell(195,7,"Currency",1,1,'C',true);

$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(105,7,'Particulars',1,0);
$pdf->Cell(45,7,'Debit',1,0);
$pdf->Cell(45,7,'Credit',1,0);
$pdf->ln(); 

// Total

$pdf->SetFont('Arial','B',8);
$pdf->Cell(105,7,'',0,0);
$pdf->Cell(45,7,'Total',1,0);
$pdf->Cell(45,7,'0',1,0);

$pdf->ln(); 
$total_SHORTTERM=0;
$pdf->SetFont('Arial','',7);

$pdf->AddPage();

$pdf -> Line(10, 270, 205, 270); // ____
$pdf -> Line(10, 10, 10, 270);// |......
$pdf -> Line(10, 10, 205, 10);//----....
$pdf -> Line(205, 10, 205, 270);//.....|

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(2,48,32);
$pdf->SetTextColor(255,255,255);
$pdf->cell(195,7,"Commodity",1,1,'C',true);

$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(105,7,'Particulars',1,0);
$pdf->Cell(45,7,'Debit',1,0);
$pdf->Cell(45,7,'Credit',1,0);
$pdf->ln(); 

// Total

$pdf->SetFont('Arial','B',8);
$pdf->Cell(105,7,'',0,0);
$pdf->Cell(45,7,'Total',1,0);
$pdf->Cell(45,7,'0',1,0);

$pdf->ln(); 
$total_SHORTTERM=0;
$pdf->SetFont('Arial','',7);


$pdf->Output('I',"Other_charges.php");
?>