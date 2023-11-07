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
// $pdf -> Line(20, 20, 205, 20);
// $pdf -> Line(205, 20, 205, 42);
$pdf->SetFont('Arial','',9);
$pdf->SetXY(12, 46);
$pdf->Write(0,"Pan: ". $data[2]);
$pdf->SetXY(12, 52);
$pdf->Write(0,"Client ID: ". $data[0]);
$pdf->SetXY(12, 58);
$pdf->Write(0,"Client Name: ". $data[1]);
$pdf->SetFont('Arial','B',9);


//finalcial Year
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

$pdf->SetXY(12, 64);
$pdf->Write(0,"Tax P&L Statement for EQ from ".$data[3]." to ".$final_convert_date."");
// Start Realized Profit Breakdown///
$pdf->SetXY(12, 70);
$pdf->Write(0,"Realized Profit Breakdown");

$pdf->SetFont('Arial','',9);
$pdf->SetXY(12, 76);
$pdf->Write(0,"Intra-day/Speculative profit");

$pdf->SetXY(78, 76);
if(isset($_SESSION['ApbackOffice_client_intraday_profit_and_loss'])){
   $pdf->Write(0,$_SESSION['ApbackOffice_client_intraday_profit_and_loss']); 
}

$pdf->SetXY(12, 82);
$pdf->Write(0,"Short-term profit");

$pdf->SetXY(78, 82);
if(isset($_SESSION['ApbackOffice_client_shortterm_profit_and_loss'])){
   $pdf->Write(0,$_SESSION['ApbackOffice_client_shortterm_profit_and_loss']); 
}


$pdf->SetXY(12, 88);
$pdf->Write(0,"Total realized profit");

$pdf->SetXY(78, 88);
if(isset($_SESSION['ApbackOffice_client_intraday_profit_and_loss']) && isset($_SESSION['ApbackOffice_client_shortterm_profit_and_loss']) && isset($_SESSION['ApbackOffice_client_longterm_profit_and_loss']))
{
$total_profit=$_SESSION['ApbackOffice_client_intraday_profit_and_loss']+$_SESSION['ApbackOffice_client_shortterm_profit_and_loss']+$_SESSION['ApbackOffice_client_longterm_profit_and_loss'];
$pdf->Write(0,$total_profit);
}

$pdf->SetXY(12, 94);
$pdf->Write(0,"Long-term profit");

$pdf->SetXY(78, 94);
if(isset($_SESSION['ApbackOffice_client_longterm_profit_and_loss'])){
   $pdf->Write(0,$_SESSION['ApbackOffice_client_longterm_profit_and_loss']); 
}

// END Realized Profit Breakdown///
// start Turnover Breakdown (Scripwise)///
$pdf->SetFont('Arial','B',9);
$pdf->SetXY(12, 100);
$pdf->Write(0,"Turnover Breakdown (Scripwise)");

$pdf->SetFont('Arial','',9);
$pdf->SetXY(12, 106);
$pdf->Write(0,"Long-term profit");

$pdf->SetXY(78, 106);
if(isset($_SESSION['ApbackOffice_client_longterm_profit_and_loss'])){
   $pdf->Write(0,$_SESSION['ApbackOffice_client_longterm_profit_and_loss']); 
}

// END Turnover Breakdown (Scripwise)///
// Start Other Debits/Credits including Service Tax//
$pdf->SetFont('Arial','B',9);
$pdf->SetXY(12, 112);
$pdf->Write(0,"Other Debits/Credits including Service Tax");

$pdf->SetFont('Arial','',9);

$pdf->SetXY(12, 118);
$pdf->Write(0,"Total Charges"); 
$pdf->SetXY(78, 118);
// $pdf->Write(0,"4299.534");

$pdf->SetXY(12, 124);
$pdf->Write(0,"Total Other Charges");
// END Other Debits/Credits including Service Tax//

// Start Charges
$pdf->SetFont('Arial','B',9);
$pdf->SetXY(12, 130);
$pdf->Write(0,"Charges");

$pdf->SetXY(12, 136);
$pdf->Write(0,"Account Head");

$pdf->SetXY(78, 136);
$pdf->Write(0,"Tax Amount");

$pdf->SetFont('Arial','',9);
$pdf->SetXY(12, 142);
$pdf->Write(0,"Brokerage - Z");
$pdf->SetXY(78, 142);
if(isset($_SESSION['ApbackOffice_client_Broekrage_profit_and_loss'])){
   $pdf->Write(0,$_SESSION['ApbackOffice_client_Broekrage_profit_and_loss']); 
}
// $pdf->Write(0,"1.518");
$pdf->SetXY(12, 148);
$pdf->Write(0,"Central GST - Z");
$pdf->SetXY(12, 154);
$pdf->Write(0,"Clearing Charges - Z");
$pdf->SetXY(78, 154);
// $pdf->Write(0,"0.0241");
$pdf->SetXY(12, 160);
$pdf->Write(0,"Exchange Transaction Charges - Z");
$pdf->SetXY(78, 160);
// $pdf->Write(0,"1362.4145");
$pdf->SetXY(12, 166);
$pdf->Write(0,"Integrated GST - Z");
$pdf->SetXY(78, 166);
// $pdf->Write(0,"245.5122");
$pdf->SetXY(12, 172);
$pdf->Write(0,"SEBI Turnover Fees - Z");
$pdf->SetXY(78, 172);
// $pdf->Write(0,"3.6693");
$pdf->SetXY(12, 178);
$pdf->Write(0,"Securities Transaction Tax - Z");

$pdf->SetXY(12, 184);
$pdf->Write(0,"Stamp Duty - Z");

$pdf->SetXY(12, 190);
$pdf->Write(0,"State GST - Z");

// End Charges

foreach ($equity_pnl as $key => $value) {

    if($value[11]=="EXPENSES")
    {   
        $pdf->SetFont('Arial','',9);

        if($value[14]=="CGST")
        {
            //CGST
            $pdf->SetXY(78, 148);
            $pdf->Write(0,$value[1]);
            //CGST
        }
        if($value[14]=="OTHER EXP")
        {
            //OTHER EXP
  
            $pdf->SetXY(78, 124);
            $pdf->Write(0,$value[1]);
            //OTHER EXP

        }
        if($value[14]=="STAMP DUTY")
        {
            //STAMP DUTY
            $pdf->SetXY(78, 184);
            $pdf->Write(0,$value[1]);
            //STAMP DUTY
        }      
        if($value[14]=="STT")
        {
            //STT
            $pdf->SetXY(78, 178);
            $pdf->Write(0,$value[1]);
            //STT
        }
        if($value[14]=="SGST")
        {
            //SGST
            $pdf->SetXY(78, 190);
            $pdf->Write(0,$value[1]);
            //SGST
        }     
        
    }

}
//START SHORT TERM TABLE
$pdf->AddPage();
$pdf -> Line(10, 270, 205, 270); // ____
$pdf -> Line(10, 10, 10, 270);// |......
$pdf -> Line(10, 10, 205, 10);//----....
$pdf -> Line(205, 10, 205, 270);//.....|

$pdf->SetFont('Arial','B',8);
$pdf->SetXY(12, 15);
$pdf->Write(0,"Short Term Trades");

$pdf->SetXY(12, 25);
$pdf->Write(0,"Symbol");

$pdf->SetXY(65, 25);
$pdf->Write(0,"Net Qty");

$pdf->SetXY(78, 25);
$pdf->Write(0,"Buy Value");

$pdf->SetXY(95, 25);
$pdf->Write(0,"Sell Value");

$pdf->SetXY(112, 25);
$pdf->Write(0,"Buy Qty");

$pdf->SetXY(125, 25);
$pdf->Write(0,"Sell Qty");

$pdf->SetXY(140, 25);
$pdf->Write(0,"Buy Average");

$pdf->SetXY(160, 25);
$pdf->Write(0,"Sell Average");

$pdf->SetXY(180, 25);
$pdf->Write(0,"Realized P&L");
$pdf->SetFont('Arial','',7);

$i=30;
$total_SHORTTERM=0;
foreach ($equity_pnl as $key => $value) {

    if($value[11]=="OP_SHORTTERM" || $value[11]=="SHORTTERM")
    {   
        //symbol
        $pdf->SetXY(12, $i);
        $pdf->Write(0,$value[15]);
        //qty
        $pdf->SetXY(65, $i);
        $pdf->Write(0,$value[16]); 
        //Buy Value
        $pdf->SetXY(78, $i);
        $pdf->Write(0,$value[4]);
        //Sell Value
        $pdf->SetXY(95, $i);
        $pdf->Write(0,$value[6]);
        //Buy Qty
        $pdf->SetXY(112, $i);
        $pdf->Write(0,$value[2]);
        //Sell Qty
        $pdf->SetXY(125, $i);
        $pdf->Write(0,$value[5]);
        //Buy Average
        $pdf->SetXY(140, $i);
        $pdf->Write(0,$value[3]);
        //Sell Average
        $pdf->SetXY(160, $i);
        $pdf->Write(0,$value[7]);
        //Realized P&L
        $pdf->SetXY(180, $i);
        $pdf->Write(0,$value[1]);

        $total_SHORTTERM+=$value[1];
 $i+=5;
    }
 
}

$pdf->SetFont('Arial','B',8);
$pdf->SetXY(145, $i+30);
$pdf->Write(0,"Total: ");
$pdf->SetFont('Arial','',8);
$pdf->SetXY(182, $i+30);
$pdf->Write(0,$total_SHORTTERM);


//LONG TERM 
$pdf->AddPage();
$pdf -> Line(10, 270, 205, 270); // ____
$pdf -> Line(10, 10, 10, 270);// |......
$pdf -> Line(10, 10, 205, 10);//----....
$pdf -> Line(205, 10, 205, 270);//.....|

$pdf->SetFont('Arial','B',8);
$pdf->SetXY(12, 15);
$pdf->Write(0,"Long Term Trades");

$pdf->SetXY(12, 25);
$pdf->Write(0,"Symbol");

$pdf->SetXY(65, 25);
$pdf->Write(0,"Net Qty");

$pdf->SetXY(78, 25);
$pdf->Write(0,"Buy Value");

$pdf->SetXY(95, 25);
$pdf->Write(0,"Sell Value");

$pdf->SetXY(112, 25);
$pdf->Write(0,"Buy Qty");

$pdf->SetXY(125, 25);
$pdf->Write(0,"Sell Qty");

$pdf->SetXY(140, 25);
$pdf->Write(0,"Buy Average");

$pdf->SetXY(160, 25);
$pdf->Write(0,"Sell Average");

$pdf->SetXY(180, 25);
$pdf->Write(0,"Realized P&L");
$pdf->SetFont('Arial','',7);
$i=30;
$total_LONGTERM=0;
foreach ($equity_pnl as $key => $value) {

    if($value[11]=="LONGTERM")
    {   
        //symbol
        $pdf->SetXY(12, $i);
        $pdf->Write(0,$value[15]);
        //qty
        $pdf->SetXY(65, $i);
        $pdf->Write(0,$value[16]); 
        //Buy Value
        $pdf->SetXY(78, $i);
        $pdf->Write(0,$value[4]);
        //Sell Value
        $pdf->SetXY(95, $i);
        $pdf->Write(0,$value[6]);
        //Buy Qty
        $pdf->SetXY(112, $i);
        $pdf->Write(0,$value[2]);
        //Sell Qty
        $pdf->SetXY(125, $i);
        $pdf->Write(0,$value[5]);
        //Buy Average
        $pdf->SetXY(140, $i);
        $pdf->Write(0,$value[3]);
        //Sell Average
        $pdf->SetXY(160, $i);
        $pdf->Write(0,$value[7]);
        //Realized P&L
        $pdf->SetXY(180, $i);
        $pdf->Write(0,$value[1]); 

        $total_LONGTERM+=$value[1]; 
$i+=5;
    }
  
}
$pdf->SetFont('Arial','B',8);
$pdf->SetXY(145, $i+30);
$pdf->Write(0,"Total: ");
$pdf->SetFont('Arial','',8);
$pdf->SetXY(182, $i+30);
$pdf->Write(0,$total_LONGTERM);


//Intraday 
$pdf->AddPage();
$pdf -> Line(10, 270, 205, 270); // ____
$pdf -> Line(10, 10, 10, 270);// |......
$pdf -> Line(10, 10, 205, 10);//----....
$pdf -> Line(205, 10, 205, 270);//.....|

$pdf->SetFont('Arial','B',8);
$pdf->SetXY(12, 15);
$pdf->Write(0,"Intra-day");

$pdf->SetXY(12, 25);
$pdf->Write(0,"Symbol");

$pdf->SetXY(65, 25);
$pdf->Write(0,"Net Qty");

$pdf->SetXY(78, 25);
$pdf->Write(0,"Buy Value");

$pdf->SetXY(95, 25);
$pdf->Write(0,"Sell Value");

$pdf->SetXY(112, 25);
$pdf->Write(0,"Buy Qty");

$pdf->SetXY(125, 25);
$pdf->Write(0,"Sell Qty");

$pdf->SetXY(140, 25);
$pdf->Write(0,"Buy Average");

$pdf->SetXY(160, 25);
$pdf->Write(0,"Sell Average");

$pdf->SetXY(180, 25);
$pdf->Write(0,"Realized P&L");
$pdf->SetFont('Arial','',7);
$i=30;
$total_TRADING=0;

foreach ($equity_pnl as $key => $value) {

    if($value[11]=="TRADING")
    {   
        //symbol
        $pdf->SetXY(12, $i);
        $pdf->Write(0,$value[15]);
        //qty
        $pdf->SetXY(65, $i);
        $pdf->Write(0,$value[16]); 
        //Buy Value
        $pdf->SetXY(78, $i);
        $pdf->Write(0,$value[4]);
        //Sell Value
        $pdf->SetXY(95, $i);
        $pdf->Write(0,$value[6]);
        //Buy Qty
        $pdf->SetXY(112, $i);
        $pdf->Write(0,$value[2]);
        //Sell Qty
        $pdf->SetXY(125, $i);
        $pdf->Write(0,$value[5]);
        //Buy Average
        $pdf->SetXY(140, $i);
        $pdf->Write(0,$value[3]);
        //Sell Average
        $pdf->SetXY(160, $i);
        $pdf->Write(0,$value[7]);
        //Realized P&L
        $pdf->SetXY(180, $i);
        $pdf->Write(0,$value[1]);

        $total_TRADING+=$value[1]; 
  $i+=5;
    }

}
$pdf->SetFont('Arial','B',8);
$pdf->SetXY(145, $i+30);
$pdf->Write(0,"Total: ");
$pdf->SetFont('Arial','',8);
$pdf->SetXY(182, $i+30);
$pdf->Write(0,$total_TRADING); 
//END SHORT TERM TABLE


$pdf->Output('I',"EQ_PNL.pdf");
?>