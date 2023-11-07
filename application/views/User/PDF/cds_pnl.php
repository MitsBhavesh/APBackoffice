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
$split_date1 = explode("/", $final_convert_date_new_todate_cd);
$year2 = $split_date1[2];

$pdf->cell(195,7,"Profit/Loss Report for Currency Derivatives from ".$final_convert_date_new_fromdate." TO ".$final_convert_date_new_todate_cd."  FY [".$year1." - ".$year2."]",1,0,'C');


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
$pdf->Cell(97.5,7,'Future realized profit',1,0);
if(isset($_SESSION['ApbackOffice_client_cd_future_total_profit_and_loss'])){
   $pdf->Cell(97.5,7,$_SESSION['ApbackOffice_client_cd_future_total_profit_and_loss'],1,0);
}


$pdf->ln();
$pdf->Cell(97.5,7,'Option realized profit',1,0);
if(isset($_SESSION['ApbackOffice_client_cd_options_total_profit_and_loss'])){
   $pdf->Cell(97.5,7,$_SESSION['ApbackOffice_client_cd_options_total_profit_and_loss'],1,0);
}


$pdf->ln();
$pdf->SetFont('Arial','B',9);
$pdf->Cell(97.5,7,'Total realized profit',1,0);
if(isset($_SESSION['ApbackOffice_client_cd_future_total_profit_and_loss']) && isset($_SESSION['ApbackOffice_client_cd_options_total_profit_and_loss']))
{
    $total_profit_cd=$_SESSION['ApbackOffice_client_cd_future_total_profit_and_loss']+$_SESSION['ApbackOffice_client_cd_options_total_profit_and_loss'];

   $pdf->Cell(97.5,7,$total_profit_cd,1,0);
}
$pdf->ln();
// ######################### Start Turnover Breakdown (Scripwise)
$pdf->ln();
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"Turnover Breakdown",1,1,'',true);
$pdf->SetFont('Arial','',9);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);

$pdf->Cell(97.5,7,'Future turnover',1,0);
if(isset($_SESSION['ApbackOffice_client_cd_future_turnover_turnover_profit_and_loss'])){
   $pdf->Cell(97.5,7,$_SESSION['ApbackOffice_client_cd_future_turnover_turnover_profit_and_loss'],1,0);
}

$pdf->ln();
$pdf->Cell(97.5,7,'Option turnover',1,0);
if(isset($_SESSION['ApbackOffice_client_cd_options_turnover_profit_and_loss'])){
   $pdf->Cell(97.5,7,$_SESSION['ApbackOffice_client_cd_options_turnover_profit_and_loss'],1,0);
}

$pdf->ln();
$pdf->SetFont('Arial','B',9);
$pdf->Cell(97.5,7,'Total Turnover',1,0);
if(isset($_SESSION['ApbackOffice_client_cd_future_turnover_turnover_profit_and_loss']) && isset($_SESSION['ApbackOffice_client_cd_options_turnover_profit_and_loss']))
{
    $total_profit_cd=$_SESSION['ApbackOffice_client_cd_future_turnover_turnover_profit_and_loss']+$_SESSION['ApbackOffice_client_cd_options_turnover_profit_and_loss'];

   $pdf->Cell(97.5,7,$total_profit_cd,1,0);
}
$pdf->ln();
// ######################### End Turnover Breakdown (Scripwise)
$pdf->ln();
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->SetFont('Arial','B',9);
$pdf->cell(195,7,"Brokerage Charges",1,1,'',true);

// $pdf->SetFillColor(255,255,255);
// $pdf->SetTextColor(0,0,0);
// $pdf->Cell(97.5,7,'Account Head',1,0);
// $pdf->Cell(97.5,7,'Brokerage Amount',1,0);
// $pdf->ln();
$pdf->SetFont('Arial','',9);
$pdf->Cell(97.5,7,'Brokerage ',1,0);

if(isset($_SESSION['ApbackOffice_client_cd_Broekrage_profit_and_loss'])){
    if($_SESSION['ApbackOffice_client_cd_Broekrage_profit_and_loss']=="0")
    {
            $pdf->Cell(97.5,7,$_SESSION['ApbackOffice_client_cd_Broekrage_profit_and_loss']."  "."(Already included in trade)",1,0);
    }
    else
    {
            $pdf->Cell(97.5,7,"-".$_SESSION['ApbackOffice_client_cd_Broekrage_profit_and_loss']."  "."(Already included in trade)",1,0);
    } 
}
$pdf->ln();
// ######################### Start Charges
$pdf->ln();
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->SetFont('Arial','B',9);
$pdf->cell(195,7,"Taxes",1,1,'',true);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','',9);
$pdf->Cell(97.5,7,'TOC',1,0);
foreach ($cds_pnl as $key => $value)
{
    if($value[32]=="TOC NSE Exchange")
    {
        $pdf->Cell(97.5,7,$value[4],1,0);
    }
}
$pdf->ln();
$pdf->Cell(97.5,7,'CGST',1,0);
foreach ($cds_pnl as $key => $value)
{
    if($value[32]=="CGST")
    {
        $pdf->Cell(97.5,7,$value[4],1,0);
    }
}
$pdf->ln();
$pdf->Cell(97.5,7,'SGST',1,0);
foreach ($cds_pnl as $key => $value)
{
    if($value[32]=="SGST")
    {
        $pdf->Cell(97.5,7,$value[4],1,0);
    }
}
$pdf->ln();
$pdf->Cell(97.5,7,'Stamp duty',1,0);
foreach ($cds_pnl as $key => $value)
{
    if($value[32]=="STAMP DUTY")
    {
        $pdf->Cell(97.5,7,$value[4],1,0);
    }
}
// echo
// foreach ($cds_pnl as $key => $value)
// {
//     if($value[32]=="STAMP DUTY")
//     {
//         $pdf->Cell(97.5,7,$value[4],1,0);
//     }
//     else
//     {
//         $pdf->Cell(97.5,7,"0",1,0);
//     }
// }

$pdf->ln();
$pdf->Cell(97.5,7,'SEBI charges',1,0);
foreach ($cds_pnl as $key => $value)
{
    if($value[32]=="SEBI FEES")
    {
        $pdf->Cell(97.5,7,$value[4],1,0);
    }
}

$pdf->ln();
$pdf->SetFont('Arial','B',9);
$pdf->Cell(97.5,7,'Total charges',1,0);
if(isset($_SESSION['APBackOffice_TOC_NSE_CD'])){

    $total_charges=$_SESSION['APBackOffice_TOC_NSE_CD']+$_SESSION['APBackOffice_CGST_CD']+$_SESSION['APBackOffice_SGST_CD']+$_SESSION['APBackOffice_STAMP_DUTY_CD']+$_SESSION['APBackOffice_SEBI_FEES_CD'];

    $pdf->Cell(97.5,7,"-".$total_charges,1,0);
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

if(isset($_SESSION['ApbackOffice_client_JV_charges_CDS_profit_and_loss']))
{
    $pdf->Cell(97.5,7,Ledger_balance($_SESSION['ApbackOffice_client_JV_charges_CDS_profit_and_loss']),1,0);
}
else
{
    $pdf->Cell(97.5,7,"-",1,0);
}
$pdf->ln();

$pdf->Cell(97.5,7,'Receipt (R)',1,0);
if(isset($_SESSION['ApbackOffice_client_R_charges_CDS_profit_and_loss']))
{
    $pdf->Cell(97.5,7,Ledger_balance($_SESSION['ApbackOffice_client_R_charges_CDS_profit_and_loss']),1,0);
}
else
{
    $pdf->Cell(97.5,7,"-",1,0);
}

$pdf->ln();
$pdf->Cell(97.5,7,'Payment (P)',1,0);
if(isset($_SESSION['ApbackOffice_client_P_charges_CDS_profit_and_loss']))
{
    $pdf->Cell(97.5,7,Ledger_balance($_SESSION['ApbackOffice_client_P_charges_CDS_profit_and_loss']),1,0);
}
else
{
    $pdf->Cell(97.5,7,"-",1,0);
}
// exit();
if ($cds_future_data=="1") 
{
//Future
$pdf->AddPage();

$pdf->SetFont('Arial','',12);
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"Future Trades",1,1,'C',true);

$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(31,7,'Symbol',1,0);
$pdf->Cell(11,7,'Op Qty',1,0);
$pdf->Cell(12,7,'Op Rate',1,0);
$pdf->Cell(10.8,7,'Buy Qty',1,0);
$pdf->Cell(11.8,7,'Buy Avg',1,0);
$pdf->Cell(15.8,7,'Buy Value',1,0);
$pdf->Cell(11.8,7,'Sell Qty',1,0);
$pdf->Cell(10.8,7,'Sell Avg',1,0);
$pdf->Cell(15.8,7,'Sell Value',1,0);
$pdf->Cell(10.8,7,'Net Qty',1,0);
$pdf->Cell(10.8,7,'Net Rate',1,0);
$pdf->Cell(11,7,'CL Price',1,0);
$pdf->Cell(15,7,'Notional',1,0);
$pdf->Cell(16.5,7,'Net P&L',1,0);
$pdf->ln(); 
$total_future=0;
$total_buy_value_future=0;
$total_sell_value_future=0;
$total_Notional_future=0;
$Notional_future=0;
$pdf->SetFont('Arial','',7.1);
// echo "<pre>";
// print_r($cds_pnl_all);
// exit();
foreach ($cds_pnl as $key => $value)
{
    if(!preg_match("/\b(CE|PE)\b/", $value[31]))
    {
        if($value[27]=="CD_NSE" && $value[22]=="FO")
        {   
            if ($pdf->GetY() > 270) 
            {
                $pdf->AddPage();
                $pdf->SetFont('Arial','B',7);
                $pdf->SetFillColor(255,255,255);
                $pdf->SetTextColor(0,0,0);

                $pdf->Cell(31,7,'Symbol',1,0);
                $pdf->Cell(11,7,'Op Qty',1,0);
                $pdf->Cell(12,7,'Op Rate',1,0);
                $pdf->Cell(10.8,7,'Buy Qty',1,0);
                $pdf->Cell(11.8,7,'Buy Avg',1,0);
                $pdf->Cell(15.8,7,'Buy Value',1,0);
                $pdf->Cell(11.8,7,'Sell Qty',1,0);
                $pdf->Cell(10.8,7,'Sell Avg',1,0);
                $pdf->Cell(15.8,7,'Sell Value',1,0);
                $pdf->Cell(10.8,7,'Net Qty',1,0);
                $pdf->Cell(10.8,7,'Net Rate',1,0);
                $pdf->Cell(11,7,'CL Price',1,0);
                $pdf->Cell(15,7,'Notional',1,0);
                $pdf->Cell(16.5,7,'Net P&L',1,0);
                $pdf->ln();
            }
            // symbol
            $pdf->SetFont('Arial','',7);
            $pdf->Cell(31,7,$value[30],1,0);
             //Open qty
            $pdf->Cell(11,7,$value[39],1,0);
            //Open rate
            // $Closing=number_format((float)$value[13], 2, '.', '');
            $pdf->Cell(12,7,$value[1],1,0);

            //Buy qty
            $pdf->Cell(10.8,7,$value[2],1,0);
            
            //Buy AVG
            $pdf->Cell(11.8,7,$value[3],1,0);
           
            //Buy Value
            $pdf->Cell(15.8,7,$value[4],1,0);
            
            //Sell qty
            $pdf->Cell(11.8,7,$value[5],1,0);
           
            //Sell Avg
            $pdf->Cell(10.8,7,$value[6],1,0);
            
            //Sell Value
            $pdf->Cell(15.8,7,$value[7],1,0);
            $pdf->Cell(10.8,7,$value[8],1,0);
            $pdf->Cell(10.8,7,$value[9],1,0);

            $pdf->Cell(11,7,$value[13],1,0);

            //Notional
            if($value[8]!="0")
            {
                $Notional_future=$value[13]*$value[8]+$value[10];
                $Notional_future=number_format((float)$Notional_future, 2, '.', '');
                $pdf->Cell(15,7,$Notional_future,1,0);
            }
            else
            {
                $Notional_future=$value[10];
                $pdf->Cell(15,7,$Notional_future,1,0);
            }
            //Realized P&L
            $pnl=$value[10];
            // $pnl=number_format((float)$pnl, 2, '.', '');
            $pdf->SetFont('Arial','B',7);
            $pdf->Cell(16.5,7,$pnl,1,0);
            $pdf->SetFont('Arial','',7);
            $pdf->ln();

            $total_future+=$pnl;
            $total_buy_value_future+=$value[4];
            $total_sell_value_future+=$value[7];
            $total_Notional_future+=$Notional_future;

        }
    }
 
}
$pdf->SetFont('Arial','B',7);
$pdf->Cell(31,7,'Total',1,0);
$pdf->Cell(11,7,'',1,0);
$pdf->Cell(12,7,'',1,0);
$pdf->Cell(10.8,7,'',1,0);
$pdf->Cell(11.8,7,'',1,0);
$pdf->Cell(15.8,7,$total_buy_value_future,1,0);
$pdf->Cell(11.8,7,'',1,0);
$pdf->Cell(10.8,7,'',1,0);
$pdf->Cell(15.8,7,$total_sell_value_future,1,0);
$pdf->Cell(10.8,7,'',1,0);
$pdf->Cell(10.8,7,'',1,0);
$pdf->Cell(11,7,'',1,0);
$pdf->Cell(15,7,$total_Notional_future,1,0);
$pdf->Cell(16.5,7,$total_future,1,0);
}
if($cds_option_data=="1")
{

//Option
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"Option Trades",1,1,'C',true);

$pdf->SetFont('Arial','B',7);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(33,7,'Symbol',1,0);
$pdf->Cell(9,7,'Op Qty',1,0);
$pdf->Cell(12,7,'Op Rate',1,0);
$pdf->Cell(10.8,7,'Buy Qty',1,0);
$pdf->Cell(11.8,7,'Buy Avg',1,0);
$pdf->Cell(15.8,7,'Buy Value',1,0);
$pdf->Cell(11.8,7,'Sell Qty',1,0);
$pdf->Cell(10.8,7,'Sell Avg',1,0);
$pdf->Cell(15.8,7,'Sell Value',1,0);
$pdf->Cell(10.8,7,'Net Qty',1,0);
$pdf->Cell(10.8,7,'Net Rate',1,0);
$pdf->Cell(11,7,'CL Price',1,0);
$pdf->Cell(15,7,'Notional',1,0);
$pdf->Cell(16.5,7,'Net P&L',1,0);
$pdf->ln(); 
$total_options=0;
$total_buy_value_options=0;
$total_sell_value_options=0;
$Total_Notional=0;
$pdf->SetFont('Arial','',7);

foreach ($cds_pnl as $key => $value)
{
    if(preg_match("/\b(CE|PE)\b/", $value[31]))
    {
        if($value[27]=="CD_NSE" && $value[22]=="FO")
        {   
            if ($pdf->GetY() > 270) 
            {
                $pdf->AddPage();
                $pdf->SetFont('Arial','B',7);
                $pdf->SetFillColor(255,255,255);
                $pdf->SetTextColor(0,0,0);

                $pdf->Cell(33,7,'Symbol',1,0);
                $pdf->Cell(9,7,'Op Qty',1,0);
                $pdf->Cell(12,7,'Op Rate',1,0);
                $pdf->Cell(10.8,7,'Buy Qty',1,0);
                $pdf->Cell(11.8,7,'Buy Avg',1,0);
                $pdf->Cell(15.8,7,'Buy Value',1,0);
                $pdf->Cell(11.8,7,'Sell Qty',1,0);
                $pdf->Cell(10.8,7,'Sell Avg',1,0);
                $pdf->Cell(15.8,7,'Sell Value',1,0);
                $pdf->Cell(10.8,7,'Net Qty',1,0);
                $pdf->Cell(10.8,7,'Net Rate',1,0);
                $pdf->Cell(11,7,'CL Price',1,0);
                $pdf->Cell(15,7,'Notional',1,0);
                $pdf->Cell(16.5,7,'Net P&L',1,0);
                $pdf->ln();
            }
            // symbol
            $pdf->SetFont('Arial','',7);
            $pdf->Cell(33,7,$value[30],1,0);
             //Open qty
            $pdf->Cell(9,7,$value[39],1,0);
            //Open rate
            // $Closing=number_format((float)$value[13], 2, '.', '');
            $pdf->Cell(12,7,$value[1],1,0);

            //Buy qty
            $pdf->Cell(10.8,7,$value[2],1,0);
            
            //Buy AVG
            $pdf->Cell(11.8,7,$value[3],1,0);
           
            //Buy Value
            $pdf->Cell(15.8,7,$value[4],1,0);
            
            //Sell qty
            $pdf->Cell(11.8,7,$value[5],1,0);
           
            //Sell Avg
            $pdf->Cell(10.8,7,$value[6],1,0);
            
            //Sell Value
            $pdf->Cell(15.8,7,$value[7],1,0);
            $pdf->Cell(10.8,7,$value[8],1,0);
            $pdf->Cell(10.8,7,$value[9],1,0);
            //Closing Price
            $pdf->Cell(11,7,$value[13],1,0);

            //Notional
            if($value[8]!="0")
            {
            $Notional=$value[13]*$value[8]+$value[10];
            // $Notional=number_format((float)$Notional, 2, '.', '');
            $pdf->Cell(15,7,$Notional,1,0);
            }
            else
            {
                $Notional=$value[10];
                $pdf->Cell(15,7,$value[10],1,0);
            }
            //Realized P&L
            $pnl=$value[10];
            // $pnl=number_format((float)$pnl, 2, '.', '');
            $pdf->SetFont('Arial','B',7);
            $pdf->Cell(16.5,7,$pnl,1,0);
            $pdf->SetFont('Arial','',7);

            $pdf->ln();

            $total_options+=$pnl;
            $total_buy_value_options+=$value[4];
            $total_sell_value_options+=$value[7];
            $Total_Notional+=$Notional;

        }
    }
 
}
$pdf->SetFont('Arial','B',7);
$pdf->Cell(33,7,'Total',1,0);
$pdf->Cell(9,7,'',1,0);
$pdf->Cell(12,7,'',1,0);
$pdf->Cell(10.8,7,'',1,0);
$pdf->Cell(11.8,7,'',1,0);
$pdf->Cell(15.8,7,$total_buy_value_options,1,0);
$pdf->Cell(11.8,7,'',1,0);
$pdf->Cell(10.8,7,'',1,0);
$pdf->Cell(15.8,7,$total_sell_value_options,1,0);
$pdf->Cell(10.8,7,'',1,0);
$pdf->Cell(10.8,7,'',1,0);
$pdf->Cell(11,7,'',1,0);
$pdf->Cell(15,7,$Total_Notional,1,0);
$pdf->Cell(16.5,7,$total_options,1,0);
}
$pdf->Output('I',$data[0]."_CD_PNL.pdf");
date_default_timezone_set('Asia/Kolkata');
$localIp = gethostbyname(gethostname());
$myfile2 = fopen("cd_pnl_log.txt", "a") or die("Unable to open file!");
$txt2 = "\n".$data[0]."\n".$this->input->ip_address()."\n".date('Y-m-d H:i:s')."\n";
fwrite($myfile2, $txt2);
?>