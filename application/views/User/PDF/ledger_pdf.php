<?php
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
        $this->cell(0,10,'Account Ledger Page '.$this->PageNo().'',0,0,'C');


    }   

}
$pdf = new PDF();
// Column headings
// $header = array('PAN', 'Client id', 'Client Name');
// Data loading
// echo "<pre>"; 
// print_r($ledger_PNL);
// exit();
$pdf->AddPage();
$pdf -> Line(10, 38, 205, 38);
$pdf -> Line(10, 10, 10, 38);
$pdf -> Line(10, 10, 205, 10);
$pdf -> Line(205, 10, 205, 38);

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

$pdf->Image('arham_logo.JPG',60,16,100);

// start pdf data
$pdf->SetFont('Arial','B',12);

$pdf->ln();
$pdf->ln();
$pdf->cell(195,7,"Report For Ledger From ".$final_convert_date_new_fromdate." TO ".$final_convert_date_new_todate_ledger."",1,0,'C');
$pdf->ln();
$pdf->ln();

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"Personal Information",1,1,'',true);
$pdf->SetFont('Arial','',9);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(45,7,'Client ID : '.$data[0],1,0);
$pdf->Cell(105,7,'Client Name : '.$data[1],1,0);
$pdf->Cell(45,7,'Pan : '.$data[2],1,0);

// $pdf->SetFont('Arial','B',9);
// $pdf->SetFillColor(2,48,32);
// $pdf->SetTextColor(255,255,255);
// $pdf->ln();
// $pdf->cell(195,7,"Personal Information",1,1,'C',true);

// $pdf->SetFont('Arial','',9);
// $pdf->SetFillColor(255,255,255);
// $pdf->SetTextColor(0,0,0);
// $pdf->SetFont('Arial','B',9);
// $pdf->Cell(45,7,'Client ID : '.$data[0],1,0);
// $pdf->Cell(105,7,'Client Name : '.$data[1],1,0);
// $pdf->Cell(45,7,'Pan : '.$data[2],1,0);

// $pdf->SetFont('Arial','B',9);
// $pdf->SetFillColor(2,48,32);
// $pdf->SetTextColor(255,255,255);
// $pdf->ln();
// $pdf->cell(195,7,"Statement For Ledger From ".$final_convert_date_new_fromdate." TO ".$final_convert_date_new_todate_ledger."",1,1,'C',true);
$pdf->ln();
$pdf->ln();

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"Ledger",1,1,'',true);

$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(14,7,'Date',1,0);
$pdf->Cell(14,7,'V.Date',1,0);
$pdf->Cell(16,7,'V.No',1,0);
$pdf->Cell(15,7,'Segment',1,0);
$pdf->Cell(68,7,'Particulars',1,0);
$pdf->Cell(11,7,'ChqNo',1,0);
$pdf->Cell(17,7,'Debit',1,0);
$pdf->Cell(20,7,'Credit',1,0);
$pdf->Cell(20,7,'Balance',1,0);
$pdf->ln(); 
// ######################### Start Ledger
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

function Ledger_balance($yestarday_balance)
{
  if($yestarday_balance >= 0)
  {
    $type = " DR";
    return "".number_format((float)$yestarday_balance, 2, '.', ',').$type."";
  }
  else
  {
    $type = " CR";
    $yestarday_balance = Abs($yestarday_balance);
    return "".number_format((float)$yestarday_balance, 2, '.', ',').$type."";
  }
}
foreach ($ledger_PNL as $key => $value) 
{
    if($ledger_PNL[$i][1] != "" || $ledger_PNL[$i][2] != "")
    {
        // $debit = $debit + floatval($ledger_PNL[$i][1]);
        // $credit = $credit + floatval($ledger_PNL[$i][2]);
            $cell_htg = 6;
            $cell_htg_row = 6;

        // $just =$value[9];
        $just = str_replace('DP Balance Transfer','DP_Balance_Transfer',$value[9]);
        $strlen_str = strlen($just);
        $not_in = 0;
      
        $old_yval = $yval;
        $xval = $pdf->GetX();
                    
        $yval = $pdf->GetY();

        $pdf->SetXY($xval+59,$yval);
        //Particulers
        $pdf->MultiCell(68,$cell_htg_row,$just,1);
        
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
        //Trading Date
        // Y/m/d
        $pdf->Cell(14,$cell_htg,($ledger_PNL[$i][19] != " " && $ledger_PNL[$i][19] != "")?date_format(date_create(str_replace(",", "", $ledger_PNL[$i][19])),"d-m-Y"):"",1);
        //Voucher Date
        if($ledger_PNL[$i][3] != "" && $ledger_PNL[$i][3]!=" ")
        { 
            $pdf->Cell(14,$cell_htg,($ledger_PNL[$i][3] != " ")?date_format(date_create(str_replace(",", "", $ledger_PNL[$i][3])),"d-m-Y"):"",1);
        }
        else
        {
             $pdf->Cell(14,$cell_htg,"",1);
        }
        //Voucher .No
        $pdf->Cell(16,$cell_htg,$value[8],1);
        //Segment
        $pdf->Cell(15,$cell_htg,$value[0],1);
        // Next Cell
        $pdf->SetXY($xval+127,$yval-$cell_htg_row);
        //ChqNo.
        $pdf->Cell(11,$cell_htg,$value[12],1,0,'R');
        // Debit
        $debit_total+=$value[1];
        $pdf->Cell(17,$cell_htg,number_format((float)$value[1], 2, '.', ','),1,0,'R');
        //Credit
        $credit_total+=$value[2];
        $pdf->Cell(20,$cell_htg,number_format((float)$value[2], 2, '.', ','),1,0,'R');
        //Balance
        if($ledger_PNL[$i][1] == 0 || $ledger_PNL[$i][1] == "")
        {
            $yestarday_balance += $value[1];
            $yestarday_balance -= $ledger_PNL[$i][2];
            $yestarday_balance_2 += $ledger_PNL[$i][2];
            $pdf->Cell(20,$cell_htg,Ledger_balance($yestarday_balance),1,0,'R');
        }
        else
        {
            $yestarday_balance += $ledger_PNL[$i][1];
            $yestarday_balance_2 -= $ledger_PNL[$i][1];
            $pdf->Cell(20,$cell_htg,Ledger_balance($yestarday_balance),1,0,'R');
        }
        // $total_balance += $yestarday_balance;
        $total_balance += $yestarday_balance;

        $pdf->Ln();
    }
    $i++;
}
// Closing line
$pdf->Cell(195,0,'','T');

//Closing Balance
$pdf->SetFont('Arial','B', 9);
$pdf->Ln();
$pdf->cell(138,5,'Closing Balance',1,0,'C');
$pdf->SetFont('Arial','', 7);
$pdf->cell(17,5,$debit_total,1,0,'R');
$pdf->cell(20,5,$credit_total,1,0,'R');
if(isset($yestarday_balance_2))
{ 
    $yestarday_balance_2 = $yestarday_balance_2 <= 0 ? abs($yestarday_balance_2) : -$yestarday_balance_2 ;
    $pdf->cell(20,5,Ledger_balance($yestarday_balance_2),1,0,'R');
    // echo  $_SESSION['Final_ledger_total_balance'];
}
else
{
    $pdf->cell(20,5,"0",1,0,'R');
}


// ######################### END Ledger
$pdf->Output('D',"LEDGER_PDF.pdf");
date_default_timezone_set('Asia/Kolkata');
$myfile2 = fopen("ledger_pdf_log.txt", "a") or die("Unable to open file!");
$txt2 = "\n".$data[0]."\n".$_SESSION['APBackOffice_user_code']."\n".$this->input->ip_address()."\n".date('Y-m-d H:i:s')."\n";
fwrite($myfile2, $txt2);
?>