<?php
// exit;
$columns = $_SESSION['Arham_client_ledger_data'][0];
$back_data = $_SESSION['Arham_client_ledger_data'][1];
// echo "<pre>";
// print_r($back_data);
// exit();
$ijk = 0;
foreach ($back_data as $value_back_data) {
    if($value_back_data[3] != "" && $value_back_data[3] != " ")
    {
        $back_data[$ijk][3] = date_format(date_create(str_replace(",", "", $value_back_data[3])),"Y-m-d");
        // print_r($back_data[$ijk][3]);
        // echo "<br>";
    }
    else
    {
        $back_data[$ijk][3] = date_format(date_create(str_replace(",", "", $value_back_data[3])),"Y-m-d");
        // echo $back_data[$ijk][3];
    }
    $ijk++;
}
// usort($back_data, 'date_compare');
// echo "<pre>";
// print_r($back_data);
// exit();

function date_compare($a, $b)
{
    $t1 = strtotime($a[3]);
    $t2 = strtotime($b[3]);
    return $t1 - $t2;
}    
usort($back_data, 'date_compare');
// echo "<pre>";
// print_r($back_data);
// exit();
$clientmaster_columns = $_SESSION['Arham_client_client_master_data'][0];
$clientmaster_back_data = $_SESSION['Arham_client_client_master_data'][1];
// echo "<pre>";
// print_r($columns);
// print_r($back_data);
// echo "</pre>";
// exit();


require('fpdf.php');
use setasign\Fpdi\Fpdi;
require_once('fpdf.php');
require_once('FPDI-2.3.4/src/autoload.php');

if(empty($back_data))
{
    $pdf = new FPDF();
    $pdf->AliasNbPages(); //Count Number of Page on footer
    // $pdf->isFinished = true;
    // add a page
    $pdf->AddPage('L'); // If you need Landscap n just write ('L')...this 
    $pdf->SetFont('Arial','B', 12);
    $pdf->Ln();
    $pdf->Cell(40,6,"Data not found!",1,0,'L'); 
}
else
{

class PDF extends FPDF
{

    //Page Header
    public function Header() {
    }

    // Page footer
    public function Footer()
    {      

        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
          // $this -> Line(10, 10, 205, 10);
        $this->cell(0,10,'Account Ledger Page '.$this->PageNo().'/{nb}',0,0,'C');


    }   
    
    

function ImprovedTable($header, $data)
{
    //Header
    $this->SetFont('Arial','B', 8);

    for($i=0;$i<count($header);$i++)
    {
        if($i == 2)
        {
            $this->Cell(14,7,$header[$i],1,0,'L');
            // $this->Cell(70,7,$header[$i],1,0,'L');
        }
        else if($i == 0)
        {
            $this->Cell(14,7,$header[$i],1,0,'L');
        }
        else if($i == 1)
        {
            $this->Cell(14,7,$header[$i],1,0,'L');
        }
        else if($i == 3)
        {
            $this->Cell(70,7,$header[$i],1,0,'L');
        }
        else if($i == 4)
        {
            $this->Cell(14,7,$header[$i],1,0,'L');
        }
        else if($i == 5)
        {
            $this->Cell(21,7,$header[$i],1,0,'L');
        }
        else if($i == 6)
        {
            $this->Cell(21,7,$header[$i],1,0,'L');
        }
        else if($i == 7)
        {
            $this->Cell(27,7,$header[$i],1,0,'L');
        }
    }
       
    $this->Ln();
    
    // Data
    $this->SetFont('Arial','', 7);
    $i=0;
    $debit_total = 0;
    $credit_total = 0;
    $total_balance = 0;
    $yestarday_balance = 0;

    //credit or debit like CR/DR
    function Ledger_balance($yestarday_balance)
    {
      if($yestarday_balance >= 0)
      {
        $type = " Dr";
        return "".number_format((float)$yestarday_balance, 2, '.', ',').$type."";
      }
      else
      {
        $type = " Cr";
        $yestarday_balance = Abs($yestarday_balance);
        return "".number_format((float)$yestarday_balance, 2, '.', ',').$type."";
      }
    }

    
    $j = 2;
    $i = 0;
    $hght = 95;
    $old_yval = 0;
    $yval = 0;
    $num = 1;

    foreach($data as $row)
    {        
        if($data[$i][1] != "" || $data[$i][2] != "")
        {

            $cell_htg = 6;
            $cell_htg_row = 6;

            $just = $row[0]." ".$row[9];
            $strlen_str = strlen($just);
            $not_in = 0;
      
            $old_yval = $yval;
            $xval = $this->GetX();
                        
            $yval = $this->GetY();

            $this->SetXY($xval+42,$yval);

            $this->MultiCell(70,$cell_htg_row,$just,1);
            
            $xval = $this->GetX();
                                    
            $yval = $this->GetY();

            // echo "<br>";
            // echo $num;
            // echo "<br>";
            // echo $old_yval - $yval;
            // $num++;
            
                       
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
               // echo "<br>";
            // echo $num;
            // echo "<br>";
            // echo $old_yval - $yval;
            // $num++;
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

            $this->SetXY($xval,$yval-$cell_htg_row);
          
            $this->SetFont('Arial','', 7);
            //Date
            $this->Cell(14,$cell_htg,date_format(date_create(str_replace(",", "", $row[19])),"d-m-Y"),1);

            $this->Cell(14,$cell_htg,date_format(date_create(str_replace(",", "", $row[3])),"d-m-Y"),1);
            //V.No
            $this->Cell(14,$cell_htg,$row[8],1);
            
            $this->SetXY($xval+112,$yval-$cell_htg_row);

             $this->SetFont('Arial','', 7);
            //ChqNo.
            $this->Cell(15,$cell_htg,$row[12],1,0,'R');
            //Debit
            $debit_total+=$row[1];
            $this->Cell(21,$cell_htg,number_format((float)$row[1], 2, '.', ','),1,0,'R');
            //Credit
            $credit_total+=$row[2];
            $this->Cell(21,$cell_htg,number_format((float)$row[2], 2, '.', ','),1,0,'R');
            //Balance
            if($row[1] != "")
            {
                $yestarday_balance += $row[1];
                $this->Cell(27,$cell_htg,Ledger_balance($yestarday_balance),1,0,'R');
            }
            else
            {
                $yestarday_balance -= $row[2];
                $this->Cell(27,$cell_htg,Ledger_balance($yestarday_balance),1,0,'R');
            }
            $total_balance += $yestarday_balance;

            $this->Ln();
            
        }
        $i++;


    }


    // Closing line
    $this->Cell(195,0,'','T');

    //Closing Balance
    $this->SetFont('Arial','B', 7);
    $this->Ln();
    $this->cell(127,5,'Closing Balance',1,0,'C');
    $this->SetFont('Arial','', 7);
    $this->cell(21,5,$debit_total,1,0,'R');
    $this->cell(21,5,$credit_total,1,0,'R');
    $this->cell(27,5,Ledger_balance($total_balance),1,0,'R');
    //Buttom
    $this->SetFont('Arial','',9);
    $this->Ln(10);
    $this->Cell(20,5,"Your faithfully,");
    $this->Ln(5);
    $this->Cell(20,5,"I/We herby confirm the above statement.");
    $this->Ln(5);
    $this->Cell(20,5,"Running About Authorisation:-You may revoke your running account authorisation at any time. The same would continue until it is revoked");
    $this->Ln(5);
    $this->Cell(20,5,"by you.");
    $this->Ln(5);
    $this->Cell(20,5,"This is computer generated statement,hence does not require signature.");
    $this->Ln(5);
    $this->Cell(98,5,"For ".$data[0][33],0,0,'L');
    $this->Cell(98,5,"For ARHAM SHARE CONSULTANTS PVT.LTD",0,0,'R');
    $this->Ln(5);
    $this->Cell(98,5,"(Authorised Signatory)",0,0,'L');
    $this->Cell(98,5,"(Authorised Signatory)",0,0,'R');
    $this->Ln(5);
    $this->Cell(98,5,"(Pan No: ".$data[0][15].")",0,0,'L');
    $this->Cell(98,5,"(Pan No: ".$data[0][15].")",0,0,'R');
}

}


$pdf = new PDF();

$pdf->AliasNbPages();


$pdf->SetFont('Arial','',7);
$pdf->AddPage();

//header box
$pdf -> Line(10, 42, 205, 42);
$pdf -> Line(10, 10, 10, 42);
$pdf -> Line(10, 10, 205, 10);
$pdf -> Line(205, 10, 205, 42);

$pdf->SetFont('Arial','B',11);
$pdf->SetXY(12, 12);
$pdf->Cell(25,4,"ARHAM SHARE CONSULTANTS PVT.LTD",0);

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

//******************************************************

// $pdf -> Line(0, 40, 215, 40);
$pdf->SetFont('Arial','',8);
$pdf->SetXY(10, 44);
// $pdf->BasicTable($header);
$pdf->Cell(25,4,"Client Code",0);
$pdf->Cell(20,4,": ".$back_data[0][32],0);


$pdf->SetXY(10, 48);
$pdf->Cell(25,4,"Name",0);
$pdf->Cell(20,4,": ".$back_data[0][33],0);

$pdf->SetXY(10, 52);
$pdf->Cell(25,4,"Address",0);

$pdf->SetXY(35, 52);
$pdf->Cell(25,4,":",0);

if (!empty($clientmaster_back_data[0][100]))
{
   
    //split Address Data
    $old_add = explode('~',$clientmaster_back_data[0][100]);

    $set_y = 54;
    foreach ($old_add as $value) {
        $pdf->SetXY(36, $set_y);
        $pdf->Write(0, $value);
        $set_y += 3.5;
    }
 }


$pdf->SetXY(125, 44);
$pdf->Cell(25,4,"Branch",0);
$pdf->Cell(20,4,": ".$clientmaster_back_data[0][45],0);

$pdf->SetXY(125, 48);
$pdf->Cell(25,4,"Email id",0);
$pdf->Cell(20,4,": ".$clientmaster_back_data[0][178],0);


$pdf->SetXY(125, 52);
$pdf->Cell(25,4,"Mobile No",0);
$pdf->Cell(20,4,": ".$clientmaster_back_data[0][200],0);

$active_seg = "";
foreach ($clientmaster_back_data as $value) {
    // print_r($value[0].",");
    if($active_seg == "")
    {
        $active_seg .=  $value[0];
    } 
    else
    {
        $active_seg .=  ",".$value[0];
    }
}
$pdf->SetXY(125, 56);
$pdf->Cell(25,4,"Active Seg",0);

$pdf->SetXY(150, 56);
$pdf->Cell(25,4,":",0);
// $pdf->Cell(20,4,": ".$back_data[0][0],0);

$pdf->SetXY(152, 56);
$pdf->MultiCell(40,4,$active_seg,0);


$pdf->SetFont('Arial','', 9);

$pdf->SetXY(10, 70);
$pdf->Cell(0,10,"Dear Sir/Madam,");

$pdf->SetXY(95, 74);
$pdf->Cell(0,10,"Sub: Confirmation of Accounts");

$pdf->SetXY(10, 78);
$pdf->Cell(0,10,"Please find here with statement of Accounts ledger from To as per our books. If any discrepancies/ errors are found you are requested");

$pdf->SetXY(10, 82);
$pdf->Cell(0,10,"to report the same within 30 days from the receipt of this statement.");

// $pdf->ln();

$pdf->SetFont('Arial','B', 9);

$pdf->SetXY(10, 88);
$pdf->Cell(0,10,"Company : Grp1");

$pdf->SetXY(90, 88);
$pdf->Cell(0,10,"Ledger Details "."2020-04-01 to ".date("d/m/Y"));


$pdf->ln(10);
$header = array('Date', 'V.Date', 'V.No', 'Particulars', 'ChqNo.', 'Debit', 'Credit', 'Balance');

$pdf->ImprovedTable($header,$back_data);
}

$pdf->Output('D',$_SESSION['Arham_User_Session_Data'][9].'_Ledger.'.'pdf');
?>