<?php
// echo "<pre>";
if(isset($_SESSION['totalofnetamount']))
{
    $netamount_total=$_SESSION['totalofnetamount'];
}
if(isset($_SESSION['totalofnetprofit']))
{
    $netprofit_total=$_SESSION['totalofnetprofit'];
}
// print_r($_SESSION['totalofnetamount']);
// echo $netamount_total;
// echo "<br>";
// echo $netprofit_total;
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
            $this->cell(0,10,' Report Global Summary Page '.$this->PageNo().'',0,0,'C');


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
$pdf->cell(280,7,"Statement For Global Summary From ".$report_globalsummery_fromdate." TO ".$report_globalsummery_todate."",1,1,'C',true);

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(280,7,"Report Global Summary",1,1,'',true);

$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(60,7,'Scrip Name',1,0);
$pdf->Cell(20,7,'Open Qty',1,0);
$pdf->Cell(20,7,'Open rate',1,0);
$pdf->Cell(20,7,'Buy Qty',1,0);
$pdf->Cell(20,7,'Buy Rate',1,0);
$pdf->Cell(20,7,'Sale Qty',1,0);
$pdf->Cell(20,7,'Sale Rate',1,0);
$pdf->Cell(20,7,'Net Qty',1,0);
$pdf->Cell(20,7,'Net Rate',1,0);
$pdf->Cell(20,7,'Net Amount',1,0);
$pdf->Cell(20,7,'Closing Price',1,0);
$pdf->Cell(20,7,'Net Profit',1,0);
$pdf->ln(); 

// ######################### Start Report Ledger  #########################
$pdf->SetFont('Arial','',7);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$i=0;
$old_yval = 0;
$yval = 0;
$openqty_total=0;
$buyqty_total=0;
$saleqty_total=0;
$netqty_total=0;

foreach ($Reportglobalsummary_PNL as $key => $value) 
{
    if($Reportglobalsummary_PNL[$i][28] != "IGST" && $Reportglobalsummary_PNL[$i][28] != "STAMP DUTY" && $Reportglobalsummary_PNL[$i][28] != "OTHER EXP" && $Reportglobalsummary_PNL[$i][28] != "STT" && $Reportglobalsummary_PNL[$i][28] != "CGST" && $Reportglobalsummary_PNL[$i][28] != "SGST" && $Reportglobalsummary_PNL[$i][28] != "TURN OVER CHARGE")

    // if($Reportglobalsummary_PNL[$i][28] == "IGST" or $Reportglobalsummary_PNL[$i][28] == "STAMP DUTY" or $Reportglobalsummary_PNL[$i][28] == "OTHER EXP" or $Reportglobalsummary_PNL[$i][28] == "STT" or $Reportglobalsummary_PNL[$i][28] == "CGST" or $Reportglobalsummary_PNL[$i][28] == "SGST" or $Reportglobalsummary_PNL[$i][28] == "TURN OVER CHARGE")
    {


        $cell_htg = 6;
        $cell_htg_row = 6;

        $just =$value[38];
        
        // $just = str_replace('DP Balance Transfer','DP_Balance_Transfer',$value[9]); 
        // echo $just;
        // exit();
        $strlen_str = strlen($just);
        $not_in = 0;
      
        $old_yval = $yval;
        $xval = $pdf->GetX();
                    
        $yval = $pdf->GetY();

        $pdf->SetXY($xval+0,$yval);//59
        //Scrip Name
        $pdf->MultiCell(60,$cell_htg_row,$just,1);//68
        
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
        // echo $cell_htg_row;
        // exit();

        $pdf->SetXY($xval,$yval-$cell_htg_row);
        $pdf->SetFont('Arial','', 7);

         $pdf->SetXY($xval+60,$yval-$cell_htg_row);
        // 75
         // $pdf->SetXY($xval+45,75);
        
        //Open Qty 
        $openqty_total+=$value[39];
        $pdf->Cell(20,$cell_htg,$value[39],1);

        //Open rate
        $pdf->Cell(20,$cell_htg,$value[1],1);

        //Buy Qty
        $buyqty_total+=$value[2];
        $pdf->Cell(20,$cell_htg,$value[2],1);

        //Buy rate
        $pdf->Cell(20,$cell_htg,$value[3],1);

        //Sale Qty
        $saleqty_total+=$value[5];
        $pdf->Cell(20,$cell_htg,$value[5],1);

        //Sale Rate
        $pdf->Cell(20,$cell_htg,$value[6],1);

        //Net Qty
        $netqty_total+=$value[8];
        $pdf->Cell(20,$cell_htg,$value[8],1);

        //Net rate
        $pdf->Cell(20,$cell_htg,$value[9],1);

        //Net Amount

        // $netamount_total+=$value[10];
        $pdf->Cell(20,$cell_htg,$value[10],1);

        //Closing Price
        $pdf->Cell(20,$cell_htg,$value[13],1);

        //Net Profit
        $pdf->Cell(20,$cell_htg,$value[14],1);


        $pdf->Ln();
    }

    $i++;

       

}
// Closing line
$pdf->Cell(195,0,'','T');

//Total
$pdf->SetFont('Arial','B', 9);
$pdf->Ln();
$pdf->cell(60,5,'Total',1,0,'C');
$pdf->SetFont('Arial','', 7);
$pdf->cell(20,5,"",1,0,'R');
$pdf->cell(20,5,"",1,0,'R');
$pdf->cell(20,5,"",1,0,'R');
$pdf->cell(20,5,"",1,0,'R');
$pdf->cell(20,5,"",1,0,'R');
$pdf->cell(20,5,"",1,0,'R');
$pdf->cell(20,5,"",1,0,'R');
$pdf->cell(20,5,"",1,0,'R');
$pdf->cell(20,5,"",1,0,'R');
$pdf->cell(20,5,"",1,0,'R');
$pdf->cell(20,5,"",1,0,'R');
$pdf->Ln();

//Grand Total
$pdf->SetFont('Arial','B', 9);
$pdf->Ln();
$pdf->cell(60,5,'Grand Total',1,0,'C');
$pdf->SetFont('Arial','', 7);
$pdf->cell(20,5,$openqty_total,1,0,'');
$pdf->cell(20,5,"",1,0,'');
$pdf->cell(20,5,$buyqty_total,1,0,'');
$pdf->cell(20,5,"",1,0,'');
$pdf->cell(20,5,$saleqty_total,1,0,'');
$pdf->cell(20,5,"",1,0,'');
$pdf->cell(20,5,$netqty_total,1,0,'');
$pdf->cell(20,5,"",1,0,'');
$pdf->cell(20,5,$netamount_total,1,0,'');
$pdf->cell(20,5,"",1,0,'');
$pdf->cell(20,5,$netprofit_total,1,0,'');
$pdf->Ln();
$pdf->Output('D',"GLOBALSUMMARY_REPORT.pdf");

?>