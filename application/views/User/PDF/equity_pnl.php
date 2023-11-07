<?php

// foreach ($equity_pnl as $key => $value) {
// echo "<pre>";
//    print_r($value);exit();

// }
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
// $header = array('PAN', 'Client id', 'Client Name');
// Data loading

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

// $pdf -> Line(10, 270, 205, 270); // ____
// $pdf -> Line(10, 43, 10, 270);// |......
// $pdf -> Line(10, 43, 205, 43);
// $pdf -> Line(205, 43, 205, 270);

// $pdf->SetFont('Arial','B',9);
// $pdf->SetXY(12, 46);
// $pdf->Write(0,"Pan: ". $data[2]);
// $pdf->SetXY(12, 52);
// $pdf->Write(0,"Client ID: ". $data[0]);
// $pdf->SetXY(12, 58);
// $pdf->Write(0,"Client Name: ". $data[1]);
// $pdf->SetFont('Arial','B',9);

// start pdf data
$pdf->SetFont('Arial','B',12);
$pdf->ln();
$pdf->ln();
$split_date = explode("/", $final_convert_date_new_fromdate);
$year1 = $split_date[2];
$split_date1 = explode("/", $final_convert_date_new_todate_eq);
$year2 = $split_date1[2];


$pdf->cell(195,7,"Profit/Loss Report Equity From ".$final_convert_date_new_fromdate." TO ".$final_convert_date_new_todate_eq."  FY [".$year1." - ".$year2."]",1,0,'C');


//     $split_date = explode("/", $final_convert_date_new_fromdate);
// $year1 = $split_date[2];
// $split_date1 = explode("/", $final_convert_date_new_todate_cd);
// $year2 = $split_date1[2];

// $pdf->cell(195,7,"Tax P&L Statement for Currency Derivatives from ".$final_convert_date_new_fromdate." TO ".$final_convert_date_new_todate_cd." FY [".$year1." - ".$year2."",1,0,'');

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
$pdf->cell(195,7,"Profit Breakdown",1,1,'',true);

$pdf->SetFont('Arial','',9);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(97.5,7,'Intra-day profit',1,0);

if(isset($_SESSION['ApbackOffice_client_intraday_profit_and_loss'])){
   $pdf->Cell(97.5,7,$_SESSION['ApbackOffice_client_intraday_profit_and_loss'],1,0);
}
$pdf->ln();

$pdf->Cell(97.5,7,'Short-term profit ',1,0);
if(isset($_SESSION['ApbackOffice_client_shortterm_profit_and_loss'])){
   $pdf->Cell(97.5,7,$_SESSION['ApbackOffice_client_shortterm_profit_and_loss'],1,0);
}
$pdf->ln();

$pdf->Cell(97.5,7,'Long-term profit',1,0);
if(isset($_SESSION['ApbackOffice_client_longterm_profit_and_loss'])){
   $pdf->Cell(97.5,7,$_SESSION['ApbackOffice_client_longterm_profit_and_loss'],1,0);
}
$pdf->SetFont('Arial','B',9);
$pdf->ln();

$pdf->Cell(97.5,7,'Total realized profit ',1,0);
if(isset($_SESSION['ApbackOffice_client_intraday_profit_and_loss']) && isset($_SESSION['ApbackOffice_client_shortterm_profit_and_loss']) && isset($_SESSION['ApbackOffice_client_longterm_profit_and_loss']))
{

    $total_profit=$_SESSION['ApbackOffice_client_intraday_profit_and_loss']+$_SESSION['ApbackOffice_client_shortterm_profit_and_loss']+$_SESSION['ApbackOffice_client_longterm_profit_and_loss'];

   $pdf->Cell(97.5,7,$total_profit,1,0);
}
$pdf->ln();

// ######################### End Other Debits/Credits including Service Tax
// ######################### Start Charges
$pdf->ln();
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"Brokerage Charges",1,1,'',true);
// $pdf->SetFont('Arial','B',9);
// $pdf->SetFillColor(255,255,255);
// $pdf->SetTextColor(0,0,0);
// $pdf->Cell(97.5,7,'Account Head',1,0);
// $pdf->Cell(97.5,7,'Brokerage Amount',1,0);
// $pdf->ln();
$pdf->SetFont('Arial','',9);
$pdf->Cell(97.5,7,'Brokerage ',1,0);

if(isset($_SESSION['ApbackOffice_client_Broekrage_profit_and_loss'])){
    if($_SESSION['ApbackOffice_client_Broekrage_profit_and_loss']=="0")
    {
            $pdf->Cell(97.5,7,$_SESSION['ApbackOffice_client_Broekrage_profit_and_loss']."  "."",1,0);
    }
    else
    {
            $pdf->Cell(97.5,7,"-".$_SESSION['ApbackOffice_client_Broekrage_profit_and_loss']."  "."(Already included in trade)",1,0);
    }  
}
$pdf->ln();
// echo "<pre>";
// print_r($equity_pnl_all_GlobalDetail);
// exit();
$pdf->ln();
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"Taxes",1,1,'',true);
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(97.5,7,'Account Head',1,0);
$pdf->Cell(97.5,7,'Tax Amount',1,0);

foreach ($equity_pnl_GlobalDetail as $key => $value) {

    if($value[2]=="EXPENSES")
    {   
        // echo $value[0]."<br>";
        $pdf->SetFont('Arial','',9);

        if($value[0]=="CGST")
        {
            //CGST
            $pdf->ln();
            $pdf->Cell(97.5,7,'Central GST ',1,0);
            $pdf->Cell(97.5,7,$value[25],1,0);
            $CGST=$value;
            //CGST
        }
        if($value[0]=="SGST")
        {
            //SGST
            $pdf->ln(); 
            $pdf->Cell(97.5,7,'State GST ',1,0);
            $pdf->Cell(97.5,7,$value[25],1,0);
           
            // $pdf->SetXY(78, 190);
            //SGST
        }
        if($value[0]=="BSE CLEARING CHGS")
        {
            //SGST
            $pdf->ln(); 
            $pdf->Cell(97.5,7,'BSE CLEARING CHARGES',1,0);
            $pdf->Cell(97.5,7,$value[25],1,0);
           
            // $pdf->SetXY(78, 190);
            //SGST
        }     
        if($value[0]=="STAMP DUTY")
        {

            $pdf->ln();
            //STAMP DUTY
            $pdf->Cell(97.5,7,'STAMP DUTY',1,0);
            $pdf->Cell(97.5,7,$value[25],1,0); 
            //STAMP DUTY
        }
        if($value[0]=="ROUNDING")
        {

            $pdf->ln();
            //STAMP DUTY
            $pdf->Cell(97.5,7,'ROUNDING',1,0);
            $pdf->Cell(97.5,7,$value[25],1,0); 
            //STAMP DUTY
        }       
        if($value[0]=="STT")
        {
            //STT
            $pdf->ln();
            $pdf->Cell(97.5,7,'Securities Transaction Tax ',1,0);
            $pdf->Cell(97.5,7,$value[25],1,0);
            //STT
        }
        if($value[0]=="SEBI FEES")
        {
            //STT
            $pdf->ln();
            $pdf->Cell(97.5,7,'SEBI Turnover Fees',1,0);
            $pdf->Cell(97.5,7,$value[25],1,0);
            //STT
        }
        if($value[0]=="TOC BSE Exchange")
        {
            $pdf->ln();
            $pdf->Cell(97.5,7,'TOC BSE Exchange',1,0);
            $pdf->Cell(97.5,7,$value[25],1,0); 
        }
        if($value[0]=="TOC NSE Exchange")
        {
            $pdf->ln();
            $pdf->Cell(97.5,7,'TOC NSE Exchange',1,0);
            $pdf->Cell(97.5,7,$value[25],1,0); 
        }
    }

}
$pdf->ln();
$pdf->SetFont('Arial','B',9);
$pdf->Cell(97.5,7,'Total Charges',1,0);


if(isset($_SESSION['APBackOffice_CGST_EQ']) && isset($_SESSION['APBackOffice_SGST_EQ']) && isset($_SESSION['APBackOffice_STAMP_DUTY_EQ']) && isset($_SESSION['APBackOffice_STT_EQ']) && isset($_SESSION['APBackOffice_SEBI_FEES_EQ']) && isset($_SESSION['APBackOffice_TOC_NSE_EQ']) && isset($_SESSION['APBackOffice_ROUNDING_EQ']) )
{

    $total_charges=$_SESSION['APBackOffice_CGST_EQ']+$_SESSION['APBackOffice_SGST_EQ']+$_SESSION['APBackOffice_STAMP_DUTY_EQ']+$_SESSION['APBackOffice_STT_EQ']+$_SESSION['APBackOffice_SEBI_FEES_EQ']+$_SESSION['APBackOffice_TOC_NSE_EQ']+$_SESSION['APBackOffice_ROUNDING_EQ']+$_SESSION['APBackOffice_TOC_BSE_EQ']+$_SESSION['APBackOffice_BSE_CLEARING_CHGS_EQ'];
    // echo $_SESSION['APBackOffice_CGST_EQ'];."<br>";
    // echo $_SESSION['APBackOffice_SGST_EQ'];."<br>";
    // echo $_SESSION['APBackOffice_STAMP_DUTY_EQ'];."<br>";
    // echo $_SESSION['APBackOffice_STT_EQ'];."<br>";
    // echo $_SESSION['APBackOffice_SEBI_FEES_EQ'];."<br>";
    // echo $_SESSION['APBackOffice_TOC_NSE_EQ'];."<br>";
    // echo $_SESSION['APBackOffice_ROUNDING_EQ'];."<br>";
    if($total_charges=="0")
    {
        $pdf->Cell(97.5,7,$total_charges,1,0);
    }   
    else
    {
        $pdf->Cell(97.5,7,"-".$total_charges,1,0);
    }
    // echo "CGST - ".$_SESSION['APBackOffice_CGST_EQ']."<br>";
    // echo "SGST - ".$_SESSION['APBackOffice_SGST_EQ']."<br>";
    // echo "STAMP_DUTY - ".$_SESSION['APBackOffice_STAMP_DUTY_EQ']."<br>";
    // echo "STT - ".$_SESSION['APBackOffice_STT_EQ']."<br>";
    // echo "SEBI_FEES - ".$_SESSION['APBackOffice_SEBI_FEES_EQ']."<br>";
    // echo "NSE TOC - ".$_SESSION['APBackOffice_TOC_NSE_EQ'];
}
else
{
    $pdf->Cell(97.5,7,"",1,0);
}
function Ledger_balance($yestarday_balance)
{
  if($yestarday_balance >= 0)
  {
    $type = " DR";
    return number_format((float)$yestarday_balance, 2, '.', ',').$type;
  }
  else
  {
    $type = " CR";
    $yestarday_balance = Abs($yestarday_balance);
    return number_format((float)$yestarday_balance, 2, '.', ',').$type;
  }
}
$pdf->ln();
$pdf->ln();
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"Other Charges",1,1,'',true);
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(97.5,7,'JV',1,0);
if(isset($_SESSION['ApbackOffice_client_JV_charges_profit_and_loss']))
{
    $pdf->Cell(97.5,7,Ledger_balance($_SESSION['ApbackOffice_client_JV_charges_profit_and_loss']),1,0);
}
else
{
    $pdf->Cell(97.5,7,"-",1,0);
}
$pdf->ln();

$pdf->Cell(97.5,7,'Receipt (R)',1,0);
if(isset($_SESSION['ApbackOffice_client_R_charges_profit_and_loss']))
{
    $pdf->Cell(97.5,7,Ledger_balance($_SESSION['ApbackOffice_client_R_charges_profit_and_loss']),1,0);
}
else
{
    $pdf->Cell(97.5,7,"-",1,0);
}

$pdf->ln();
$pdf->Cell(97.5,7,'Payment (P)',1,0);
if(isset($_SESSION['ApbackOffice_client_P_charges_profit_and_loss']))
{
    $pdf->Cell(97.5,7,Ledger_balance($_SESSION['ApbackOffice_client_P_charges_profit_and_loss']),1,0);
}
else
{
    $pdf->Cell(97.5,7,"-",1,0);
}

// ######################### End charges

// ######################### Start Holding TABLED
if($ASSETS=="0"){
$pdf->AddPage();

// $pdf->SetFont('Arial','B',9);
// $pdf->SetFillColor(2,48,32);
// $pdf->SetTextColor(255,255,255);

// $pdf->cell(195,7,"Trades History",1,1,'C',true);

// $pdf->SetFont('Arial','',9);
// $pdf->SetFillColor(193, 225, 193);
// $pdf->SetTextColor(2,48,32);
// $pdf->cell(195,7,"Holdings",1,1,'',true);

$pdf->SetFont('Arial','',12);
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"Holdings",1,1,'C',true);

$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(49,7,'Symbol',1,0);
$pdf->Cell(19,7,'ISIN',1,0);
$pdf->Cell(9,7,'B Qty',1,0);
$pdf->Cell(12,7,'Buy Avg',1,0);
$pdf->Cell(15,7,'Buy Value',1,0);
$pdf->Cell(15,7,'Buy date',1,0);
$pdf->Cell(9,7,'S Qty',1,0);
$pdf->Cell(12,7,'Sell Avg',1,0);
$pdf->Cell(15,7,'Sell Value',1,0);
$pdf->Cell(13.8,7,'Sell date',1,0);
$pdf->Cell(11,7,'Closing',1,0);
$pdf->Cell(15.2,7,'P&L',1,0);
$pdf->ln(); 
$total_holding=0;
$total_buy_holding_value=0;
$pdf->SetFont('Arial','',7);

/* initializing an array to store usernames to compare */
// $userNames = array();
// $userNames1 = array();
// $styy = array();
// /* looping through array */
// foreach($equity_pnl_GlobalDetail as $key=>$value){
//     if(!empty($userNames) && !empty($userNames1) && !empty($styy) && in_array($value[23],$userNames) && in_array($value[19],$userNames1) && in_array($value[24],$styy)) unset($equity_pnl_GlobalDetail[$key]);  //unset from $array if username already exists
//     $userNames[] = $value[23];  // creating username array to compare with main array values
//     $userNames1[] = $value[19];  // creating username array to compare with main array values
//     $styy[] = $value[24];  // creating username array to compare with main array values
// }

/* print updated array */
// echo "<pre>";print_r($equity_pnl_GlobalDetail);echo "</pre>";
// exit();
// // echo "<pre>";
// // print
// $i=0
// echo "<pre>";
// print_r($equity_pnl_all_GlobalDetail);
// exit();
foreach ($equity_pnl_GlobalDetail as $key => $value)
{
    if($value[14]=="ASSETS" || $value[14]=="OP_ASSETS")
        { 
            //symbol
            if($value[0]!="MF_BSE")
            {
                if ($pdf->GetY() > 270) 
                {
                    $pdf->AddPage();
                    $pdf->SetFont('Arial','B',7);
                    $pdf->SetFillColor(255,255,255);
                    $pdf->SetTextColor(0,0,0);

                    $pdf->Cell(49,7,'Symbol',1,0);
                    $pdf->Cell(19,7,'ISIN',1,0);
                    $pdf->Cell(9,7,'B Qty',1,0);
                    $pdf->Cell(12,7,'Buy Avg',1,0);
                    $pdf->Cell(15,7,'Buy Value',1,0);
                    $pdf->Cell(15,7,'Buy date',1,0);
                    $pdf->Cell(9,7,'S Qty',1,0);
                    $pdf->Cell(12,7,'Sell Avg',1,0);
                    $pdf->Cell(15,7,'Sell Value',1,0);
                    $pdf->Cell(13.8,7,'Sell date',1,0);
                    $pdf->Cell(11,7,'Closing',1,0);
                    $pdf->Cell(15.2,7,'P&L',1,0);
                    $pdf->ln();
                }
                // $old_year_data=str_replace(" 00:00:00 +0530","",$value[23]);
                // $old_year_data=str_replace(",","",$old_year_data);
                // $old_year_data=strtotime($old_year_data);
                // $date_new_year=date("Y", $old_year_data);
                // if($date_new_year!="2016")
                // {
                $pdf->SetFont('Arial','',7);
                if(empty($value[19]))
                {
                     $pdf->Cell(49,7,$value[2],1,0); 
                }
                else
                {
                    $pdf->Cell(49,7,$value[19],1,0); 
                }
        
                //isin
                $pdf->Cell(19,7,$value[20],1,0);

                //Buy Qty
                $pdf->Cell(9,7,$value[24],1,0);

                //Buy Average
                $Buy_avH=number_format((float)$value[25], 2, '.', '');
                $pdf->Cell(12,7,$Buy_avH,1,0);

                //Buy Value
                $Buy_vH=number_format((float)$value[10], 2, '.', '');
                $pdf->Cell(15,7,$Buy_vH,1,0);
                
                //Buy Date
                $d=str_replace(" 00:00:00 +0530","",$value[23]);
                $d=str_replace(",","",$d);
                $d=strtotime($d);
                $date_new=date("d-m-Y", $d);
                $pdf->Cell(15,7,$date_new,1,0);

                //Sell Qty
                $pdf->Cell(9,7,"0",1,0);

                //Sell Avg
                $pdf->Cell(12,7,"0",1,0);

                //Sell Value
                $pdf->Cell(15,7,"0",1,0);

                //Sell Date
                $pdf->Cell(13.8,7,'0',1,0);

                //Closing
                $pdf->Cell(11,7,$value[21],1,0);

                //Realized P&L
                $realized_pl=(int)$value[21]*$value[24]-$value[10];

                $realized_pl=number_format((float)$realized_pl, 2, '.', '');
                $pdf->SetFont('Arial','B',7);
                $pdf->Cell(15.2,7,$realized_pl,1,0);
                $pdf->SetFont('Arial','',7);

                $pdf->ln();
                $total_holding+=(int)$realized_pl;
                $total_buy_holding_value+=(int)$value[10];
            // $i++;
            // }
            }
            }
        }
        // echo $i;
        // exit();
// Total
$pdf->SetFont('Arial','B',8);
$pdf->Cell(49,7,'Total',1,0);
$pdf->Cell(19,7,'-',1,0);
$pdf->Cell(9,7,'-',1,0);
$pdf->Cell(12,7,'-',1,0);
$pdf->Cell(15,7,$total_buy_holding_value,1,0);
$pdf->Cell(15,7,"-",1,0);
$pdf->Cell(9,7,'-',1,0);
$pdf->Cell(12,7,'-',1,0);
$pdf->Cell(15,7,'-',1,0);
$pdf->Cell(13.8,7,'-',1,0);
$pdf->Cell(11,7,'-',1,0);
$pdf->Cell(15.2,7,$total_holding,1,0);
}
// ######################### End Holding TABLED
// ######################### Start SHORT TERM TABLED
if($SHORTTERM=="0"){
$pdf->AddPage();


// $pdf->SetFont('Arial','B',9);
// $pdf->SetFillColor(2,48,32);
// $pdf->SetTextColor(255,255,255);

// $pdf->cell(195,7,"Trades History",1,1,'C',true);

// $pdf->SetFont('Arial','',9);
// $pdf->SetFillColor(193, 225, 193);
// $pdf->SetTextColor(2,48,32);
// $pdf->cell(195,7,"Short Term gain",1,1,'',true);

$pdf->SetFont('Arial','',12);
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"Short Term gain",1,1,'C',true);

$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(49,7,'Symbol',1,0);
$pdf->Cell(19,7,'ISIN',1,0);
$pdf->Cell(9,7,'B Qty',1,0);
$pdf->Cell(12,7,'Buy Avg',1,0);
$pdf->Cell(15,7,'Buy Value',1,0);
$pdf->Cell(15,7,'Buy Date',1,0);
$pdf->Cell(9,7,'S Qty',1,0);
$pdf->Cell(12,7,'Sell Avg',1,0);
$pdf->Cell(15,7,'Sell Value',1,0);
$pdf->Cell(14,7,'Sell date',1,0);
$pdf->Cell(11,7,'Closing',1,0);
$pdf->Cell(15,7,'P&L',1,0);
$pdf->ln(); 
$total_SHORTTERM=0;
$total_buy_value=0;
$total_sell_value=0;
$pnl=0;
$pdf->SetFont('Arial','',7);
function truncate_number($number, $precision = 2) {

    // Zero causes issues, and no need to truncate
    if (0 == (int)$number) {
        return $number;
    }

    // Are we negative?
    $negative = $number / abs($number);

    // Cast the number to a positive to solve rounding
    $number = abs($number);

    // Calculate precision number for dividing / multiplying
    $precision = pow(10, $precision);

    // Run the math, re-applying the negative value to ensure
    // returns correctly negative / positive
    return floor( $number * $precision ) / $precision * $negative;
}
foreach ($equity_pnl_GlobalDetail as $key => $value)
{
    if($value[14]=="OP_SHORTTERM" || $value[14]=="SHORTTERM")
        { 
            if ($pdf->GetY() > 270) 
                {
                    $pdf->AddPage();
                    $pdf->SetFont('Arial','B',7);
                    $pdf->SetFillColor(255,255,255);
                    $pdf->SetTextColor(0,0,0);

                    $pdf->Cell(49,7,'Symbol',1,0);
                    $pdf->Cell(19,7,'ISIN',1,0);
                    $pdf->Cell(9,7,'B Qty',1,0);
                    $pdf->Cell(12,7,'Buy Avg',1,0);
                    $pdf->Cell(15,7,'Buy Value',1,0);
                    $pdf->Cell(15,7,'Buy Date',1,0);
                    $pdf->Cell(9,7,'S Qty',1,0);
                    $pdf->Cell(12,7,'Sell Avg',1,0);
                    $pdf->Cell(15,7,'Sell Value',1,0);
                    $pdf->Cell(14,7,'Sell date',1,0);
                    $pdf->Cell(11,7,'Closing',1,0);
                    $pdf->Cell(15,7,'P&L',1,0);
                    $pdf->ln();
                }
                // $old_year_data=str_replace(" 00:00:00 +0530","",$value[23]);
                // $old_year_data=str_replace(",","",$old_year_data);
                // $old_year_data=strtotime($old_year_data);
                // $date_new_year=date("Y", $old_year_data);
                // if($date_new_year!="2016")
                // {
                $pdf->SetFont('Arial','',7);
            //symbol
            $pdf->Cell(49,7,$value[19],1,0); 

            //isin
            $pdf->Cell(19,7,$value[20],1,0);

            //Buy Qty
            $pdf->Cell(9,7,$value[24],1,0);

            //Buy Average
            $Buy_avH=number_format((float)$value[25], 2, '.', '');
            // $Buy_avH=truncate_number((float)$value[25],4);
            $pdf->Cell(12,7,$Buy_avH,1,0);

            //Buy Value
            $Buy_vS=$value[25]*$value[24];
            $Buy_vS=number_format((float)$Buy_vS, 2, '.', '');
            $pdf->Cell(15,7,$Buy_vS,1,0);

            //Buy Date
            $d=str_replace(" 00:00:00 +0530","",$value[23]);
            $d=str_replace(",","",$d);
            $d=strtotime($d);
            $date_new=date("d-m-Y", $d);
            $pdf->Cell(15,7,$date_new,1,0);

            //Sell Qty
            $pdf->Cell(9,7,$value[7],1,0);

            //Sell Avg
            $Sell_AS=number_format((float)$value[8], 2, '.', '');
            // $Sell_AS=truncate_number((float)$value[8],3);
            $pdf->Cell(12,7,$Sell_AS,1,0);

            //Sell Value
            $Sell_vS=$value[8]*$value[7];
            // $Sell_vS=truncate_number((float)$Sell_vS);
            $Sell_vS=number_format((float)$Sell_vS, 2, '.', '');
            $pdf->Cell(15,7,$Sell_vS,1,0);
            
            //Sell Date
            $sell_date=str_replace(" 00:00:00 +0530","",$value[6]);
            $sell_date=str_replace(",","",$sell_date);
            $sell_date=strtotime($sell_date);
            $sell_date_new=date("d-m-Y", $sell_date);
            $pdf->Cell(14,7,$sell_date_new,1,0);

            //Closing
            $pdf->Cell(11,7,$value[21],1,0);

            //Realized P&L
            $pnl=$value[10];
            // $shortterm_total+=number_format((float)$pnl, 2, '.', '');

            // $realized_pl=number_format((float)$value[10], 2, '.', '');
            $pdf->SetFont('Arial','B',7);
            $pdf->Cell(15,7,$value[10],1,0);
            $pdf->SetFont('Arial','',7);

            $pdf->ln();
            $total_SHORTTERM+=number_format((float)$pnl, 2, '.', '');
            $total_buy_value+=(int)$Buy_vS;
            $total_sell_value+=(int)$Sell_vS;
            }
        }
// Total
$pdf->SetFont('Arial','B',7);
$pdf->Cell(49,7,'Total',1,0);
$pdf->Cell(19,7,'-',1,0);
$pdf->Cell(9,7,'-',1,0);
$pdf->Cell(12,7,'-',1,0);
$pdf->Cell(15,7,$total_buy_value,1,0);
$pdf->Cell(15,7,'-',1,0);
$pdf->Cell(9,7,'-',1,0);
$pdf->Cell(12,7,'-',1,0);
$pdf->Cell(15,7,$total_sell_value,1,0);
$pdf->Cell(14,7,'-',1,0);
$pdf->Cell(11,7,'-',1,0);
$pdf->Cell(15,7,$total_SHORTTERM,1,0);
}
// ######################### End SHORT TERM TABLED
// ######################### Start LONG TERM  TABLED
if($LONGTERM=="0"){
$pdf->AddPage();
// $pdf->SetFont('Arial','B',9);
// $pdf->SetFillColor(2,48,32);
// $pdf->SetTextColor(255,255,255);

// $pdf->cell(195,7,"Trades History",1,1,'C',true);

// $pdf->SetFont('Arial','',9);
// $pdf->SetFillColor(193, 225, 193);
// $pdf->SetTextColor(2,48,32);
// $pdf->cell(195,7,"Long Term gain",1,1,'',true);

$pdf->SetFont('Arial','',12);
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"Long Term gain",1,1,'C',true);

$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(49,7,'Symbol',1,0);
$pdf->Cell(19,7,'ISIN',1,0);
$pdf->Cell(9,7,'B Qty',1,0);
$pdf->Cell(12,7,'Buy Avg',1,0);
$pdf->Cell(15,7,'Buy Value',1,0);
$pdf->Cell(15,7,'Buy date',1,0);
$pdf->Cell(9,7,'S Qty',1,0);
$pdf->Cell(12,7,'Sell Avg',1,0);
$pdf->Cell(15,7,'Sell Value',1,0);
$pdf->Cell(13.8,7,'Sell date',1,0);
$pdf->Cell(11,7,'Closing',1,0);
$pdf->Cell(15.2,7,'P&L',1,0);
$pdf->ln(); 
$total_LONGTERM=0;
$total_buy_value_long=0;
$total_sell_value_long=0;
$pnl=0;
$pdf->SetFont('Arial','',7);

foreach ($equity_pnl_GlobalDetail as $key => $value)
{
    if($value[14]=="LONGTERM")
        { 
            if ($pdf->GetY() > 270) 
            {
                $pdf->AddPage();
                $pdf->SetFont('Arial','B',7);
                $pdf->SetFillColor(255,255,255);
                $pdf->SetTextColor(0,0,0);

                $pdf->Cell(49,7,'Symbol',1,0);
                $pdf->Cell(19,7,'ISIN',1,0);
                $pdf->Cell(9,7,'B Qty',1,0);
                $pdf->Cell(12,7,'Buy Avg',1,0);
                $pdf->Cell(15,7,'Buy Value',1,0);
                $pdf->Cell(15,7,'Buy date',1,0);
                $pdf->Cell(9,7,'S Qty',1,0);
                $pdf->Cell(12,7,'Sell Avg',1,0);
                $pdf->Cell(15,7,'Sell Value',1,0);
                $pdf->Cell(13.8,7,'Sell date',1,0);
                $pdf->Cell(11,7,'Closing',1,0);
                $pdf->Cell(15.2,7,'P&L',1,0);
                $pdf->ln();
            }
            // symbol
            $pdf->SetFont('Arial','',7);
            $pdf->Cell(49,7,$value[19],1,0); 

            //isin
            $pdf->Cell(19,7,$value[20],1,0);
            //Buy Qty
            $pdf->Cell(9,7,$value[24],1,0);
            //Buy Average
            $Buy_avH=number_format((float)$value[25], 2, '.', '');
            $pdf->Cell(12,7,$Buy_avH,1,0);
            //Buy Value
            $Buy_vL=$value[25]*$value[24];
            $Buy_vL=number_format((float)$Buy_vL, 2, '.', '');
            $pdf->Cell(15,7,$Buy_vL,1,0);

            //Buy Date
            $d=str_replace(" 00:00:00 +0530","",$value[23]);
            $d=str_replace(",","",$d);
            $d=strtotime($d);
            $date_new=date("d-m-Y", $d);
            $pdf->Cell(15,7,$date_new,1,0);

            //Sell Qty
            $pdf->Cell(9,7,$value[7],1,0);

            //Sell Avg
            $Sell_vavl=number_format((float)$value[8], 2, '.', '');
            $pdf->Cell(12,7,$Sell_vavl,1,0);
            //Sell Value
            $Sell_vL=$value[8]*$value[7];
            $Sell_vL=number_format((float)$Sell_vL, 2, '.', '');
            $pdf->Cell(15,7,$Sell_vL,1,0);

            //Sell Date
            $sell_date=str_replace(" 00:00:00 +0530","",$value[6]);
            $sell_date=str_replace(",","",$sell_date);
            $sell_date=strtotime($sell_date);
            $sell_date_new=date("d-m-Y", $sell_date);
            $pdf->Cell(13.8,7,$sell_date_new,1,0);

            //Closing
            $pdf->Cell(11,7,$value[21],1,0);

            //Realized P&L
            $realized_pl=number_format((float)$value[10], 2, '.', '');
            $pdf->SetFont('Arial','B',7);
            $pdf->Cell(15.2,7,$value[10],1,0);
            $pdf->SetFont('Arial','',7);

            $pdf->ln();
            $total_LONGTERM+=(int)$realized_pl;
            $total_buy_value_long+=(int)$Buy_vL;
            $total_sell_value_long+=(int)$Sell_vL;
            }
        }
// Total
$pdf->SetFont('Arial','B',8);
$pdf->Cell(49,7,'Total',1,0);
$pdf->Cell(19,7,'-',1,0);
$pdf->Cell(9,7,'-',1,0);
$pdf->Cell(12,7,'-',1,0);
$pdf->Cell(15,7,$total_buy_value_long,1,0);
$pdf->Cell(15,7,'-',1,0);
$pdf->Cell(9,7,'-',1,0);
$pdf->Cell(12,7,'-',1,0);
$pdf->Cell(15,7,$total_sell_value_long,1,0);
$pdf->Cell(13.8,7,'-',1,0);
$pdf->Cell(11,7,'-',1,0);
$pdf->Cell(15.2,7,$total_LONGTERM,1,0);
}
// ######################### END LONG TERM  TABLED
// ######################### Start Intraday  table
if($TRADING=="0"){
$pdf->AddPage();


// $pdf->SetFont('Arial','B',9);
// $pdf->SetFillColor(2,48,32);
// $pdf->SetTextColor(255,255,255);

// $pdf->cell(195,7,"Trades History",1,1,'C',true);

// $pdf->SetFont('Arial','',9);
// $pdf->SetFillColor(193, 225, 193);
// $pdf->SetTextColor(2,48,32);
// $pdf->cell(195,7,"Intra-day gain",1,1,'',true);
$pdf->SetFont('Arial','',12);
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"Intra-day gain",1,1,'C',true);

$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(49,7,'Symbol',1,0);
$pdf->Cell(19,7,'ISIN',1,0);
$pdf->Cell(9,7,'B Qty',1,0);
$pdf->Cell(12,7,'Buy Avg',1,0);
$pdf->Cell(15,7,'Buy Value',1,0);
$pdf->Cell(15,7,'Buy date',1,0);
$pdf->Cell(9,7,'S Qty',1,0);
$pdf->Cell(12,7,'Sell Avg',1,0);
$pdf->Cell(15,7,'Sell Value',1,0);
$pdf->Cell(13.8,7,'Sell date',1,0);
$pdf->Cell(11,7,'Closing',1,0);
$pdf->Cell(15.2,7,'P&L',1,0);
$pdf->ln(); 
$total_intraday=0;
$total_buy_value_intraday=0;
$total_sell_value_intraday=0;
$pnl=0;
$pdf->SetFont('Arial','',7);

foreach ($equity_pnl_GlobalDetail as $key => $value)
{
    if($value[14]=="TRADING")
        { 
            if ($pdf->GetY() > 270) 
            {
                $pdf->AddPage();
                $pdf->SetFont('Arial','B',7);
                $pdf->SetFillColor(255,255,255);
                $pdf->SetTextColor(0,0,0);

                $pdf->Cell(49,7,'Symbol',1,0);
                $pdf->Cell(19,7,'ISIN',1,0);
                $pdf->Cell(9,7,'B Qty',1,0);
                $pdf->Cell(12,7,'Buy Avg',1,0);
                $pdf->Cell(15,7,'Buy Value',1,0);
                $pdf->Cell(15,7,'Buy date',1,0);
                $pdf->Cell(9,7,'S Qty',1,0);
                $pdf->Cell(12,7,'Sell Avg',1,0);
                $pdf->Cell(15,7,'Sell Value',1,0);
                $pdf->Cell(13.8,7,'Sell date',1,0);
                $pdf->Cell(11,7,'Closing',1,0);
                $pdf->Cell(15.2,7,'P&L',1,0);
                $pdf->ln();
            }
            // symbol
            $pdf->SetFont('Arial','',7);
            $pdf->Cell(49,7,$value[19],1,0); 

            //isin
            $pdf->Cell(19,7,$value[20],1,0);
            
           

            //Buy Qty
            $pdf->Cell(9,7,$value[24],1,0);

            //Buy Average
            $Buy_avH=number_format((float)$value[25], 2, '.', '');
            $pdf->Cell(12,7,$Buy_avH,1,0);
             //Buy Value
            $Buy_vS=$value[25]*$value[24];
            $Buy_vS=number_format((float)$Buy_vS, 2, '.', '');
            $pdf->Cell(15,7,$Buy_vS,1,0);
            
            //Buy Date
            $d=str_replace(" 00:00:00 +0530","",$value[23]);
            $d=str_replace(",","",$d);
            $d=strtotime($d);
            $date_new=date("d-m-Y", $d);
            $pdf->Cell(15,7,$date_new,1,0);

           
            
            //Sell Qty
            $pdf->Cell(9,7,$value[7],1,0);

            //Sell Avg
            // $Sell_AI=truncate_number((float)$value[8]);
            $Sell_avg=number_format((float)$value[8], 2, '.', '');
            $pdf->Cell(12,7,$Sell_avg,1,0);
             //Sell Value
            $Sell_vS=$value[8]*$value[7];
            $Sell_vS=number_format((float)$Sell_vS, 2, '.', '');
            $pdf->Cell(15,7,$Sell_vS,1,0);

            //Sell Date
            $sell_date=str_replace(" 00:00:00 +0530","",$value[6]);
            $sell_date=str_replace(",","",$sell_date);
            $sell_date=strtotime($sell_date);
            $sell_date_new=date("d-m-Y", $sell_date);
            $pdf->Cell(13.8,7,$sell_date_new,1,0);

            //Closing
            $pdf->Cell(11,7,$value[21],1,0);

            //Realized P&L
            $realized_pl=number_format((float)$value[10], 2, '.', '');
            $pdf->SetFont('Arial','B',7);
            $pdf->Cell(15.2,7,$value[10],1,0);
            $pdf->SetFont('Arial','',7);

            $pdf->ln();
            $total_intraday+=(int)$realized_pl;
            $total_buy_value_intraday+=(int)$Buy_vS;
            $total_sell_value_intraday+=(int)$Sell_vS;
            }
        }
// Total
$pdf->SetFont('Arial','B',8);
$pdf->Cell(49,7,'Total',1,0);
$pdf->Cell(19,7,'-',1,0);
$pdf->Cell(9,7,'-',1,0);
$pdf->Cell(12,7,'-',1,0);
$pdf->Cell(15,7,$total_buy_value_intraday,1,0);
$pdf->Cell(15,7,'-',1,0);
$pdf->Cell(9,7,'-',1,0);
$pdf->Cell(12,7,'-',1,0);
$pdf->Cell(15,7,$total_sell_value_intraday,1,0);
$pdf->Cell(13.8,7,'-',1,0);
$pdf->Cell(11,7,'-',1,0);
$pdf->Cell(15.2,7,$total_intraday,1,0);
}
// ######################### End Intraday  table
if($LIABILITIES=="0"){
$pdf->AddPage();

// $pdf->SetFont('Arial','B',9);
// $pdf->SetFillColor(2,48,32);
// $pdf->SetTextColor(255,255,255);

// $pdf->cell(195,7,"Trades History",1,1,'C',true);

// $pdf->SetFont('Arial','',9);
// $pdf->SetFillColor(193, 225, 193);
// $pdf->SetTextColor(2,48,32);
// $pdf->cell(195,7,"LIABILITIES",1,1,'',true);
$pdf->SetFont('Arial','',12);
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"LIABILITIES",1,1,'C',true);

$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(49,7,'Symbol',1,0);
$pdf->Cell(19,7,'ISIN',1,0);
$pdf->Cell(9,7,'B Qty',1,0);
$pdf->Cell(12,7,'Buy Avg',1,0);
$pdf->Cell(15,7,'Buy Value',1,0);
$pdf->Cell(15,7,'Buy date',1,0);
$pdf->Cell(9,7,'S Qty',1,0);
$pdf->Cell(12,7,'Sell Avg',1,0);
$pdf->Cell(15,7,'Sell Value',1,0);
$pdf->Cell(13.8,7,'Sell date',1,0);
$pdf->Cell(11,7,'Closing',1,0);
$pdf->Cell(15.2,7,'P&L',1,0);
$pdf->ln(); 
$total_liabilites=0;
$total_buy_liabilites_value=0;
$pdf->SetFont('Arial','',7);

foreach ($equity_pnl_GlobalDetail as $key => $value)
{
    if($value[14]=="LIABILITIES")
        { 
            //symbol
            $pdf->Cell(49,7,$value[19],1,0); 

            //isin
            $pdf->Cell(19,7,$value[20],1,0);
            
            //Buy Qty
            $pdf->Cell(9,7,$value[24],1,0);

            //Buy Average
            $Buy_avH=number_format((float)$value[25], 2, '.', '');
            $pdf->Cell(12,7,$Buy_avH,1,0);

            //Buy Value
            // $Buy_vH=number_format((float)$value[10], 2, '.', '');
            $pdf->Cell(15,7,"0",1,0);
            
            //Buy Date
            if(empty($value[23]))
            {
                $pdf->Cell(15,7,'-',1,0);
            }
            else
            {
                $d=str_replace(" 00:00:00 +0530","",$value[23]);
                $d=str_replace(",","",$d);
                $d=strtotime($d);
                $date_new=date("d-m-Y", $d);
                $pdf->Cell(15,7,$date_new,1,0);
            }
            //Sell Qty
            $pdf->Cell(9,7,$value[7],1,0);

            //Sell Avg
            $pdf->Cell(12,7,$value[8],1,0);

            //Sell Value
            $pdf->Cell(15,7,$value[10],1,0);

            //Sell Date
            $sell_date=str_replace(" 00:00:00 +0530","",$value[6]);
            $sell_date=str_replace(",","",$sell_date);
            $sell_date=strtotime($sell_date);
            $sell_date_new=date("d-m-Y", $sell_date);
            $pdf->Cell(13.8,7,$sell_date_new,1,0);
            // $pdf->Cell(13.8,7,'0',1,0);

            //Closing
            $pdf->Cell(11,7,$value[21],1,0);

            //Realized P&L
            $realized_pl=$value[21]*$value[24]-$value[10];
            $realized_pl=number_format((float)$realized_pl, 2, '.', '');
            $pdf->SetFont('Arial','B',7);
            $pdf->Cell(15.2,7,$realized_pl,1,0);
            $pdf->SetFont('Arial','',7);

            $pdf->ln();
            $total_liabilites+=(int)$realized_pl;
            $total_buy_liabilites_value+=(int)$value[10];
            }
        }
// Total
$pdf->SetFont('Arial','B',8);
$pdf->Cell(49,7,'Total',1,0);
$pdf->Cell(19,7,'-',1,0);
$pdf->Cell(9,7,'-',1,0);
$pdf->Cell(12,7,'-',1,0);
$pdf->Cell(15,7,'-',1,0);
$pdf->Cell(15,7,'-',1,0);
$pdf->Cell(9,7,'-',1,0);
$pdf->Cell(12,7,'-',1,0);
$pdf->Cell(15,7,'-',1,0);
$pdf->Cell(13.8,7,'-',1,0);
$pdf->Cell(11,7,'-',1,0);
$pdf->Cell(15.2,7,$total_liabilites,1,0);
}
#################
$pdf->Output('I',$data[0]."_EQ_PNL.pdf");
date_default_timezone_set('Asia/Kolkata');
$localIp = gethostbyname(gethostname());
$myfile2 = fopen("eq_pnl_log.txt", "a") or die("Unable to open file!");
$txt2 = "\n".$data[0]."\n".$this->input->ip_address()."\n".date('Y-m-d H:i:s')."\n";
fwrite($myfile2, $txt2);
?>