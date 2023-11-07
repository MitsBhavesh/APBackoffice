<?php

$columns = $_SESSION['Arham_client_holding_data'][0];
$back_data = $_SESSION['Arham_client_holding_data'][1];
// echo "<pre>";
// print_r($columns);
// print_r($back_data);
// echo "</pre>";
// exit();


use setasign\Fpdi\Fpdi;
require_once('fpdf.php');
require_once('FPDI-2.3.4/src/autoload.php');


class PDF extends FPDF
{
// Simple table
	function BasicTable($header, $back_data)
	{
	    // Header
	    $i = 0;
	    $this->SetFont('Arial','B',8);  
	    foreach($header as $col)
	    {
	        if($i==1)
	        {
	           	$this->Cell(65,6,$col,1);   //Increse the header cell weight, height,...,boder
	        }
	        else if($i==0)
	       	{
	       		$this->Cell(15,6,$col,1);
	       	}
	        else if($i==2)
	       	{
	       		$this->Cell(26,6,$col,1);
	       	}
	        else if($i==3)
	       	{
	       		$this->Cell(18,6,$col,1);
	       	}
	       	else if($i==4)
	       	{
	       		$this->Cell(18,6,$col,1);
	       	}
	       	else if($i==5)
	       	{
	       		$this->Cell(18,6,$col,1);
	       	}
	       	else if($i==6)
	       	{
	       		$this->Cell(18,6,$col,1);
	       	}
	       	else if($i==7)
	       	{
	       		$this->Cell(18,6,$col,1);
	       	}
	       	else if($i==8)
	       	{
	       		$this->Cell(18,6,$col,1);
	       	}
	       	else if($i==9)
	       	{
	       		$this->Cell(18,6,$col,1);
	       	}
	        else
	        {	
	           	$this->Cell(23,6,$col,1);
	        }
	        $i++;
	    }
	    $this->Ln();
	    $this->SetFont('Arial','',8);
	    // Data
		   
	      GLOBAL $poa_total;
	      GLOBAL $nonpoa_total;
	      GLOBAL $broker_total;
	      GLOBAL $collatral_total;
	      GLOBAL $in_short_total;
	      GLOBAL $out_short_total;
	      GLOBAL $net_qty_total;
	      GLOBAL $closing_price_total;
	      GLOBAL $market_value_total;
	       $j = 2;
	       foreach ($back_data as $data_row) {
	       	$str_len = 0;
		    $str_htg = 6;

		    if($str_len == 0)
			    {
			    	$str_len = strlen($data_row[26]);
			    	if($str_len > 10)
			    	{		        			
				   		$str_len = $str_len / 10;
				   		$str_htg = $str_len * 4;
				   		// echo "<script>alert('".$data_row[26]."')</script>"; 	
				   	}
			    	
			    }
	        $i = -1;
	        
	       	foreach ($data_row as $value) {
	       	// echo "<script>alert('".$data_row."')</script>"; 	
	       		if($this->PageNo() == $j){
	       			 $i_hed = 0;
				    $this->SetFont('Arial','B',8);  
				    //$this->Ln();
				    // foreach($header as $col)
				    // {

				    //     if($i_hed==1)
				    //     {
				    //        	$this->Cell(65,6,$col,1);   //Increse the header cell weight, height,...,boder
				    //     }
				    //     else if($i_hed==0)
				    //    	{
				    //    		$this->Cell(15,6,$col,1);
				    //    	}
				    //     else if($i_hed==2)
				    //    	{
				    //    		$this->Cell(26,6,$col,1);
				    //    	}
				    //     else if($i_hed==3)
				    //    	{
				    //    		$this->Cell(18,6,$col,1);
				    //    	}
				    //    	else if($i_hed==4)
				    //    	{
				    //    		$this->Cell(18,6,$col,1);
				    //    	}
				    //    	else if($i_hed==5)
				    //    	{
				    //    		$this->Cell(18,6,$col,1);
				    //    	}
				    //    	else if($i_hed==6)
				    //    	{
				    //    		$this->Cell(18,6,$col,1);
				    //    	}
				    //    	else if($i_hed==7)
				    //    	{
				    //    		$this->Cell(18,6,$col,1);
				    //    	}
				    //    	else if($i_hed==8)
				    //    	{
				    //    		$this->Cell(18,6,$col,1);
				    //    	}
				    //    	else if($i_hed==9)
				    //    	{
				    //    		$this->Cell(18,6,$col,1);
				    //    	}
				    //     else
				    //     {	
				    //        	$this->Cell(23,6,$col,1);
				    //     }
				    //     $i_hed++;
				    // }
				    // $this->Ln();
				    // $j++;
				    // echo "<script>alert('".$j."')</script>";
	       		}
	       		$this->SetFont('Arial','',8);

	        	if($i==1)
	        	{
	            	$this->Cell(65,$str_htg,$data_row[26],1,0,'L');  // Scrip Name
	        	}
	        	else if($i==0)
	        	{
	        		$this->Cell(15,$str_htg,$data_row[28],1,0,'L');  // Scrip
	        	}
	        	else if($i == -1)
	        	{
	        		$this->Cell(0.1,$str_htg,"");
	        	}
	        	else if($i==2)
	        	{
	        		$this->Cell(26,$str_htg,$data_row[9],1,0,'L');   //Isin
	        	}
	        	else if($i==3)					
	        	{
	        		$poa_total += $data_row[32]; 
	        		$this->Cell(18,$str_htg,number_format((float)$data_row[32], 2, '.', ','),1,0,'R');  //POA
	        	}
	        	else if($i==4)
	        	{
	        		$nonpoa_total += $data_row[36];
	        		$this->Cell(18,$str_htg,number_format((float)$data_row[36],2,'.',','),1,0,'R');
	        	}
	        	else if($i==5)
	        	{
	        		$broker_total += $data_row[20];
	        		$this->Cell(18,$str_htg,number_format((float)$data_row[20],2,'.',','),1,0,'R');
	        	}
	        	else if($i==6)
	        	{
	        		$collatral_total += $data_row[29];
	        		$this->Cell(18,$str_htg,number_format((float)$data_row[29],2,'.',','),1,0,'R');
	        	}
	        	else if($i==7)
	        	{
	        		$in_short_total += $data_row[5];
	        		$this->Cell(18,$str_htg,number_format((float)$data_row[5],2,'.',','),1,0,'R');
	        	}
	        	else if($i==8)
	        	{
	        		$out_short_total += $data_row[6];
	        		$this->Cell(18,$str_htg,number_format((float)$data_row[6],2,'.',','),1,0,'R');
	        	}
	        	else if($i==9)
	        	{
	        		$net_qty_total += $data_row[38];
	        		$this->Cell(18,$str_htg,number_format((float)$data_row[38],2,'.',','),1,0,'R');
	        	}
	        	else if($i==10)
	        	{
	        		$closing_price_total += $data_row[30];
	        		$this->Cell(23,$str_htg,number_format((float)$data_row[30],2,'.',','),1,0,'R');
	        	}
	        	else if($i==11)
	        	{	
	        		$market_value_total += $data_row[2];
	            	$this->Cell(23,$str_htg,number_format((float)$data_row[2],2,'.',','),1,0,'R');
	        	}
	        	
	        	$i++;

	        }
	        
	        $this->Ln();

	    }

		//tOTAKL total
	    // $this->Cell(106,6,"tOTTT Total",1,0,'L');
	    // $this->Cell(18,6,number_format((float)$poa_total, 2, '.', ','),1,0,'R');
	    // $this->Cell(18,6,number_format((float)$nonpoa_total, 2, '.', ','),1,0,'R');
	    // $this->Cell(18,6,number_format((float)$broker_total, 2, '.', ','),1,0,'R');
	    // $this->Cell(18,6,number_format((float)$collatral_total, 2, '.', ','),1,0,'R');
	    // $this->Cell(18,6,number_format((float)$in_short_total, 2, '.', ','),1,0,'R');
	    // $this->Cell(18,6,number_format((float)$out_short_total, 2, '.', ','),1,0,'R');
	    // $this->Cell(18,6,number_format((float)$net_qty_total, 2, '.', ','),1,0,'R');
	    // $this->Cell(23,6,number_format((float)$closing_price_total, 2, '.', ','),1,0,'R');
	    // $this->Cell(23,6,number_format((float)$market_value_total, 2, '.', ','),1,0,'R');
	    // $this->Ln();


		//Grand total
	    // $this->Cell(106,6,"Grand Total",1,0,'L');
	    // $this->Cell(18,6,number_format((float)$poa_total, 2, '.', ','),1,0,'R');
	    // $this->Cell(18,6,number_format((float)$nonpoa_total, 2, '.', ','),1,0,'R');
	    // $this->Cell(18,6,number_format((float)$broker_total, 2, '.', ','),1,0,'R');
	    // $this->Cell(18,6,number_format((float)$collatral_total, 2, '.', ','),1,0,'R');
	    // $this->Cell(18,6,number_format((float)$in_short_total, 2, '.', ','),1,0,'R');
	    // $this->Cell(18,6,number_format((float)$out_short_total, 2, '.', ','),1,0,'R');
	    // $this->Cell(18,6,number_format((float)$net_qty_total, 2, '.', ','),1,0,'R');
	    // $this->Cell(23,6,number_format((float)$closing_price_total, 2, '.', ','),1,0,'R');
	    // $this->Cell(23,6,number_format((float)$market_value_total, 2, '.', ','),1,0,'R');
	    // $this->Ln();
		//grand total
	    // $this->Cell(106,6,"Grand Total",1,0,'L');
	    // $this->Cell(18,6,"3,531.00",1,0,'R');
	    // $this->Cell(18,6,"0.00",1,0,'R');
	    // $this->Cell(18,6,"0.00",1,0,'R');
	    // $this->Cell(18,6,"59.00",1,0,'R');
	    // $this->Cell(18,6,"0.00",1,0,'R');
	    // $this->Cell(18,6,"0.00",1,0,'R');
	    // $this->Cell(18,6,"3,590.00",1,0,'R');
	    // $this->Cell(23,6,"4,148.80",1,0,'R');
	    // $this->Cell(23,6,"126,452.40",1,0,'R');
	    // $this->cell(50,6,'vgvggggvgvgvgvgvvgg',1);
	}

	// Page footer
	function Footer()
	{
		// $this->Ln();
 		GLOBAL $poa_total;
	    GLOBAL $nonpoa_total;
	    GLOBAL $broker_total;
	    GLOBAL $collatral_total;
	    GLOBAL $in_short_total;
	    GLOBAL $out_short_total;
	    GLOBAL $net_qty_total;
	    GLOBAL $closing_price_total;
	    GLOBAL $market_value_total;


	    // Total
		$this->Cell(106,6,"Total",1,0,'C');

	   	$this->Cell(18,6,number_format((float)$poa_total, 2, '.', ','),1,0,'R');
	   	$this->Cell(18,6,number_format((float)$nonpoa_total, 2, '.', ','),1,0,'R');
	    $this->Cell(18,6,number_format((float)$broker_total, 2, '.', ','),1,0,'R');
	    $this->Cell(18,6,number_format((float)$collatral_total, 2, '.', ','),1,0,'R');
	    $this->Cell(18,6,number_format((float)$in_short_total, 2, '.', ','),1,0,'R');
	    $this->Cell(18,6,number_format((float)$out_short_total, 2, '.', ','),1,0,'R');
	    $this->Cell(18,6,number_format((float)$net_qty_total, 2, '.', ','),1,0,'R');
	    $this->Cell(23,6,number_format((float)$closing_price_total, 2, '.', ','),1,0,'R');
	    $this->Cell(23,6,number_format((float)$market_value_total, 2, '.', ','),1,0,'R');
	    $this->Ln();

	    //Grand total
	    $this->Cell(106,6,"Grand Total",1,0,'C');
	    $this->Cell(18,6,number_format((float)$poa_total, 2, '.', ','),1,0,'R');
	    $this->Cell(18,6,number_format((float)$nonpoa_total, 2, '.', ','),1,0,'R');
	    $this->Cell(18,6,number_format((float)$broker_total, 2, '.', ','),1,0,'R');
	    $this->Cell(18,6,number_format((float)$collatral_total, 2, '.', ','),1,0,'R');
	    $this->Cell(18,6,number_format((float)$in_short_total, 2, '.', ','),1,0,'R');
	    $this->Cell(18,6,number_format((float)$out_short_total, 2, '.', ','),1,0,'R');
	    $this->Cell(18,6,number_format((float)$net_qty_total, 2, '.', ','),1,0,'R');
	    $this->Cell(23,6,number_format((float)$closing_price_total, 2, '.', ','),1,0,'R');
	    $this->Cell(23,6,number_format((float)$market_value_total, 2, '.', ','),1,0,'R');
	    $this->Ln();

		$this->SetY(-15);
		// Arial italic 8
		$this->SetFont('Arial','I',8);
		
		// Page number
		$this->cell(0,16,'Account Holdings Page '.$this->PageNo().'/{nb}',0,0,'C');
		
			
			// if($this->PageNo() == 2){
			// 	// echo "<script>alert('$this->PageNo()')</script>";
			// 	$this->SetXY(10,200);
			// 	$this->Cell(106,6,"Ishita",1,0,'L');
			// }
			// elseif ($this->PageNo() == 1) {
			// 	$this->SetXY(10,200);
			// 	$this->Cell(106,6,"Hiren",1,0,'L');
			// }
		

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
$pdf->Cell(25,4,"Holding Statment As on ".date('d/m/Y'),0);

$pdf->SetXY(140, 19);
$pdf->Cell(25,4,"CLIENTCODE :");

$pdf->SetXY(164, 21);  //CLIENT CODE
$pdf->write(0,$back_data[0][0]);

$pdf->SetXY(140, 25); // CLIENT NAME
$pdf->write(0,$back_data[0][12]);


$pdf->SetXY(140, 27);
$pdf->Cell(25,4,"BRANCHCODE :");

$pdf->SetXY(165, 29); // Branch Code
$pdf->write(0,$back_data[0][10]);

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

$pdf->ln(4); //TABLE SPACING

$header = array('Scrip', 'N Qty', 'Rate', 'N Amount', 'CI Rate', 'Profit/Loss', 'Buy Qty', 'Buy Rate', 'Buy Amount', 'Sale Qty', 'Sale Rate', 'Sale Amount', 'Short Term', 'Long Term', 'Speculation', 'Lower Amount');

// Data loading
$pdf->SetFont('Arial','B',13);

// $data = $pdf->LoadData('Holdings.txt');

$pdf->BasicTable($header,$back_data);

// $pdf->isFinished = true;

$pdf->Output('I', 'client.pdf');

?>
