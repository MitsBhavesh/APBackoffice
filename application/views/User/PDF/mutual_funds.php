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
// ................

// $pdf -> Line(20, 20, 205, 20);
// $pdf -> Line(205, 20, 205, 42);
// $pdf->SetFont('Arial','',9);
// $pdf->SetXY(12, 46);
// $pdf->Write(0,"Pan: ". $data[2]);
// $pdf->SetXY(12, 52);
// $pdf->Write(0,"Client ID: ". $data[0]);
// $pdf->SetXY(12, 58);
// $pdf->Write(0,"Client Name: ". $data[1]);
// $pdf->SetFont('Arial','B',9);


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

// start pdf data
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(2,48,32);
$pdf->SetTextColor(255,255,255);
$pdf->ln();
$pdf->cell(195,7,"Personal Information",1,1,'C',true);

$pdf->SetFont('Arial','',9);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(45,7,'Pan : '.$data[2],1,0);
$pdf->Cell(45,7,'Client ID : '.$data[0],1,0);
$pdf->Cell(105,7,'Client Name : '.$data[1],1,0);

$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(2,48,32);
$pdf->SetTextColor(255,255,255);
$pdf->ln();
$pdf->cell(195,7,"Tax P&L Statement for EQ from ".$data[3]." to ".$final_convert_date."",1,1,'C',true);

// ######################### Start Realized Profit Breakdown
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"Realized Profit Breakdown",1,1,'',true);

$pdf->SetFont('Arial','',9);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(97.5,7,'Short-term profit Equity',1,0);
$pdf->Cell(97.5,7,'0',1,0);


$pdf->ln();
$pdf->Cell(97.5,7,'Long-term profit Equity',1,0);
$pdf->Cell(97.5,7,'0',1,0);


$pdf->ln();
$pdf->Cell(97.5,7,'Long-term profit Debt',1,0);
$pdf->Cell(97.5,7,'0',1,0);

$pdf->ln();
$pdf->Cell(97.5,7,'Total realized profit',1,0);
$pdf->Cell(97.5,7,'0',1,0);

$pdf->ln();
$pdf->Cell(97.5,7,'Short-term profit Debt',1,0);
$pdf->Cell(97.5,7,'0',1,0);


// ######################### End Realized Profit Breakdown
// ######################### Start Turnover Breakdown (Scripwise)
$pdf->ln();
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"Turnover Breakdown (Scripwise)",1,1,'',true);
$pdf->SetFont('Arial','',9);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(97.5,7,'Long-term turnover Debt',1,0);
$pdf->ln();
$pdf->Cell(97.5,7,'Short-term turnover Equity ',1,0);
$pdf->Cell(97.5,7,'0',1,0);
$pdf->ln();
$pdf->Cell(97.5,7,'Total Turnover ',1,0);
$pdf->Cell(97.5,7,'0',1,0);
$pdf->ln();
$pdf->Cell(97.5,7,'Long-term turnover Equity',1,0);
$pdf->Cell(97.5,7,'0',1,0);
$pdf->ln();
$pdf->Cell(97.5,7,'Short-term turnover Debt',1,0);
$pdf->Cell(97.5,7,'0',1,0);


// ######################### End Turnover Breakdown (Scripwise)
// ######################### Start Other Debits/Credits including Service Tax
$pdf->ln();
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"Other Debits/Credits including Service Tax",1,1,'',true);
$pdf->SetFont('Arial','',9);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(97.5,7,'Coin Subscription Charges',1,0);
$pdf->Cell(97.5,7,"0",1,0);


// ######################### End Other Debits/Credits including Service Tax
// ######################### Start Charges
$pdf->ln();
$pdf->SetFillColor(193, 225, 193);
$pdf->SetTextColor(2,48,32);
$pdf->cell(195,7,"Charges",1,1,'',true);
$pdf->SetFont('Arial','B',9);
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(97.5,7,'Account Head',1,0);
$pdf->Cell(97.5,7,'Tax Amount',1,0);



   $pdf->Cell(97.5,7,'0',1,0); 


// foreach ($equity_pnl as $key => $value) {

//     if($value[11]=="EXPENSES")
//     {   
//         $pdf->SetFont('Arial','',9);

//         if($value[14]=="CGST")
//         {
//             //CGST
//             $pdf->ln();
//             $pdf->Cell(97.5,7,'Central GST - Z',1,0);
//             $pdf->Cell(97.5,7,$value[1],1,0);

//             $pdf->ln();
//             $pdf->Cell(97.5,7,'Integrated GST - Z',1,0);
//             $pdf->Cell(97.5,7,"",1,0);

//             //CGST
//         }
//          if($value[14]=="SGST")
//         {
//             //SGST
//             $pdf->ln(); 
//             $pdf->Cell(97.5,7,'State GST - Z',1,0);
//             $pdf->Cell(97.5,7,$value[1],1,0);
           
//             // $pdf->SetXY(78, 190);
//             //SGST
//         }     
//         if($value[14]=="STAMP DUTY")
//         {

//             $pdf->ln();
//             $pdf->Cell(97.5,7,'Clearing Charges - Z',1,0);
//             $pdf->Cell(97.5,7,"",1,0);

//             $pdf->ln();
//             $pdf->Cell(97.5,7,'Exchange Transaction Charges - Z',1,0);
//             $pdf->Cell(97.5,7,"",1,0);
           
//             $pdf->ln();
//             $pdf->Cell(97.5,7,'SEBI Turnover Fees - Z',1,0);
//             $pdf->Cell(97.5,7,"",1,0);
//             $pdf->ln(); 
//             //STAMP DUTY
//             $pdf->Cell(97.5,7,'Stamp Duty - Z',1,0);
//             $pdf->Cell(97.5,7,$value[1],1,0);
//             $pdf->ln(); 
//             //STAMP DUTY
//         }       
//         if($value[14]=="STT")
//         {
//             //STT
//             $pdf->Cell(97.5,7,'Securities Transaction Tax - Z',1,0);
//             $pdf->Cell(97.5,7,$value[1],1,0);
//             $pdf->ln(); 
//             //STT
//         }
//         if($value[14]=="OTHER EXP")
//         {
//             //OTHER EXP

//             //OTHER EXP

//         }
        
//     }

// }


// // ######################### End charges

// // ######################### Start SHORT TERM TABLE
// $pdf->AddPage();

// $pdf -> Line(10, 270, 205, 270); // ____
// $pdf -> Line(10, 10, 10, 270);// |......
// $pdf -> Line(10, 10, 205, 10);//----....
// $pdf -> Line(205, 10, 205, 270);//.....|

// $pdf->SetFont('Arial','B',9);
// $pdf->SetFillColor(2,48,32);
// $pdf->SetTextColor(255,255,255);
// $pdf->cell(195,7,"Trades History",1,1,'C',true);

// $pdf->SetFont('Arial','',9);
// $pdf->SetFillColor(193, 225, 193);
// $pdf->SetTextColor(2,48,32);
// $pdf->cell(195,7,"Short Term Trades",1,1,'',true);

// $pdf->SetFont('Arial','B',7);
// $pdf->SetFillColor(255,255,255);
// $pdf->SetTextColor(0,0,0);
// $pdf->Cell(60,7,'Symbol',1,0);
// $pdf->Cell(16.8,7,'Net Qty',1,0);
// $pdf->Cell(16.8,7,'Buy Value',1,0);
// $pdf->Cell(16.8,7,'Sell Value',1,0);
// $pdf->Cell(16.8,7,'Buy Qty',1,0);
// $pdf->Cell(16.8,7,'Sell Qty',1,0);
// $pdf->Cell(16.8,7,'Buy Average',1,0);
// $pdf->Cell(16.8,7,'Sell Average',1,0);
// $pdf->Cell(17.5,7,'Realized P&L',1,0);
// $pdf->ln(); 
// $total_SHORTTERM=0;
// $pdf->SetFont('Arial','',7);

// // Total
// $pdf->Cell(60,7,'',0,0);
// $pdf->Cell(16.8,7,'',0,0);
// $pdf->Cell(16.8,7,'',0,0);
// $pdf->Cell(16.8,7,'',0,0);
// $pdf->Cell(16.8,7,'',0,0);
// $pdf->Cell(16.8,7,'',0,0);
// $pdf->Cell(16.8,7,'',0,0);
// $pdf->SetFont('Arial','B',8);
// $pdf->Cell(16.8,7,'Total',1,0);
// $pdf->Cell(17.5,7,$total_SHORTTERM,1,0);

// // ######################### End SHORT TERM TABLE


// // ######################### Start LONG TERM  TABLE
// $pdf->AddPage();
// $pdf -> Line(10, 270, 205, 270); // ____
// $pdf -> Line(10, 10, 10, 270);// |......
// $pdf -> Line(10, 10, 205, 10);//----....
// $pdf -> Line(205, 10, 205, 270);//.....|


// $pdf->SetFont('Arial','',9);
// $pdf->SetFillColor(193, 225, 193);
// $pdf->SetTextColor(2,48,32);
// $pdf->cell(195,7,"Long Term Trades",1,1,'',true);

// $pdf->SetFont('Arial','B',7);
// $pdf->SetFillColor(255,255,255);
// $pdf->SetTextColor(0,0,0);
// $pdf->Cell(60,7,'Symbol',1,0);
// $pdf->Cell(16.8,7,'Net Qty',1,0);
// $pdf->Cell(16.8,7,'Buy Value',1,0);
// $pdf->Cell(16.8,7,'Sell Value',1,0);
// $pdf->Cell(16.8,7,'Buy Qty',1,0);
// $pdf->Cell(16.8,7,'Sell Qty',1,0);
// $pdf->Cell(16.8,7,'Buy Average',1,0);
// $pdf->Cell(16.8,7,'Sell Average',1,0);
// $pdf->Cell(17.5,7,'Realized P&L',1,0);
// $pdf->ln(); 
// $total_LONGTERM=0;
// $pdf->SetFont('Arial','',7);

// // Total
// $pdf->Cell(60,7,'',0,0);
// $pdf->Cell(16.8,7,'',0,0);
// $pdf->Cell(16.8,7,'',0,0);
// $pdf->Cell(16.8,7,'',0,0);
// $pdf->Cell(16.8,7,'',0,0);
// $pdf->Cell(16.8,7,'',0,0);
// $pdf->Cell(16.8,7,'',0,0);
// $pdf->SetFont('Arial','B',8);
// $pdf->Cell(16.8,7,'Total',1,0);
// $pdf->Cell(17.5,7,$total_LONGTERM,1,0);
// // ######################### End LONG TERM  TABLE

// // ######################### Start Intraday  table
// $pdf->AddPage();
// $pdf -> Line(10, 270, 205, 270); // ____
// $pdf -> Line(10, 10, 10, 270);// |......
// $pdf -> Line(10, 10, 205, 10);//----....
// $pdf -> Line(205, 10, 205, 270);//.....|

// $pdf->SetFont('Arial','',9);
// $pdf->SetFillColor(193, 225, 193);
// $pdf->SetTextColor(2,48,32);
// $pdf->cell(195,7,"Intra-day",1,1,'',true);


// $pdf->SetFont('Arial','B',7);
// $pdf->SetFillColor(255,255,255);
// $pdf->SetTextColor(0,0,0);
// $pdf->Cell(60,7,'Symbol',1,0);
// $pdf->Cell(16.8,7,'Net Qty',1,0);
// $pdf->Cell(16.8,7,'Buy Value',1,0);
// $pdf->Cell(16.8,7,'Sell Value',1,0);
// $pdf->Cell(16.8,7,'Buy Qty',1,0);
// $pdf->Cell(16.8,7,'Sell Qty',1,0);
// $pdf->Cell(16.8,7,'Buy Average',1,0);
// $pdf->Cell(16.8,7,'Sell Average',1,0);
// $pdf->Cell(17.5,7,'Realized P&L',1,0);
// $pdf->ln();
// $total_TRADING=0;

// $pdf->Cell(60,7,'',0,0);
// $pdf->Cell(16.8,7,'',0,0);
// $pdf->Cell(16.8,7,'',0,0);
// $pdf->Cell(16.8,7,'',0,0);
// $pdf->Cell(16.8,7,'',0,0);
// $pdf->Cell(16.8,7,'',0,0);
// $pdf->Cell(16.8,7,'',0,0);
// $pdf->SetFont('Arial','B',8);
// $pdf->Cell(16.8,7,'Total',1,0);
// $pdf->Cell(17.5,7,$total_TRADING,1,0);

// foreach ($equity_pnl as $key => $value) {

//     if($value[11]=="TRADING")
//     {   
//         //symbol
//         $pdf->Cell(60,7,$value[15],1,0);
//         //qty
//         $pdf->Cell(16.8,7,$value[16],1,0);
//         //Buy Value
//         $pdf->Cell(16.8,7,$value[4],1,0);
//         //Sell Value
//         $pdf->Cell(16.8,7,$value[6],1,0);
//         //Buy Qty
//         $pdf->Cell(16.8,7,$value[2],1,0);
//         //Sell Qty
//         $pdf->Cell(16.8,7,$value[5],1,0);
//         //Buy Average
//         $pdf->Cell(16.8,7,$value[3],1,0);
//         //Sell Average
//         $pdf->Cell(16.8,7,$value[7],1,0);
//         //Realized P&L
//         $pdf->Cell(17.5,7,$value[1],1,0);

//         $pdf->ln();

//         $total_TRADING+=$value[1]; 
//     }

// }
$pdf->Output('I',"EQ_PNL.pdf");
?>