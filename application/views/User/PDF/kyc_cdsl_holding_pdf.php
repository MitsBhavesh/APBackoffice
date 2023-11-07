<?php
// echo "<pre>";
// print_r($Holding_PNL);
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
	        $this->cell(0,10,'DP Ledger Page '.$this->PageNo().'',0,0,'C');


	}   
}
$pdf = new PDF();
$pdf->AddPage();
$pdf -> Line(10, 42, 205, 42);
$pdf -> Line(10, 10, 10, 42);
$pdf -> Line(10, 10, 205, 10);
$pdf -> Line(205, 10, 205, 42);

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

$pdf->Image('arham_logo.JPG',60,17,100);

// start pdf data
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(2,48,32);
$pdf->SetTextColor(255,255,255);
$pdf->ln();
$pdf->cell(195,7,"Personal Information",1,1,'C',true);

$pdf->SetFont('Arial','',9);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(45,7,'Client ID : '.$data[0],1,0);
$pdf->Cell(105,7,'Client Name : '.$data[1],1,0);
$pdf->Cell(45,7,'Pan : '.$data[2],1,0);

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(2,48,32);
$pdf->SetTextColor(255,255,255);
$pdf->ln();
$pdf->cell(195,7,"Statement For Holding From 01/04/2022 TO 30/04/2023",1,1,'C',true);

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"Holding",1,1,'',true);

$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(45,7,'Scrip Name',1,0);
$pdf->Cell(20,7,'ISIN',1,0);
$pdf->Cell(13,7,'Free B/C',1,0);
$pdf->Cell(16,7,'Pledge B/C',1,0);
$pdf->Cell(18,7,'PendingDmt',1,0);
$pdf->Cell(11,7,'Lock In',1,0);
$pdf->Cell(18,7,'PendingRmt',1,0);
$pdf->Cell(12,7,'Total',1,0);
$pdf->Cell(14,7,'Price',1,0);
$pdf->Cell(14,7,'Value',1,0);
$pdf->Cell(14,7,'EarMark',1,0);
$pdf->ln(); 

$pdf->SetFont('Arial','',7);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$i=0;
$debit_total = 0;
$credit_total = 0;
$total_balance = 0;
$yestarday_balance = 0;
$yestarday_balance_2 = 0;
$j = 2;
$i = 0;
$hght = 95;
$old_yval = 0;
$yval = 0;
$num = 1;
// $Holding_PNL
foreach ($Holding_PNL as $key => $value) 
{
    $total_sum=array((int)$value[5],(int)$value[8],(int)$value[4],(int)$value[6]);
    $sum_totalvalue=array_sum($total_sum);
    $value_multiply = (float)$sum_totalvalue * (float)$value[16];
    if($sum_totalvalue!=0)
    {
        $cell_htg = 6;
        $cell_htg_row = 6;

        $just =$value[14];
        $strlen_str = strlen($just);
        $not_in = 0;
      
        $old_yval = $yval;
        $xval = $pdf->GetX();
                    
        $yval = $pdf->GetY();

        $pdf->SetXY($xval+0,$yval);//59

        
        //scrip name
        $pdf->MultiCell(45,$cell_htg_row,$just,1);//68
        
        $xval = $pdf->GetX();
                                
        $yval = $pdf->GetY();
           
        if(($old_yval-$yval) == -12)
        {
            $cell_htg = 12;
            $cell_htg_row = 12;
        }
        else if(($old_yval-$yval) == -18)
        {
            $cell_htg = 18;
            $cell_htg_row = 18;
        }
        else if($old_yval-$yval == -24)
        {
    
            $cell_htg = 24;
            $cell_htg_row = 24;
        }
        else if(($old_yval-$yval) == -30)
        {
            $cell_htg = 30;
            $cell_htg_row = 30;
        }
        else if(($old_yval-$yval) == -36)
        {
            $cell_htg = 36;
            $cell_htg_row = 36;
        }
        else if(($old_yval-$yval) == 252)
        {
            // echo "sadsa";
            $cell_htg = 12;
            $cell_htg_row = 12;
        }
        // echo $yval;
        // exit();

        $pdf->SetXY($xval,$yval-$cell_htg_row);
        $pdf->SetFont('Arial','', 7);
       
       
        // echo $yval;
        // exit(); 
        $pdf->SetXY($xval+45,$yval-$cell_htg_row);
        // 75
         // $pdf->SetXY($xval+45,75);
        
        // ISIN
        $pdf->Cell(20,$cell_htg,$value[13],1);
        // Free Balance 
        $pdf->Cell(13,$cell_htg,$value[5],1);
        // Pledge Balance
        $pdf->Cell(16,$cell_htg,$value[8],1);
        // Pending Dmt
        $pdf->Cell(18,$cell_htg,$value[4],1);
        // Lock In
        $pdf->Cell(11,$cell_htg,$value[6],1);
        // Pending Remat
        $pdf->Cell(18,$cell_htg," ",1);
        //Total
        $pdf->Cell(12,$cell_htg,$sum_totalvalue,1);
        //Price
        $pdf->Cell(14,$cell_htg,$value[16],1);
        //Value
        $pdf->Cell(14,$cell_htg,$value_multiply,1);
        //Ear Mark
        $pdf->Cell(14,$cell_htg," ",1);
        $pdf->Ln();
    }
    $i++;
}
$pdf->Output('D',"CDSL_HOLDING.pdf");
// date_default_timezone_set('Asia/Kolkata');
// $myfile2 = fopen("kyc_holding_pdf_log.txt", "a") or die("Unable to open file!");
// $txt2 = "\n".$this->input->ip_address()."\n".date('Y-m-d H:i:s')."\n";
// fwrite($myfile2, $txt2);
?>