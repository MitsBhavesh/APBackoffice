<?php

$columns = $_SESSION['Arham_client_income_tax_data'][0];
$back_data = $_SESSION['Arham_client_income_tax_data'][1];

$group = array();

foreach ( $back_data as $value ) {
    $group[$value[11]][] = $value;
 //    echo "<pre>";
	// print_r($group);
	// exit();
}
// echo "<pre>";
// print_r($columns);
// print_r($group);
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
	function BasicTable($header, $group)
	{
	    // Header
	    $i = 0;
	    $this->SetFont('Arial','B',6);

	    foreach($header as $col)
	    {
	        if($i==1)					// N Qty
	        {
	           	$this->Cell(15,6,$col,1);   //Increse the header cell weight, height,...,boder
	        }
	        else if($i==0)				// Scrip
	       	{
	       		$this->Cell(50,6,$col,1); 
	       	}
	        else if($i==2)				//N rate
	       	{
	       		$this->Cell(15,6,$col,1);
	       	}
	        else if($i==3)				// N Amount
	       	{
	       		$this->Cell(17,6,$col,1);
	       	}
	       	else if($i==4)				// Closing Price
	       	{
	       		$this->Cell(13,6,$col,1);
	       	}
	       	else if($i==5)				// Profit/Loss
	       	{
	       		$this->Cell(17,6,$col,1);
	       	}
	       	else if($i==6)				// Buy Qty
	       	{
	       		$this->Cell(15,6,$col,1);
	       	}
	       	else if($i==7)				// Buy Rate
	       	{
	       		$this->Cell(13,6,$col,1);
	       	}
	       	else if($i==8)				// Buy Amount
	       	{
	       		$this->Cell(19,6,$col,1);
	       	}
	       	else if($i==9)				// Sale Qty				
	       	{
	       		$this->Cell(15,6,$col,1);
	       	}
	       	else if($i==10)				// Sale Rate
	       	{
	       		$this->Cell(14,6,$col,1);
	       	}	
	       	else if($i==11)				// Sale Amount
	       	{
	       		$this->Cell(17,6,$col,1);
	       	}	
	       	else if($i==12)				// Short Term
	       	{
	       		$this->Cell(15,6,$col,1);
	       	}	
	       	else if($i==13)				// Long Term
	       	{
	       		$this->Cell(15,6,$col,1);
	       	}	
	       	else if($i==14)				// Speculation
	       	{
	       		$this->Cell(14,6,$col,1);
	       	}	
	       	else if($i==15)				// Lower Amount
	       	{
	       		$this->Cell(19,6,$col,1);
	       	}
	      
	        $i++;
	    }
	    $this->Ln();
	    // $this->SetFont('Arial','',7);
	    // Data
		   
	    $tot_nqty = 0;
	    $tot_nrate = 0;
	    $tot_namt = 0;
	    $tot_closing_price = 0;
	    $tot_p_l = 0;
	    $tot_bqty = 0;
	    $tot_brate = 0;
	    $tot_bamt = 0;
	    $tot_sqty = 0;
	    $tot_srate = 0;
	    $tot_samt = 0;
	    $tot_s_term = 0;
	    $tot_l_term = 0;
	    $tot_spec = 0;
	    $tot_lower_amt = 0;
	     
		$yval = 0;
	     //   $j = 2;
	    $i = 0;
	       foreach ($group as $key_index => $data_row)
	        {
	        	$this->SetFont('Arial','B',7);
	        	$this->Cell(283,6,$key_index,1,0,'L');
	        	$this->Ln();

	        	$group_tot_nqty = 0;
			    $group_tot_nrate = 0;
			    $group_tot_namt = 0;
			    $group_tot_closing_price = 0;
			    $group_tot_p_l = 0;
			    $group_tot_bqty = 0;
			    $group_tot_brate = 0;
			    $group_tot_bamt = 0;
			    $group_tot_sqty = 0;
			    $group_tot_srate = 0;
			    $group_tot_samt = 0;
			    $group_tot_s_term = 0;
			    $group_tot_l_term = 0;
			    $group_tot_spec = 0;
			    $group_tot_lower_amt = 0;



	        	foreach ($data_row as $value) {
	        		$htg_cell = 6;
	        			$htg_cell_1 = 6;
	        			$cell_up = 6;
	        		for ($i=0; $i < 16 ; $i++) 
	        		{ 
	        			
		        		// if(strlen($value[15]) > 30)
		        		// {
		        		// 	$htg_cell = 12;
		        		// 	$htg_cell_1 = 6;
		        		// 	$cell_up = 12;
		        		// } 	

	        			$this->SetFont('Arial','',6);
	        		if($i==0)				// Scrip
			        {
			           	$cell_val = $this->MultiCell(50,$htg_cell,$value[14]." ".$value[15],1);   //Increse the header cell weight, height,...,boder
			           	
			           	// echo $old_xval;
			           	$xval = $this->GetX();
			           	
			           	
			           	// exit();
			           	$old_yval = $yval;
			           	$yval = $this->GetY();
			           	// echo $old_yval;
			           	// echo "<br>";
			           	if(($old_yval-$yval) == -12)
			           	{
			           		$htg_cell = 12;
			           		$cell_up = 12;
			           	}
			           	// print_r($yval);
			           	// print_r("<br>");

			           	$this->SetXY($xval+50,$yval-$cell_up);
			           	// $this->Ln();
			        } 
			        else if($i==1)          // N Qty
			        {
			        	 $tot_nqty += ($value[16] == "") ? 0 : $value[16];
			        	 $group_tot_nqty += ($value[16] == "") ? 0 : $value[16];
			           	$this->Cell(15,$htg_cell,$value[16],1,0,'R'); 
			        }
			        else if($i==2)			//N rate
			        {
			        	$tot_nrate += ($value[17] == "") ? 0 : $value[17];
			        	$group_tot_nrate += ($value[17] == "") ? 0 : $value[17];
			           	$this->Cell(15,$htg_cell,$value[17],1,0,'R');   
			        }
			        else if($i==3)			// N Amount
			        {
			        	$tot_namt += ($value[18] == "") ? 0 : $value[18];
			        	$group_tot_namt += ($value[18] == "") ? 0 : $value[18];
			           	$this->Cell(17,$htg_cell,$value[18],1,0,'R');   
			        }
			        else if($i==4)			// Closing Price
			        {
			        	// $tot_closing_price += ($value[19] == "") ? 0 : $value[19];
			        	// $group_tot_closing_price += ($value[19] == "") ? 0 : $value[19];
			           	$this->Cell(12,$htg_cell,$value[19],1,0,'R');   
			        }
			        else if($i==5)			// Profit/Loss
			        {
			        	$tot_p_l += ($value[1] == "") ? 0 : $value[1];
			        	$group_tot_p_l += ($value[1] == "") ? 0 : $value[1];
			           	$this->Cell(17,$htg_cell,$value[1],1,0,'R');   
			        }
			        else if($i==6)			// Buy Qty
			        {
			        	$tot_bqty += ($value[2] == "") ? 0 : $value[2];
			        	$group_tot_bqty += ($value[2] == "") ? 0 : $value[2];
			           	$this->Cell(15,$htg_cell,$value[2],1,0,'R');   
			        }
			        else if($i==7)			//Buy Rate
			        {
			        	$tot_brate += ($value[3] == "") ? 0 : $value[3];
			        	$group_tot_brate += ($value[3] == "") ? 0 : $value[3];
		           	    $this->Cell(13,$htg_cell,$value[3],1,0,'R');   
			        }
			        else if($i==8)			// Buy Amount
			        {
			        	$tot_bamt += ($value[4] == "") ? 0 : $value[4];
			        	$group_tot_bamt += ($value[4] == "") ? 0 : $value[4];
			           	$this->Cell(19,$htg_cell,$value[4],1,0,'R');   
			        }
			        else if($i==9)			// Sale Qty
			        {
			        	$tot_sqty += ($value[5] == "") ? 0 : $value[5];
			        	$group_tot_sqty += ($value[5] == "") ? 0 : $value[5];
			           	$this->Cell(15,$htg_cell,$value[5],1,0,'R');   
			        }
			        else if($i==10)			// Sale Rate
			        {
			        	$tot_srate += ($value[7] == "") ? 0 : $value[7];
			        	$group_tot_srate += ($value[7] == "") ? 0 : $value[7];
			           	$this->Cell(14,$htg_cell,$value[7],1,0,'R');   
			        }
			        else if($i==11)			// Sale Amount
			        {
			        	$tot_samt += ($value[6] == "") ? 0 : $value[6];
			        	$group_tot_samt += ($value[6] == "") ? 0 : $value[6];
			           	$this->Cell(19,$htg_cell,$value[6],1,0,'R');   
			        }
			        else if($i==12)			// Short Term						
			        {
			        	$tot_s_term += ($value[9] == "") ? 0 : $value[9];
			        	$group_tot_s_term += ($value[9] == "") ? 0 : $value[9];
			           	$this->Cell(15,$htg_cell,$value[9],1,0,'R');   
			        }
			        else if($i==13)			// Long Term
			        {
			        	$tot_l_term += ($value[8] == "") ? 0 : $value[8];
			        	$group_tot_l_term += ($value[8] == "") ? 0 : $value[8];
			           	$this->Cell(15,$htg_cell,$value[8],1,0,'R');   
			        }
			        else if($i==14)			// Speculation
			        {
			        	// $tot_spec += ($value[10] == "") ? 0 : $value[10];
			        	// $group_tot_spec += ($value[10] == "") ? 0 : $value[10];
			           	$this->Cell(13,$htg_cell,$value[10],1,0,'R');   
			        }
			        else if($i==15)			// Lower Amount
			        {
			        	$tot_lower_amt += ($value[12] == "") ? 0 : $value[12];
			        	$group_tot_lower_amt += ($value[12] == "") ? 0 : $value[12];
			           	$this->Cell(19,$htg_cell,$value[12],1,0,'R');   
			        }

			    }

			    $this->Ln();
	        }   
	        	$this->SetFont('Arial','',6);
			    $this->Cell(50,6,"Profit / Loss ",1,0,'L');
			    $this->Cell(15,6,number_format((float)$group_tot_nqty, 2, '.', ','),1,0,'R');
			    $this->Cell(15,6,number_format((float)$group_tot_nrate, 2, '.', ','),1,0,'R');
			    $this->Cell(17,6,number_format((float)$group_tot_namt, 2, '.', ','),1,0,'R');
			    $this->Cell(12,6,"",1,0,'R');
			    $this->Cell(17,6,number_format((float)$group_tot_p_l, 2, '.', ','),1,0,'R');
			    $this->Cell(15,6,number_format((float)$group_tot_bqty, 2, '.', ','),1,0,'R');
			    $this->Cell(13,6,number_format((float)$group_tot_brate, 2, '.', ','),1,0,'R');
			    $this->Cell(19,6,number_format((float)$group_tot_bamt, 2, '.', ','),1,0,'R');
			    $this->Cell(15,6,number_format((float)$group_tot_sqty, 2, '.', ','),1,0,'R');
			    $this->Cell(14,6,number_format((float)$group_tot_srate, 2, '.', ','),1,0,'R');
			    $this->Cell(19,6,number_format((float)$group_tot_samt, 2, '.', ','),1,0,'R');
			    $this->Cell(15,6,number_format((float)$group_tot_s_term, 2, '.', ','),1,0,'R');
			    $this->Cell(15,6,number_format((float)$group_tot_l_term, 2, '.', ','),1,0,'R');
			    $this->Cell(13,6,"",1,0,'R');
			    $this->Cell(19,6,number_format((float)$group_tot_lower_amt, 2, '.', ','),1,0,'R');
			    $this->Ln();

	   	}

		// total
	    $this->SetFont('Arial','B',6);
	    $this->Cell(50,6,"Total Profit/Loss",1,0,'C');
	    $this->Cell(15,6,number_format((float)$tot_nqty, 2, '.', ','),1,0,'R');
	    $this->Cell(15,6,number_format((float)$tot_nrate, 2, '.', ','),1,0,'R');
	    $this->Cell(17,6,number_format((float)$tot_namt, 2, '.', ','),1,0,'R');
	    $this->Cell(12,6,"",1,0,'R');
	    $this->Cell(17,6,number_format((float)$tot_p_l, 2, '.', ','),1,0,'R');
	    $this->Cell(15,6,number_format((float)$tot_bqty, 2, '.', ','),1,0,'R');
	    $this->Cell(13,6,number_format((float)$tot_brate, 2, '.', ','),1,0,'R');
	    $this->Cell(19,6,number_format((float)$tot_bamt, 2, '.', ','),1,0,'R');
	    $this->Cell(15,6,number_format((float)$tot_sqty, 2, '.', ','),1,0,'R');
	    $this->Cell(14,6,number_format((float)$tot_srate, 2, '.', ','),1,0,'R');
	    $this->Cell(19,6,number_format((float)$tot_samt, 2, '.', ','),1,0,'R');
	    $this->Cell(15,6,number_format((float)$tot_s_term, 2, '.', ','),1,0,'R');
	    $this->Cell(15,6,number_format((float)$tot_l_term, 2, '.', ','),1,0,'R');
	    $this->Cell(13,6,"",1,0,'R');
	    $this->Cell(19,6,number_format((float)$tot_lower_amt, 2, '.', ','),1,0,'R');
	    $this->Ln();


	}

	// Page footer
	function Footer()
	{
		
		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		
		// Page number
		$this->cell(0,16,'Income Tax Page '.$this->PageNo().'/{nb}',0,0,'C');	

	}

}

$pdf = new PDF();
$pdf->AliasNbPages(); //Count Number of Page on footer
// $pdf->isFinished = true;
// add a page
$pdf->AddPage('L'); // If you need Landscap n just write ('L')...this 

$pdf->SetFont('Arial','B', 12);
//$pdf->SetTextColor(255, 0, 0);
$pdf->SetTextColor(0, 0, 0);

$pdf -> Line(10, 42, 288, 42);   //__
$pdf -> Line(10, 10, 10, 42);		// |...
$pdf -> Line(10, 10, 288, 10);   // --
$pdf -> Line(288, 10, 288, 42);     // ...|

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


$pdf->SetFont('Arial','', 9);
date_default_timezone_set('Asia/Kolkata');
$pdf->SetXY(140, 15);
$pdf->Cell(25,4,"Annual P&L Summary ".date('d/m/Y'),0);

$pdf->SetXY(140, 19);
$pdf->Cell(25,4,"CLIENT CODE :");

$pdf->SetXY(164, 21);  //CLIENT CODE
$pdf->write(0,$back_data[0][0]);

$pdf->SetXY(140, 25); // CLIENT NAME
$pdf->write(0,$back_data[0][13]);

$pdf->SetXY(140, 27);
$pdf->Cell(25,4,"BRANCH CODE :");

$pdf->SetXY(166, 29); // Branch Code
$pdf->write(0,$branchcode);

// $pdf->SetXY(140, 27);
// $pdf->Cell(25,4,"BRANCHCODE :");

// $pdf->SetXY(165, 29); // Branch Code
// $pdf->write(0,$back_data[0][10]);

$pdf->Image('arham_logo.jpg',240,19,45);

// $pdf->Cell(0,10,'ARHAM SHARE CONSULTANT PVT. LTD.',0,0,'L');

// $pdf -> Line(10, 42, 292, 42); 
// $pdf -> Line(10, 48, 10, 205);		
// $pdf -> Line(10, 205, 292, 205);  
// $pdf -> Line(292, 205, 292, 48); 

$pdf->SetFont('Arial','', 10);

// $pdf->ln(12);
// $pdf->Cell(0,0,"Holding Statment As on 19/11/2020",0,0,'L');

$pdf->ln(15); //FULL TABLE LINE

$pdf->ln(5); //TABLE SPACING

$header = array('Scrip', 'N Qty', 'N Rate', 'N Amount', 'Cl Rate', 'Profit/Loss', 'Buy Qty', 'Buy Rate', 'Buy Amount', 'Sale Qty', 'Sale Rate', 'Sale Amount', 'Short Term', 'Long Term', 'Speculation', 'Lower Amount');

// Data loading
$pdf->SetFont('Arial','B',13);

// $data = $pdf->LoadData('Holdings.txt');

$pdf->BasicTable($header,$group);
}

// $pdf->isFinished = true;

$pdf->Output('D', $_SESSION['Arham_User_Session_Data'][9].'_Income_Tax.'.'pdf');

?>
