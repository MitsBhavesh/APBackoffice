<?php

// print_r($kyc_dpledger_fromdate);
// echo "<br>";
// echo "<pre>";
// print_r($DPledger_PNL);
// exit();
// $i = 0;
// foreach ($DPledger_PNL as $key => $value) 
// {
//     echo "<pre>";
//     print_r($value);
//     print_r($DPledger_PNL[$i][1]);
//     // exit();
// }
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
$pdf->cell(195,7,"Statement For DP Ledger From ".$kyc_dpledger_fromdate." TO ".$kyc_dpledger_todate."",1,1,'C',true);

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"DP Ledger",1,1,'',true);

$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(14,7,'Date',1,0);
$pdf->Cell(14,7,'Voucher',1,0);
$pdf->Cell(16,7,'CDSL No',1,0);
$pdf->Cell(15,7,'Code',1,0);
$pdf->Cell(60,7,'Narration',1,0);
$pdf->Cell(11,7,'ChqNo',1,0);
$pdf->Cell(17,7,'R.Date',1,0);
$pdf->Cell(15,7,'Debit',1,0);
$pdf->Cell(15,7,'Credit',1,0);
$pdf->Cell(18,7,'Balance',1,0);
$pdf->ln(); 

// ######################### Start DP Ledger  #########################
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
foreach ($DPledger_PNL as $key => $value) 
{
    if($DPledger_PNL[$i][10] != "" || $DPledger_PNL[$i][11] != "")
    {
        $cell_htg = 6;
        $cell_htg_row = 6;

        // $just =$value[1];
        $just = str_replace('DP Balance Transfer','DP_Balance_Transfer',$value[1]); 
        $strlen_str = strlen($just);
        $not_in = 0;
      
        $old_yval = $yval;
        $xval = $pdf->GetX();
                    
        $yval = $pdf->GetY();

        $pdf->SetXY($xval+59,$yval);//59
        //Narration
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
       
        // Trading Date
        $pdf->Cell(14,$cell_htg,($DPledger_PNL[$i][12] != " " && $DPledger_PNL[$i][12] != "")?date_format(date_create(str_replace(",", "", $DPledger_PNL[$i][12])),"d-m-Y"):"",1);

        // echo ($data_row[12] != " ")?date_format(date_create(str_replace(",", "", $data_row[12])),"Y/m/d"):""; 
        //Voucher 
        // $pdf->Cell(14,$cell_htg,$value[6],1);
        if(str_replace(" ", "", $DPledger_PNL[$i][6]) == "SJ")
        {
          
           $pdf->Cell(14,$cell_htg,"Bill",1);
          
        }
        elseif(str_replace(" ", "", $DPledger_PNL[$i][6]) == "OP")
        {
              // $s1=str_replace("J","JV",$data_row[6]);
              // echo $s1;
           // echo "OP";
           $pdf->Cell(14,$cell_htg,"OP",1);
        }
        else
        {
           // echo "JV";
           $pdf->Cell(14,$cell_htg,"JV",1);
        }
        //CDSL No 
        $pdf->Cell(16,$cell_htg,substr($value[14],2),1);
        // Code
        // $pdf->Cell(15,$cell_htg,$value[6],1);
        if(str_replace(" ", "", $DPledger_PNL[$i][6]) == "SJ")
        {
         
          // echo " ";
          $pdf->Cell(15,$cell_htg," ",1);
         
        }
        elseif(str_replace(" ", "", $DPledger_PNL[$i][6]) == "OP")
        {
          // echo "OP";
          $pdf->Cell(15,$cell_htg,"OP",1);
        }
        else
        {
          // echo "JV";
          $pdf->Cell(15,$cell_htg,"JV",1);
        }
         // Next Cell
        $pdf->SetXY($xval+119,$yval-$cell_htg_row);
        //Cheque No
        $pdf->Cell(11,$cell_htg,$value[2],1);
        //Receive Date
        $pdf->Cell(17,$cell_htg,($DPledger_PNL[$i][12] != " " && $DPledger_PNL[$i][12] != "")?date_format(date_create(str_replace(",", "", $DPledger_PNL[$i][12])),"d-m-Y"):"",1);
       
        //Debit
        // $pdf->Cell(15,$cell_htg,$value[10],1);
        $debit_total+=$value[10];
        $pdf->Cell(15,$cell_htg,number_format((float)$value[10], 2, '.', ','),1,0,'R');
        //Credit
        // $pdf->Cell(15,$cell_htg,$value[11],1);
        $credit_total+=$value[11];
        $pdf->Cell(15,$cell_htg,number_format((float)$value[11], 2, '.', ','),1,0,'R');
        //Balance
        if($DPledger_PNL[$i][10] == 0 || $DPledger_PNL[$i][10] == "")
        {
            $yestarday_balance += $value[10];
            $yestarday_balance -= $DPledger_PNL[$i][11];
            $yestarday_balance_2 += $DPledger_PNL[$i][11];
            $pdf->Cell(18,$cell_htg,Ledger_balance($yestarday_balance),1,0,'R');
        }
        else
        {
            $yestarday_balance += $DPledger_PNL[$i][10];
            $yestarday_balance_2 -= $DPledger_PNL[$i][10];
            $pdf->Cell(18,$cell_htg,Ledger_balance($yestarday_balance),1,0,'R');
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
$pdf->cell(147,5,'Ledger Balance',1,0,'C');
$pdf->SetFont('Arial','', 7);
$pdf->cell(15,5,$debit_total,1,0,'R');
$pdf->cell(15,5,$credit_total,1,0,'R');
if(isset($yestarday_balance_2))
{ 
    $yestarday_balance_2 = $yestarday_balance_2 <= 0 ? abs($yestarday_balance_2) : -$yestarday_balance_2 ;
    $pdf->cell(18,5,Ledger_balance($yestarday_balance_2),1,0,'R');
    // echo  $_SESSION['Final_ledger_total_balance'];
}
else
{
    $pdf->cell(18,5,"0",1,0,'R');
}
// ######################### End DP Ledger  ###########################

// $pdf->Output('I',"DP_LEDGER.pdf");
$pdf->Output('D',"DP_LEDGER.pdf");
date_default_timezone_set('Asia/Kolkata');
$myfile2 = fopen("kyc_dp_ledger_pdf_log.txt", "a") or die("Unable to open file!");
$txt2 = "\n".$this->input->ip_address()."\n".date('Y-m-d H:i:s')."\n";
fwrite($myfile2, $txt2);
?>

