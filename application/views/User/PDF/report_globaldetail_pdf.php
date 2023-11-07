<?php

 // print_r($_SESSION['subtotal_buyqty']);exit();
// exit();

// ###################### Start  Total ####################

// if(isset($_SESSION['totalofsaleqty_sub']))
// {
//     $saleqty_total_sub=$_SESSION['totalofsaleqty_sub'];
// }
// if(isset($_SESSION['totalofnetqty_sub']))
// {
//     $netqty_total_sub=$_SESSION['totalofnetqty_sub'];
// }
// if(isset($_SESSION['totalofnetamount_sub']))
// {
//     $netamount_total_sub=$_SESSION['totalofnetamount_sub'];
// }
// ###################### End  Total ######################
// ###################### Start Grand Total ####################
if(isset($_SESSION['totalofbuyqty']))
{
    $buyqty_total=$_SESSION['totalofbuyqty'];
}
if(isset($_SESSION['totalofsaleqty']))
{
    $saleqty_total=$_SESSION['totalofsaleqty'];
}
if(isset($_SESSION['totalofnetqty']))
{
    $netqty_total=$_SESSION['totalofnetqty'];
}
if(isset($_SESSION['totalofnetamount']))
{
    $netamount_total=$_SESSION['totalofnetamount'];
}
// ###################### End Grand Total ######################
$group = array();
foreach ($Reportglobaldetail_PNL as $value ) {
    $group[$value[30]][] = $value;
}
// echo "<pre>";
// print_r($group );
// exit();
require('fpdf.php');
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
    public function Footer()
    {      

            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Page number
              // $this -> Line(10, 10, 205, 10);
            $this->cell(0,10,' Report Global Detail Page '.$this->PageNo().'',0,0,'C');


    }   
}
$pdf = new PDF('L');
$pdf->AddPage();
$pdf -> Line(10, 42, 290, 42);
$pdf -> Line(10, 10, 10, 42);
$pdf -> Line(10, 10, 290, 10);
$pdf -> Line(290, 10, 290, 42);

$pdf->SetFont('Arial','B',11);
$pdf->SetXY(12, 12);
$pdf->Cell(25,4,"",0);

$pdf->SetFont('Arial','',7);
$pdf->SetXY(12, 16);
$pdf->Cell(25,4,"",0);

$pdf->SetXY(12, 20);
$pdf->Cell(25,4,"",0);

$pdf->SetXY(12, 24);
$pdf->Cell(25,4,"",0);

$pdf->SetXY(12, 28);
$pdf->Cell(25,4,"",0);

$pdf->SetXY(12, 32);
$pdf->Cell(25,4,"",0);

$pdf->SetXY(12, 36);
$pdf->Cell(25,4,"",0);

$pdf->Image('arham_logo.JPG',100,17,100);

// start pdf data
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(2,48,32);
$pdf->SetTextColor(255,255,255);
$pdf->ln();
$pdf->cell(280,7,"Personal Information",1,1,'C',true);

$pdf->SetFont('Arial','',9);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(60,7,'Client ID : '.$data[0],1,0);
$pdf->Cell(160,7,'Client Name : '.$data[1],1,0);
$pdf->Cell(60,7,'Pan : '.$data[2],1,0);

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(2,48,32);
$pdf->SetTextColor(255,255,255);
$pdf->ln();
$pdf->cell(280,7,"Statement For Global Detail From ".$report_globaldetail_fromdate." TO ".$report_globaldetail_todate."",1,1,'C',true);

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(280,7,"Report Global Detail",1,1,'',true);

$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(22,7,'Company',1,0);
$pdf->Cell(22,7,'Date',1,0);
$pdf->Cell(70,7,'Narration',1,0);
$pdf->Cell(22,7,'Buy Qty',1,0);
$pdf->Cell(22,7,'Buy Rate',1,0);
$pdf->Cell(22,7,'Sale Qty',1,0);
$pdf->Cell(22,7,'Sale Rate',1,0);
$pdf->Cell(22,7,'Net Qty',1,0);
$pdf->Cell(28,7,'Net Rate',1,0);
$pdf->Cell(28,7,'Net Amount',1,0);
$pdf->ln(); 

// ######################### Start Report Ledger  #########################
// $pdf->SetFont('Arial','',7);
// $pdf->SetFillColor(255,255,255);
// $pdf->SetTextColor(0,0,0);
$i=0;
$old_yval = 0;
$yval = 0;

// $buyrate_total=0;
// $saleqty_total=0;
// $salerate_total=0;
// $netqty_total=0;
// $netrate_total=0;
// $netamount_total=0;
foreach ($group as $key_index => $data_row) 
{ 
    // echo "<pre>";
    // print_r($data_row);
    // // $buyqty_total_sub+=$Reportglobaldetail_PNL[$i][34];
    // // print_r($buyqty_total_sub);
    // exit();

    $cell_htg = 6;
    $buyqty_total_sub=0;
    $saleqty_total_sub=0;
    $netqty_total_sub=0;
    $netamount_total_sub=0;
    $pdf->SetFont('Arial','B',8);
    $pdf->SetFillColor(192, 192, 192);
    $pdf->Cell(280,$cell_htg,$key_index,1,0,'',true);
    
    $pdf->Ln();
    foreach ($data_row as $key_index2 => $data_row2) 
    {
        $pdf->SetFont('Arial','',7);
        $pdf->SetFillColor(255,255,255);
        $pdf->SetTextColor(0,0,0);

        // company name
        $pdf->Cell(22,$cell_htg,$Reportglobaldetail_PNL[$i][0],1);
        // Date
        $pdf->Cell(22,$cell_htg,($Reportglobaldetail_PNL[$i][32] != " ")?date_format(date_create(str_replace("/", "-", $Reportglobaldetail_PNL[$i][32])),"d-m-Y"):"",1);
        // Narration
        $pdf->Cell(70,$cell_htg,$Reportglobaldetail_PNL[$i][26],1);
        // buy quantity 
        $buyqty_total_sub+=$data_row2[34];
        $pdf->Cell(22,$cell_htg,$Reportglobaldetail_PNL[$i][34],1);
        // buy rate
        // $buyrate_total+=$value[1];
        $pdf->Cell(22,$cell_htg,$Reportglobaldetail_PNL[$i][1],1);
        // sale qty
        $saleqty_total_sub+=$data_row2[3];
        $pdf->Cell(22,$cell_htg,$Reportglobaldetail_PNL[$i][3],1);
        // sale rate
        // $salerate_total+=$value[4];
        $pdf->Cell(22,$cell_htg,$Reportglobaldetail_PNL[$i][4],1);
        // net qty
        $netqty_total_sub+=$data_row2[6];
        $pdf->Cell(22,$cell_htg,$Reportglobaldetail_PNL[$i][6],1);
        // net rate
        // $netrate_total+=$value[7];
        $pdf->Cell(28,$cell_htg,$Reportglobaldetail_PNL[$i][7],1);
        // net amount
        $netamount_total_sub+=$data_row2[9];
        $pdf->Cell(28,$cell_htg,$Reportglobaldetail_PNL[$i][9],1);
        $pdf->Ln();
        $i++;

    // echo $buyqty_total_sub;
    // exit();
    }
   

    $pdf->SetFont('Arial','B',8);
    $pdf->Cell(22,$cell_htg,"",1);
    $pdf->Cell(22,$cell_htg,"",1);
    $pdf->Cell(70,$cell_htg,"Total",1);
    $pdf->Cell(22,$cell_htg,$buyqty_total_sub,1);
    $pdf->Cell(22,$cell_htg,"",1);
    $pdf->Cell(22,$cell_htg,$saleqty_total_sub,1);
    $pdf->Cell(22,$cell_htg,"",1);
    $pdf->Cell(22,$cell_htg,$netqty_total_sub,1);
    $pdf->Cell(28,$cell_htg,"",1);
    $pdf->Cell(28,$cell_htg,$netamount_total_sub,1);
    $pdf->Ln();
    $pdf->SetFont('Arial','',7);
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0,0,0);

}
// Closing line
$pdf->Cell(195,0,'','T');

$pdf->SetFont('Arial','B', 9);
$pdf->Ln();

$pdf->cell(22,$cell_htg,'Grand Total',1,0,'C');
// $pdf->SetFont('Arial','', 7);
$pdf->Cell(22,$cell_htg,"",1);
$pdf->Cell(70,$cell_htg,"",1);
$pdf->Cell(22,$cell_htg,$buyqty_total,1);
$pdf->Cell(22,$cell_htg,"",1);
$pdf->Cell(22,$cell_htg,$saleqty_total,1);
$pdf->Cell(22,$cell_htg,"",1);
$pdf->Cell(22,$cell_htg,$netqty_total,1);
$pdf->Cell(28,$cell_htg,"",1);
$pdf->Cell(28,$cell_htg,$netamount_total,1);

$pdf->Output('D',"GLOBALDETAIL_REPORT.pdf");

?>