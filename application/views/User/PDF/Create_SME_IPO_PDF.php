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
		// print_r($row);
		$client_code_array = array($row[0]);
		$trading_user=$_SESSION['No_of_client_list'];
		$ses_client_code_new=0;
		$result1=[];

		foreach ($trading_user as $people) {

					$ses_client_code_new = array($people['TRADING_CLIENT_ID']??$people['TRADING CLIENT ID']);
					$result2=array_intersect($client_code_array,$ses_client_code_new);
					if(empty($result2))
					{

					}
					else
					{
						$result1[]=$result2;
					}
		
		}
		

		foreach ($result1 as $key => $value) 
		{
			if(!empty($value))
			{
				$sql = "select * from DP_CLIENTMASTER where UCC='$value[0]' or DPID='$value[0]'";
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

$pdf->SetXY(146, 22);
$pdf->Write(0,$row[1]);  //Application code

$pdf->SetFont('Helvetica','', 8);
$setx = 116.5;
$sety = 33.5;
$inm = 1;
$cname = str_split($ipo_pdf_data[0]['CLIENTNAME']);  //print_r($cname);
foreach ($cname as $value) 
{
	if($inm >= 16 && $inm <= 16)
	{
		$sety += 5;	
		$setx = 103;
	}
	$pdf->SetXY($setx,$sety);
	$pdf->Write(0,$value);  // Client Name
	$setx += 5.20;
	$inm++;
}
//  Address
$pdf->SetFont('Helvetica','', 7);
	$setx_add = 112;
	$sety_add = 43;
	$iadd = 0;
	$old_add = explode(' ',$ipo_pdf_data[0]['ADDRESS1'].','.$ipo_pdf_data[0]['ADDRESS2'].','.$ipo_pdf_data[0]['ADDRESS3']); //print_r($old_add); die();
	foreach ($old_add as $value) 
	{
		if ($iadd >= 3 && $iadd <= 3)
		{
			$setx_add = 112;
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
$pdf->SetXY(102, 49.5);
$pdf->Write(0,$city_state);


$pdf->SetXY(146, 49.5);
$pdf->Write(0,$ipo_pdf_data[0]['EMAILID']);  // Email ID

$pdf->SetFont('Helvetica','', 8);
$mob = str_split($ipo_pdf_data[0]['MOBILE']);
$pdf->SetXY(137, 54);
$pdf->Write(0,$mob[0]);  // Mobile No 0

$pdf->SetXY(143, 54);
$pdf->Write(0,$mob[1]);  // Mobile No 1

$pdf->SetXY(148, 54);
$pdf->Write(0,$mob[2]);  // Mobile No 2

$pdf->SetXY(153, 54);
$pdf->Write(0,$mob[3]);  // Mobile No 3

$pdf->SetXY(158, 54);
$pdf->Write(0,$mob[4]);  // Mobile No 4

$pdf->SetXY(163, 54);
$pdf->Write(0,$mob[5]);  // Mobile No 5

$pdf->SetXY(168, 54);
$pdf->Write(0,$mob[6]);  // Mobile No 6

$pdf->SetXY(174, 54);
$pdf->Write(0,$mob[7]);  // Mobile No 7

$pdf->SetXY(179, 54);
$pdf->Write(0,$mob[8]);  // Mobile No 8

$pdf->SetXY(184, 54);
$pdf->Write(0,$mob[9]);  // Mobile No 9

// PAN
$pdf->SetFont('Helvetica','', 12);
$pan = str_split($ipo_pdf_data[0]['PAN']);
$pdf->SetXY(103, 65);
$pdf->Write(0,$pan[0]);  // PAN No 0

$pdf->SetXY(112, 65);
$pdf->Write(0,$pan[1]);  // PAN No 1

$pdf->SetXY(121, 65);
$pdf->Write(0,$pan[2]);  // PAN No 2

$pdf->SetXY(130, 65);
$pdf->Write(0,$pan[3]);  // PAN No 3

$pdf->SetXY(139, 65);
$pdf->Write(0,$pan[4]);  // PAN No 4

$pdf->SetXY(148, 65);
$pdf->Write(0,$pan[5]);  // PAN No 5

$pdf->SetXY(157, 65);
$pdf->Write(0,$pan[6]);  // PAN No 6

$pdf->SetXY(165, 65);
$pdf->Write(0,$pan[7]);  // PAN No 7

$pdf->SetXY(175, 65);
$pdf->Write(0,$pan[8]);  // PAN No 8

$pdf->SetXY(183, 65);
$pdf->Write(0,$pan[9]);  // PAN No 9

$boid = str_split($ipo_pdf_data[0]['DPID']);
$pdf->SetXY(12, 75);
$pdf->Write(0,$boid[0]);  // BOID 0

$pdf->SetXY(20, 75);
$pdf->Write(0,$boid[1]);  // BOID 1

$pdf->SetXY(29, 75);
$pdf->Write(0,$boid[2]);  // BOID 2

$pdf->SetXY(39, 75);
$pdf->Write(0,$boid[3]);  // BOID 3

$pdf->SetXY(46, 75);
$pdf->Write(0,$boid[4]);  // BOID 4

$pdf->SetXY(55, 75);
$pdf->Write(0,$boid[5]);  // BOID 5

$pdf->SetXY(64, 75);
$pdf->Write(0,$boid[6]);  // BOID 6

$pdf->SetXY(73, 75);
$pdf->Write(0,$boid[7]);  // BOID 7

$pdf->SetXY(82, 75);
$pdf->Write(0,$boid[8]);  // BOID 8

$pdf->SetXY(91, 75);
$pdf->Write(0,$boid[9]);  // BOID 9

$pdf->SetXY(99, 75);
$pdf->Write(0,$boid[10]);  // BOID 10

$pdf->SetXY(108, 75);
$pdf->Write(0,$boid[11]);  // BOID 11

$pdf->SetXY(117, 75);
$pdf->Write(0,$boid[12]);  // BOID 12

$pdf->SetXY(126, 75);
$pdf->Write(0,$boid[13]);  // BOID 13

$pdf->SetXY(135, 75);
$pdf->Write(0,$boid[14]);  // BOID 14

$pdf->SetXY(143, 75);
$pdf->Write(0,$boid[15]);  // BOID 15

$pdf->SetFont('Helvetica','', 8);
// $qtylen = strlen($ipo_pdf_data[0]['Qty']); //print_r($qtylen);
$qty = str_split($ipo_qty); //print_r($qty); // QTY
$set_x = 25;
foreach ($qty as $value) 
{
	$pdf->SetXY($set_x, 106);           
	$pdf->Write(0,$value);            
	$set_x +=6;

}

$pdf->SetFont('Helvetica','B', 9);
$pdf->SetXY(72,106);
$pdf->Write(0,'Cut-Off');

//tick on cdsl
$pdf->Image('check.png',88,68);

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
$setx = 42;
foreach ($Amt as $val) 
{
	$pdf->SetXY($setx, 125);
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
	$pdf->SetXY(103, 126);
	$pdf->Write(0,$amt_to_word);  // Amount in Word 
// }

$pdf->SetFont('Helvetica','', 8);
$accno = str_split($ipo_pdf_data[0]['BANK_ACCOUNTNO']);
$setx = 24;
foreach ($accno as $val) 
{
	$pdf->SetXY($setx, 131);
	$pdf->Write(0,$val);  // Bank Account NO.0
	$setx +=4.7;
}

$pdf->SetXY(36, 136);
$pdf->Write(0,$ipo_pdf_data[0]['BANK_NAME']);  // Bank Name

//Current Date
// date_default_timezone_set('Asia/Kolkata');
// $currentdate = date('dmy');
// $pdf->SetXY(21,272);
// $pdf->SetXY(0,$currentdate);

$pdf->SetFont('Helvetica','', 15);
$pdf->SetXY(146, 191);
$pdf->Write(0,$row[1]);  // Application No.

$setx = 19;
$boid1 = str_split($ipo_pdf_data[0]['DPID']);
foreach ($boid1 as $value) 
{
	$pdf->SetXY($setx, 205);
	$pdf->Write(0,$value);  // BOID
	$setx +=6.8;
}

$setx = 127;
$pan1 = str_split($ipo_pdf_data[0]['PAN']);
foreach ($pan1 as $valu) 
{
	$pdf->SetXY($setx, 205);
	$pdf->Write(0,$valu);  // PAN No 
	$setx +=6.4;
}


$pdf->SetFont('Helvetica','', 7);
$pdf->SetXY(43, 212);
$pdf->Write(0,$ipo_amount);  // Amount in Figure

$pdf->SetXY(106, 212);
$pdf->Write(0,$ipo_pdf_data[0]['BANK_ACCOUNTNO']);  // Bank Account NO.

$pdf->SetXY(36, 216);
$pdf->Write(0,$ipo_pdf_data[0]['BANK_NAME']);  // Bank Name

$pdf->SetXY(42, 222);
$pdf->Write(0,$ipo_pdf_data[0]['CLIENTNAME']);  // Client Name

$pdf->SetXY(35, 227);
$pdf->Write(0,$ipo_pdf_data[0]['MOBILE']);  // Mobile No

$pdf->SetXY(81, 227);
$pdf->Write(0,$ipo_pdf_data[0]['EMAILID']);  // Email ID

$pdf->SetXY(42, 241);
$pdf->Write(0,$ipo_qty);  // QTY

$pdf->SetFont('Helvetica','B', 9);
$pdf->SetXY(38, 245);
$pdf->Write(0,'Cut-Off');  // Cuttof price

$pdf->SetFont('Helvetica','', 6);
$pdf->SetXY(42, 250);
$pdf->Write(0,$ipo_amount);  // Amount in Figure

$pdf->SetXY(45, 256);
$pdf->Write(0,$ipo_pdf_data[0]['BANK_ACCOUNTNO']);  // Bank Account NO.

$pdf->SetXY(38, 260);
$pdf->Write(0,$ipo_pdf_data[0]['BANK_NAME']);  // Bank Name

$pdf->SetFont('Helvetica','', 6);
$pdf->SetXY(131, 237);
$pdf->Write(0,$ipo_pdf_data[0]['CLIENTNAME']);  // Client Name

$pdf->SetXY(88, 243);
$pdf->Write(0,$ipo_pdf_data[0]['DPID']);  // BOID

$pdf->SetXY(88, 246);
$pdf->Write(0,$ipo_pdf_data[0]['PAN']);  // PAN No 

$pdf->SetFont('Helvetica','', 9);
$pdf->SetXY(21, 271);
$pdf->Write(0,$ipo_pdf_data[0]['UCC']);  // UCC Code.

$pdf->SetFont('Helvetica','', 15);
$pdf->SetXY(146, 258);
$pdf->Write(0,$row[1]);  // Application No.

$nm = $row[0]."_".$ipo_name."_SME";


$pdf->SetFont('Helvetica','B', 6);
//Notes:
$pdf->SetXY(88, 283);
$pdf->Write(0,'Please Check Pan,Demat and Bank Detail Before Submit'); 
$pdf->SetXY(88, 286);
$pdf->Write(0,'We are not Responsible for any Print Mistake'); 

$stored_path = "E:/APBackOffice_PDF/Stored_IPO_Data/BSE/";
$pdf->Output('F',$stored_path.$nm.'.pdf');	// Pdf Upload in Folder
// $pdf->Output('I');
// exit;
}
}
}
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
	if(file_exists("temp_sme.zip"))
	{
		unlink("temp_sme.zip");
	}
	$zip = new ZipArchive;
	$tmpFile = "temp_sme.zip";
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
		$stored_path = "E:/APBackOffice_PDF/Stored_IPO_Data/BSE/";
		$file = $stored_path.$nm.'_SME.pdf';
		// print_r($file.$nm.'_SME.pdf');
		// echo "<br>";
		if(file_exists($file))
		{
			$zip->addFile($file,$nm.'.pdf');
		} 
		// $zip->addFile($file,$nm.'_SME.pdf');
		// print_r($nm);
		// echo "<br>";
	}
	// exit();

	$zip->close();
}
else
{
	// echo "<script>alert('Invalid CSV File.');</script>";
	// echo "<script>window.location = '".base_url('HelpDesk/SME_IPO')."'</script>";
	header("location:".base_url()."AP_SME_IPO/abc_test");
	exit();
}
// exit;
header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$ipo_name."_".date('d/m/Y his').'.zip');
header('Content-Length: ' . filesize($tmpFile));
readfile($tmpFile);
exit;
?>