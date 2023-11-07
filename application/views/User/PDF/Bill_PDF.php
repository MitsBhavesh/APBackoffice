<?php

$columns = $_SESSION['Arham_client_ledger_data'][0];
$back_data = $_SESSION['Arham_client_ledger_data'][1];
// echo "<pre>";
// print_r($columns);
// print_r($back_data);
// echo "</pre>";
// exit();

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
// Simple table
	function BasicTable($header, $data_row)
	{
	    // Header
	    $i = 0;
	    $this->SetFont('Arial','B',8);  
	    foreach($header as $col)
	    {
	        if($i==1)
	        {
	           	$this->MultiCell(10,6,$col,1);   //Increse the header MultiCell 10i6ht, height,...,boder
	   //         	$x = $this->GetX();
				// $y = $this->GetY();
				// $this->SetXY($x + 15, $y-24);
	        }
	        else if($i==0)
	       	{
	       		$this->MultiCell(10,6,$col,1);
	   //     		$x = $this->GetX();
				// $y = $this->GetY();
				// $this->SetXY($x + 15, $y-24);
	       	}
	        else if($i==2)
	       	{
	       		$this->MultiCell(15,6,$col,1);
	   //     		$x = $this->GetX();
				// $y = $this->GetY();
				// $this->SetXY($x + 15, $y-24);
	       	}
	        else if($i==3)
	       	{
	       		$this->MultiCell(10,6,$col,1);
	       	}
	       	else if($i==4)
	       	{
	       		$this->MultiCell(10,6,$col,1);
	       	}
	       	else if($i==5)
	       	{
	       		$this->MultiCell(10,6,$col,1);
	       	}
	       	else if($i==6)
	       	{
	       		$this->MultiCell(10,6,$col,1);
	       	}
	       	else if($i==7)
	       	{
	       		$this->MultiCell(10,6,$col,1);
	       	}
	       	else if($i==8)
	       	{
	       		$this->MultiCell(10,6,$col,1);
	       	}
	       	else if($i==9)
	       	{
	       		$this->MultiCell(10,6,$col,1);
	       	}
	        // else
	        // {	
	        //    	$this->MultiCell(10,6,$col,1);
	        // }
	        $i++;
	    }
	    $this->Ln();
	               
	}

	function Footer()
	{
		$this->SetY(-15);
		
		$this->SetFont('Arial','I',8);
		 
		// Page number
		$this->cell(0,16,'Account Holdings Page '.$this->PageNo().'/{nb}',0,0,'C');
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

 $pdf->Image('arham_logo.jpg',150,15,45);

//******************************************************

// $pdf -> Line(0, 40, 215, 40);
$pdf->SetFont('Arial','',8);
$pdf->SetXY(10, 44);

$pdf->Cell(25,4,"Client Code",0);
$pdf->Cell(20,4,": ".$back_data[0][32],0);


$pdf->SetXY(10, 48);
$pdf->Cell(25,4,"Name",0);
$pdf->Cell(20,4,": ".$back_data[0][33],0);

$pdf->SetXY(10, 52);
$pdf->Cell(25,4,"Address",0);

$pdf->SetXY(35, 52);
$pdf->Cell(25,4,":",0);

if (!empty($back_data[0][36]))
{
   
    //split Address Data
    $old_add = explode(',',$back_data[0][36]);

    $set_y = 54;
    foreach ($old_add as $value) {
        $pdf->SetXY(36, $set_y);
        $pdf->Write(0, $value);
        $set_y += 3.5;
    }
 }

$pdf->SetXY(125, 44);
$pdf->Cell(25,4,"PAN  of Client",0);
$pdf->Cell(20,4,": ".$back_data[0][15],0);

$pdf->SetXY(125, 48);
$pdf->Cell(25,4,"Branch",0);
$pdf->Cell(20,4,": ".$back_data[0][0],0);

$pdf->SetXY(125, 52);
$pdf->Cell(25,4,"Email id",0);
$pdf->Cell(20,4,": ".$back_data[0][16],0);


$pdf->SetXY(125, 56);
$pdf->Cell(25,4,"Mobile No",0);
$pdf->Cell(20,4,": ".$back_data[0][34],0);

$pdf->SetFont('Arial','', 9);

$pdf->SetXY(10, 70);
$pdf->Cell(0,10,"Dear Sir/Madam,");

// $pdf->SetXY(95, 74);
// $pdf->Cell(0,10,"Sub: Confirmation of Accounts");

$pdf->SetXY(10, 74);
$pdf->Cell(0,10,"I/W e have this day done by your order and on your account the following transactions : ");

// $pdf->SetXY(10, 82);
// $pdf->Cell(0,10,"to report the same within 30 days from the receipt of this statement.");

$pdf->ln(15); //FULL TABLE LINE

$pdf->ln(4); //TABLE SPACING

$header = array('Order No.', 'Order Time', 'Trade No.', 'Trade Time', 'Security/Contract Description', 'Buy(B)Sell(s)', 'Quantity', 'Gross rate/trade price per Unit(Rs)', 'Brokerage per Unit(Rs)', 'Net RAte per Unit(Rs)', 'Closing Rate per Unit(Rs) **', 'Net Total(Before Levies)(Rs.)','Remark');

// Data loading
$pdf->SetFont('Arial','B',13);

// $data = $pdf->LoadData('Holdings.txt');

	$pdf->BasicTable($header,$back_data);


}

$pdf->Output('I', $_SESSION['Arham_User_Session_Data'][9].'_Bill.'.'pdf');

?>