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
// $pdf -> Line(10, 270, 205, 270); // ____
// $pdf -> Line(10, 10, 10, 270);// |......
// $pdf -> Line(10, 10, 205, 10);//----....
// $pdf -> Line(205, 10, 205, 270);//.....|

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
$split_date = explode("/", $final_convert_date_new_fromdate);
$year1 = $split_date[2];
$split_date1 = explode("/", $final_convert_date_new_todate_eq);
$year2 = $split_date1[2];

$pdf->cell(195,7,"Profit/Loss Report For Summary From ".$final_convert_date_new_fromdate." TO ".$final_convert_date_new_todate_eq."  FY [".$year1." - ".$year2."]",1,0,'C');

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

// ######################### Start Realized Profit Breakdown
$pdf->ln();

$pdf->ln();
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"Equity Profit/Loss",1,1,'',true);
$pdf->SetFont('Arial','',9);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(97.5,7,'Intra-day Profit',1,0);
$pdf->Cell(97.5,7,$intraday_total,1,0);
$pdf->ln();
$pdf->Cell(97.5,7,'Short-term Profit ',1,0);
$pdf->Cell(97.5,7,$shortterm_total,1,0);
$pdf->ln();
$pdf->Cell(97.5,7,'Long-term Profit',1,0);
$pdf->Cell(97.5,7,$longterm_total,1,0);
$pdf->SetFont('Arial','B',9);
$pdf->ln();
$pdf->Cell(97.5,7,'Total Realized Profit ',1,0);
$pdf->Cell(97.5,7,$intraday_total+$shortterm_total+$longterm_total,1,0);
$pdf->ln();
$pdf->SetFont('Arial','',9);
$pdf->Cell(97.5,7,"Liabilities",1,0);
$pdf->Cell(97.5,7,$LIABILITIES_total,1,0);
$pdf->ln();
$pdf->Cell(97.5,7,'Holding',1,0);
$pdf->Cell(97.5,7,$holdings,1,0);
$pdf->ln();

$pdf->ln();
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"Future Option Profit/Loss",1,1,'',true);
$pdf->SetFont('Arial','',9);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(97.5,7,'Total Realized Profit',1,0);
$pdf->Cell(97.5,7,$future_total+$options_total,1,0);
$pdf->ln();

$pdf->ln();
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32); 
$pdf->cell(195,7,"Currency Derivatives Profit/Loss",1,1,'',true);
$pdf->SetFont('Arial','',9);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(97.5,7,'Total Realized Profit',1,0);
$pdf->Cell(97.5,7,$cd_future_total+$cd_options_total,1,0);
$pdf->ln();
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
$pdf->ln();
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"Other Taxes",1,1,'',true);
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(97.5,7,'JV',1,0);
$pdf->Cell(97.5,7,Ledger_balance($yestarday_balance_2_charges),1,0);
$pdf->ln();
$pdf->Cell(97.5,7,'Payment (P)',1,0);
$pdf->Cell(97.5,7,Ledger_balance($yestarday_balance_2_charges_P),1,0);
$pdf->ln();
$pdf->Cell(97.5,7,'Receipt (R)',1,0);
$pdf->Cell(97.5,7,Ledger_balance($yestarday_balance_2_charges_R),1,0);

$pdf->AddPage();
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"JV Summary",1,1,'C',true);

$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(14,7,'V.Date',1,0);
$pdf->Cell(15,7,'Segment',1,0);
$pdf->Cell(109,7,'Particulars',1,0);
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
foreach ($act_jv as $key => $value) 
{
    // if($ledger_PNL[$i][1] != "" || $ledger_PNL[$i][2] != "")
    // {
        // $debit = $debit + floatval($ledger_PNL[$i][1]);
        // $credit = $credit + floatval($ledger_PNL[$i][2]);
    if (str_contains($act_jv[$i][13], 'FUND TRANSFER') || str_contains($act_jv[$i][13], 'Inter Exchange'))
        { 
        }
        else
        {
            if($act_jv[$i][12] != "" || $act_jv[$i][11] != "")
            {
            $cell_htg = 6;
            $cell_htg_row = 6;



            $just =$value[13];
            $just = str_replace('DP Balance Transfer','DP_Balance_Transfer',$value[13]);
            $strlen_str = strlen($just);
            $not_in = 0;
          
            $old_yval = $yval;
            $xval = $pdf->GetX();
                        
            $yval = $pdf->GetY();

            $pdf->SetXY($xval+29,$yval);
            //Particulers
            $pdf->MultiCell(109,$cell_htg_row,$just,1);
            
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
            // $pdf->Cell(14,$cell_htg,"",1);

            //Voucher Date
            if($value[7] != "" && $value[7]!=" ")
            { 
                $pdf->Cell(14,$cell_htg,($value[7] != " ")?date_format(date_create(str_replace(",", "", $value[7])),"d-m-Y"):"",1);
            }
            else
            {
                 $pdf->Cell(14,$cell_htg,"",1);
            }


            //Voucher .No
            // $pdf->Cell(16,$cell_htg,$value[4],1);
            //Segment
            $pdf->Cell(15,$cell_htg,$value[0],1);
            // Next Cell
            $pdf->SetXY($xval+138,$yval-$cell_htg_row);
            //ChqNo.
            // $pdf->Cell(11,$cell_htg,$value[9],1,0,'R');
            // Debit
            $debit_total+=$value[12];

            $pdf->Cell(17,$cell_htg,number_format((float)$value[12], 2, '.', ','),1,0,'R');
            //Credit
            $credit_total+=$value[11];
            $pdf->Cell(20,$cell_htg,number_format((float)$value[11], 2, '.', ','),1,0,'R');
            //Balance
            if($value[12] == 0)
            {
                $yestarday_balance -= $value[11];
                $yestarday_balance_2 += $value[11];
                
                // $yestarday_balance -= $ledger_PNL[$i][2];
                // $yestarday_balance_2 += $ledger_PNL[$i][2];
                $pdf->Cell(20,$cell_htg,Ledger_balance($yestarday_balance),1,0,'R');
            }
            else
            {
                $yestarday_balance += $value[12];
                $yestarday_balance_2 -= $value[12];
                // $yestarday_balance += $ledger_PNL[$i][1];
                // $yestarday_balance -= $ledger_PNL[$i][1];
                $pdf->Cell(20,$cell_htg,Ledger_balance($yestarday_balance),1,0,'R');
            }
            // $total_balance += $yestarday_balance;
            $total_balance += $yestarday_balance;

            $pdf->Ln();
    }
}
    $i++;
}
// Closing line
$pdf->Cell(195,0,'','T');

//Closing Balance
$pdf->SetFont('Arial','B', 9);
$pdf->Ln();
$pdf->cell(138,5,'Closing Balance',1,0,'C');
$pdf->SetFont('Arial','B', 7);
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

$pdf->AddPage();
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"Payment Summary",1,1,'C',true);

$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(14,7,'V.Date',1,0);
$pdf->Cell(15,7,'Segment',1,0);
$pdf->Cell(109,7,'Particulars',1,0);
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

$hght = 95;
$old_yval = 0;
$yval = 0;
$num = 1;
foreach ($act_P as $key => $value) 
{
    // if($ledger_PNL[$i][1] != "" || $ledger_PNL[$i][2] != "")
    // {
        // $debit = $debit + floatval($ledger_PNL[$i][1]);
        // $credit = $credit + floatval($ledger_PNL[$i][2]);
    if (str_contains($act_P[$i][13], 'FUND TRANSFER') || str_contains($act_P[$i][13], 'Inter Exchange'))
        { 
        }
        else
        {
            if($act_P[$i][12] != "" || $act_P[$i][11] != "")
            {
            $cell_htg = 6;
            $cell_htg_row = 6;



            $just =$value[13];
            $just = str_replace('DP Balance Transfer','DP_Balance_Transfer',$value[13]);
            $strlen_str = strlen($just);
            $not_in = 0;
          
            $old_yval = $yval;
            $xval = $pdf->GetX();
                        
            $yval = $pdf->GetY();

            $pdf->SetXY($xval+29,$yval);
            //Particulers
            $pdf->MultiCell(109,$cell_htg_row,$just,1);
            
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
            // $pdf->Cell(14,$cell_htg,"",1);

            //Voucher Date
            if($value[7] != "" && $value[7]!=" ")
            { 
                $pdf->Cell(14,$cell_htg,($value[7] != " ")?date_format(date_create(str_replace(",", "", $value[7])),"d-m-Y"):"",1);
            }
            else
            {
                 $pdf->Cell(14,$cell_htg,"",1);
            }


            //Voucher .No
            // $pdf->Cell(16,$cell_htg,$value[4],1);
            //Segment
            $pdf->Cell(15,$cell_htg,$value[0],1);
            // Next Cell
            $pdf->SetXY($xval+138,$yval-$cell_htg_row);
            //ChqNo.
            // $pdf->Cell(11,$cell_htg,$value[9],1,0,'R');
            // Debit
            $debit_total+=$value[12];

            $pdf->Cell(17,$cell_htg,number_format((float)$value[12], 2, '.', ','),1,0,'R');
            //Credit
            $credit_total+=$value[11];
            $pdf->Cell(20,$cell_htg,number_format((float)$value[11], 2, '.', ','),1,0,'R');
            //Balance
            if($value[12] == 0)
            {
                $yestarday_balance -= $value[11];
                $yestarday_balance_2 += $value[11];
                
                // $yestarday_balance -= $ledger_PNL[$i][2];
                // $yestarday_balance_2 += $ledger_PNL[$i][2];
                $pdf->Cell(20,$cell_htg,Ledger_balance($yestarday_balance),1,0,'R');
            }
            else
            {
                $yestarday_balance += $value[12];
                $yestarday_balance_2 -= $value[12];
                // $yestarday_balance += $ledger_PNL[$i][1];
                // $yestarday_balance -= $ledger_PNL[$i][1];
                $pdf->Cell(20,$cell_htg,Ledger_balance($yestarday_balance),1,0,'R');
            }
            // $total_balance += $yestarday_balance;
            $total_balance += $yestarday_balance;

            $pdf->Ln();
    }
}
    $i++;
}
// Closing line
$pdf->Cell(195,0,'','T');

//Closing Balance
$pdf->SetFont('Arial','B', 9);
$pdf->Ln();
$pdf->cell(138,5,'Closing Balance',1,0,'C');
$pdf->SetFont('Arial','B', 7);
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

$pdf->AddPage();
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"Receipt Summary",1,1,'C',true);

$pdf->SetFont('Arial','B',8);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(14,7,'V.Date',1,0);
$pdf->Cell(15,7,'Segment',1,0);
$pdf->Cell(109,7,'Particulars',1,0);
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

$hght = 95;
$old_yval = 0;
$yval = 0;
$num = 1;
foreach ($act_R as $key => $value) 
{
    // if($ledger_PNL[$i][1] != "" || $ledger_PNL[$i][2] != "")
    // {
        // $debit = $debit + floatval($ledger_PNL[$i][1]);
        // $credit = $credit + floatval($ledger_PNL[$i][2]);
    if (str_contains($act_R[$i][13], 'FUND TRANSFER') || str_contains($act_R[$i][13], 'Inter Exchange'))
        { 
        }
        else
        {
            if($act_R[$i][12] != "" || $act_R[$i][11] != "")
            {
            $cell_htg = 6;
            $cell_htg_row = 6;



            $just =$value[13];
            $just = str_replace('DP Balance Transfer','DP_Balance_Transfer',$value[13]);
            $strlen_str = strlen($just);
            $not_in = 0;
          
            $old_yval = $yval;
            $xval = $pdf->GetX();
                        
            $yval = $pdf->GetY();

            $pdf->SetXY($xval+29,$yval);
            //Particulers
            $pdf->MultiCell(109,$cell_htg_row,$just,1);
            
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
            // $pdf->Cell(14,$cell_htg,"",1);

            //Voucher Date
            if($value[7] != "" && $value[7]!=" ")
            { 
                $pdf->Cell(14,$cell_htg,($value[7] != " ")?date_format(date_create(str_replace(",", "", $value[7])),"d-m-Y"):"",1);
            }
            else
            {
                 $pdf->Cell(14,$cell_htg,"",1);
            }


            //Voucher .No
            // $pdf->Cell(16,$cell_htg,$value[4],1);
            //Segment
            $pdf->Cell(15,$cell_htg,$value[0],1);
            // Next Cell
            $pdf->SetXY($xval+138,$yval-$cell_htg_row);
            //ChqNo.
            // $pdf->Cell(11,$cell_htg,$value[9],1,0,'R');
            // Debit
            $debit_total+=$value[12];

            $pdf->Cell(17,$cell_htg,number_format((float)$value[12], 2, '.', ','),1,0,'R');
            //Credit
            $credit_total+=$value[11];
            $pdf->Cell(20,$cell_htg,number_format((float)$value[11], 2, '.', ','),1,0,'R');
            //Balance
            if($value[12] == 0)
            {
                $yestarday_balance -= $value[11];
                $yestarday_balance_2 += $value[11];
                
                // $yestarday_balance -= $ledger_PNL[$i][2];
                // $yestarday_balance_2 += $ledger_PNL[$i][2];
                $pdf->Cell(20,$cell_htg,Ledger_balance($yestarday_balance),1,0,'R');
            }
            else
            {
                $yestarday_balance += $value[12];
                $yestarday_balance_2 -= $value[12];
                // $yestarday_balance += $ledger_PNL[$i][1];
                // $yestarday_balance -= $ledger_PNL[$i][1];
                $pdf->Cell(20,$cell_htg,Ledger_balance($yestarday_balance),1,0,'R');
            }
            // $total_balance += $yestarday_balance;
            $total_balance += $yestarday_balance;

            $pdf->Ln();
    }
}
    $i++;
}
// Closing line
$pdf->Cell(195,0,'','T');

//Closing Balance
$pdf->SetFont('Arial','B', 9);
$pdf->Ln();
$pdf->cell(138,5,'Closing Balance',1,0,'C');
$pdf->SetFont('Arial','B', 7);
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

$pdf->Output('I',"summary_pnl.pdf");
date_default_timezone_set('Asia/Kolkata');
$myfile2 = fopen("Summary_pnl_log.txt", "a") or die("Unable to open file!");
$txt2 = "\n".$data[0]."\n".$_SESSION['APBackOffice_user_code']."\n".$this->input->ip_address()."\n".date('Y-m-d H:i:s')."\n";
fwrite($myfile2, $txt2);