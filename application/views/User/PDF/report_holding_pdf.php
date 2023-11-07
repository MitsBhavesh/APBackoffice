<?php
// echo "<pre>";
// print_r($Reportholding_PNL);
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
            $this->cell(0,10,' Report Holding Page '.$this->PageNo().'',0,0,'C');


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
$pdf->cell(195,7,"Statement For Holding From 01/04/2022 TO ".$report_holding_todate,1,1,'C',true);

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"Report Holding",1,1,'',true);

$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(57,7,'Scrip Name',1,0);
$pdf->Cell(22,7,'ISIN',1,0);
$pdf->Cell(9,7,'POA',1,0);
$pdf->Cell(15,7,'NONPOA',1,0);
$pdf->Cell(14,7,'Colletral',1,0);
$pdf->Cell(13,7,'In Short',1,0);
$pdf->Cell(15,7,'Out Short',1,0);
$pdf->Cell(10,7,'Net',1,0);
$pdf->Cell(20,7,'Closing Price',1,0);
$pdf->Cell(20,7,'Amount',1,0);
$pdf->ln(); 

$pdf->SetFont('Arial','',7);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);

$i=0;
$old_yval = 0;
$yval = 0;
$poa_total=0;
$nonpoa_total=0;
$colletral_total=0;
$inshort_total=0;
$outshort_total=0;
$net_total=0;
$closing_price_total=0;
$amount_total=0;

foreach ($Reportholding_PNL as $key => $value) 
{
    //  echo $Reportholding_PNL[$i][32];
    // exit();


    if($Reportholding_PNL[$i][26] != "")
    {
        $cell_htg = 6;
        $cell_htg_row = 6;

        $just =$value[26];
        $strlen_str = strlen($just);
        $not_in = 0;
      
        $old_yval = $yval;
        $xval = $pdf->GetX();
                    
        $yval = $pdf->GetY();

        $pdf->SetXY($xval+0,$yval);//59

        
        //scrip name
        $pdf->MultiCell(57,$cell_htg_row,$just,1);//68
        
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
        $pdf->SetXY($xval+57,$yval-$cell_htg_row);
       
        // ISIN
        $pdf->Cell(22,$cell_htg,$value[9],1);
        // POA
        $poa_total+=$value[32];
        $pdf->Cell(9,$cell_htg,$value[32],1);
        // NONPOA
        $nonpoa_total+=$value[36];
        $pdf->Cell(15,$cell_htg,$value[36],1);
        // Colletral
        $colletral_total+=$value[29];
        $pdf->Cell(14,$cell_htg,$value[29],1);
        // In Short
        $inshort_total+=$value[5];
        $pdf->Cell(13,$cell_htg,$value[5],1);
        // Out Short
        $outshort_total+=$value[6];
        $pdf->Cell(15,$cell_htg,$value[6],1);
        // Net
        $net_total+=$value[38];
        $pdf->Cell(10,$cell_htg,$value[38],1);
        // Closing Price
        $closing_price_total+=$value[30];
        $pdf->Cell(20,$cell_htg,$value[30],1);
        // Amount
        $amount_total+=$value[2];
        $pdf->Cell(20,$cell_htg,$value[2],1);

        $pdf->Ln();
    }
    $i++;
}
// Closing line
$pdf->Cell(195,0,'','T');

//Closing Balance
$pdf->SetFont('Arial','B', 9);
$pdf->Ln();
$pdf->cell(57,5,'Total',1,0,'C');
$pdf->SetFont('Arial','', 7);
$pdf->cell(22,5,"",1,0,'R');
$pdf->cell(9,5,"",1,0,'R');
$pdf->cell(15,5,"",1,0,'R');
$pdf->cell(14,5,"",1,0,'R');
$pdf->cell(13,5,"",1,0,'R');
$pdf->cell(15,5,"",1,0,'R');
$pdf->cell(10,5,"",1,0,'R');
$pdf->cell(20,5,"",1,0,'R');
$pdf->cell(20,5,"",1,0,'R');

$pdf->Ln();

$pdf->SetFont('Arial','B', 9);
$pdf->cell(57,5,'Grand Total',1,0,'C');
$pdf->SetFont('Arial','', 7);
$pdf->cell(22,5,"",1,0,'R');
$pdf->cell(9,5,$poa_total,1,0,'');
$pdf->cell(15,5,$nonpoa_total,1,0,'');
$pdf->cell(14,5,$colletral_total,1,0,'');
$pdf->cell(13,5,$inshort_total,1,0,'');
$pdf->cell(15,5,$outshort_total,1,0,'');
$pdf->cell(10,5,$net_total,1,0,'');
$pdf->cell(20,5,$closing_price_total,1,0,'');
$pdf->cell(20,5,$amount_total,1,0,'');
// $pdf->cell(15,5,$credit_total,1,0,'R');

$pdf->Output('D',"HOLDING_REPORT.pdf");

?>