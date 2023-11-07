<?php 
include('number_to_word.php');
use setasign\Fpdi\Fpdi;
require_once('fpdf.php');
require_once('FPDI-2.3.4/src/autoload.php');

$ipo_name = str_replace(' ', '_',$data['sme_ipo_name']);
$ipo_qty = $data['sme_ipo_qty'];
$ipo_price = $data['sme_ipo_price'];

$ipo_amount = $data['sme_ipo_Amount'];
// print_r($data); die;


$csv = $_FILES['sme_ipo_file']['tmp_name'];

	$handle = fopen($csv,"r");

	$check_file_get = 0;
	$KYC_db = $this->load->database('AP_No_Of_Client', TRUE);
	while (($row = fgetcsv($handle, 10000, ",")) != FALSE) //get row vales
	{
		// $KYC_db = $this->load->database('KYC_db', TRUE);

		$sql = "select * from DP_CLIENTMASTER where UCC='$row[0]' or DPID='$row[0]'";
		$ipo_pdf_data = $KYC_db->query($sql);
		// print_r($ipo_pdf_data);
		// exit;
		if(!is_object($ipo_pdf_data))
		{
			continue;
		}

		$ipo_pdf_data =  $ipo_pdf_data->result_array();
		// print_r($ipo_pdf_data);
		// die();
		if(empty($ipo_pdf_data))
		{
			continue;
		}

		$check_file_get++;


		// foreach ($client_code_array as $key => $value) 
		// {
		// 	if(!empty($value))
		// 	{	
		// 		// print_r($value);
		// 		$sql = "select * from DP_CLIENTMASTER where UCC='$value[0]'";
		// 		$ipo_pdf_data = $KYC_db->query($sql);
		// 		// print_r($ipo_pdf_data);
		// 		// exit;
		// 		if(!is_object($ipo_pdf_data))
		// 		{
		// 			continue;
		// 		}

		// 		$ipo_pdf_data =  $ipo_pdf_data->result_array();
		// 		// print_r($ipo_pdf_data);
		// 		// die();
		// 		if(empty($ipo_pdf_data))
		// 		{
		// 			continue;
		// 		}

		// 		$check_file_get++;
		// echo "<pre>";
	// 	print_r($row[0]);
	// 	echo "<br>";
	// 	print_r($ipo_pdf_data);
	// 	echo "<br>";
	// 	echo "<br>";
	// }
	// 	die();
	// 	if(1 == 1)
	// 	{
// print_r($data);

$pdf = new Fpdi();

$pdf->setAutoPageBreak(false);
$PDF_MARGIN_LEFT = 00;
$PDF_MARGIN_TOP = 00;
$PDF_MARGIN_RIGHT = 3;
$pdf->SetMargins($PDF_MARGIN_LEFT, $PDF_MARGIN_TOP, $PDF_MARGIN_RIGHT);

// add a page
$pdf->AddPage();
$path = '//192.168.102.100\e\usermanagement\IPO_PDF/'.$ipo_name.'_SME.pdf';
// print_r($ipo_name); die;
if(!file_exists($path))
{
	$this->session->set_userdata('APBackOffice_danger_alert',"PDF is not Found.");
	redirect(base_url('AP_SME_IPO'));
}
// $pdf->setSourceFile('//192.168.102.100\e\usermanagement\IPO_PDF/DATAPATTENS.pdf');
$pdf->setSourceFile($path);


$tplIdx = $pdf->importPage(1);
$pdf->useTemplate($tplIdx);

//set the source file
// $page_count = $pdf->setSourceFile('E:\BackOfficePDF\Update.pdf');
$pdf->SetFont('Helvetica','', 15);
$pdf->SetTextColor(0, 0, 0);

$pdf->SetXY(158, 18);
$pdf->Write(0,$row[1]);  //Application code

$pdf->SetFont('Helvetica','', 8);
$setx = 121;
$sety = 38;
$inm = 1;
$cname = str_split($ipo_pdf_data[0]['CLIENTNAME']);  //print_r($cname);
foreach ($cname as $value) 
{
	if($inm >= 15 && $inm <= 15)
	{
		$sety += 5;	
		$setx = 108;
	}
	$pdf->SetXY($setx,$sety);
	$pdf->Write(0,$value);  // Client Name
	$setx += 6;
	$inm++;
}
//  Address
$pdf->SetFont('Helvetica','', 7);
	$setx_add = 120;
	$sety_add = 47;
	$iadd = 0;
	$old_add = explode(' ',$ipo_pdf_data[0]['ADDRESS1'].','.$ipo_pdf_data[0]['ADDRESS2'].','.$ipo_pdf_data[0]['ADDRESS3']); 
	// print_r($old_add); die();
	foreach ($old_add as $value) 
	{
		if ($iadd >= 3 && $iadd <= 3)
		{
			$setx_add = 170;
			$sety_add = 44+3; 
		}
		$pdf->SetXY($setx_add, $sety_add);
		$pdf->Write(0,$value);
		$setx_add = $pdf->GetX();
		$setx_add += 1;
		$iadd++;
		// break;
		// echo "<br>";
	}
// City,State,pincode
$city_state = $ipo_pdf_data[0]['CITY'].",".$ipo_pdf_data[0]['STATE'].",".$ipo_pdf_data[0]['PINCODE'];
$pdf->SetXY(108, 51);
$pdf->Write(0,$city_state);


$pdf->SetXY(155, 51);
$pdf->Write(0,$ipo_pdf_data[0]['EMAILID']);  // Email ID

$pdf->SetFont('Helvetica','', 8);
$mob = str_split($ipo_pdf_data[0]['MOBILE']);
$pdf->SetXY(149, 55);
$pdf->Write(0,$mob[0]);  // Mobile No 0

$pdf->SetXY(155, 55);
$pdf->Write(0,$mob[1]);  // Mobile No 1

$pdf->SetXY(160, 55);
$pdf->Write(0,$mob[2]);  // Mobile No 2

$pdf->SetXY(166, 55);
$pdf->Write(0,$mob[3]);  // Mobile No 3

$pdf->SetXY(173, 55);
$pdf->Write(0,$mob[4]);  // Mobile No 4

$pdf->SetXY(178, 55);
$pdf->Write(0,$mob[5]);  // Mobile No 5

$pdf->SetXY(184, 55);
$pdf->Write(0,$mob[6]);  // Mobile No 6

$pdf->SetXY(189, 55);
$pdf->Write(0,$mob[7]);  // Mobile No 7

$pdf->SetXY(195, 55);
$pdf->Write(0,$mob[8]);  // Mobile No 8

$pdf->SetXY(201, 55);
$pdf->Write(0,$mob[9]);  // Mobile No 9

// PAN
$pdf->SetFont('Helvetica','', 12);
$pan = str_split($ipo_pdf_data[0]['PAN']);
$pdf->SetXY(108, 67);
$pdf->Write(0,$pan[0]);  // PAN No 0

$pdf->SetXY(119, 67);
$pdf->Write(0,$pan[1]);  // PAN No 1

$pdf->SetXY(130, 67);
$pdf->Write(0,$pan[2]);  // PAN No 2

$pdf->SetXY(140, 67);
$pdf->Write(0,$pan[3]);  // PAN No 3

$pdf->SetXY(150, 67);
$pdf->Write(0,$pan[4]);  // PAN No 4

$pdf->SetXY(160, 67);
$pdf->Write(0,$pan[5]);  // PAN No 5

$pdf->SetXY(170, 67);
$pdf->Write(0,$pan[6]);  // PAN No 6

$pdf->SetXY(180, 67);
$pdf->Write(0,$pan[7]);  // PAN No 7

$pdf->SetXY(190, 67);
$pdf->Write(0,$pan[8]);  // PAN No 8

$pdf->SetXY(200, 67);
$pdf->Write(0,$pan[9]);  // PAN No 9

$boid = str_split($ipo_pdf_data[0]['DPID']);
$pdf->SetXY(6, 80);
$pdf->Write(0,$boid[0]);  // BOID 0

$pdf->SetXY(16, 80);
$pdf->Write(0,$boid[1]);  // BOID 1

$pdf->SetXY(26, 80);
$pdf->Write(0,$boid[2]);  // BOID 2

$pdf->SetXY(36, 80);
$pdf->Write(0,$boid[3]);  // BOID 3

$pdf->SetXY(46, 80);
$pdf->Write(0,$boid[4]);  // BOID 4

$pdf->SetXY(55, 80);
$pdf->Write(0,$boid[5]);  // BOID 5

$pdf->SetXY(66, 80);
$pdf->Write(0,$boid[6]);  // BOID 6

$pdf->SetXY(75, 80);
$pdf->Write(0,$boid[7]);  // BOID 7

$pdf->SetXY(86, 80);
$pdf->Write(0,$boid[8]);  // BOID 8

$pdf->SetXY(96, 80);
$pdf->Write(0,$boid[9]);  // BOID 9

$pdf->SetXY(106, 80);
$pdf->Write(0,$boid[10]);  // BOID 10

$pdf->SetXY(116, 80);
$pdf->Write(0,$boid[11]);  // BOID 11

$pdf->SetXY(126, 80);
$pdf->Write(0,$boid[12]);  // BOID 12

$pdf->SetXY(136, 80);
$pdf->Write(0,$boid[13]);  // BOID 13

$pdf->SetXY(146, 80);
$pdf->Write(0,$boid[14]);  // BOID 14

$pdf->SetXY(156, 80);
$pdf->Write(0,$boid[15]);  // BOID 15

$pdf->SetFont('Helvetica','', 8);
// $qtylen = strlen($ipo_pdf_data[0]['Qty']); //print_r($qtylen);
$qty = str_split($ipo_qty); //print_r($qty); // QTY
$set_x = 22;
foreach ($qty as $value) 
{
	$pdf->SetXY($set_x, 111);           
	$pdf->Write(0,$value);            
	$set_x +=6;

}

$pdf->SetFont('Helvetica','B', 9);
$pdf->SetXY(73,111);
$pdf->Write(0,'Cut-Off');

//tick on cdsl
$pdf->Image('check.png',91,72.5);

$pdf->SetFont('Helvetica','', 6);
// if($sub_category == "HNI")
// {
// 	$qty = str_split(intval($ipo_price)); //print_r($qty); // Price for HNI
// 	$set_x = 74;
// 	foreach ($qty as $value) 
// 	{
// 		$pdf->SetXY($set_x, 105.5);           
// 		$pdf->Write(0,$value);            
// 		$set_x +=6;

// 	}
// }

$Amt = str_split($ipo_amount);  // Amount in Figure
$setx = 40;
foreach ($Amt as $val) 
{
	$pdf->SetXY($setx, 131);
	$pdf->Write(0,$val);  
	$setx +=4.5;
}
$pdf->SetFont('Helvetica','', 6);
// if($sub_category != "HNI")
// {
	$amt_to_word = str_replace("\r", "", AmountInWords($ipo_amount));
	$amt_to_word = str_replace("\n", "", $amt_to_word);
	$amt_to_word = preg_replace('!\s+!', ' ', $amt_to_word);
	// print(json_encode($amt_to_word));
	// exit;
	// $pdf->SetXY(21, 270);
	$pdf->SetXY(103, 130);
	$pdf->Write(0,$amt_to_word);  // Amount in Word 
// }

$pdf->SetFont('Helvetica','', 8);
$accno = str_split($ipo_pdf_data[0]['BANK_ACCOUNTNO']);
$setx = 20;
foreach ($accno as $val) 
{
	$pdf->SetXY($setx, 137);
	$pdf->Write(0,$val);  // Bank Account NO.0
	$setx +=5.3;
}

$pdf->SetXY(36, 142);
$pdf->Write(0,$ipo_pdf_data[0]['BANK_NAME']);  // Bank Name

//Current Date
// date_default_timezone_set('Asia/Kolkata');
// $currentdate = date('dmy');
// $pdf->SetXY(21,272);
// $pdf->SetXY(0,$currentdate);

$pdf->SetFont('Helvetica','', 15);
$pdf->SetXY(160, 200);
$pdf->Write(0,$row[1]);  // Application No.

$setx = 12;
$boid1 = str_split($ipo_pdf_data[0]['DPID']);
foreach ($boid1 as $value) 
{
	$pdf->SetXY($setx, 215);
	$pdf->Write(0,$value);  // BOID
	$setx +=7.7;
}

$setx = 137;
$pan1 = str_split($ipo_pdf_data[0]['PAN']);
foreach ($pan1 as $valu) 
{
	$pdf->SetXY($setx, 215);
	$pdf->Write(0,$valu);  // PAN No 
	$setx +=7;
}


$pdf->SetFont('Helvetica','', 7);
$pdf->SetXY(40, 225);
$pdf->Write(0,$ipo_amount);  // Amount in Figure

$pdf->SetXY(100, 225);
$pdf->Write(0,$ipo_pdf_data[0]['BANK_ACCOUNTNO']);  // Bank Account NO.

$pdf->SetXY(34, 230);
$pdf->Write(0,$ipo_pdf_data[0]['BANK_NAME']);  // Bank Name

$pdf->SetXY(35, 235);
$pdf->Write(0,$ipo_pdf_data[0]['CLIENTNAME']);  // Client Name

$pdf->SetXY(35, 240);
$pdf->Write(0,$ipo_pdf_data[0]['MOBILE']);  // Mobile No

$pdf->SetXY(85, 240);
$pdf->Write(0,$ipo_pdf_data[0]['EMAILID']);  // Email ID

$pdf->SetXY(42, 255);
$pdf->Write(0,$ipo_qty);  // QTY

$pdf->SetFont('Helvetica','B', 9);
$pdf->SetXY(38, 260);
$pdf->Write(0,'Cut-Off');  // Cuttof price

$pdf->SetFont('Helvetica','', 6);
$pdf->SetXY(45, 265);
$pdf->Write(0,$ipo_amount);  // Amount in Figure

$pdf->SetXY(45, 271);
$pdf->Write(0,$ipo_pdf_data[0]['BANK_ACCOUNTNO']);  // Bank Account NO.

$pdf->SetXY(38, 275);
$pdf->Write(0,$ipo_pdf_data[0]['BANK_NAME']);  // Bank Name

$pdf->SetFont('Helvetica','', 6);
$pdf->SetXY(143, 254);
$pdf->Write(0,$ipo_pdf_data[0]['CLIENTNAME']);  // Client Name

$pdf->SetXY(95, 260);
$pdf->Write(0,$ipo_pdf_data[0]['DPID']);  // BOID

$pdf->SetXY(95, 264);
$pdf->Write(0,$ipo_pdf_data[0]['PAN']);  // PAN No 

$pdf->SetFont('Helvetica','', 9);
$pdf->SetXY(21, 282);
$pdf->Write(0,$ipo_pdf_data[0]['UCC']);  // UCC Code.

$pdf->SetFont('Helvetica','', 15);
$pdf->SetXY(165, 275);
$pdf->Write(0,$row[1]);  // Application No.

$nm = $row[0]."_".$ipo_name."_SME";


$pdf->SetFont('Helvetica','B', 6);
//Notes:
$pdf->SetXY(88, 283);
$pdf->Write(0,'Please Check Pan,Demat and Bank Detail Before Submit'); 
$pdf->SetXY(88, 286);
$pdf->Write(0,'We are not Responsible for any Print Mistake'); 

$stored_path = "E:/APBackOffice_PDF/Stored_IPO_Data/NSE/";
$pdf->Output('F',$stored_path.$nm.'.pdf');	// Pdf Upload in Folder
// $pdf->Output('I');
// exit;
}

// exit();
// die();
fclose($handle);

$csv = $_FILES['sme_ipo_file']['tmp_name'];
$handle = fopen($csv,"r");



// $image1 = "http://cdn.screenrant.com/wp-content/uploads/Darth-Vader-voiced-by-Arnold-Schwarzenegger.jpg";
// $image2 = "http://cdn.screenrant.com/wp-content/uploads/Star-Wars-Logo-Art.jpg";

// $files = array($image1, $image2);

// $tmpFile = tempnam('/tmp', '');
// exit;
if($check_file_get != 0)
{
	if(file_exists("temp_nse.zip"))
	{
		unlink("temp_nse.zip");
	}
	$zip = new ZipArchive;
	$tmpFile = "temp_nse.zip";
	$zip->open($tmpFile, ZipArchive::CREATE);
	// foreach ($files as $file) {

	while (($row = fgetcsv($handle, 10000, ",")) != FALSE) //get row vales
	{
		// echo "asdsad";
		$nm = $row[0]."_".$ipo_name; 
		// if($sub_category == "POL")
		// // if($sub_category == "SHA")
		// {
		// 	// $path = '//192.168.102.100\e\usermanagement\IPO_PDF/'.$ipo_name.'_SHAREHOLDER.pdf';
		// 	$nm = $row[0]."_".$ipo_name."_POLHOLDER"; 
		// 	// $nm = $row[0]."_".$ipo_name."_SHAREHOLDER"; 
		// }
		// else if($sub_category == "HNI")
		// {
		// 	// $path = '//192.168.102.100\e\usermanagement\IPO_PDF/'.$ipo_name.'_SHAREHOLDER.pdf';
		// 	$nm = $row[0]."_".$ipo_name."_HNI"; 
		// }
		$stored_path = "E:/APBackOffice_PDF/Stored_IPO_Data/NSE/";
		$file = $stored_path.$nm.'_SME.pdf';
		// print_r($file);
		// echo "<br>";
		$zip->addFile($file,$nm.'_SME.pdf');
		// print_r($nm);
		// echo "<br>";
	}

	$zip->close();
}
else
{
	// echo "<script>alert('Invalid CSV File.');</script>";
	// echo "<script>window.location = '".base_url('AP_SME_IPO')."'</script>";
	// header("location:".base_url()."AP_SME_IPO/abc_test");
	$this->session->set_userdata('APBackOffice_danger_alert',"Invalid Client List OR CSV File Invalid!");
	redirect(base_url('AP_SME_IPO'));
	// exit();
}
// exit;
header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$ipo_name."_".date('d/m/Y his').'.zip');
header('Content-Length: ' . filesize($tmpFile));
readfile($tmpFile);
exit;
?>